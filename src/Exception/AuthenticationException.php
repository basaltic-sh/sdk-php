<?php

declare(strict_types=1);

namespace Basaltic\Exception;

final class AuthenticationException extends \RuntimeException
{
    public function __construct(public readonly int $statusCode, public readonly string $errorCode = '')
    {
        // Never attach the credential-bearing token request or raw server response.
        parent::__construct(match ($errorCode) {
            'invalid_client' => 'The access key was rejected. Check or rotate the credential.',
            'invalid_grant' => 'Authentication was refused. Check the account or organization status.',
            default => "Token exchange failed (HTTP {$statusCode}).",
        });
    }

    public function isTemporary(): bool
    {
        return $this->statusCode === 429 || $this->statusCode >= 500
            || $this->errorCode === 'temporarily_unavailable';
    }
}
