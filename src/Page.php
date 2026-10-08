<?php

declare(strict_types=1);

namespace Basaltic;

use Basaltic\Exception\ProtocolException;
use Psr\Http\Message\ResponseInterface;

final class Page extends Result
{
    /** @param array<string, mixed> $data */
    public function __construct(array $data, ResponseInterface $response, private readonly string $itemsKey)
    {
        parent::__construct($data, $response);
    }

    /** @return list<mixed> */
    public function items(): array
    {
        $items = $this[$this->itemsKey];
        if (!is_array($items) || !array_is_list($items)) {
            throw new ProtocolException('List response is missing its items array.');
        }
        return $items;
    }

    public function hasMore(): bool
    {
        return ($this['meta']['has_more'] ?? false) === true;
    }

    public function marker(): string
    {
        $marker = $this['meta']['marker'] ?? '';
        return is_string($marker) ? $marker : '';
    }

    /**
     * @param callable(string): Page $fetch
     * @return \Generator<int, mixed>
     */
    public static function iterate(callable $fetch, string $marker = ''): \Generator
    {
        $seen = [$marker => true];
        while (true) {
            $page = $fetch($marker);
            foreach ($page->items() as $item) {
                yield $item;
            }
            if (!$page->hasMore()) {
                return;
            }
            $marker = $page->marker();
            if ($marker === '' || isset($seen[$marker])) {
                throw new ProtocolException('Pagination did not advance; refusing a truncated or repeated walk.');
            }
            $seen[$marker] = true;
        }
    }
}
