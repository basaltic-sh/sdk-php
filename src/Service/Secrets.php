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
final class Secrets extends AbstractService
{
    protected const SERVICE = 'secrets';
    protected const ENDPOINT = 'https://secrets.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'createSecret' => [
            'id' => 'createSecret',
            'method' => 'POST',
            'path' => '/v1/secrets',
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
        'deleteSecret' => [
            'id' => 'deleteSecret',
            'method' => 'DELETE',
            'path' => '/v1/secrets/{secret_id}',
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
        'describeSecret' => [
            'id' => 'describeSecret',
            'method' => 'GET',
            'path' => '/v1/secrets/{secret_id}',
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
        'getSecretValue' => [
            'id' => 'getSecretValue',
            'method' => 'GET',
            'path' => '/v1/secrets/{secret_id}/value',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'version' => [
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
        'listSecrets' => [
            'id' => 'listSecrets',
            'method' => 'GET',
            'path' => '/v1/secrets',
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
                'include_deleted' => [
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
            'items_key' => 'secrets',
        ],
        'listVersions' => [
            'id' => 'listVersions',
            'method' => 'GET',
            'path' => '/v1/secrets/{secret_id}/versions',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
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
            'items_key' => 'versions',
        ],
        'putSecretValue' => [
            'id' => 'putSecretValue',
            'method' => 'POST',
            'path' => '/v1/secrets/{secret_id}/value',
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
        'restoreSecret' => [
            'id' => 'restoreSecret',
            'method' => 'POST',
            'path' => '/v1/secrets/{secret_id}/restore',
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
        'updateSecret' => [
            'id' => 'updateSecret',
            'method' => 'PATCH',
            'path' => '/v1/secrets/{secret_id}',
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
    ];

    /**
     * Create a new secret with an initial value
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSecret(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSecret', [], $body, [], $options);
    }

    /**
     * Schedule deletion (soft delete with recovery window)
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function deleteSecret(string $secretId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('deleteSecret', ['secret_id' => $secretId], $body, [], $options);
    }

    /**
     * Describe a secret (no value)
     */
    public function describeSecret(string $secretId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeSecret', ['secret_id' => $secretId], null, [], $options);
    }

    /**
     * Read the current value (or a specific version)
     * @param array<string, mixed> $query
     */
    public function getSecretValue(string $secretId, array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('getSecretValue', ['secret_id' => $secretId], null, $query, $options);
    }

    /**
     * List secrets
     * @param array<string, mixed> $query
     */
    public function listSecrets(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSecrets', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSecretsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSecrets(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List versions
     * @param array<string, mixed> $query
     */
    public function listVersions(string $secretId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listVersions', ['secret_id' => $secretId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listVersionsAll(string $secretId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listVersions($secretId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Store a new version (becomes current)
     * @param array<string, mixed>|\stdClass $body
     */
    public function putSecretValue(string $secretId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putSecretValue', ['secret_id' => $secretId], $body, [], $options);
    }

    /**
     * Restore a secret from the recovery window
     */
    public function restoreSecret(string $secretId, ?RequestOptions $options = null): Result
    {
        return $this->result('restoreSecret', ['secret_id' => $secretId], null, [], $options);
    }

    /**
     * Update mutable metadata
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSecret(string $secretId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSecret', ['secret_id' => $secretId], $body, [], $options);
    }
}
