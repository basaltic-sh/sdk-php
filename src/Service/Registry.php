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
final class Registry extends AbstractService
{
    protected const SERVICE = 'registry';
    protected const ENDPOINT = 'https://registry.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'batchDeleteImage' => [
            'id' => 'batchDeleteImage',
            'method' => 'POST',
            'path' => '/v1/repositories/{repository_id}/images/batch-delete',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'digests' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'tags' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createPullThroughCacheRule' => [
            'id' => 'createPullThroughCacheRule',
            'method' => 'POST',
            'path' => '/v1/pull-through-cache-rules',
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
        'createRepository' => [
            'id' => 'createRepository',
            'method' => 'POST',
            'path' => '/v1/repositories',
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
        'deleteEncryptionConfiguration' => [
            'id' => 'deleteEncryptionConfiguration',
            'method' => 'DELETE',
            'path' => '/v1/encryption-configuration',
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
        'deleteLifecyclePolicy' => [
            'id' => 'deleteLifecyclePolicy',
            'method' => 'DELETE',
            'path' => '/v1/repositories/{repository_id}/lifecycle-policy',
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
        'deletePullThroughCacheRule' => [
            'id' => 'deletePullThroughCacheRule',
            'method' => 'DELETE',
            'path' => '/v1/pull-through-cache-rules/{prefix}',
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
        'deleteRepository' => [
            'id' => 'deleteRepository',
            'method' => 'DELETE',
            'path' => '/v1/repositories/{repository_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'force' => [
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
        'deleteRepositoryPolicy' => [
            'id' => 'deleteRepositoryPolicy',
            'method' => 'DELETE',
            'path' => '/v1/repositories/{repository_id}/policy',
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
        'describeImage' => [
            'id' => 'describeImage',
            'method' => 'GET',
            'path' => '/v1/repositories/{repository_id}/images/{image_reference}',
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
        'describeImages' => [
            'id' => 'describeImages',
            'method' => 'GET',
            'path' => '/v1/repositories/{repository_id}/images',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'tag_status' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'tag_prefix' => [
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
        'describePullThroughCacheRule' => [
            'id' => 'describePullThroughCacheRule',
            'method' => 'GET',
            'path' => '/v1/pull-through-cache-rules/{prefix}',
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
        'describePullThroughCacheRules' => [
            'id' => 'describePullThroughCacheRules',
            'method' => 'GET',
            'path' => '/v1/pull-through-cache-rules',
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
            'items_key' => null,
        ],
        'describeRepositories' => [
            'id' => 'describeRepositories',
            'method' => 'GET',
            'path' => '/v1/repositories',
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
            'items_key' => null,
        ],
        'describeRepository' => [
            'id' => 'describeRepository',
            'method' => 'GET',
            'path' => '/v1/repositories/{repository_id}',
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
        'getAuthorizationToken' => [
            'id' => 'getAuthorizationToken',
            'method' => 'POST',
            'path' => '/v1/authorization-token',
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
        'getEncryptionConfiguration' => [
            'id' => 'getEncryptionConfiguration',
            'method' => 'GET',
            'path' => '/v1/encryption-configuration',
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
        'getLifecyclePolicy' => [
            'id' => 'getLifecyclePolicy',
            'method' => 'GET',
            'path' => '/v1/repositories/{repository_id}/lifecycle-policy',
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
        'getRepositoryPolicy' => [
            'id' => 'getRepositoryPolicy',
            'method' => 'GET',
            'path' => '/v1/repositories/{repository_id}/policy',
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
        'getRetainedRegistryPresence' => [
            'id' => 'getRetainedRegistryPresence',
            'method' => 'GET',
            'path' => '/v1/encryption-configuration/retained-data',
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
        'listTags' => [
            'id' => 'listTags',
            'method' => 'GET',
            'path' => '/v1/repositories/{repository_id}/tags',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
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
            'items_key' => 'tags',
        ],
        'putEncryptionConfiguration' => [
            'id' => 'putEncryptionConfiguration',
            'method' => 'PUT',
            'path' => '/v1/encryption-configuration',
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
        'putLifecyclePolicy' => [
            'id' => 'putLifecyclePolicy',
            'method' => 'PUT',
            'path' => '/v1/repositories/{repository_id}/lifecycle-policy',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'rules' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'selection' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'tag_prefixes' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'tag_patterns' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
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
        'setRepositoryPolicy' => [
            'id' => 'setRepositoryPolicy',
            'method' => 'PUT',
            'path' => '/v1/repositories/{repository_id}/policy',
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
                        'properties' => [
                            'statements' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'principals' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'resources' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'conditions' => [
                                            'type' => 'array',
                                            'items' => [
                                                'type' => 'object',
                                                'properties' => [
                                                    'values' => [
                                                        'type' => 'array',
                                                        'items' => [],
                                                    ],
                                                ],
                                            ],
                                        ],
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
        'startLifecyclePolicyPreview' => [
            'id' => 'startLifecyclePolicyPreview',
            'method' => 'POST',
            'path' => '/v1/repositories/{repository_id}/lifecycle-policy/preview',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'rules' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'selection' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'tag_prefixes' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'tag_patterns' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
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
        'updatePullThroughCacheRule' => [
            'id' => 'updatePullThroughCacheRule',
            'method' => 'PATCH',
            'path' => '/v1/pull-through-cache-rules/{prefix}',
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
        'updateRepository' => [
            'id' => 'updateRepository',
            'method' => 'PATCH',
            'path' => '/v1/repositories/{repository_id}',
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
     * Delete images
     * @param array<string, mixed>|\stdClass $body
     */
    public function batchDeleteImage(string $repositoryId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('batchDeleteImage', ['repository_id' => $repositoryId], $body, [], $options);
    }

    /**
     * Create a pull-through cache rule
     * @param array<string, mixed>|\stdClass $body
     */
    public function createPullThroughCacheRule(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createPullThroughCacheRule', [], $body, [], $options);
    }

    /**
     * Create a repository
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRepository(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRepository', [], $body, [], $options);
    }

    /**
     * Delete encryption configuration
     */
    public function deleteEncryptionConfiguration(?RequestOptions $options = null): void
    {
        $this->discard('deleteEncryptionConfiguration', [], null, [], $options);
    }

    /**
     * Delete the lifecycle policy
     */
    public function deleteLifecyclePolicy(string $repositoryId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteLifecyclePolicy', ['repository_id' => $repositoryId], null, [], $options);
    }

    /**
     * Delete a pull-through cache rule
     */
    public function deletePullThroughCacheRule(string $prefix, ?RequestOptions $options = null): void
    {
        $this->discard('deletePullThroughCacheRule', ['prefix' => $prefix], null, [], $options);
    }

    /**
     * Delete a repository
     * @param array<string, mixed> $query
     */
    public function deleteRepository(string $repositoryId, array $query = [], ?RequestOptions $options = null): void
    {
        $this->discard('deleteRepository', ['repository_id' => $repositoryId], null, $query, $options);
    }

    /**
     * Delete the repository policy
     */
    public function deleteRepositoryPolicy(string $repositoryId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRepositoryPolicy', ['repository_id' => $repositoryId], null, [], $options);
    }

    /**
     * Describe an image
     */
    public function describeImage(string $repositoryId, string $imageReference, ?RequestOptions $options = null): Result
    {
        return $this->result('describeImage', ['repository_id' => $repositoryId, 'image_reference' => $imageReference], null, [], $options);
    }

    /**
     * List images
     * @param array<string, mixed> $query
     */
    public function describeImages(string $repositoryId, array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('describeImages', ['repository_id' => $repositoryId], null, $query, $options);
    }

    /**
     * Get a pull-through cache rule
     */
    public function describePullThroughCacheRule(string $prefix, ?RequestOptions $options = null): Result
    {
        return $this->result('describePullThroughCacheRule', ['prefix' => $prefix], null, [], $options);
    }

    /**
     * List pull-through cache rules
     * @param array<string, mixed> $query
     */
    public function describePullThroughCacheRules(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('describePullThroughCacheRules', [], null, $query, $options);
    }

    /**
     * List repositories
     * @param array<string, mixed> $query
     */
    public function describeRepositories(array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('describeRepositories', [], null, $query, $options);
    }

    /**
     * Describe a repository
     */
    public function describeRepository(string $repositoryId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeRepository', ['repository_id' => $repositoryId], null, [], $options);
    }

    /**
     * Get a docker login credential
     */
    public function getAuthorizationToken(?RequestOptions $options = null): Result
    {
        return $this->result('getAuthorizationToken', [], null, [], $options);
    }

    /**
     * Get the encryption configuration
     */
    public function getEncryptionConfiguration(?RequestOptions $options = null): Result
    {
        return $this->result('getEncryptionConfiguration', [], null, [], $options);
    }

    /**
     * Get the lifecycle policy
     */
    public function getLifecyclePolicy(string $repositoryId, ?RequestOptions $options = null): Result
    {
        return $this->result('getLifecyclePolicy', ['repository_id' => $repositoryId], null, [], $options);
    }

    /**
     * Get the repository policy
     */
    public function getRepositoryPolicy(string $repositoryId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRepositoryPolicy', ['repository_id' => $repositoryId], null, [], $options);
    }

    /**
     * Check retained registry data presence
     */
    public function getRetainedRegistryPresence(?RequestOptions $options = null): Result
    {
        return $this->result('getRetainedRegistryPresence', [], null, [], $options);
    }

    /**
     * List tags
     * @param array<string, mixed> $query
     */
    public function listTags(string $repositoryId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listTags', ['repository_id' => $repositoryId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listTagsAll(string $repositoryId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listTags($repositoryId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Set the encryption configuration
     * @param array<string, mixed>|\stdClass $body
     */
    public function putEncryptionConfiguration(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putEncryptionConfiguration', [], $body, [], $options);
    }

    /**
     * Set the lifecycle policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putLifecyclePolicy(string $repositoryId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putLifecyclePolicy', ['repository_id' => $repositoryId], $body, [], $options);
    }

    /**
     * Set the repository policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function setRepositoryPolicy(string $repositoryId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('setRepositoryPolicy', ['repository_id' => $repositoryId], $body, [], $options);
    }

    /**
     * Preview a lifecycle policy
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function startLifecyclePolicyPreview(string $repositoryId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('startLifecyclePolicyPreview', ['repository_id' => $repositoryId], $body, [], $options);
    }

    /**
     * Update a pull-through cache rule
     * @param array<string, mixed>|\stdClass $body
     */
    public function updatePullThroughCacheRule(string $prefix, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updatePullThroughCacheRule', ['prefix' => $prefix], $body, [], $options);
    }

    /**
     * Update repository settings
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRepository(string $repositoryId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRepository', ['repository_id' => $repositoryId], $body, [], $options);
    }
}
