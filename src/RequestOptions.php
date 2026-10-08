<?php

declare(strict_types=1);

namespace Basaltic;

final readonly class RequestOptions
{
    /** @param array<string, string> $headers */
    public function __construct(
        public ?string $accountId = null,
        public ?string $idempotencyKey = null,
        public ?int $maxAttempts = null,
        public array $headers = [],
    ) {
        if ($maxAttempts !== null && ($maxAttempts < 1 || $maxAttempts > 10)) {
            throw new \InvalidArgumentException('maxAttempts must be between 1 and 10.');
        }
        if ($idempotencyKey !== null && ($idempotencyKey === '' || preg_match('/[\x00-\x20\x7f]/', $idempotencyKey))) {
            throw new \InvalidArgumentException('Invalid idempotency key.');
        }
        foreach (array_keys($headers) as $name) {
            if (in_array(strtolower($name), ['authorization', 'host', 'x-account-id', 'idempotency-key', 'content-length'], true)) {
                throw new \InvalidArgumentException('Use SDK options for managed headers.');
            }
        }
    }

    /** Generate once per logical operation; reuse the value when retrying it. */
    public static function newIdempotencyKey(): string
    {
        return bin2hex(random_bytes(16));
    }
}
