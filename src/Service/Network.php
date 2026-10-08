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
final class Network extends AbstractService
{
    protected const SERVICE = 'network';
    protected const ENDPOINT = 'https://network.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'attachFloatingIp' => [
            'id' => 'attachFloatingIp',
            'method' => 'POST',
            'path' => '/v1/floating-ips/{floating_ip_id}/attach',
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
        'attachInternetGateway' => [
            'id' => 'attachInternetGateway',
            'method' => 'POST',
            'path' => '/v1/internet-gateways/{internet_gateway_id}/attach',
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
        'createEgressOnlyGateway' => [
            'id' => 'createEgressOnlyGateway',
            'method' => 'POST',
            'path' => '/v1/egress-only-gateways',
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
        'createFloatingIp' => [
            'id' => 'createFloatingIp',
            'method' => 'POST',
            'path' => '/v1/floating-ips',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'tags' => [
                        'type' => 'object',
                    ],
                    'health_check' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createInterface' => [
            'id' => 'createInterface',
            'method' => 'POST',
            'path' => '/v1/interfaces',
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
                    'addresses' => [
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
        'createInterfaceAddress' => [
            'id' => 'createInterfaceAddress',
            'method' => 'POST',
            'path' => '/v1/interfaces/{interface_id}/addresses',
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
        'createInterfacePrefix' => [
            'id' => 'createInterfacePrefix',
            'method' => 'POST',
            'path' => '/v1/interfaces/{interface_id}/prefixes',
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
        'createInternetGateway' => [
            'id' => 'createInternetGateway',
            'method' => 'POST',
            'path' => '/v1/internet-gateways',
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
        'createNATGateway' => [
            'id' => 'createNATGateway',
            'method' => 'POST',
            'path' => '/v1/nat-gateways',
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
        'createPrefixPool' => [
            'id' => 'createPrefixPool',
            'method' => 'POST',
            'path' => '/v1/vpcs/{vpc_id}/prefix-pools',
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
        'createRoute' => [
            'id' => 'createRoute',
            'method' => 'POST',
            'path' => '/v1/route-tables/{route_table_id}/routes',
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
        'createRouteTable' => [
            'id' => 'createRouteTable',
            'method' => 'POST',
            'path' => '/v1/route-tables',
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
        'createSecurityGroup' => [
            'id' => 'createSecurityGroup',
            'method' => 'POST',
            'path' => '/v1/security-groups',
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
        'createSecurityGroupRule' => [
            'id' => 'createSecurityGroupRule',
            'method' => 'POST',
            'path' => '/v1/security-groups/{security_group_id}/rules',
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
        'createSubnet' => [
            'id' => 'createSubnet',
            'method' => 'POST',
            'path' => '/v1/subnets',
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
        'createVpc' => [
            'id' => 'createVpc',
            'method' => 'POST',
            'path' => '/v1/vpcs',
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
        'deleteEgressOnlyGateway' => [
            'id' => 'deleteEgressOnlyGateway',
            'method' => 'DELETE',
            'path' => '/v1/egress-only-gateways/{egress_only_gateway_id}',
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
        'deleteFloatingIp' => [
            'id' => 'deleteFloatingIp',
            'method' => 'DELETE',
            'path' => '/v1/floating-ips/{floating_ip_id}',
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
        'deleteInterface' => [
            'id' => 'deleteInterface',
            'method' => 'DELETE',
            'path' => '/v1/interfaces/{interface_id}',
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
        'deleteInterfaceAddress' => [
            'id' => 'deleteInterfaceAddress',
            'method' => 'DELETE',
            'path' => '/v1/interfaces/{interface_id}/addresses/{address_id}',
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
        'deleteInterfacePrefix' => [
            'id' => 'deleteInterfacePrefix',
            'method' => 'DELETE',
            'path' => '/v1/interfaces/{interface_id}/prefixes/{prefix_id}',
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
        'deleteInternetGateway' => [
            'id' => 'deleteInternetGateway',
            'method' => 'DELETE',
            'path' => '/v1/internet-gateways/{internet_gateway_id}',
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
        'deleteNATGateway' => [
            'id' => 'deleteNATGateway',
            'method' => 'DELETE',
            'path' => '/v1/nat-gateways/{nat_gateway_id}',
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
        'deletePrefixPool' => [
            'id' => 'deletePrefixPool',
            'method' => 'DELETE',
            'path' => '/v1/vpcs/{vpc_id}/prefix-pools/{pool_id}',
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
        'deleteRoute' => [
            'id' => 'deleteRoute',
            'method' => 'DELETE',
            'path' => '/v1/route-tables/{route_table_id}/routes/{route_id}',
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
        'deleteRouteTable' => [
            'id' => 'deleteRouteTable',
            'method' => 'DELETE',
            'path' => '/v1/route-tables/{route_table_id}',
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
        'deleteSecurityGroup' => [
            'id' => 'deleteSecurityGroup',
            'method' => 'DELETE',
            'path' => '/v1/security-groups/{security_group_id}',
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
        'deleteSecurityGroupRule' => [
            'id' => 'deleteSecurityGroupRule',
            'method' => 'DELETE',
            'path' => '/v1/security-groups/{security_group_id}/rules/{rule_id}',
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
        'deleteSubnet' => [
            'id' => 'deleteSubnet',
            'method' => 'DELETE',
            'path' => '/v1/subnets/{subnet_id}',
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
        'deleteVpc' => [
            'id' => 'deleteVpc',
            'method' => 'DELETE',
            'path' => '/v1/vpcs/{vpc_id}',
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
        'detachFloatingIp' => [
            'id' => 'detachFloatingIp',
            'method' => 'POST',
            'path' => '/v1/floating-ips/{floating_ip_id}/detach',
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
        'detachInternetGateway' => [
            'id' => 'detachInternetGateway',
            'method' => 'POST',
            'path' => '/v1/internet-gateways/{internet_gateway_id}/detach',
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
        'getEgressOnlyGateway' => [
            'id' => 'getEgressOnlyGateway',
            'method' => 'GET',
            'path' => '/v1/egress-only-gateways/{egress_only_gateway_id}',
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
        'getFloatingIp' => [
            'id' => 'getFloatingIp',
            'method' => 'GET',
            'path' => '/v1/floating-ips/{floating_ip_id}',
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
        'getInterface' => [
            'id' => 'getInterface',
            'method' => 'GET',
            'path' => '/v1/interfaces/{interface_id}',
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
        'getInterfaceAddress' => [
            'id' => 'getInterfaceAddress',
            'method' => 'GET',
            'path' => '/v1/interfaces/{interface_id}/addresses/{address_id}',
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
        'getInternetGateway' => [
            'id' => 'getInternetGateway',
            'method' => 'GET',
            'path' => '/v1/internet-gateways/{internet_gateway_id}',
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
        'getNATGateway' => [
            'id' => 'getNATGateway',
            'method' => 'GET',
            'path' => '/v1/nat-gateways/{nat_gateway_id}',
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
        'getRoute' => [
            'id' => 'getRoute',
            'method' => 'GET',
            'path' => '/v1/route-tables/{route_table_id}/routes/{route_id}',
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
        'getRouteTable' => [
            'id' => 'getRouteTable',
            'method' => 'GET',
            'path' => '/v1/route-tables/{route_table_id}',
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
        'getSecurityGroup' => [
            'id' => 'getSecurityGroup',
            'method' => 'GET',
            'path' => '/v1/security-groups/{security_group_id}',
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
        'getSecurityGroupRule' => [
            'id' => 'getSecurityGroupRule',
            'method' => 'GET',
            'path' => '/v1/security-groups/{security_group_id}/rules/{rule_id}',
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
        'getSubnet' => [
            'id' => 'getSubnet',
            'method' => 'GET',
            'path' => '/v1/subnets/{subnet_id}',
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
        'getVpc' => [
            'id' => 'getVpc',
            'method' => 'GET',
            'path' => '/v1/vpcs/{vpc_id}',
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
        'listEgressOnlyGatewayRoutes' => [
            'id' => 'listEgressOnlyGatewayRoutes',
            'method' => 'GET',
            'path' => '/v1/egress-only-gateways/{egress_only_gateway_id}/routes',
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
            'items_key' => 'routes',
        ],
        'listEgressOnlyGateways' => [
            'id' => 'listEgressOnlyGateways',
            'method' => 'GET',
            'path' => '/v1/egress-only-gateways',
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
            'items_key' => 'egress_only_gateways',
        ],
        'listFloatingIps' => [
            'id' => 'listFloatingIps',
            'method' => 'GET',
            'path' => '/v1/floating-ips',
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
                'attached_to' => [
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
        'listInterfaceAddresses' => [
            'id' => 'listInterfaceAddresses',
            'method' => 'GET',
            'path' => '/v1/interfaces/{interface_id}/addresses',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'addresses',
        ],
        'listInterfacePrefixes' => [
            'id' => 'listInterfacePrefixes',
            'method' => 'GET',
            'path' => '/v1/interfaces/{interface_id}/prefixes',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'routed_prefixes',
        ],
        'listInterfaceSecurityGroups' => [
            'id' => 'listInterfaceSecurityGroups',
            'method' => 'GET',
            'path' => '/v1/interfaces/{interface_id}/security-groups',
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
            'items_key' => 'security_group_ids',
        ],
        'listInterfaces' => [
            'id' => 'listInterfaces',
            'method' => 'GET',
            'path' => '/v1/interfaces',
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
                'subnet' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'vpc' => [
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
            'items_key' => 'interfaces',
        ],
        'listInternetGatewayRoutes' => [
            'id' => 'listInternetGatewayRoutes',
            'method' => 'GET',
            'path' => '/v1/internet-gateways/{internet_gateway_id}/routes',
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
            'items_key' => 'routes',
        ],
        'listInternetGateways' => [
            'id' => 'listInternetGateways',
            'method' => 'GET',
            'path' => '/v1/internet-gateways',
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
            'items_key' => 'internet_gateways',
        ],
        'listNATGatewayRoutes' => [
            'id' => 'listNATGatewayRoutes',
            'method' => 'GET',
            'path' => '/v1/nat-gateways/{nat_gateway_id}/routes',
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
            'items_key' => 'routes',
        ],
        'listNATGateways' => [
            'id' => 'listNATGateways',
            'method' => 'GET',
            'path' => '/v1/nat-gateways',
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
                'subnet' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'vpc' => [
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
            'items_key' => 'nat_gateways',
        ],
        'listPrefixPools' => [
            'id' => 'listPrefixPools',
            'method' => 'GET',
            'path' => '/v1/vpcs/{vpc_id}/prefix-pools',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'prefix_pools',
        ],
        'listRouteTables' => [
            'id' => 'listRouteTables',
            'method' => 'GET',
            'path' => '/v1/route-tables',
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
                'vpc' => [
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
            'items_key' => 'route_tables',
        ],
        'listRoutes' => [
            'id' => 'listRoutes',
            'method' => 'GET',
            'path' => '/v1/route-tables/{route_table_id}/routes',
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
            'items_key' => 'routes',
        ],
        'listSecurityGroupRules' => [
            'id' => 'listSecurityGroupRules',
            'method' => 'GET',
            'path' => '/v1/security-groups/{security_group_id}/rules',
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
            'items_key' => 'rules',
        ],
        'listSecurityGroups' => [
            'id' => 'listSecurityGroups',
            'method' => 'GET',
            'path' => '/v1/security-groups',
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
            'items_key' => 'security_groups',
        ],
        'listSubnets' => [
            'id' => 'listSubnets',
            'method' => 'GET',
            'path' => '/v1/subnets',
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
                'vpc' => [
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
            'items_key' => 'subnets',
        ],
        'listVpcs' => [
            'id' => 'listVpcs',
            'method' => 'GET',
            'path' => '/v1/vpcs',
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
            'items_key' => 'vpcs',
        ],
        'setInterfaceSecurityGroups' => [
            'id' => 'setInterfaceSecurityGroups',
            'method' => 'PUT',
            'path' => '/v1/interfaces/{interface_id}/security-groups',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'security_groups' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateEgressOnlyGateway' => [
            'id' => 'updateEgressOnlyGateway',
            'method' => 'PATCH',
            'path' => '/v1/egress-only-gateways/{egress_only_gateway_id}',
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
        'updateFloatingIp' => [
            'id' => 'updateFloatingIp',
            'method' => 'PATCH',
            'path' => '/v1/floating-ips/{floating_ip_id}',
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
                    'health_check' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateInterface' => [
            'id' => 'updateInterface',
            'method' => 'PATCH',
            'path' => '/v1/interfaces/{interface_id}',
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
        'updateInternetGateway' => [
            'id' => 'updateInternetGateway',
            'method' => 'PATCH',
            'path' => '/v1/internet-gateways/{internet_gateway_id}',
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
        'updateNATGateway' => [
            'id' => 'updateNATGateway',
            'method' => 'PATCH',
            'path' => '/v1/nat-gateways/{nat_gateway_id}',
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
        'updateRoute' => [
            'id' => 'updateRoute',
            'method' => 'PATCH',
            'path' => '/v1/route-tables/{route_table_id}/routes/{route_id}',
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
        'updateRouteTable' => [
            'id' => 'updateRouteTable',
            'method' => 'PATCH',
            'path' => '/v1/route-tables/{route_table_id}',
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
        'updateSecurityGroup' => [
            'id' => 'updateSecurityGroup',
            'method' => 'PATCH',
            'path' => '/v1/security-groups/{security_group_id}',
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
        'updateSubnet' => [
            'id' => 'updateSubnet',
            'method' => 'PATCH',
            'path' => '/v1/subnets/{subnet_id}',
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
        'updateVpc' => [
            'id' => 'updateVpc',
            'method' => 'PATCH',
            'path' => '/v1/vpcs/{vpc_id}',
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
     * Attach a floating IP to an interface
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachFloatingIp(string $floatingIpId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachFloatingIp', ['floating_ip_id' => $floatingIpId], $body, [], $options);
    }

    /**
     * Attach internet gateway to a VPC
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachInternetGateway(string $internetGatewayId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachInternetGateway', ['internet_gateway_id' => $internetGatewayId], $body, [], $options);
    }

    /**
     * Create egress-only gateway
     * @param array<string, mixed>|\stdClass $body
     */
    public function createEgressOnlyGateway(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createEgressOnlyGateway', [], $body, [], $options);
    }

    /**
     * Allocate floating IP
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function createFloatingIp(array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('createFloatingIp', [], $body, [], $options);
    }

    /**
     * Create interface
     * @param array<string, mixed>|\stdClass $body
     */
    public function createInterface(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createInterface', [], $body, [], $options);
    }

    /**
     * Create interface address
     * @param array<string, mixed>|\stdClass $body
     */
    public function createInterfaceAddress(string $interfaceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createInterfaceAddress', ['interface_id' => $interfaceId], $body, [], $options);
    }

    /**
     * Create interface prefix
     * @param array<string, mixed>|\stdClass $body
     */
    public function createInterfacePrefix(string $interfaceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createInterfacePrefix', ['interface_id' => $interfaceId], $body, [], $options);
    }

    /**
     * Create internet gateway
     * @param array<string, mixed>|\stdClass $body
     */
    public function createInternetGateway(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createInternetGateway', [], $body, [], $options);
    }

    /**
     * Create NAT gateway
     * @param array<string, mixed>|\stdClass $body
     */
    public function createNATGateway(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createNATGateway', [], $body, [], $options);
    }

    /**
     * Create prefix pool
     * @param array<string, mixed>|\stdClass $body
     */
    public function createPrefixPool(string $vpcId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createPrefixPool', ['vpc_id' => $vpcId], $body, [], $options);
    }

    /**
     * Create route
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRoute(string $routeTableId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRoute', ['route_table_id' => $routeTableId], $body, [], $options);
    }

    /**
     * Create route table
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRouteTable(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRouteTable', [], $body, [], $options);
    }

    /**
     * Create security group
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSecurityGroup(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSecurityGroup', [], $body, [], $options);
    }

    /**
     * Create security group rule
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSecurityGroupRule(string $securityGroupId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSecurityGroupRule', ['security_group_id' => $securityGroupId], $body, [], $options);
    }

    /**
     * Create subnet
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSubnet(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSubnet', [], $body, [], $options);
    }

    /**
     * Create VPC
     * @param array<string, mixed>|\stdClass $body
     */
    public function createVpc(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createVpc', [], $body, [], $options);
    }

    /**
     * Delete egress-only gateway
     */
    public function deleteEgressOnlyGateway(string $egressOnlyGatewayId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteEgressOnlyGateway', ['egress_only_gateway_id' => $egressOnlyGatewayId], null, [], $options);
    }

    /**
     * Release floating IP
     */
    public function deleteFloatingIp(string $floatingIpId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteFloatingIp', ['floating_ip_id' => $floatingIpId], null, [], $options);
    }

    /**
     * Delete interface
     */
    public function deleteInterface(string $interfaceId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteInterface', ['interface_id' => $interfaceId], null, [], $options);
    }

    /**
     * Delete interface address
     */
    public function deleteInterfaceAddress(string $interfaceId, string $addressId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteInterfaceAddress', ['interface_id' => $interfaceId, 'address_id' => $addressId], null, [], $options);
    }

    /**
     * Delete interface prefix
     */
    public function deleteInterfacePrefix(string $interfaceId, string $prefixId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteInterfacePrefix', ['interface_id' => $interfaceId, 'prefix_id' => $prefixId], null, [], $options);
    }

    /**
     * Delete internet gateway
     */
    public function deleteInternetGateway(string $internetGatewayId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteInternetGateway', ['internet_gateway_id' => $internetGatewayId], null, [], $options);
    }

    /**
     * Delete NAT gateway
     */
    public function deleteNATGateway(string $natGatewayId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteNATGateway', ['nat_gateway_id' => $natGatewayId], null, [], $options);
    }

    /**
     * Delete prefix pool
     */
    public function deletePrefixPool(string $vpcId, string $poolId, ?RequestOptions $options = null): void
    {
        $this->discard('deletePrefixPool', ['vpc_id' => $vpcId, 'pool_id' => $poolId], null, [], $options);
    }

    /**
     * Delete route
     */
    public function deleteRoute(string $routeTableId, string $routeId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRoute', ['route_table_id' => $routeTableId, 'route_id' => $routeId], null, [], $options);
    }

    /**
     * Delete route table
     */
    public function deleteRouteTable(string $routeTableId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRouteTable', ['route_table_id' => $routeTableId], null, [], $options);
    }

    /**
     * Delete security group
     */
    public function deleteSecurityGroup(string $securityGroupId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteSecurityGroup', ['security_group_id' => $securityGroupId], null, [], $options);
    }

    /**
     * Delete security group rule
     */
    public function deleteSecurityGroupRule(string $securityGroupId, string $ruleId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteSecurityGroupRule', ['security_group_id' => $securityGroupId, 'rule_id' => $ruleId], null, [], $options);
    }

    /**
     * Delete subnet
     */
    public function deleteSubnet(string $subnetId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteSubnet', ['subnet_id' => $subnetId], null, [], $options);
    }

    /**
     * Delete VPC
     */
    public function deleteVpc(string $vpcId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteVpc', ['vpc_id' => $vpcId], null, [], $options);
    }

    /**
     * Detach a floating IP
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function detachFloatingIp(string $floatingIpId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('detachFloatingIp', ['floating_ip_id' => $floatingIpId], $body, [], $options);
    }

    /**
     * Detach internet gateway from its VPC
     */
    public function detachInternetGateway(string $internetGatewayId, ?RequestOptions $options = null): Result
    {
        return $this->result('detachInternetGateway', ['internet_gateway_id' => $internetGatewayId], null, [], $options);
    }

    /**
     * Get egress-only gateway
     */
    public function getEgressOnlyGateway(string $egressOnlyGatewayId, ?RequestOptions $options = null): Result
    {
        return $this->result('getEgressOnlyGateway', ['egress_only_gateway_id' => $egressOnlyGatewayId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getEgressOnlyGatewayByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getEgressOnlyGateway($id, $options),
            fn (array $filter): Page => $this->listEgressOnlyGateways(array_replace($scope, $filter), $options),
            true,
            'egress_only_gateway',
        );
    }

    /**
     * Get floating IP
     */
    public function getFloatingIp(string $floatingIpId, ?RequestOptions $options = null): Result
    {
        return $this->result('getFloatingIp', ['floating_ip_id' => $floatingIpId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getFloatingIpByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getFloatingIp($id, $options),
            fn (array $filter): Page => $this->listFloatingIps(array_replace($scope, $filter), $options),
            true,
            'floating_ip',
        );
    }

    /**
     * Get interface
     */
    public function getInterface(string $interfaceId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInterface', ['interface_id' => $interfaceId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getInterfaceByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getInterface($id, $options),
            fn (array $filter): Page => $this->listInterfaces(array_replace($scope, $filter), $options),
            true,
            'interface',
        );
    }

    /**
     * Get interface address
     */
    public function getInterfaceAddress(string $interfaceId, string $addressId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInterfaceAddress', ['interface_id' => $interfaceId, 'address_id' => $addressId], null, [], $options);
    }

    /**
     * Get internet gateway
     */
    public function getInternetGateway(string $internetGatewayId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInternetGateway', ['internet_gateway_id' => $internetGatewayId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getInternetGatewayByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getInternetGateway($id, $options),
            fn (array $filter): Page => $this->listInternetGateways(array_replace($scope, $filter), $options),
            true,
            'internet_gateway',
        );
    }

    /**
     * Get NAT gateway
     */
    public function getNATGateway(string $natGatewayId, ?RequestOptions $options = null): Result
    {
        return $this->result('getNATGateway', ['nat_gateway_id' => $natGatewayId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getNATGatewayByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getNATGateway($id, $options),
            fn (array $filter): Page => $this->listNATGateways(array_replace($scope, $filter), $options),
            true,
            'nat_gateway',
        );
    }

    /**
     * Get route
     */
    public function getRoute(string $routeTableId, string $routeId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRoute', ['route_table_id' => $routeTableId, 'route_id' => $routeId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRouteByReference(string $routeTableId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRoute($routeTableId, $id, $options),
            fn (array $filter): Page => $this->listRoutes($routeTableId, array_replace($scope, $filter), $options),
            true,
            'route',
        );
    }

    /**
     * Get route table
     */
    public function getRouteTable(string $routeTableId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRouteTable', ['route_table_id' => $routeTableId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRouteTableByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRouteTable($id, $options),
            fn (array $filter): Page => $this->listRouteTables(array_replace($scope, $filter), $options),
            true,
            'route_table',
        );
    }

    /**
     * Get security group
     */
    public function getSecurityGroup(string $securityGroupId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSecurityGroup', ['security_group_id' => $securityGroupId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getSecurityGroupByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getSecurityGroup($id, $options),
            fn (array $filter): Page => $this->listSecurityGroups(array_replace($scope, $filter), $options),
            true,
            'security_group',
        );
    }

    /**
     * Get security group rule
     */
    public function getSecurityGroupRule(string $securityGroupId, string $ruleId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSecurityGroupRule', ['security_group_id' => $securityGroupId, 'rule_id' => $ruleId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getSecurityGroupRuleByReference(string $securityGroupId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getSecurityGroupRule($securityGroupId, $id, $options),
            fn (array $filter): Page => $this->listSecurityGroupRules($securityGroupId, array_replace($scope, $filter), $options),
            true,
            'rule',
        );
    }

    /**
     * Get subnet
     */
    public function getSubnet(string $subnetId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSubnet', ['subnet_id' => $subnetId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getSubnetByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getSubnet($id, $options),
            fn (array $filter): Page => $this->listSubnets(array_replace($scope, $filter), $options),
            true,
            'subnet',
        );
    }

    /**
     * Get VPC
     */
    public function getVpc(string $vpcId, ?RequestOptions $options = null): Result
    {
        return $this->result('getVpc', ['vpc_id' => $vpcId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getVpcByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getVpc($id, $options),
            fn (array $filter): Page => $this->listVpcs(array_replace($scope, $filter), $options),
            true,
            'vpc',
        );
    }

    /**
     * List egress-only gateway routes
     * @param array<string, mixed> $query
     */
    public function listEgressOnlyGatewayRoutes(string $egressOnlyGatewayId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listEgressOnlyGatewayRoutes', ['egress_only_gateway_id' => $egressOnlyGatewayId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listEgressOnlyGatewayRoutesAll(string $egressOnlyGatewayId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listEgressOnlyGatewayRoutes($egressOnlyGatewayId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List egress-only gateways
     * @param array<string, mixed> $query
     */
    public function listEgressOnlyGateways(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listEgressOnlyGateways', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listEgressOnlyGatewaysAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listEgressOnlyGateways(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List floating IPs
     * @param array<string, mixed> $query
     */
    public function listFloatingIps(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listFloatingIps', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listFloatingIpsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listFloatingIps(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List interface addresses
     */
    public function listInterfaceAddresses(string $interfaceId, ?RequestOptions $options = null): Page
    {
        return $this->page('listInterfaceAddresses', ['interface_id' => $interfaceId], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInterfaceAddressesAll(string $interfaceId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInterfaceAddresses($interfaceId, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List interface prefixes
     */
    public function listInterfacePrefixes(string $interfaceId, ?RequestOptions $options = null): Page
    {
        return $this->page('listInterfacePrefixes', ['interface_id' => $interfaceId], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInterfacePrefixesAll(string $interfaceId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInterfacePrefixes($interfaceId, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List interface security-group membership
     * @param array<string, mixed> $query
     */
    public function listInterfaceSecurityGroups(string $interfaceId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInterfaceSecurityGroups', ['interface_id' => $interfaceId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInterfaceSecurityGroupsAll(string $interfaceId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInterfaceSecurityGroups($interfaceId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List interfaces
     * @param array<string, mixed> $query
     */
    public function listInterfaces(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInterfaces', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInterfacesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInterfaces(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List internet gateway routes
     * @param array<string, mixed> $query
     */
    public function listInternetGatewayRoutes(string $internetGatewayId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInternetGatewayRoutes', ['internet_gateway_id' => $internetGatewayId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInternetGatewayRoutesAll(string $internetGatewayId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInternetGatewayRoutes($internetGatewayId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List internet gateways
     * @param array<string, mixed> $query
     */
    public function listInternetGateways(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInternetGateways', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInternetGatewaysAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInternetGateways(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List NAT gateway routes
     * @param array<string, mixed> $query
     */
    public function listNATGatewayRoutes(string $natGatewayId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listNATGatewayRoutes', ['nat_gateway_id' => $natGatewayId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listNATGatewayRoutesAll(string $natGatewayId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listNATGatewayRoutes($natGatewayId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List NAT gateways
     * @param array<string, mixed> $query
     */
    public function listNATGateways(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listNATGateways', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listNATGatewaysAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listNATGateways(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List prefix pools
     */
    public function listPrefixPools(string $vpcId, ?RequestOptions $options = null): Page
    {
        return $this->page('listPrefixPools', ['vpc_id' => $vpcId], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPrefixPoolsAll(string $vpcId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPrefixPools($vpcId, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List route tables
     * @param array<string, mixed> $query
     */
    public function listRouteTables(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRouteTables', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRouteTablesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRouteTables(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List routes
     * @param array<string, mixed> $query
     */
    public function listRoutes(string $routeTableId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRoutes', ['route_table_id' => $routeTableId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRoutesAll(string $routeTableId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRoutes($routeTableId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List security group rules
     * @param array<string, mixed> $query
     */
    public function listSecurityGroupRules(string $securityGroupId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSecurityGroupRules', ['security_group_id' => $securityGroupId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSecurityGroupRulesAll(string $securityGroupId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSecurityGroupRules($securityGroupId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List security groups
     * @param array<string, mixed> $query
     */
    public function listSecurityGroups(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSecurityGroups', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSecurityGroupsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSecurityGroups(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List subnets
     * @param array<string, mixed> $query
     */
    public function listSubnets(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSubnets', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSubnetsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSubnets(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List VPCs
     * @param array<string, mixed> $query
     */
    public function listVpcs(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listVpcs', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listVpcsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listVpcs(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Set interface security-group membership
     * @param array<string, mixed>|\stdClass $body
     */
    public function setInterfaceSecurityGroups(string $interfaceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('setInterfaceSecurityGroups', ['interface_id' => $interfaceId], $body, [], $options);
    }

    /**
     * Update egress-only gateway
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateEgressOnlyGateway(string $egressOnlyGatewayId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateEgressOnlyGateway', ['egress_only_gateway_id' => $egressOnlyGatewayId], $body, [], $options);
    }

    /**
     * Update floating IP
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateFloatingIp(string $floatingIpId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateFloatingIp', ['floating_ip_id' => $floatingIpId], $body, [], $options);
    }

    /**
     * Update interface
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateInterface(string $interfaceId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateInterface', ['interface_id' => $interfaceId], $body, [], $options);
    }

    /**
     * Update internet gateway
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateInternetGateway(string $internetGatewayId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateInternetGateway', ['internet_gateway_id' => $internetGatewayId], $body, [], $options);
    }

    /**
     * Update NAT gateway
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateNATGateway(string $natGatewayId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateNATGateway', ['nat_gateway_id' => $natGatewayId], $body, [], $options);
    }

    /**
     * Update route
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRoute(string $routeTableId, string $routeId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRoute', ['route_table_id' => $routeTableId, 'route_id' => $routeId], $body, [], $options);
    }

    /**
     * Update route table
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRouteTable(string $routeTableId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRouteTable', ['route_table_id' => $routeTableId], $body, [], $options);
    }

    /**
     * Update security group
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSecurityGroup(string $securityGroupId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSecurityGroup', ['security_group_id' => $securityGroupId], $body, [], $options);
    }

    /**
     * Update subnet
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSubnet(string $subnetId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSubnet', ['subnet_id' => $subnetId], $body, [], $options);
    }

    /**
     * Update VPC
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateVpc(string $vpcId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateVpc', ['vpc_id' => $vpcId], $body, [], $options);
    }
}
