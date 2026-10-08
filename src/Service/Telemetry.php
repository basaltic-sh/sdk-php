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
final class Telemetry extends AbstractService
{
    protected const SERVICE = 'telemetry';
    protected const ENDPOINT = 'https://telemetry.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'createLogGroup' => [
            'id' => 'createLogGroup',
            'method' => 'POST',
            'path' => '/v1/log-groups',
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
        'deleteLogGroup' => [
            'id' => 'deleteLogGroup',
            'method' => 'DELETE',
            'path' => '/v1/log-groups/{id}',
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
        'deleteTraceSettings' => [
            'id' => 'deleteTraceSettings',
            'method' => 'DELETE',
            'path' => '/v1/trace-settings',
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
        'getLog' => [
            'id' => 'getLog',
            'method' => 'GET',
            'path' => '/v1/logs/{log_id}',
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
        'getLogGroup' => [
            'id' => 'getLogGroup',
            'method' => 'GET',
            'path' => '/v1/log-groups/{id}',
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
        'getRetainedTelemetryPresence' => [
            'id' => 'getRetainedTelemetryPresence',
            'method' => 'GET',
            'path' => '/v1/trace-settings/retained-data',
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
        'getTrace' => [
            'id' => 'getTrace',
            'method' => 'GET',
            'path' => '/v1/traces/{trace_id}',
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
        'getTraceSettings' => [
            'id' => 'getTraceSettings',
            'method' => 'GET',
            'path' => '/v1/trace-settings',
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
        'ingestLogs' => [
            'id' => 'ingestLogs',
            'method' => 'POST',
            'path' => '/v1/logs',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'logs' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'attributes' => [
                                    'type' => 'object',
                                ],
                                'resource' => [
                                    'type' => 'object',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'ingestSpans' => [
            'id' => 'ingestSpans',
            'method' => 'POST',
            'path' => '/v1/spans',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'spans' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'attributes' => [
                                    'type' => 'object',
                                ],
                                'resource' => [
                                    'type' => 'object',
                                ],
                                'events' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'attributes' => [
                                                'type' => 'object',
                                            ],
                                        ],
                                    ],
                                ],
                                'links' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'listLogGroups' => [
            'id' => 'listLogGroups',
            'method' => 'GET',
            'path' => '/v1/log-groups',
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
            'items_key' => 'log_groups',
        ],
        'listMetricNames' => [
            'id' => 'listMetricNames',
            'method' => 'GET',
            'path' => '/v1/metrics/names',
            'authenticated' => true,
            'required_query' => [
                'start',
                'end',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'start' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'end' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'data',
        ],
        'listMetricNamesPost' => [
            'id' => 'listMetricNamesPost',
            'method' => 'POST',
            'path' => '/v1/metrics/names',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/x-www-form-urlencoded',
            'body_shape' => [
                'type' => 'object',
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'listMetricSeries' => [
            'id' => 'listMetricSeries',
            'method' => 'GET',
            'path' => '/v1/metrics/series',
            'authenticated' => true,
            'required_query' => [
                'metric',
                'start',
                'end',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'metric' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'start' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'end' => [
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
        'listMetricSeriesPost' => [
            'id' => 'listMetricSeriesPost',
            'method' => 'POST',
            'path' => '/v1/metrics/series',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/x-www-form-urlencoded',
            'body_shape' => [
                'type' => 'object',
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'putTraceSettings' => [
            'id' => 'putTraceSettings',
            'method' => 'PUT',
            'path' => '/v1/trace-settings',
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
        'queryMetricsInstant' => [
            'id' => 'queryMetricsInstant',
            'method' => 'GET',
            'path' => '/v1/metrics/query',
            'authenticated' => true,
            'required_query' => [
                'metric',
                'agg',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'metric' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'agg' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'match[]' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'by[]' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'step' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'time' => [
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
        'queryMetricsInstantPost' => [
            'id' => 'queryMetricsInstantPost',
            'method' => 'POST',
            'path' => '/v1/metrics/query',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/x-www-form-urlencoded',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'match[]' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'by[]' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'queryMetricsRange' => [
            'id' => 'queryMetricsRange',
            'method' => 'GET',
            'path' => '/v1/metrics/query_range',
            'authenticated' => true,
            'required_query' => [
                'metric',
                'agg',
                'start',
                'end',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'metric' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'agg' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'match[]' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'by[]' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'start' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'end' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'step' => [
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
        'queryMetricsRangePost' => [
            'id' => 'queryMetricsRangePost',
            'method' => 'POST',
            'path' => '/v1/metrics/query_range',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/x-www-form-urlencoded',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'match[]' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'by[]' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'searchLogs' => [
            'id' => 'searchLogs',
            'method' => 'GET',
            'path' => '/v1/logs',
            'authenticated' => true,
            'required_query' => [
                'from',
                'to',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'from' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'to' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'log_group' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'log_stream' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'min_severity' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'region' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'q' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'trace_id' => [
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
            'items_key' => null,
        ],
        'searchTraces' => [
            'id' => 'searchTraces',
            'method' => 'GET',
            'path' => '/v1/traces',
            'authenticated' => true,
            'required_query' => [
                'from',
                'to',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'from' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'to' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'service' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'operation' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status_code' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'min_duration_ms' => [
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
            'items_key' => null,
        ],
        'updateLogGroup' => [
            'id' => 'updateLogGroup',
            'method' => 'PATCH',
            'path' => '/v1/log-groups/{id}',
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
        'writeMetrics' => [
            'id' => 'writeMetrics',
            'method' => 'POST',
            'path' => '/v1/metrics/write',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/x-protobuf',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
    ];

    /**
     * Create a log group
     * @param array<string, mixed>|\stdClass $body
     */
    public function createLogGroup(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createLogGroup', [], $body, [], $options);
    }

    /**
     * Delete a log group
     */
    public function deleteLogGroup(string $id, ?RequestOptions $options = null): void
    {
        $this->discard('deleteLogGroup', ['id' => $id], null, [], $options);
    }

    /**
     * Delete trace settings
     */
    public function deleteTraceSettings(?RequestOptions $options = null): void
    {
        $this->discard('deleteTraceSettings', [], null, [], $options);
    }

    /**
     * Get a single log record by id
     */
    public function getLog(string $logId, ?RequestOptions $options = null): Result
    {
        return $this->result('getLog', ['log_id' => $logId], null, [], $options);
    }

    /**
     * Get a log group by id
     */
    public function getLogGroup(string $id, ?RequestOptions $options = null): Result
    {
        return $this->result('getLogGroup', ['id' => $id], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getLogGroupByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getLogGroup($id, $options),
            fn (array $filter): Page => $this->listLogGroups(array_replace($scope, $filter), $options),
            true,
            'log_group',
        );
    }

    /**
     * Check retained telemetry presence
     */
    public function getRetainedTelemetryPresence(?RequestOptions $options = null): Result
    {
        return $this->result('getRetainedTelemetryPresence', [], null, [], $options);
    }

    /**
     * Get all spans for a trace
     */
    public function getTrace(string $traceId, ?RequestOptions $options = null): Result
    {
        return $this->result('getTrace', ['trace_id' => $traceId], null, [], $options);
    }

    /**
     * Get the caller account's trace settings
     */
    public function getTraceSettings(?RequestOptions $options = null): Result
    {
        return $this->result('getTraceSettings', [], null, [], $options);
    }

    /**
     * Ingest a batch of log records
     * @param array<string, mixed>|\stdClass $body
     */
    public function ingestLogs(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('ingestLogs', [], $body, [], $options);
    }

    /**
     * Ingest a batch of trace spans
     * @param array<string, mixed>|\stdClass $body
     */
    public function ingestSpans(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('ingestSpans', [], $body, [], $options);
    }

    /**
     * List log groups (or look up one by name)
     * @param array<string, mixed> $query
     */
    public function listLogGroups(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listLogGroups', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listLogGroupsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listLogGroups(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the distinct metric names emitted in a time window
     * @param array<string, mixed> $query
     */
    public function listMetricNames(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listMetricNames', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listMetricNamesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listMetricNames($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the distinct metric names emitted in a time window (form body)
     * @param array<string, mixed>|null $body
     */
    public function listMetricNamesPost(array|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('listMetricNamesPost', [], $body, [], $options);
    }

    /**
     * List distinct label sets for a metric
     * @param array<string, mixed> $query
     */
    public function listMetricSeries(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('listMetricSeries', [], null, $query, $options);
    }

    /**
     * List distinct label sets for a metric (form body)
     * @param array<string, mixed>|null $body
     */
    public function listMetricSeriesPost(array|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('listMetricSeriesPost', [], $body, [], $options);
    }

    /**
     * Update the caller account's trace settings
     * @param array<string, mixed>|\stdClass $body
     */
    public function putTraceSettings(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putTraceSettings', [], $body, [], $options);
    }

    /**
     * Instant structured metric query
     * @param array<string, mixed> $query
     */
    public function queryMetricsInstant(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('queryMetricsInstant', [], null, $query, $options);
    }

    /**
     * Instant structured metric query (form body)
     * @param array<string, mixed>|null $body
     */
    public function queryMetricsInstantPost(array|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('queryMetricsInstantPost', [], $body, [], $options);
    }

    /**
     * Range structured metric query
     * @param array<string, mixed> $query
     */
    public function queryMetricsRange(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('queryMetricsRange', [], null, $query, $options);
    }

    /**
     * Range structured metric query (form body)
     * @param array<string, mixed>|null $body
     */
    public function queryMetricsRangePost(array|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('queryMetricsRangePost', [], $body, [], $options);
    }

    /**
     * Search log records
     * @param array<string, mixed> $query
     */
    public function searchLogs(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('searchLogs', [], null, $query, $options);
    }

    /**
     * List traces
     * @param array<string, mixed> $query
     */
    public function searchTraces(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('searchTraces', [], null, $query, $options);
    }

    /**
     * Update a log group
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateLogGroup(string $id, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateLogGroup', ['id' => $id], $body, [], $options);
    }

    /**
     * Prometheus remote_write ingest
     * @param string|resource|\Psr\Http\Message\StreamInterface $body
     */
    public function writeMetrics(mixed $body, ?RequestOptions $options = null): void
    {
        $this->discard('writeMetrics', [], $body, [], $options);
    }
}
