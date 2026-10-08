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
final class Dns extends AbstractService
{
    protected const SERVICE = 'dns';
    protected const ENDPOINT = 'https://dns.basaltic.sh';
    protected const OPERATIONS = [
        'associateZoneVPC' => [
            'id' => 'associateZoneVPC',
            'method' => 'POST',
            'path' => '/v1/zones/{zone_id}/vpc-associations',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createRecord' => [
            'id' => 'createRecord',
            'method' => 'POST',
            'path' => '/v1/zones/{zone_id}/records',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'values' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createZone' => [
            'id' => 'createZone',
            'method' => 'POST',
            'path' => '/v1/zones',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'vpcs' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'deleteRecord' => [
            'id' => 'deleteRecord',
            'method' => 'DELETE',
            'path' => '/v1/zones/{zone_id}/records/{record_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'deleteZone' => [
            'id' => 'deleteZone',
            'method' => 'DELETE',
            'path' => '/v1/zones/{zone_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'deleteZoneRecordImport' => [
            'id' => 'deleteZoneRecordImport',
            'method' => 'DELETE',
            'path' => '/v1/zones/{zone_id}/record-import',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'dissociateZoneVPC' => [
            'id' => 'dissociateZoneVPC',
            'method' => 'DELETE',
            'path' => '/v1/zones/{zone_id}/vpc-associations/{vpc_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'exportZoneFile' => [
            'id' => 'exportZoneFile',
            'method' => 'GET',
            'path' => '/v1/zones/{zone_id}/export',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'text/plain',
            'items_key' => null,
        ],
        'getRecord' => [
            'id' => 'getRecord',
            'method' => 'GET',
            'path' => '/v1/zones/{zone_id}/records/{record_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'getZone' => [
            'id' => 'getZone',
            'method' => 'GET',
            'path' => '/v1/zones/{zone_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'getZoneRecordImport' => [
            'id' => 'getZoneRecordImport',
            'method' => 'GET',
            'path' => '/v1/zones/{zone_id}/record-import',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'importZoneFile' => [
            'id' => 'importZoneFile',
            'method' => 'POST',
            'path' => '/v1/zones/{zone_id}/import',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'listRecords' => [
            'id' => 'listRecords',
            'method' => 'GET',
            'path' => '/v1/zones/{zone_id}/records',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'type' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'name' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'include_managed' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'limit' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'marker' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'records',
        ],
        'listZoneVPCAssociations' => [
            'id' => 'listZoneVPCAssociations',
            'method' => 'GET',
            'path' => '/v1/zones/{zone_id}/vpc-associations',
            'authenticated' => true,
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
            'items_key' => 'vpc_ids',
        ],
        'listZones' => [
            'id' => 'listZones',
            'method' => 'GET',
            'path' => '/v1/zones',
            'authenticated' => true,
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
                'limit' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'marker' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'zones',
        ],
        'updateRecord' => [
            'id' => 'updateRecord',
            'method' => 'PATCH',
            'path' => '/v1/zones/{zone_id}/records/{record_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'values' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateZone' => [
            'id' => 'updateZone',
            'method' => 'PATCH',
            'path' => '/v1/zones/{zone_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'verifyZoneOwnership' => [
            'id' => 'verifyZoneOwnership',
            'method' => 'POST',
            'path' => '/v1/zones/{zone_id}/verify-ownership',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
    ];

    /**
     * Associate a VPC with a private zone
     * @param array<string, mixed>|\stdClass $body
     */
    public function associateZoneVPC(string $zoneId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('associateZoneVPC', ['zone_id' => $zoneId], $body, [], $options);
    }

    /**
     * Create record
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRecord(string $zoneId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRecord', ['zone_id' => $zoneId], $body, [], $options);
    }

    /**
     * Create zone
     * @param array<string, mixed>|\stdClass $body
     */
    public function createZone(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createZone', [], $body, [], $options);
    }

    /**
     * Delete record
     */
    public function deleteRecord(string $zoneId, string $recordId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRecord', ['zone_id' => $zoneId, 'record_id' => $recordId], null, [], $options);
    }

    /**
     * Delete zone
     */
    public function deleteZone(string $zoneId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteZone', ['zone_id' => $zoneId], null, [], $options);
    }

    /**
     * Discard the record-import outcome
     */
    public function deleteZoneRecordImport(string $zoneId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteZoneRecordImport', ['zone_id' => $zoneId], null, [], $options);
    }

    /**
     * Dissociate a VPC from a private zone
     */
    public function dissociateZoneVPC(string $zoneId, string $vpcId, ?RequestOptions $options = null): void
    {
        $this->discard('dissociateZoneVPC', ['zone_id' => $zoneId, 'vpc_id' => $vpcId], null, [], $options);
    }

    /**
     * Export the zone as a zone file
     */
    public function exportZoneFile(string $zoneId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('exportZoneFile', ['zone_id' => $zoneId], null, [], $options);
    }

    /**
     * Get record
     */
    public function getRecord(string $zoneId, string $recordId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRecord', ['zone_id' => $zoneId, 'record_id' => $recordId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRecordByReference(string $zoneId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRecord($zoneId, $id, $options),
            fn (array $filter): Page => $this->listRecords($zoneId, array_replace($scope, $filter), $options),
            true,
            'record',
        );
    }

    /**
     * Get zone
     */
    public function getZone(string $zoneId, ?RequestOptions $options = null): Result
    {
        return $this->result('getZone', ['zone_id' => $zoneId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getZoneByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getZone($id, $options),
            fn (array $filter): Page => $this->listZones(array_replace($scope, $filter), $options),
            true,
            'zone',
        );
    }

    /**
     * Get the record-import outcome
     */
    public function getZoneRecordImport(string $zoneId, ?RequestOptions $options = null): Result
    {
        return $this->result('getZoneRecordImport', ['zone_id' => $zoneId], null, [], $options);
    }

    /**
     * Import a zone file
     * @param array<string, mixed>|\stdClass $body
     */
    public function importZoneFile(string $zoneId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('importZoneFile', ['zone_id' => $zoneId], $body, [], $options);
    }

    /**
     * List records
     * @param array<string, mixed> $query
     */
    public function listRecords(string $zoneId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRecords', ['zone_id' => $zoneId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRecordsAll(string $zoneId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRecords($zoneId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List VPC associations
     * @param array<string, mixed> $query
     */
    public function listZoneVPCAssociations(string $zoneId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listZoneVPCAssociations', ['zone_id' => $zoneId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listZoneVPCAssociationsAll(string $zoneId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listZoneVPCAssociations($zoneId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List zones
     * @param array<string, mixed> $query
     */
    public function listZones(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listZones', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listZonesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listZones(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Update record
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRecord(string $zoneId, string $recordId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRecord', ['zone_id' => $zoneId, 'record_id' => $recordId], $body, [], $options);
    }

    /**
     * Update zone
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateZone(string $zoneId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateZone', ['zone_id' => $zoneId], $body, [], $options);
    }

    /**
     * Verify zone ownership
     */
    public function verifyZoneOwnership(string $zoneId, ?RequestOptions $options = null): Result
    {
        return $this->result('verifyZoneOwnership', ['zone_id' => $zoneId], null, [], $options);
    }
}
