<?php

declare(strict_types=1);

namespace Basaltic\Service;

use Basaltic\AbstractService;
use Basaltic\Page;
use Basaltic\RequestOptions;
use Basaltic\Result;
use Basaltic\Reference;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

// Generated from the Basaltic API specifications. Do not edit.
final class Quota extends AbstractService
{
    protected const SERVICE = 'quota';
    protected const ENDPOINT = 'https://quota.basaltic.sh';
    protected const OPERATIONS = [
        'listQuotas' => [
            'id' => 'listQuotas',
            'method' => 'GET',
            'path' => '/v1/quotas',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'region' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'quotas',
        ],
    ];

    /**
     * List quotas
     * @param array<string, mixed> $query
     */
    public function listQuotas(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listQuotas', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listQuotasAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listQuotas($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }
}
