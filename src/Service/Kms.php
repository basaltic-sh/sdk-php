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
final class Kms extends AbstractService
{
    protected const SERVICE = 'kms';
    protected const ENDPOINT = 'https://kms.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'cancelKeyDeletion' => [
            'id' => 'cancelKeyDeletion',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/cancel-deletion',
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
        'createKey' => [
            'id' => 'createKey',
            'method' => 'POST',
            'path' => '/v1/keys',
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
        'decrypt' => [
            'id' => 'decrypt',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/decrypt',
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
        'disableKey' => [
            'id' => 'disableKey',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/disable',
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
        'enableKey' => [
            'id' => 'enableKey',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/enable',
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
        'encrypt' => [
            'id' => 'encrypt',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/encrypt',
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
        'generateDataKey' => [
            'id' => 'generateDataKey',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/generate-data-key',
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
        'getKey' => [
            'id' => 'getKey',
            'method' => 'GET',
            'path' => '/v1/keys/{key_id}',
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
        'listKeys' => [
            'id' => 'listKeys',
            'method' => 'GET',
            'path' => '/v1/keys',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'limit' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'marker' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'state' => [
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
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'keys',
        ],
        'scheduleKeyDeletion' => [
            'id' => 'scheduleKeyDeletion',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/schedule-deletion',
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
        'sign' => [
            'id' => 'sign',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/sign',
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
        'updateKey' => [
            'id' => 'updateKey',
            'method' => 'PATCH',
            'path' => '/v1/keys/{key_id}',
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
        'verify' => [
            'id' => 'verify',
            'method' => 'POST',
            'path' => '/v1/keys/{key_id}/verify',
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
    ];

    /**
     * Cancel a scheduled deletion
     */
    public function cancelKeyDeletion(string $keyId, ?RequestOptions $options = null): Result
    {
        return $this->result('cancelKeyDeletion', ['key_id' => $keyId], null, [], $options);
    }

    /**
     * Create a KMS key
     * @param array<string, mixed>|\stdClass $body
     */
    public function createKey(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createKey', [], $body, [], $options);
    }

    /**
     * Decrypt a ciphertext
     * @param array<string, mixed>|\stdClass $body
     */
    public function decrypt(string $keyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('decrypt', ['key_id' => $keyId], $body, [], $options);
    }

    /**
     * Disable a key
     */
    public function disableKey(string $keyId, ?RequestOptions $options = null): Result
    {
        return $this->result('disableKey', ['key_id' => $keyId], null, [], $options);
    }

    /**
     * Enable a disabled key
     */
    public function enableKey(string $keyId, ?RequestOptions $options = null): Result
    {
        return $this->result('enableKey', ['key_id' => $keyId], null, [], $options);
    }

    /**
     * Encrypt a payload
     * @param array<string, mixed>|\stdClass $body
     */
    public function encrypt(string $keyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('encrypt', ['key_id' => $keyId], $body, [], $options);
    }

    /**
     * Generate a fresh data key
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function generateDataKey(string $keyId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('generateDataKey', ['key_id' => $keyId], $body, [], $options);
    }

    /**
     * Get a KMS key
     */
    public function getKey(string $keyId, ?RequestOptions $options = null): Result
    {
        return $this->result('getKey', ['key_id' => $keyId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getKeyByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getKey($id, $options),
            fn (array $filter): Page => $this->listKeys(array_replace($scope, $filter), $options),
            true,
            'key',
        );
    }

    /**
     * List KMS keys
     * @param array<string, mixed> $query
     */
    public function listKeys(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listKeys', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listKeysAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listKeys(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Schedule key for deletion
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function scheduleKeyDeletion(string $keyId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('scheduleKeyDeletion', ['key_id' => $keyId], $body, [], $options);
    }

    /**
     * Sign a message
     * @param array<string, mixed>|\stdClass $body
     */
    public function sign(string $keyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('sign', ['key_id' => $keyId], $body, [], $options);
    }

    /**
     * Update key metadata
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateKey(string $keyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateKey', ['key_id' => $keyId], $body, [], $options);
    }

    /**
     * Verify a signature
     * @param array<string, mixed>|\stdClass $body
     */
    public function verify(string $keyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('verify', ['key_id' => $keyId], $body, [], $options);
    }
}
