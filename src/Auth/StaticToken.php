<?php

declare(strict_types=1);

namespace Basaltic\Auth;

final class StaticToken implements TokenProvider
{
    public function __construct(#[\SensitiveParameter] private readonly string $value)
    {
        if ($value === '' || preg_match('/[\x00-\x20\x7f]/', $value)) {
            throw new \InvalidArgumentException('A nonempty bearer token without whitespace is required.');
        }
    }

    public function token(): string
    {
        return $this->value;
    }

    /** @return array<string, string> */
    public function __debugInfo(): array
    {
        return ['token' => '[redacted]'];
    }
}
