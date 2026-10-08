<?php

declare(strict_types=1);

namespace Basaltic;

use Basaltic\Exception\ProtocolException;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractService
{
    protected const SERVICE = '';
    protected const ENDPOINT = '';
    /** @var array<string, array<string, mixed>> */
    protected const OPERATIONS = [];

    public function __construct(private readonly Transport $transport)
    {
    }

    /**
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    protected function download(string $id, array $path, mixed $body, array $query, ?RequestOptions $options): ResponseInterface
    {
        return $this->transport->send(static::SERVICE, static::ENDPOINT, static::OPERATIONS[$id], $path, $body, $query, $options);
    }

    /**
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    protected function result(string $id, array $path, mixed $body, array $query, ?RequestOptions $options): Result
    {
        $response = $this->download($id, $path, $body, $query, $options);
        try {
            $raw = (string) $response->getBody();
            if (trim($raw) === '') {
                $data = [];
            } else {
                try {
                    $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING);
                } catch (\JsonException) {
                    throw new ProtocolException("{$id}: malformed JSON response.");
                }
                if (!is_array($data)) {
                    throw new ProtocolException("{$id}: expected a JSON object or array.");
                }
            }
            $itemsKey = static::OPERATIONS[$id]['items_key'];
            return $itemsKey !== null ? new Page($data, $response, $itemsKey) : new Result($data, $response);
        } finally {
            $response->getBody()->close();
        }
    }

    /**
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    protected function page(string $id, array $path, mixed $body, array $query, ?RequestOptions $options): Page
    {
        $page = $this->result($id, $path, $body, $query, $options);
        if (!$page instanceof Page) {
            throw new \LogicException('Operation is not a list.');
        }
        return $page;
    }

    /**
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    protected function discard(string $id, array $path, mixed $body, array $query, ?RequestOptions $options): void
    {
        $this->download($id, $path, $body, $query, $options)->getBody()->close();
    }

    /**
     * @param array<string, string> $path
     * @param array<string, mixed> $query
     */
    protected function websocket(string $id, array $path, mixed $body, array $query, ?RequestOptions $options): \Psr\Http\Message\RequestInterface
    {
        return $this->transport->websocket(static::SERVICE, static::ENDPOINT, static::OPERATIONS[$id], $path, $query, $options);
    }
}
