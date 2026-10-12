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
        'getCountry' => [
            'id' => 'getCountry',
            'method' => 'GET',
            'path' => '/v1/countries/{country}',
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
        'listCities' => [
            'id' => 'listCities',
            'method' => 'GET',
            'path' => '/v1/cities',
            'authenticated' => false,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'state' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'country' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'q' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'limit' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'cities',
        ],
        'listCountries' => [
            'id' => 'listCountries',
            'method' => 'GET',
            'path' => '/v1/countries',
            'authenticated' => false,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'countries',
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
        'listStates' => [
            'id' => 'listStates',
            'method' => 'GET',
            'path' => '/v1/states',
            'authenticated' => false,
            'required_query' => [
                'country',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'country' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'states',
        ],
        'lookupPostalCode' => [
            'id' => 'lookupPostalCode',
            'method' => 'GET',
            'path' => '/v1/postal-codes/{code}',
            'authenticated' => false,
            'required_query' => [
                'country',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'country' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
    ];

    /**
     * Get a country and its address rules
     */
    public function getCountry(string $country, ?RequestOptions $options = null): Result
    {
        return $this->result('getCountry', ['country' => $country], null, [], $options);
    }

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
     * List cities
     * @param array<string, mixed> $query
     */
    public function listCities(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listCities', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listCitiesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listCities($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List countries
     */
    public function listCountries(?RequestOptions $options = null): Page
    {
        return $this->page('listCountries', [], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listCountriesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listCountries($options),
            (string) ($query['marker'] ?? ''),
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

    /**
     * List a country's states
     * @param array<string, mixed> $query
     */
    public function listStates(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listStates', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listStatesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listStates($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Look up a postal code
     * @param array<string, mixed> $query
     */
    public function lookupPostalCode(string $code, array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('lookupPostalCode', ['code' => $code], null, $query, $options);
    }
}
