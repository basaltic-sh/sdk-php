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
final class Queue extends AbstractService
{
    protected const SERVICE = 'queue';
    protected const ENDPOINT = 'https://queue.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'changeMessageVisibility' => [
            'id' => 'changeMessageVisibility',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/messages/visibility',
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
        'changeMessageVisibilityBatch' => [
            'id' => 'changeMessageVisibilityBatch',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/messages/visibility-batch',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'entries' => [
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
        'createQueue' => [
            'id' => 'createQueue',
            'method' => 'POST',
            'path' => '/v1/queues',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'redrive_policy' => [
                        'type' => 'object',
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'deleteMessage' => [
            'id' => 'deleteMessage',
            'method' => 'DELETE',
            'path' => '/v1/queues/{queue_id}/messages',
            'authenticated' => true,
            'required_query' => [
                'receipt_handle',
            ],
            'required_headers' => [],
            'query_encoding' => [
                'receipt_handle' => [
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
        'deleteMessageBatch' => [
            'id' => 'deleteMessageBatch',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/messages/delete-batch',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'entries' => [
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
        'deleteQueue' => [
            'id' => 'deleteQueue',
            'method' => 'DELETE',
            'path' => '/v1/queues/{queue_id}',
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
        'describeQueue' => [
            'id' => 'describeQueue',
            'method' => 'GET',
            'path' => '/v1/queues/{queue_id}',
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
        'listQueues' => [
            'id' => 'listQueues',
            'method' => 'GET',
            'path' => '/v1/queues',
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
                'marker' => [
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
            'items_key' => 'queues',
        ],
        'peekMessages' => [
            'id' => 'peekMessages',
            'method' => 'GET',
            'path' => '/v1/queues/{queue_id}/messages',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'visibility' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'marker' => [
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
            'items_key' => null,
        ],
        'purgeQueue' => [
            'id' => 'purgeQueue',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/purge',
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
        'receiveMessages' => [
            'id' => 'receiveMessages',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/messages/receive',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'sendMessage' => [
            'id' => 'sendMessage',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/messages',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'attributes' => [
                        'type' => 'object',
                        'additional' => [
                            'type' => 'object',
                        ],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'sendMessageBatch' => [
            'id' => 'sendMessageBatch',
            'method' => 'POST',
            'path' => '/v1/queues/{queue_id}/messages/batch',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'entries' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'attributes' => [
                                    'type' => 'object',
                                    'additional' => [
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
        'updateQueue' => [
            'id' => 'updateQueue',
            'method' => 'PATCH',
            'path' => '/v1/queues/{queue_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'redrive_policy' => [
                        'type' => 'object',
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
    ];

    /**
     * Extend or shorten a lease
     * @param array<string, mixed>|\stdClass $body
     */
    public function changeMessageVisibility(string $queueId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('changeMessageVisibility', ['queue_id' => $queueId], $body, [], $options);
    }

    /**
     * Extend or shorten up to ten leases
     * @param array<string, mixed>|\stdClass $body
     */
    public function changeMessageVisibilityBatch(string $queueId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('changeMessageVisibilityBatch', ['queue_id' => $queueId], $body, [], $options);
    }

    /**
     * Create a queue
     * @param array<string, mixed>|\stdClass $body
     */
    public function createQueue(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createQueue', [], $body, [], $options);
    }

    /**
     * Delete a leased message
     * @param array<string, mixed> $query
     */
    public function deleteMessage(string $queueId, array $query = [], ?RequestOptions $options = null): void
    {
        $this->discard('deleteMessage', ['queue_id' => $queueId], null, $query, $options);
    }

    /**
     * Delete up to ten leased messages
     * @param array<string, mixed>|\stdClass $body
     */
    public function deleteMessageBatch(string $queueId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('deleteMessageBatch', ['queue_id' => $queueId], $body, [], $options);
    }

    /**
     * Delete a queue
     */
    public function deleteQueue(string $queueId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteQueue', ['queue_id' => $queueId], null, [], $options);
    }

    /**
     * Describe a queue
     */
    public function describeQueue(string $queueId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeQueue', ['queue_id' => $queueId], null, [], $options);
    }

    /**
     * List queues
     * @param array<string, mixed> $query
     */
    public function listQueues(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listQueues', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listQueuesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listQueues(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Peek at a queue's messages
     * @param array<string, mixed> $query
     */
    public function peekMessages(string $queueId, array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('peekMessages', ['queue_id' => $queueId], null, $query, $options);
    }

    /**
     * Delete every message on a queue
     */
    public function purgeQueue(string $queueId, ?RequestOptions $options = null): Result
    {
        return $this->result('purgeQueue', ['queue_id' => $queueId], null, [], $options);
    }

    /**
     * Lease messages
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function receiveMessages(string $queueId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('receiveMessages', ['queue_id' => $queueId], $body, [], $options);
    }

    /**
     * Send a message
     * @param array<string, mixed>|\stdClass $body
     */
    public function sendMessage(string $queueId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('sendMessage', ['queue_id' => $queueId], $body, [], $options);
    }

    /**
     * Send up to ten messages
     * @param array<string, mixed>|\stdClass $body
     */
    public function sendMessageBatch(string $queueId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('sendMessageBatch', ['queue_id' => $queueId], $body, [], $options);
    }

    /**
     * Update queue attributes
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateQueue(string $queueId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateQueue', ['queue_id' => $queueId], $body, [], $options);
    }
}
