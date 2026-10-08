<?php

declare(strict_types=1);

namespace Basaltic;

use Basaltic\Auth\RefreshableTokenProvider;
use Basaltic\Exception\ApiException;
use Basaltic\Exception\TransportException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

final class Transport
{
    public function __construct(private readonly Config $config)
    {
    }

    /**
     * @param array<string, mixed> $operation
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    public function send(
        string $service,
        string $endpoint,
        array $operation,
        array $path,
        mixed $body,
        array $query,
        ?RequestOptions $options,
    ): ResponseInterface {
        $options ??= new RequestOptions();
        $streaming = is_resource($body) || $body instanceof StreamInterface;
        $request = $this->prepare($service, $endpoint, $operation, $path, $body, $query, $options);
        $attempts = $streaming ? 1 : ($options->maxAttempts ?? $this->config->maxAttempts);
        $repeatable = in_array($operation['method'], ['GET', 'HEAD', 'OPTIONS', 'PUT', 'DELETE'], true)
            || $options->idempotencyKey !== null;
        $refreshed = false;
        for ($attempt = 1; $attempt <= $attempts; $attempt++) {
            if ($operation['authenticated']) {
                $provider = $this->config->tokenProvider;
                if ($provider === null) {
                    throw new \LogicException('Anonymous access cannot call an authenticated operation.');
                }
                $request = $request->withHeader('Authorization', 'Bearer ' . $provider->token());
            }
            if (!$streaming && $request->getBody()->isSeekable()) {
                $request->getBody()->rewind();
            }
            try {
                $response = $this->config->httpClient->sendRequest($request);
            } catch (NetworkExceptionInterface) {
                if (!$repeatable || $attempt === $attempts) {
                    throw new TransportException("{$operation['id']}: HTTP transport failed.");
                }
                ($this->config->sleep)($this->backoff($attempt));
                continue;
            } catch (ClientExceptionInterface) {
                // Do not retain a PSR request exception: it can contain bearer tokens and bodies.
                throw new TransportException("{$operation['id']}: HTTP client could not send the request.");
            }
            $status = $response->getStatusCode();
            if ($status >= 200 && $status < 300) {
                return $response;
            }
            if (
                $status === 401 && !$refreshed && $attempt < $attempts && $operation['authenticated']
                && $this->config->tokenProvider instanceof RefreshableTokenProvider
            ) {
                $refreshed = true;
                $this->config->tokenProvider->invalidate();
                $response->getBody()->close();
                continue;
            }
            if ($repeatable && $attempt < $attempts && in_array($status, [429, 500, 502, 503, 504], true)) {
                $delay = $this->retryDelay($attempt, $response->getHeaderLine('Retry-After'));
                if ($delay !== null) {
                    $response->getBody()->close();
                    ($this->config->sleep)($delay);
                    continue;
                }
            }
            try {
                throw ApiException::fromResponse($operation['id'], $response);
            } finally {
                $response->getBody()->close();
            }
        }
        throw new \LogicException('Retry budget exhausted without an outcome.');
    }

    /**
     * @param array<string, mixed> $operation
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    private function prepare(string $service, string $endpoint, array $operation, array $path, mixed $body, array $query, ?RequestOptions $options): RequestInterface
    {
        $options ??= new RequestOptions();
        $url = $this->config->endpoint($service, $endpoint);
        $route = preg_replace_callback('/\{([^}]+)\}/', static function (array $match) use ($path): string {
            $value = $path[$match[1]] ?? '';
            if ($value === '') {
                throw new \InvalidArgumentException('Required path parameter is empty.');
            }
            // A complete path segment is escaped, including slashes inside object keys.
            return str_replace('.', '%2E', rawurlencode($value));
        }, $operation['path']);
        $url .= $route;
        foreach ($operation['required_query'] as $name) {
            if (!array_key_exists($name, $query) || $query[$name] === null) {
                throw new \InvalidArgumentException("Required query parameter {$name} is missing.");
            }
        }
        $encoded = self::encodeQuery($query, $operation['query_encoding']);
        if ($encoded !== '') {
            $url .= '?' . $encoded;
        }
        $headers = ['Accept' => $operation['accept'], 'User-Agent' => self::userAgent()];
        foreach ($options->headers as $name => $value) {
            $headers[$name] = $value;
        }
        foreach ($operation['required_headers'] as $name) {
            if (!array_key_exists(strtolower($name), array_change_key_case($headers))) {
                throw new \InvalidArgumentException("Required header {$name} is missing.");
            }
        }
        $account = $options->accountId ?? $this->config->accountId;
        if ($account !== '') {
            $headers['X-Account-Id'] = $account;
        }
        if ($options->idempotencyKey !== null) {
            $headers['Idempotency-Key'] = $options->idempotencyKey;
        }
        if ($body !== null) {
            $headers['Content-Type'] = $operation['content_type'];
            if ($operation['content_type'] === 'application/json') {
                $body = self::normalizeJson($body, $operation['body_shape']);
                $body = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION);
            } elseif ($operation['content_type'] === 'application/x-www-form-urlencoded') {
                if (!is_array($body)) {
                    throw new \InvalidArgumentException('Form body must be an array.');
                }
                $body = self::encodeQuery($body, []);
            }
        } elseif ($operation['body_required']) {
            throw new \InvalidArgumentException('Request body is required.');
        }
        return new Request($operation['method'], $url, $headers, $body);
    }

    /**
     * Build the authenticated HTTP upgrade request for a caller-owned WebSocket client.
     * No HTTP request or terminal session is opened here.
     * @param array<string, mixed> $operation
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    public function websocket(string $service, string $endpoint, array $operation, array $path, array $query, ?RequestOptions $options): RequestInterface
    {
        $request = $this->prepare($service, $endpoint, $operation, $path, null, $query, $options);
        $provider = $this->config->tokenProvider;
        if ($provider === null) {
            throw new \LogicException('A token provider is required for the serial console.');
        }
        return $request->withHeader('Authorization', 'Bearer ' . $provider->token())
            ->withHeader('Connection', 'Upgrade')->withHeader('Upgrade', 'websocket')
            ->withHeader('Sec-WebSocket-Version', '13')->withHeader('Sec-WebSocket-Key', base64_encode(random_bytes(16)));
    }

    /**
     * @param array<string, mixed> $values
     * @param array<string, array{style: string, explode: bool}> $encodings
     */
    public static function encodeQuery(array $values, array $encodings): string
    {
        $parts = [];
        $scalar = static function (mixed $value): string {
            if (!is_scalar($value)) {
                throw new \InvalidArgumentException('Query and form values must be scalars or lists of scalars.');
            }
            return is_bool($value) ? ($value ? 'true' : 'false') : (string) $value;
        };
        foreach ($values as $key => $value) {
            if ($value === null) {
                continue;
            }
            $keyEncoded = rawurlencode($key);
            if (is_array($value)) {
                $items = array_map($scalar, $value);
                $encoding = $encodings[$key] ?? ['style' => 'form', 'explode' => true];
                if ($encoding['explode']) {
                    foreach ($items as $item) {
                        $parts[] = $keyEncoded . '=' . rawurlencode($item);
                    }
                } else {
                    $delimiter = match ($encoding['style']) {
                        'spaceDelimited' => ' ', 'pipeDelimited' => '|', default => ',',
                    };
                    $parts[] = $keyEncoded . '=' . rawurlencode(implode($delimiter, $items));
                }
            } else {
                $parts[] = $keyEncoded . '=' . rawurlencode($scalar($value));
            }
        }
        return implode('&', $parts);
    }

    /** @param array<string, mixed> $shape */
    private static function normalizeJson(mixed $value, array $shape): mixed
    {
        if ($value === null || (!is_array($value) && !$value instanceof \stdClass)) {
            return $value;
        }
        if (($shape['type'] ?? '') === 'object') {
            $out = new \stdClass();
            foreach ((array) $value as $key => $item) {
                $out->{$key} = self::normalizeJson($item, $shape['properties'][$key] ?? $shape['additional'] ?? []);
            }
            return $out;
        }
        if (($shape['type'] ?? '') === 'array' && is_array($value)) {
            return array_map(static fn (mixed $item): mixed => self::normalizeJson($item, $shape['items'] ?? []), $value);
        }
        return $value;
    }

    private function backoff(int $attempt): float
    {
        $cap = min($this->config->maxDelay, $this->config->baseDelay * 2 ** ($attempt - 1));
        return random_int(0, 1000000) / 1000000 * $cap;
    }

    private function retryDelay(int $attempt, string $retryAfter): ?float
    {
        if ($retryAfter === '') {
            return $this->backoff($attempt);
        }
        $date = strtotime($retryAfter);
        $delay = preg_match('/^[0-9]+$/D', $retryAfter) ? (float) $retryAfter
            : ($date !== false ? max(0.0, $date - ($this->config->clock)()) : $this->backoff($attempt));
        // Never retry sooner than requested. Return the error if the wait exceeds our budget.
        return $delay <= $this->config->maxDelay ? $delay : null;
    }

    private static function userAgent(): string
    {
        $version = class_exists(\Composer\InstalledVersions::class)
            && \Composer\InstalledVersions::isInstalled('basaltic/sdk-php')
            ? \Composer\InstalledVersions::getPrettyVersion('basaltic/sdk-php') : 'dev';
        return 'basaltic-php/' . ($version ?? 'dev') . ' PHP/' . PHP_VERSION;
    }
}
