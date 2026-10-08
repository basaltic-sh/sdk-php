<?php

declare(strict_types=1);

namespace Basaltic;

use Basaltic\Auth\ClientCredentials;
use Basaltic\Auth\StaticToken;
use Basaltic\Auth\TokenProvider;
use Psr\Http\Client\ClientInterface;

final class Config
{
    public readonly string $region;
    public readonly string $accountId;
    public readonly string $domain;
    /** @var array<string, string> */
    private readonly array $endpoints;
    public readonly ?TokenProvider $tokenProvider;
    public readonly ClientInterface $httpClient;
    public readonly int $maxAttempts;
    public readonly float $baseDelay;
    public readonly float $maxDelay;
    /** @var \Closure(): float */
    public readonly \Closure $clock;
    /** @var \Closure(float): void */
    public readonly \Closure $sleep;

    /**
     * Explicit values override environment variables, including an empty region/account.
     *
     * @param array<string, mixed> $options
     */
    public function __construct(#[\SensitiveParameter] array $options = [])
    {
        $allowed = ['region', 'account_id', 'domain', 'endpoints', 'access_token', 'access_key_id',
            'secret_access_key', 'anonymous', 'token_provider', 'http_client', 'token_url',
            'max_attempts', 'base_delay', 'max_delay', 'timeout', 'clock', 'sleep'];
        if (array_diff(array_keys($options), $allowed)) {
            throw new \InvalidArgumentException('Unknown SDK configuration option.');
        }
        $env = static fn (string $key): string => getenv('BASALTIC_' . $key) ?: '';
        $this->region = $options['region'] ?? $env('REGION');
        $this->accountId = $options['account_id'] ?? $env('ACCOUNT_ID');
        $this->domain = $options['domain'] ?? ($env('DOMAIN') ?: 'basaltic.sh');
        if (!preg_match('/^[a-zA-Z0-9.-]+$/D', $this->domain)) {
            throw new \InvalidArgumentException('Invalid API domain.');
        }
        $endpoints = [];
        foreach (getenv() as $key => $value) {
            if (str_starts_with($key, 'BASALTIC_ENDPOINT_URL_') && $value !== '') {
                $endpoints[strtolower(substr($key, strlen('BASALTIC_ENDPOINT_URL_')))] = $value;
            }
        }
        $this->endpoints = array_replace($endpoints, $options['endpoints'] ?? []);
        $this->maxAttempts = $options['max_attempts'] ?? 4;
        $this->baseDelay = (float) ($options['base_delay'] ?? 0.2);
        $this->maxDelay = (float) ($options['max_delay'] ?? 20);
        $timeout = (float) ($options['timeout'] ?? 30);
        if (
            $this->maxAttempts < 1 || $this->maxAttempts > 10 || $this->baseDelay < 0
            || $this->maxDelay < 0 || $timeout <= 0
        ) {
            throw new \InvalidArgumentException('Invalid retry or timeout configuration.');
        }
        $this->clock = $options['clock'] ?? static fn (): float => microtime(true);
        $this->sleep = $options['sleep'] ?? static function (float $seconds): void {
            usleep((int) round($seconds * 1000000));
        };
        $this->httpClient = $options['http_client'] ?? new \GuzzleHttp\Client([
            'timeout' => $timeout, 'connect_timeout' => min(10, $timeout),
            'allow_redirects' => false, 'http_errors' => false,
        ]);
        $explicitCredentials = array_key_exists('access_key_id', $options) || array_key_exists('secret_access_key', $options);
        $token = $options['access_token'] ?? ($explicitCredentials ? '' : $env('ACCESS_TOKEN'));
        $key = $options['access_key_id'] ?? $env('ACCESS_KEY_ID');
        $secret = $options['secret_access_key'] ?? $env('SECRET_ACCESS_KEY');
        if ($options['anonymous'] ?? false) {
            $this->tokenProvider = null;
        } elseif (isset($options['token_provider'])) {
            $this->tokenProvider = $options['token_provider'];
        } elseif ($token !== '') {
            $this->tokenProvider = new StaticToken($token);
        } elseif ($key !== '' && $secret !== '') {
            $url = $options['token_url'] ?? $this->endpoint('iam', 'https://iam.basaltic.sh') . '/v1/oauth/token';
            self::validateUrl($url);
            $this->tokenProvider = new ClientCredentials($key, $secret, $url, $this->httpClient, $this->clock);
        } else {
            throw new \InvalidArgumentException('Configure an access key pair, bearer token, or explicit anonymous access.');
        }
    }

    public function endpoint(string $service, string $template): string
    {
        if (isset($this->endpoints[$service])) {
            $url = $this->endpoints[$service];
        } else {
            if (str_contains($template, '{region}') && !preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/D', $this->region)) {
                throw new \InvalidArgumentException("A valid region is required for {$service}.");
            }
            $url = str_replace(['basaltic.sh', '{region}'], [$this->domain, $this->region], $template);
        }
        self::validateUrl($url);
        return rtrim($url, '/');
    }

    public static function validateUrl(string $url): void
    {
        $parts = parse_url($url);
        if (
            $parts === false || !isset($parts['host']) || isset($parts['user'], $parts['pass'])
            || isset($parts['user']) || isset($parts['query']) || isset($parts['fragment'])
            || !in_array($parts['scheme'] ?? '', ['http', 'https'], true)
            || preg_match('/[\x00-\x20\x7f]/', $url)
        ) {
            throw new \InvalidArgumentException('Endpoint must be an absolute HTTP(S) URL without credentials, query, or fragment.');
        }
    }
}
