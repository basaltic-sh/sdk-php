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
final class Audit extends AbstractService
{
    protected const SERVICE = 'audit';
    protected const ENDPOINT = 'https://audit.basaltic.sh';
    protected const OPERATIONS = [
        'getAuditLog' => [
            'id' => 'getAuditLog',
            'method' => 'GET',
            'path' => '/v1/audit-logs/{log_id}',
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
        'listAuditLogs' => [
            'id' => 'listAuditLogs',
            'method' => 'GET',
            'path' => '/v1/audit-logs',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'actor' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'actor_type' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'action' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'resource_type' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'resource' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'ip_address' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'from' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'to' => [
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
            'items_key' => 'audit_logs',
        ],
    ];

    /**
     * Get audit log entry
     */
    public function getAuditLog(string $logId, ?RequestOptions $options = null): Result
    {
        return $this->result('getAuditLog', ['log_id' => $logId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getAuditLogByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getAuditLog($id, $options),
            fn (array $filter): Page => $this->listAuditLogs(array_replace($scope, $filter), $options),
            false,
            'audit_log',
        );
    }

    /**
     * List audit logs
     * @param array<string, mixed> $query
     */
    public function listAuditLogs(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listAuditLogs', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listAuditLogsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listAuditLogs(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }
}
