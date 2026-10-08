<?php

declare(strict_types=1);

namespace Basaltic\Auth;

use Basaltic\Exception\AuthenticationException;
use Basaltic\Exception\TransportException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final class ClientCredentials implements RefreshableTokenProvider
{
    private string $cached = '';
    private float $refreshAt = 0;
    /** @var \Closure(): float */
    private readonly \Closure $clock;

    /** @param \Closure(): float $clock */
    public function __construct(
        #[\SensitiveParameter] private readonly string $keyId,
        #[\SensitiveParameter] private readonly string $secret,
        private readonly string $tokenUrl,
        private readonly ClientInterface $httpClient,
        ?\Closure $clock = null,
    ) {
        if ($keyId === '' || $secret === '' || str_contains($keyId, ':')) {
            throw new \InvalidArgumentException('A valid access key ID and secret are required.');
        }
        $this->clock = $clock ?? static fn (): float => microtime(true);
    }

    public function token(): string
    {
        $now = ($this->clock)();
        if ($this->cached !== '' && $now < $this->refreshAt) {
            return $this->cached;
        }
        $request = new Request('POST', $this->tokenUrl, [
            'Authorization' => 'Basic ' . base64_encode($this->keyId . ':' . $this->secret),
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ], 'grant_type=client_credentials');
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface) {
            throw new TransportException('Token exchange transport failed.');
        }
        try {
            $data = json_decode($response->getBody()->read(1048576), true);
            if ($response->getStatusCode() !== 200) {
                $code = is_array($data) && is_string($data['error'] ?? null) ? $data['error'] : '';
                // Keep known OAuth codes only; arbitrary response text may echo secrets.
                $code = in_array($code, ['invalid_client', 'invalid_grant', 'temporarily_unavailable'], true) ? $code : '';
                throw new AuthenticationException($response->getStatusCode(), $code);
            }
            if (!is_array($data) || !is_string($data['access_token'] ?? null) || $data['access_token'] === '') {
                throw new AuthenticationException(200);
            }
            if (isset($data['token_type']) && strtolower((string) $data['token_type']) !== 'bearer') {
                throw new AuthenticationException(200);
            }
            $token = (new StaticToken($data['access_token']))->token();
            $lifetime = $data['expires_in'] ?? 900;
            if (!is_numeric($lifetime) || (float) $lifetime <= 0) {
                throw new AuthenticationException(200);
            }
            $this->cached = $token;
            $this->refreshAt = $now + (float) $lifetime - min(300.0, (float) $lifetime * 0.1);
            return $token;
        } finally {
            $response->getBody()->close();
        }
    }

    public function invalidate(): void
    {
        $this->cached = '';
        $this->refreshAt = 0;
    }

    /** @return array<string, string> */
    public function __debugInfo(): array
    {
        return ['credentials' => '[redacted]'];
    }
}
