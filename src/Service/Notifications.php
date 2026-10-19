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
final class Notifications extends AbstractService
{
    protected const SERVICE = 'notifications';
    protected const ENDPOINT = 'https://notifications.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'createTopic' => [
            'id' => 'createTopic',
            'method' => 'POST',
            'path' => '/v1/topics',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'delivery_policy' => [
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
        'deleteTopic' => [
            'id' => 'deleteTopic',
            'method' => 'DELETE',
            'path' => '/v1/topics/{topic_id}',
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
        'deleteTopicPolicy' => [
            'id' => 'deleteTopicPolicy',
            'method' => 'DELETE',
            'path' => '/v1/topics/{topic_id}/policy',
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
        'describeMessage' => [
            'id' => 'describeMessage',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/messages/{message_id}',
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
        'describeSubscription' => [
            'id' => 'describeSubscription',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/subscriptions/{subscription_id}',
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
        'describeTopic' => [
            'id' => 'describeTopic',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}',
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
        'getSubscriptionSigningSecret' => [
            'id' => 'getSubscriptionSigningSecret',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/subscriptions/{subscription_id}/signing-secret',
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
        'getTopicPolicy' => [
            'id' => 'getTopicPolicy',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/policy',
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
        'listDeliveries' => [
            'id' => 'listDeliveries',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/deliveries',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'message' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'subscription' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status' => [
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
            'items_key' => 'deliveries',
        ],
        'listMessages' => [
            'id' => 'listMessages',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/messages',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'fanout_state' => [
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
            'items_key' => 'messages',
        ],
        'listSubscriptions' => [
            'id' => 'listSubscriptions',
            'method' => 'GET',
            'path' => '/v1/topics/{topic_id}/subscriptions',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status' => [
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
            'items_key' => 'subscriptions',
        ],
        'listTopics' => [
            'id' => 'listTopics',
            'method' => 'GET',
            'path' => '/v1/topics',
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
            'items_key' => 'topics',
        ],
        'publish' => [
            'id' => 'publish',
            'method' => 'POST',
            'path' => '/v1/topics/{topic_id}/publish',
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
        'publishBatch' => [
            'id' => 'publishBatch',
            'method' => 'POST',
            'path' => '/v1/topics/{topic_id}/publish-batch',
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
        'putTopicPolicy' => [
            'id' => 'putTopicPolicy',
            'method' => 'PUT',
            'path' => '/v1/topics/{topic_id}/policy',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'document' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'resendConfirmation' => [
            'id' => 'resendConfirmation',
            'method' => 'POST',
            'path' => '/v1/topics/{topic_id}/subscriptions/{subscription_id}/resend-confirmation',
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
        'rotateSubscriptionSigningSecret' => [
            'id' => 'rotateSubscriptionSigningSecret',
            'method' => 'POST',
            'path' => '/v1/topics/{topic_id}/subscriptions/{subscription_id}/signing-secret/rotate',
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
        'subscribe' => [
            'id' => 'subscribe',
            'method' => 'POST',
            'path' => '/v1/topics/{topic_id}/subscriptions',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'filter_policy' => [
                        'type' => 'object',
                        'additional' => [
                            'type' => 'array',
                            'items' => [],
                        ],
                    ],
                    'delivery_policy' => [
                        'type' => 'object',
                    ],
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
        'unsubscribe' => [
            'id' => 'unsubscribe',
            'method' => 'DELETE',
            'path' => '/v1/topics/{topic_id}/subscriptions/{subscription_id}',
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
        'updateSubscription' => [
            'id' => 'updateSubscription',
            'method' => 'PATCH',
            'path' => '/v1/topics/{topic_id}/subscriptions/{subscription_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'filter_policy' => [
                        'type' => 'object',
                        'additional' => [
                            'type' => 'array',
                            'items' => [],
                        ],
                    ],
                    'delivery_policy' => [
                        'type' => 'object',
                    ],
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
        'updateTopic' => [
            'id' => 'updateTopic',
            'method' => 'PATCH',
            'path' => '/v1/topics/{topic_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'delivery_policy' => [
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
     * Create a topic
     * @param array<string, mixed>|\stdClass $body
     */
    public function createTopic(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createTopic', [], $body, [], $options);
    }

    /**
     * Delete a topic
     */
    public function deleteTopic(string $topicId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteTopic', ['topic_id' => $topicId], null, [], $options);
    }

    /**
     * Delete the topic's resource policy
     */
    public function deleteTopicPolicy(string $topicId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteTopicPolicy', ['topic_id' => $topicId], null, [], $options);
    }

    /**
     * Describe a published notification
     */
    public function describeMessage(string $topicId, string $messageId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeMessage', ['topic_id' => $topicId, 'message_id' => $messageId], null, [], $options);
    }

    /**
     * Describe a subscription
     */
    public function describeSubscription(string $topicId, string $subscriptionId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeSubscription', ['topic_id' => $topicId, 'subscription_id' => $subscriptionId], null, [], $options);
    }

    /**
     * Describe a topic
     */
    public function describeTopic(string $topicId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeTopic', ['topic_id' => $topicId], null, [], $options);
    }

    /**
     * Read the webhook signing secret
     */
    public function getSubscriptionSigningSecret(string $topicId, string $subscriptionId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSubscriptionSigningSecret', ['topic_id' => $topicId, 'subscription_id' => $subscriptionId], null, [], $options);
    }

    /**
     * Read the topic's resource policy
     */
    public function getTopicPolicy(string $topicId, ?RequestOptions $options = null): Result
    {
        return $this->result('getTopicPolicy', ['topic_id' => $topicId], null, [], $options);
    }

    /**
     * List delivery records
     * @param array<string, mixed> $query
     */
    public function listDeliveries(string $topicId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listDeliveries', ['topic_id' => $topicId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listDeliveriesAll(string $topicId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listDeliveries($topicId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List messages
     * @param array<string, mixed> $query
     */
    public function listMessages(string $topicId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listMessages', ['topic_id' => $topicId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listMessagesAll(string $topicId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listMessages($topicId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List subscriptions
     * @param array<string, mixed> $query
     */
    public function listSubscriptions(string $topicId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSubscriptions', ['topic_id' => $topicId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSubscriptionsAll(string $topicId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSubscriptions($topicId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List topics
     * @param array<string, mixed> $query
     */
    public function listTopics(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listTopics', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listTopicsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listTopics(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Publish a notification
     * @param array<string, mixed>|\stdClass $body
     */
    public function publish(string $topicId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('publish', ['topic_id' => $topicId], $body, [], $options);
    }

    /**
     * Publish up to 10 notifications
     * @param array<string, mixed>|\stdClass $body
     */
    public function publishBatch(string $topicId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('publishBatch', ['topic_id' => $topicId], $body, [], $options);
    }

    /**
     * Set the topic's resource policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putTopicPolicy(string $topicId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putTopicPolicy', ['topic_id' => $topicId], $body, [], $options);
    }

    /**
     * Re-send the confirmation handshake
     */
    public function resendConfirmation(string $topicId, string $subscriptionId, ?RequestOptions $options = null): Result
    {
        return $this->result('resendConfirmation', ['topic_id' => $topicId, 'subscription_id' => $subscriptionId], null, [], $options);
    }

    /**
     * Rotate the webhook signing secret
     */
    public function rotateSubscriptionSigningSecret(string $topicId, string $subscriptionId, ?RequestOptions $options = null): Result
    {
        return $this->result('rotateSubscriptionSigningSecret', ['topic_id' => $topicId, 'subscription_id' => $subscriptionId], null, [], $options);
    }

    /**
     * Subscribe an endpoint to a topic
     * @param array<string, mixed>|\stdClass $body
     */
    public function subscribe(string $topicId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('subscribe', ['topic_id' => $topicId], $body, [], $options);
    }

    /**
     * Unsubscribe
     */
    public function unsubscribe(string $topicId, string $subscriptionId, ?RequestOptions $options = null): void
    {
        $this->discard('unsubscribe', ['topic_id' => $topicId, 'subscription_id' => $subscriptionId], null, [], $options);
    }

    /**
     * Update mutable subscription settings
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSubscription(string $topicId, string $subscriptionId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSubscription', ['topic_id' => $topicId, 'subscription_id' => $subscriptionId], $body, [], $options);
    }

    /**
     * Update mutable topic metadata
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateTopic(string $topicId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateTopic', ['topic_id' => $topicId], $body, [], $options);
    }
}
