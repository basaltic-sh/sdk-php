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
final class Compute extends AbstractService
{
    protected const SERVICE = 'compute';
    protected const ENDPOINT = 'https://compute.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'attachInstanceNIC' => [
            'id' => 'attachInstanceNIC',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/nics',
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
        'attachInstancePoolFloatingIp' => [
            'id' => 'attachInstancePoolFloatingIp',
            'method' => 'POST',
            'path' => '/v1/instance-pools/{pool_id}/floating-ips',
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
        'attachInstanceVolume' => [
            'id' => 'attachInstanceVolume',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/volumes',
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
        'createImage' => [
            'id' => 'createImage',
            'method' => 'POST',
            'path' => '/v1/images',
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
                    'attributes' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createInstance' => [
            'id' => 'createInstance',
            'method' => 'POST',
            'path' => '/v1/instances',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'networks' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'security_groups' => [
                                    'type' => 'array',
                                    'items' => [],
                                ],
                                'addresses' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'volumes' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'performance' => [
                                    'type' => 'object',
                                ],
                                'snapshot_schedules' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                        'properties' => [
                                            'tags' => [
                                                'type' => 'object',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'metadata' => [
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
        'createInstancePool' => [
            'id' => 'createInstancePool',
            'method' => 'POST',
            'path' => '/v1/instance-pools',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'autoscaling' => [
                        'type' => 'object',
                        'properties' => [
                            'metrics' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'labels' => [
                                            'type' => 'object',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                    'template' => [
                        'type' => 'object',
                        'properties' => [
                            'networks' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'security_groups' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'addresses' => [
                                            'type' => 'array',
                                            'items' => [
                                                'type' => 'object',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'metadata' => [
                                'type' => 'object',
                            ],
                            'tags' => [
                                'type' => 'object',
                            ],
                            'volumes' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'performance' => [
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
        'createSerialConsoleTicket' => [
            'id' => 'createSerialConsoleTicket',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/console/ticket',
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
        'deleteImage' => [
            'id' => 'deleteImage',
            'method' => 'DELETE',
            'path' => '/v1/images/{image_id}',
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
        'deleteInstance' => [
            'id' => 'deleteInstance',
            'method' => 'DELETE',
            'path' => '/v1/instances/{instance_id}',
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
        'deleteInstancePool' => [
            'id' => 'deleteInstancePool',
            'method' => 'DELETE',
            'path' => '/v1/instance-pools/{pool_id}',
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
        'detachInstanceNIC' => [
            'id' => 'detachInstanceNIC',
            'method' => 'DELETE',
            'path' => '/v1/instances/{instance_id}/nics/{interface_id}',
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
        'detachInstancePoolFloatingIp' => [
            'id' => 'detachInstancePoolFloatingIp',
            'method' => 'DELETE',
            'path' => '/v1/instance-pools/{pool_id}/floating-ips/{floating_ip_id}',
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
        'detachInstanceVolume' => [
            'id' => 'detachInstanceVolume',
            'method' => 'DELETE',
            'path' => '/v1/instances/{instance_id}/volumes/{volume_id}',
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
        'getConsoleOutput' => [
            'id' => 'getConsoleOutput',
            'method' => 'GET',
            'path' => '/v1/instances/{instance_id}/console/output',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'max_bytes' => [
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
        'getConsoleScreenshot' => [
            'id' => 'getConsoleScreenshot',
            'method' => 'GET',
            'path' => '/v1/instances/{instance_id}/console/screenshot',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'image/png',
            'items_key' => null,
        ],
        'getFlavor' => [
            'id' => 'getFlavor',
            'method' => 'GET',
            'path' => '/v1/flavors/{flavor_id}',
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
        'getImage' => [
            'id' => 'getImage',
            'method' => 'GET',
            'path' => '/v1/images/{image_id}',
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
        'getInstance' => [
            'id' => 'getInstance',
            'method' => 'GET',
            'path' => '/v1/instances/{instance_id}',
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
        'getInstancePool' => [
            'id' => 'getInstancePool',
            'method' => 'GET',
            'path' => '/v1/instance-pools/{pool_id}',
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
        'listFlavors' => [
            'id' => 'listFlavors',
            'method' => 'GET',
            'path' => '/v1/flavors',
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
                'family' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'flavors',
        ],
        'listImageCatalog' => [
            'id' => 'listImageCatalog',
            'method' => 'GET',
            'path' => '/v1/image-catalog',
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
                'os' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'architecture' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'categories',
        ],
        'listImages' => [
            'id' => 'listImages',
            'method' => 'GET',
            'path' => '/v1/images',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
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
                'os' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'architecture' => [
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
                'all_versions' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'images',
        ],
        'listInstanceNICs' => [
            'id' => 'listInstanceNICs',
            'method' => 'GET',
            'path' => '/v1/instances/{instance_id}/nics',
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
            'items_key' => 'nics',
        ],
        'listInstancePoolFloatingIps' => [
            'id' => 'listInstancePoolFloatingIps',
            'method' => 'GET',
            'path' => '/v1/instance-pools/{pool_id}/floating-ips',
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
            'items_key' => 'floating_ips',
        ],
        'listInstancePools' => [
            'id' => 'listInstancePools',
            'method' => 'GET',
            'path' => '/v1/instance-pools',
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
            'items_key' => 'instance_pools',
        ],
        'listInstanceVolumes' => [
            'id' => 'listInstanceVolumes',
            'method' => 'GET',
            'path' => '/v1/instances/{instance_id}/volumes',
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
            'items_key' => 'attachments',
        ],
        'listInstances' => [
            'id' => 'listInstances',
            'method' => 'GET',
            'path' => '/v1/instances',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
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
                'name' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'current_state' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'flavor' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'image' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'instances',
        ],
        'listPoolInstances' => [
            'id' => 'listPoolInstances',
            'method' => 'GET',
            'path' => '/v1/instance-pools/{pool_id}/instances',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
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
                'name' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'current_state' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'flavor' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'image' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'instances',
        ],
        'rebootInstance' => [
            'id' => 'rebootInstance',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/reboot',
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
        'refreshInstancePool' => [
            'id' => 'refreshInstancePool',
            'method' => 'POST',
            'path' => '/v1/instance-pools/{pool_id}/refresh',
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
        'reinstallInstance' => [
            'id' => 'reinstallInstance',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/reinstall',
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
        'resizeInstance' => [
            'id' => 'resizeInstance',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/resize',
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
        'startInstance' => [
            'id' => 'startInstance',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/start',
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
        'startSerialConsole' => [
            'id' => 'startSerialConsole',
            'method' => 'GET',
            'path' => '/v1/instances/{instance_id}/console/serial',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'backlog_bytes' => [
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
        'stopInstance' => [
            'id' => 'stopInstance',
            'method' => 'POST',
            'path' => '/v1/instances/{instance_id}/stop',
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
        'updateImage' => [
            'id' => 'updateImage',
            'method' => 'PATCH',
            'path' => '/v1/images/{image_id}',
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
                    'attributes' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateInstance' => [
            'id' => 'updateInstance',
            'method' => 'PATCH',
            'path' => '/v1/instances/{instance_id}',
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
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateInstancePool' => [
            'id' => 'updateInstancePool',
            'method' => 'PATCH',
            'path' => '/v1/instance-pools/{pool_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'autoscaling' => [
                        'type' => 'object',
                        'properties' => [
                            'metrics' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'labels' => [
                                            'type' => 'object',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                    'template' => [
                        'type' => 'object',
                        'properties' => [
                            'networks' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'security_groups' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'addresses' => [
                                            'type' => 'array',
                                            'items' => [
                                                'type' => 'object',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'metadata' => [
                                'type' => 'object',
                            ],
                            'tags' => [
                                'type' => 'object',
                            ],
                            'volumes' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'performance' => [
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
        'updateInstanceVolumeAttachment' => [
            'id' => 'updateInstanceVolumeAttachment',
            'method' => 'PATCH',
            'path' => '/v1/instances/{instance_id}/volumes/{volume_id}',
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
     * Attach an existing NIC to an instance
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachInstanceNIC(string $instanceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachInstanceNIC', ['instance_id' => $instanceId], $body, [], $options);
    }

    /**
     * Give the pool a shared public address
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachInstancePoolFloatingIp(string $poolId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachInstancePoolFloatingIp', ['pool_id' => $poolId], $body, [], $options);
    }

    /**
     * Attach a data volume to an instance
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachInstanceVolume(string $instanceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachInstanceVolume', ['instance_id' => $instanceId], $body, [], $options);
    }

    /**
     * Import an image from an object URL
     * @param array<string, mixed>|\stdClass $body
     */
    public function createImage(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createImage', [], $body, [], $options);
    }

    /**
     * Create instance
     * @param array<string, mixed>|\stdClass $body
     */
    public function createInstance(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createInstance', [], $body, [], $options);
    }

    /**
     * Create an instance pool
     * @param array<string, mixed>|\stdClass $body
     */
    public function createInstancePool(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createInstancePool', [], $body, [], $options);
    }

    /**
     * Mint a ticket for the serial console
     */
    public function createSerialConsoleTicket(string $instanceId, ?RequestOptions $options = null): Result
    {
        return $this->result('createSerialConsoleTicket', ['instance_id' => $instanceId], null, [], $options);
    }

    /**
     * Delete an unused image
     */
    public function deleteImage(string $imageId, ?RequestOptions $options = null): Result
    {
        return $this->result('deleteImage', ['image_id' => $imageId], null, [], $options);
    }

    /**
     * Delete instance
     */
    public function deleteInstance(string $instanceId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteInstance', ['instance_id' => $instanceId], null, [], $options);
    }

    /**
     * Delete an instance pool
     */
    public function deleteInstancePool(string $poolId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteInstancePool', ['pool_id' => $poolId], null, [], $options);
    }

    /**
     * Detach a NIC from a running instance
     */
    public function detachInstanceNIC(string $instanceId, string $interfaceId, ?RequestOptions $options = null): void
    {
        $this->discard('detachInstanceNIC', ['instance_id' => $instanceId, 'interface_id' => $interfaceId], null, [], $options);
    }

    /**
     * Take a shared address off the pool
     */
    public function detachInstancePoolFloatingIp(string $poolId, string $floatingIpId, ?RequestOptions $options = null): void
    {
        $this->discard('detachInstancePoolFloatingIp', ['pool_id' => $poolId, 'floating_ip_id' => $floatingIpId], null, [], $options);
    }

    /**
     * Detach a data volume from an instance
     */
    public function detachInstanceVolume(string $instanceId, string $volumeId, ?RequestOptions $options = null): void
    {
        $this->discard('detachInstanceVolume', ['instance_id' => $instanceId, 'volume_id' => $volumeId], null, [], $options);
    }

    /**
     * Get the instance's serial console output
     * @param array<string, mixed> $query
     */
    public function getConsoleOutput(string $instanceId, array $query = [], ?RequestOptions $options = null): Result
    {
        return $this->result('getConsoleOutput', ['instance_id' => $instanceId], null, $query, $options);
    }

    /**
     * Capture the instance's display
     */
    public function getConsoleScreenshot(string $instanceId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('getConsoleScreenshot', ['instance_id' => $instanceId], null, [], $options);
    }

    /**
     * Get flavor
     */
    public function getFlavor(string $flavorId, ?RequestOptions $options = null): Result
    {
        return $this->result('getFlavor', ['flavor_id' => $flavorId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getFlavorByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getFlavor($id, $options),
            fn (array $filter): Page => $this->listFlavors(array_replace($scope, $filter), $options),
            true,
            'flavor',
        );
    }

    /**
     * Get an image
     */
    public function getImage(string $imageId, ?RequestOptions $options = null): Result
    {
        return $this->result('getImage', ['image_id' => $imageId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getImageByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getImage($id, $options),
            fn (array $filter): Page => $this->listImages(array_replace($scope, $filter), $options),
            true,
            'image',
        );
    }

    /**
     * Get instance
     */
    public function getInstance(string $instanceId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInstance', ['instance_id' => $instanceId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getInstanceByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getInstance($id, $options),
            fn (array $filter): Page => $this->listInstances(array_replace($scope, $filter), $options),
            true,
            'instance',
        );
    }

    /**
     * Get an instance pool
     */
    public function getInstancePool(string $poolId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInstancePool', ['pool_id' => $poolId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getInstancePoolByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getInstancePool($id, $options),
            fn (array $filter): Page => $this->listInstancePools(array_replace($scope, $filter), $options),
            true,
            'instance_pool',
        );
    }

    /**
     * List flavors
     * @param array<string, mixed> $query
     */
    public function listFlavors(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listFlavors', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listFlavorsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listFlavors($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the launch image catalog
     * @param array<string, mixed> $query
     */
    public function listImageCatalog(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listImageCatalog', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listImageCatalogAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listImageCatalog(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List images
     * @param array<string, mixed> $query
     */
    public function listImages(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listImages', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listImagesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listImages(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the instance's network interfaces
     * @param array<string, mixed> $query
     */
    public function listInstanceNICs(string $instanceId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInstanceNICs', ['instance_id' => $instanceId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInstanceNICsAll(string $instanceId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInstanceNICs($instanceId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the pool's shared public addresses
     * @param array<string, mixed> $query
     */
    public function listInstancePoolFloatingIps(string $poolId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInstancePoolFloatingIps', ['pool_id' => $poolId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInstancePoolFloatingIpsAll(string $poolId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInstancePoolFloatingIps($poolId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List instance pools
     * @param array<string, mixed> $query
     */
    public function listInstancePools(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInstancePools', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInstancePoolsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInstancePools(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the instance's attached volumes
     * @param array<string, mixed> $query
     */
    public function listInstanceVolumes(string $instanceId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInstanceVolumes', ['instance_id' => $instanceId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInstanceVolumesAll(string $instanceId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInstanceVolumes($instanceId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List instances
     * @param array<string, mixed> $query
     */
    public function listInstances(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInstances', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInstancesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInstances(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List a pool's instances
     * @param array<string, mixed> $query
     */
    public function listPoolInstances(string $poolId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPoolInstances', ['pool_id' => $poolId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPoolInstancesAll(string $poolId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPoolInstances($poolId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Reboot instance
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function rebootInstance(string $instanceId, array|\stdClass|null $body = null, ?RequestOptions $options = null): void
    {
        $this->discard('rebootInstance', ['instance_id' => $instanceId], $body, [], $options);
    }

    /**
     * Roll every member onto the pool's current launch template
     */
    public function refreshInstancePool(string $poolId, ?RequestOptions $options = null): Result
    {
        return $this->result('refreshInstancePool', ['pool_id' => $poolId], null, [], $options);
    }

    /**
     * Reinstall instance
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function reinstallInstance(string $instanceId, array|\stdClass|null $body = null, ?RequestOptions $options = null): void
    {
        $this->discard('reinstallInstance', ['instance_id' => $instanceId], $body, [], $options);
    }

    /**
     * Resize instance
     * @param array<string, mixed>|\stdClass $body
     */
    public function resizeInstance(string $instanceId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('resizeInstance', ['instance_id' => $instanceId], $body, [], $options);
    }

    /**
     * Start instance
     */
    public function startInstance(string $instanceId, ?RequestOptions $options = null): void
    {
        $this->discard('startInstance', ['instance_id' => $instanceId], null, [], $options);
    }

    /**
     * Open an interactive serial console
     * @param array<string, mixed> $query
     */
    public function startSerialConsole(string $instanceId, array $query = [], ?RequestOptions $options = null): RequestInterface
    {
        return $this->websocket('startSerialConsole', ['instance_id' => $instanceId], null, $query, $options);
    }

    /**
     * Stop instance
     */
    public function stopInstance(string $instanceId, ?RequestOptions $options = null): void
    {
        $this->discard('stopInstance', ['instance_id' => $instanceId], null, [], $options);
    }

    /**
     * Update an image's metadata
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateImage(string $imageId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateImage', ['image_id' => $imageId], $body, [], $options);
    }

    /**
     * Update instance
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateInstance(string $instanceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateInstance', ['instance_id' => $instanceId], $body, [], $options);
    }

    /**
     * Update an instance pool's description, size, tags or launch template
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateInstancePool(string $poolId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateInstancePool', ['pool_id' => $poolId], $body, [], $options);
    }

    /**
     * Update a volume attachment's settings
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateInstanceVolumeAttachment(string $instanceId, string $volumeId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('updateInstanceVolumeAttachment', ['instance_id' => $instanceId, 'volume_id' => $volumeId], $body, [], $options);
    }
}
