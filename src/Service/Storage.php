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
final class Storage extends AbstractService
{
    protected const SERVICE = 'storage';
    protected const ENDPOINT = 'https://storage.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'abortMultipartUpload' => [
            'id' => 'abortMultipartUpload',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/multipart-uploads/{upload_id}',
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
        'completeMultipartUpload' => [
            'id' => 'completeMultipartUpload',
            'method' => 'POST',
            'path' => '/v1/buckets/{bucket}/multipart-uploads/{upload_id}/complete',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'parts' => [
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
        'createBucket' => [
            'id' => 'createBucket',
            'method' => 'POST',
            'path' => '/v1/buckets',
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
        'createSnapshot' => [
            'id' => 'createSnapshot',
            'method' => 'POST',
            'path' => '/v1/snapshots',
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
        'createSnapshotPolicy' => [
            'id' => 'createSnapshotPolicy',
            'method' => 'POST',
            'path' => '/v1/snapshot-policies',
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
        'createVolume' => [
            'id' => 'createVolume',
            'method' => 'POST',
            'path' => '/v1/volumes',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'performance' => [
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
        'deleteBucket' => [
            'id' => 'deleteBucket',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}',
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
        'deleteBucketCORS' => [
            'id' => 'deleteBucketCORS',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/cors',
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
        'deleteBucketEncryption' => [
            'id' => 'deleteBucketEncryption',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/encryption',
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
        'deleteBucketLifecycle' => [
            'id' => 'deleteBucketLifecycle',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/lifecycle',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [
                'If-Match',
            ],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'deleteBucketObjectLock' => [
            'id' => 'deleteBucketObjectLock',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/object-lock',
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
        'deleteBucketPolicy' => [
            'id' => 'deleteBucketPolicy',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/policy',
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
        'deleteBucketTagging' => [
            'id' => 'deleteBucketTagging',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/tagging',
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
        'deleteObject' => [
            'id' => 'deleteObject',
            'method' => 'DELETE',
            'path' => '/v1/buckets/{bucket}/objects/{key}',
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
        'deleteSnapshot' => [
            'id' => 'deleteSnapshot',
            'method' => 'DELETE',
            'path' => '/v1/snapshots/{snapshot_id}',
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
        'deleteSnapshotPolicy' => [
            'id' => 'deleteSnapshotPolicy',
            'method' => 'DELETE',
            'path' => '/v1/snapshot-policies/{policy_id}',
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
        'deleteVolume' => [
            'id' => 'deleteVolume',
            'method' => 'DELETE',
            'path' => '/v1/volumes/{volume_id}',
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
        'extendVolume' => [
            'id' => 'extendVolume',
            'method' => 'POST',
            'path' => '/v1/volumes/{volume_id}/extend',
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
        'getBucketCORS' => [
            'id' => 'getBucketCORS',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/cors',
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
        'getBucketEncryption' => [
            'id' => 'getBucketEncryption',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/encryption',
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
        'getBucketLifecycle' => [
            'id' => 'getBucketLifecycle',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/lifecycle',
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
        'getBucketObjectLock' => [
            'id' => 'getBucketObjectLock',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/object-lock',
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
        'getBucketPolicy' => [
            'id' => 'getBucketPolicy',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/policy',
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
        'getBucketTagging' => [
            'id' => 'getBucketTagging',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/tagging',
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
        'getBucketVersioning' => [
            'id' => 'getBucketVersioning',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/versioning',
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
        'getObject' => [
            'id' => 'getObject',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/objects/{key}',
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
        'getSnapshot' => [
            'id' => 'getSnapshot',
            'method' => 'GET',
            'path' => '/v1/snapshots/{snapshot_id}',
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
        'getSnapshotPolicy' => [
            'id' => 'getSnapshotPolicy',
            'method' => 'GET',
            'path' => '/v1/snapshot-policies/{policy_id}',
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
        'getVolume' => [
            'id' => 'getVolume',
            'method' => 'GET',
            'path' => '/v1/volumes/{volume_id}',
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
        'headBucket' => [
            'id' => 'headBucket',
            'method' => 'HEAD',
            'path' => '/v1/buckets/{bucket}',
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
        'headObject' => [
            'id' => 'headObject',
            'method' => 'HEAD',
            'path' => '/v1/buckets/{bucket}/objects/{key}',
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
        'initiateMultipartUpload' => [
            'id' => 'initiateMultipartUpload',
            'method' => 'POST',
            'path' => '/v1/buckets/{bucket}/multipart-uploads',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'metadata' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'listBuckets' => [
            'id' => 'listBuckets',
            'method' => 'GET',
            'path' => '/v1/buckets',
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
            'items_key' => 'buckets',
        ],
        'listMultipartUploads' => [
            'id' => 'listMultipartUploads',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/multipart-uploads',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'prefix' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'max_uploads' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'uploads',
        ],
        'listObjectVersions' => [
            'id' => 'listObjectVersions',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/object-versions',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'prefix' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'key_marker' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'version_id_marker' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'max_keys' => [
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
        'listObjects' => [
            'id' => 'listObjects',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/objects',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'prefix' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'delimiter' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'marker' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'max_keys' => [
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
        'listParts' => [
            'id' => 'listParts',
            'method' => 'GET',
            'path' => '/v1/buckets/{bucket}/multipart-uploads/{upload_id}/parts',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'parts',
        ],
        'listSnapshotPolicies' => [
            'id' => 'listSnapshotPolicies',
            'method' => 'GET',
            'path' => '/v1/snapshot-policies',
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
                'volume' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'enabled' => [
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
            'items_key' => 'snapshot_policies',
        ],
        'listSnapshots' => [
            'id' => 'listSnapshots',
            'method' => 'GET',
            'path' => '/v1/snapshots',
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
                'volume' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'name' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'snapshot_policy' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'snapshots',
        ],
        'listVolumeTypes' => [
            'id' => 'listVolumeTypes',
            'method' => 'GET',
            'path' => '/v1/volume-types',
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
            'items_key' => 'volume_types',
        ],
        'listVolumes' => [
            'id' => 'listVolumes',
            'method' => 'GET',
            'path' => '/v1/volumes',
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
                'name' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status' => [
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
            'items_key' => 'volumes',
        ],
        'putBucketCORS' => [
            'id' => 'putBucketCORS',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/cors',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'cors' => [
                        'type' => 'object',
                        'properties' => [
                            'rules' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'allowed_origins' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'allowed_methods' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'allowed_headers' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'expose_headers' => [
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
        'putBucketDeletionProtection' => [
            'id' => 'putBucketDeletionProtection',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/deletion-protection',
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
        'putBucketEncryption' => [
            'id' => 'putBucketEncryption',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/encryption',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'encryption' => [
                        'type' => 'object',
                        'properties' => [
                            'rules' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'default' => [
                                            'type' => 'object',
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
        'putBucketLifecycle' => [
            'id' => 'putBucketLifecycle',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/lifecycle',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [
                'If-Match',
            ],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'lifecycle' => [
                        'type' => 'object',
                        'properties' => [
                            'rules' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'filter' => [
                                            'type' => 'object',
                                        ],
                                        'transition' => [
                                            'type' => 'object',
                                        ],
                                        'expiration' => [
                                            'type' => 'object',
                                        ],
                                        'noncurrent_version_expiration' => [
                                            'type' => 'object',
                                        ],
                                        'abort_incomplete_multipart_upload' => [
                                            'type' => 'object',
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
        'putBucketObjectLock' => [
            'id' => 'putBucketObjectLock',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/object-lock',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'object_lock' => [
                        'type' => 'object',
                        'properties' => [
                            'rule' => [
                                'type' => 'object',
                                'properties' => [
                                    'default_retention' => [
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
        'putBucketPolicy' => [
            'id' => 'putBucketPolicy',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/policy',
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
        'putBucketTagging' => [
            'id' => 'putBucketTagging',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/tagging',
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
        'putBucketVersioning' => [
            'id' => 'putBucketVersioning',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/versioning',
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
        'putObject' => [
            'id' => 'putObject',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/objects/{key}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/octet-stream',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'restoreBucket' => [
            'id' => 'restoreBucket',
            'method' => 'POST',
            'path' => '/v1/buckets/{bucket}/restore',
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
        'updateSnapshot' => [
            'id' => 'updateSnapshot',
            'method' => 'PATCH',
            'path' => '/v1/snapshots/{snapshot_id}',
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
        'updateSnapshotPolicy' => [
            'id' => 'updateSnapshotPolicy',
            'method' => 'PATCH',
            'path' => '/v1/snapshot-policies/{policy_id}',
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
        'updateVolume' => [
            'id' => 'updateVolume',
            'method' => 'PATCH',
            'path' => '/v1/volumes/{volume_id}',
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
        'updateVolumePerformance' => [
            'id' => 'updateVolumePerformance',
            'method' => 'POST',
            'path' => '/v1/volumes/{volume_id}/performance',
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
        'uploadPart' => [
            'id' => 'uploadPart',
            'method' => 'PUT',
            'path' => '/v1/buckets/{bucket}/multipart-uploads/{upload_id}/parts/{part_number}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/octet-stream',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => null,
        ],
    ];

    /**
     * Abort a multipart upload
     */
    public function abortMultipartUpload(string $bucket, string $uploadId, ?RequestOptions $options = null): void
    {
        $this->discard('abortMultipartUpload', ['bucket' => $bucket, 'upload_id' => $uploadId], null, [], $options);
    }

    /**
     * Complete a multipart upload
     * @param array<string, mixed>|\stdClass $body
     */
    public function completeMultipartUpload(string $bucket, string $uploadId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('completeMultipartUpload', ['bucket' => $bucket, 'upload_id' => $uploadId], $body, [], $options);
    }

    /**
     * Create bucket
     * @param array<string, mixed>|\stdClass $body
     */
    public function createBucket(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createBucket', [], $body, [], $options);
    }

    /**
     * Create snapshot
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSnapshot(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSnapshot', [], $body, [], $options);
    }

    /**
     * Create snapshot policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSnapshotPolicy(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSnapshotPolicy', [], $body, [], $options);
    }

    /**
     * Create volume
     * @param array<string, mixed>|\stdClass $body
     */
    public function createVolume(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createVolume', [], $body, [], $options);
    }

    /**
     * Delete bucket
     */
    public function deleteBucket(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('deleteBucket', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete bucket CORS configuration
     */
    public function deleteBucketCORS(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('deleteBucketCORS', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete bucket encryption configuration
     */
    public function deleteBucketEncryption(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('deleteBucketEncryption', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete bucket lifecycle configuration
     */
    public function deleteBucketLifecycle(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('deleteBucketLifecycle', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete bucket object-lock configuration
     */
    public function deleteBucketObjectLock(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('deleteBucketObjectLock', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete bucket policy
     */
    public function deleteBucketPolicy(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('deleteBucketPolicy', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete bucket tag set
     */
    public function deleteBucketTagging(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('deleteBucketTagging', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Delete object
     */
    public function deleteObject(string $bucket, string $key, ?RequestOptions $options = null): void
    {
        $this->discard('deleteObject', ['bucket' => $bucket, 'key' => $key], null, [], $options);
    }

    /**
     * Delete snapshot
     */
    public function deleteSnapshot(string $snapshotId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteSnapshot', ['snapshot_id' => $snapshotId], null, [], $options);
    }

    /**
     * Delete snapshot policy
     */
    public function deleteSnapshotPolicy(string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteSnapshotPolicy', ['policy_id' => $policyId], null, [], $options);
    }

    /**
     * Delete volume
     */
    public function deleteVolume(string $volumeId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteVolume', ['volume_id' => $volumeId], null, [], $options);
    }

    /**
     * Extend volume
     * @param array<string, mixed>|\stdClass $body
     */
    public function extendVolume(string $volumeId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('extendVolume', ['volume_id' => $volumeId], $body, [], $options);
    }

    /**
     * Get bucket CORS configuration
     */
    public function getBucketCORS(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketCORS', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Get bucket encryption configuration
     */
    public function getBucketEncryption(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketEncryption', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Get bucket lifecycle configuration
     */
    public function getBucketLifecycle(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketLifecycle', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Get bucket object-lock configuration
     */
    public function getBucketObjectLock(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketObjectLock', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Get bucket policy
     */
    public function getBucketPolicy(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketPolicy', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Get bucket tag set
     */
    public function getBucketTagging(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketTagging', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Get bucket versioning state
     */
    public function getBucketVersioning(string $bucket, ?RequestOptions $options = null): Result
    {
        return $this->result('getBucketVersioning', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Download object
     */
    public function getObject(string $bucket, string $key, ?RequestOptions $options = null): Result
    {
        return $this->result('getObject', ['bucket' => $bucket, 'key' => $key], null, [], $options);
    }

    /**
     * Get snapshot
     */
    public function getSnapshot(string $snapshotId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSnapshot', ['snapshot_id' => $snapshotId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getSnapshotByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getSnapshot($id, $options),
            fn (array $filter): Page => $this->listSnapshots(array_replace($scope, $filter), $options),
            true,
            'snapshot',
        );
    }

    /**
     * Get snapshot policy
     */
    public function getSnapshotPolicy(string $policyId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSnapshotPolicy', ['policy_id' => $policyId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getSnapshotPolicyByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getSnapshotPolicy($id, $options),
            fn (array $filter): Page => $this->listSnapshotPolicies(array_replace($scope, $filter), $options),
            true,
            'snapshot_policy',
        );
    }

    /**
     * Get volume
     */
    public function getVolume(string $volumeId, ?RequestOptions $options = null): Result
    {
        return $this->result('getVolume', ['volume_id' => $volumeId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getVolumeByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getVolume($id, $options),
            fn (array $filter): Page => $this->listVolumes(array_replace($scope, $filter), $options),
            true,
            'volume',
        );
    }

    /**
     * Head bucket
     */
    public function headBucket(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('headBucket', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Head object
     */
    public function headObject(string $bucket, string $key, ?RequestOptions $options = null): void
    {
        $this->discard('headObject', ['bucket' => $bucket, 'key' => $key], null, [], $options);
    }

    /**
     * Initiate a multipart upload
     * @param array<string, mixed>|\stdClass $body
     */
    public function initiateMultipartUpload(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('initiateMultipartUpload', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * List buckets
     * @param array<string, mixed> $query
     */
    public function listBuckets(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listBuckets', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listBucketsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listBuckets(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List in-flight multipart uploads
     * @param array<string, mixed> $query
     */
    public function listMultipartUploads(string $bucket, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listMultipartUploads', ['bucket' => $bucket], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listMultipartUploadsAll(string $bucket, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listMultipartUploads($bucket, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List object versions
     * @param array<string, mixed> $query
     */
    public function listObjectVersions(string $bucket, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listObjectVersions', ['bucket' => $bucket], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listObjectVersionsAll(string $bucket, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listObjectVersions($bucket, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List objects
     * @param array<string, mixed> $query
     */
    public function listObjects(string $bucket, array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('listObjects', ['bucket' => $bucket], null, $query, $options);
    }

    /**
     * List uploaded parts
     */
    public function listParts(string $bucket, string $uploadId, ?RequestOptions $options = null): Page
    {
        return $this->page('listParts', ['bucket' => $bucket, 'upload_id' => $uploadId], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPartsAll(string $bucket, string $uploadId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listParts($bucket, $uploadId, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List snapshot policies
     * @param array<string, mixed> $query
     */
    public function listSnapshotPolicies(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSnapshotPolicies', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSnapshotPoliciesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSnapshotPolicies(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List snapshots
     * @param array<string, mixed> $query
     */
    public function listSnapshots(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSnapshots', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSnapshotsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSnapshots(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List volume types
     * @param array<string, mixed> $query
     */
    public function listVolumeTypes(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listVolumeTypes', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listVolumeTypesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listVolumeTypes($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List volumes
     * @param array<string, mixed> $query
     */
    public function listVolumes(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listVolumes', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listVolumesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listVolumes(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Put bucket CORS configuration
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketCORS(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketCORS', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Set bucket deletion protection
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketDeletionProtection(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketDeletionProtection', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Put bucket encryption configuration
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketEncryption(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketEncryption', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Put bucket lifecycle configuration
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketLifecycle(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketLifecycle', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Put bucket object-lock configuration
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketObjectLock(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketObjectLock', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Put bucket policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketPolicy(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketPolicy', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Put bucket tag set
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketTagging(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketTagging', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Set bucket versioning state
     * @param array<string, mixed>|\stdClass $body
     */
    public function putBucketVersioning(string $bucket, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('putBucketVersioning', ['bucket' => $bucket], $body, [], $options);
    }

    /**
     * Upload object
     * @param string|resource|\Psr\Http\Message\StreamInterface $body
     */
    public function putObject(string $bucket, string $key, mixed $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putObject', ['bucket' => $bucket, 'key' => $key], $body, [], $options);
    }

    /**
     * Restore a bucket pending deletion
     */
    public function restoreBucket(string $bucket, ?RequestOptions $options = null): void
    {
        $this->discard('restoreBucket', ['bucket' => $bucket], null, [], $options);
    }

    /**
     * Update snapshot metadata
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSnapshot(string $snapshotId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSnapshot', ['snapshot_id' => $snapshotId], $body, [], $options);
    }

    /**
     * Update snapshot policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSnapshotPolicy(string $policyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSnapshotPolicy', ['policy_id' => $policyId], $body, [], $options);
    }

    /**
     * Update volume metadata
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateVolume(string $volumeId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateVolume', ['volume_id' => $volumeId], $body, [], $options);
    }

    /**
     * Update provisioned performance
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateVolumePerformance(string $volumeId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateVolumePerformance', ['volume_id' => $volumeId], $body, [], $options);
    }

    /**
     * Upload a part
     * @param string|resource|\Psr\Http\Message\StreamInterface $body
     */
    public function uploadPart(string $bucket, string $uploadId, string $partNumber, mixed $body, ?RequestOptions $options = null): Result
    {
        return $this->result('uploadPart', ['bucket' => $bucket, 'upload_id' => $uploadId, 'part_number' => $partNumber], $body, [], $options);
    }
}
