<?php

declare(strict_types=1);

namespace Basaltic;

use Psr\Http\Message\ResponseInterface;

/** @implements \ArrayAccess<string, mixed> */
class Result implements \ArrayAccess, \JsonSerializable
{
    /** @param array<string, mixed> $data */
    public function __construct(private readonly array $data, public readonly ResponseInterface $response)
    {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->data;
    }

    public function requestId(): string
    {
        return $this->response->getHeaderLine('X-Request-Id');
    }

    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \LogicException('SDK results are immutable.');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \LogicException('SDK results are immutable.');
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return $this->data;
    }
}
