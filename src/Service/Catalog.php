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
final class Catalog extends AbstractService
{
    protected const SERVICE = 'catalog';
    protected const ENDPOINT = 'https://catalog.basaltic.sh';
    protected const OPERATIONS = [
        'getRegion' => [
            'id' => 'getRegion',
            'method' => 'GET',
            'path' => '/v1/regions/{code}',
            'authenticated' => false,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'listRegions' => [
            'id' => 'listRegions',
            'method' => 'GET',
            'path' => '/v1/regions',
            'authenticated' => false,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'name' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'regions',
        ],
    ];

    /**
     * Get a region
     */
    public function getRegion(string $code, ?RequestOptions $options = null): Result
    {
        return $this->result('getRegion', ['code' => $code], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRegionByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRegion($id, $options),
            fn (array $filter): Page => $this->listRegions(array_replace($scope, $filter), $options),
            true,
            null,
        );
    }

    /**
     * List regions
     * @param array<string, mixed> $query
     */
    public function listRegions(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRegions', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRegionsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRegions($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }
}
