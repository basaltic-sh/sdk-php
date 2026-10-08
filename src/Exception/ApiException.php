<?php

declare(strict_types=1);

namespace Basaltic\Exception;

use Psr\Http\Message\ResponseInterface;

final class ApiException extends \RuntimeException
{
    /** @param array<string, list<string>> $headers */
    public function __construct(
        public readonly int $statusCode,
        public readonly string $errorCode,
        string $message,
        public readonly string $requestId,
        public readonly string $operationId,
        public readonly array $headers = [],
    ) {
        parent::__construct("{$operationId}: {$message} (HTTP {$statusCode}, request {$requestId})");
    }

    public static function fromResponse(string $operationId, ResponseInterface $response): self
    {
        $raw = $response->getBody()->read(1048576);
        $data = json_decode($raw, true);
        $error = is_array($data) && is_array($data['error'] ?? null) ? $data['error'] : [];
        return new self(
            $response->getStatusCode(),
            is_string($error['code'] ?? null) ? $error['code'] : '',
            is_string($error['message'] ?? null) ? $error['message'] : 'Unexpected API response',
            is_string($error['request_id'] ?? null) ? $error['request_id'] : $response->getHeaderLine('X-Request-Id'),
            $operationId,
            $response->getHeaders(),
        );
    }

    public function isNotFound(): bool
    {
        return in_array($this->statusCode, [404, 410], true);
    }

    public function isUnauthorized(): bool
    {
        return $this->statusCode === 401;
    }

    public function isQuotaExceeded(): bool
    {
        return in_array($this->errorCode, ['QUOTA_EXCEEDED', 'LIMIT_EXCEEDED'], true)
            || str_ends_with($this->errorCode, '_QUOTA_EXCEEDED')
            || str_ends_with($this->errorCode, '_LIMIT_EXCEEDED');
    }

    public function isAccessDenied(): bool
    {
        return $this->statusCode === 403 && !$this->isQuotaExceeded();
    }

    public function isConflict(): bool
    {
        return $this->statusCode === 409;
    }

    public function isInvalidInput(): bool
    {
        return in_array($this->statusCode, [400, 422], true);
    }

    public function isRateLimited(): bool
    {
        return $this->statusCode === 429;
    }

    public function isTransient(): bool
    {
        return $this->statusCode === 429 || $this->statusCode >= 500;
    }
}
