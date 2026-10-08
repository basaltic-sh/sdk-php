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
final class Loadbalancer extends AbstractService
{
    protected const SERVICE = 'loadbalancer';
    protected const ENDPOINT = 'https://loadbalancer.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'attachListenerCertificate' => [
            'id' => 'attachListenerCertificate',
            'method' => 'POST',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/certificates',
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
        'attachTarget' => [
            'id' => 'attachTarget',
            'method' => 'POST',
            'path' => '/v1/target-groups/{id}/targets',
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
        'createListener' => [
            'id' => 'createListener',
            'method' => 'POST',
            'path' => '/v1/load-balancers/{id}/listeners',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'certificates' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createLoadBalancer' => [
            'id' => 'createLoadBalancer',
            'method' => 'POST',
            'path' => '/v1/load-balancers',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'floating_ips' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'security_groups' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'tags' => [
                        'type' => 'object',
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createRule' => [
            'id' => 'createRule',
            'method' => 'POST',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/rules',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
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
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createTargetGroup' => [
            'id' => 'createTargetGroup',
            'method' => 'POST',
            'path' => '/v1/target-groups',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'health_check' => [
                        'type' => 'object',
                    ],
                    'session_affinity' => [
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
        'deleteListener' => [
            'id' => 'deleteListener',
            'method' => 'DELETE',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}',
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
        'deleteLoadBalancer' => [
            'id' => 'deleteLoadBalancer',
            'method' => 'DELETE',
            'path' => '/v1/load-balancers/{id}',
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
        'deleteRuleInListener' => [
            'id' => 'deleteRuleInListener',
            'method' => 'DELETE',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/rules/{rule_id}',
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
        'deleteTargetGroup' => [
            'id' => 'deleteTargetGroup',
            'method' => 'DELETE',
            'path' => '/v1/target-groups/{id}',
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
        'detachListenerCertificate' => [
            'id' => 'detachListenerCertificate',
            'method' => 'DELETE',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/certificates/{certificate_id}',
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
        'detachTarget' => [
            'id' => 'detachTarget',
            'method' => 'DELETE',
            'path' => '/v1/target-groups/{id}/targets/{target_id}',
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
        'getListener' => [
            'id' => 'getListener',
            'method' => 'GET',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}',
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
        'getLoadBalancer' => [
            'id' => 'getLoadBalancer',
            'method' => 'GET',
            'path' => '/v1/load-balancers/{id}',
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
        'getRule' => [
            'id' => 'getRule',
            'method' => 'GET',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/rules/{rule_id}',
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
        'getTarget' => [
            'id' => 'getTarget',
            'method' => 'GET',
            'path' => '/v1/target-groups/{id}/targets/{target_id}',
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
        'getTargetGroup' => [
            'id' => 'getTargetGroup',
            'method' => 'GET',
            'path' => '/v1/target-groups/{id}',
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
        'listListeners' => [
            'id' => 'listListeners',
            'method' => 'GET',
            'path' => '/v1/load-balancers/{id}/listeners',
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
            'items_key' => 'listeners',
        ],
        'listLoadBalancerReplicas' => [
            'id' => 'listLoadBalancerReplicas',
            'method' => 'GET',
            'path' => '/v1/load-balancers/{id}/replicas',
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
            'items_key' => 'replicas',
        ],
        'listLoadBalancers' => [
            'id' => 'listLoadBalancers',
            'method' => 'GET',
            'path' => '/v1/load-balancers',
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
                'status' => [
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
            'items_key' => 'load_balancers',
        ],
        'listRules' => [
            'id' => 'listRules',
            'method' => 'GET',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/rules',
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
            'items_key' => 'rules',
        ],
        'listTargetGroups' => [
            'id' => 'listTargetGroups',
            'method' => 'GET',
            'path' => '/v1/target-groups',
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
                'protocol' => [
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
            'items_key' => 'target_groups',
        ],
        'listTargets' => [
            'id' => 'listTargets',
            'method' => 'GET',
            'path' => '/v1/target-groups/{id}/targets',
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
            'items_key' => 'targets',
        ],
        'updateListener' => [
            'id' => 'updateListener',
            'method' => 'PATCH',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}',
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
        'updateLoadBalancer' => [
            'id' => 'updateLoadBalancer',
            'method' => 'PATCH',
            'path' => '/v1/load-balancers/{id}',
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
        'updateRule' => [
            'id' => 'updateRule',
            'method' => 'PATCH',
            'path' => '/v1/load-balancers/{id}/listeners/{listener_id}/rules/{rule_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
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
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateTargetGroup' => [
            'id' => 'updateTargetGroup',
            'method' => 'PATCH',
            'path' => '/v1/target-groups/{id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'health_check' => [
                        'type' => 'object',
                    ],
                    'session_affinity' => [
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
     * Attach an additional certificate to an HTTPS listener
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachListenerCertificate(string $id, string $listenerId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachListenerCertificate', ['id' => $id, 'listener_id' => $listenerId], $body, [], $options);
    }

    /**
     * Attach a target to this group
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachTarget(string $id, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('attachTarget', ['id' => $id], $body, [], $options);
    }

    /**
     * Create a listener on this load balancer
     * @param array<string, mixed>|\stdClass $body
     */
    public function createListener(string $id, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createListener', ['id' => $id], $body, [], $options);
    }

    /**
     * Create a load balancer
     * @param array<string, mixed>|\stdClass $body
     */
    public function createLoadBalancer(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createLoadBalancer', [], $body, [], $options);
    }

    /**
     * Create a routing rule on this listener (HTTP/HTTPS only)
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRule(string $id, string $listenerId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRule', ['id' => $id, 'listener_id' => $listenerId], $body, [], $options);
    }

    /**
     * Create a target group
     * @param array<string, mixed>|\stdClass $body
     */
    public function createTargetGroup(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createTargetGroup', [], $body, [], $options);
    }

    /**
     * Delete a listener
     */
    public function deleteListener(string $id, string $listenerId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteListener', ['id' => $id, 'listener_id' => $listenerId], null, [], $options);
    }

    /**
     * Delete a load balancer
     */
    public function deleteLoadBalancer(string $id, ?RequestOptions $options = null): void
    {
        $this->discard('deleteLoadBalancer', ['id' => $id], null, [], $options);
    }

    /**
     * Delete a routing rule
     */
    public function deleteRuleInListener(string $id, string $listenerId, string $ruleId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRuleInListener', ['id' => $id, 'listener_id' => $listenerId, 'rule_id' => $ruleId], null, [], $options);
    }

    /**
     * Delete a target group
     */
    public function deleteTargetGroup(string $id, ?RequestOptions $options = null): void
    {
        $this->discard('deleteTargetGroup', ['id' => $id], null, [], $options);
    }

    /**
     * Detach a certificate from an HTTPS listener
     */
    public function detachListenerCertificate(string $id, string $listenerId, string $certificateId, ?RequestOptions $options = null): void
    {
        $this->discard('detachListenerCertificate', ['id' => $id, 'listener_id' => $listenerId, 'certificate_id' => $certificateId], null, [], $options);
    }

    /**
     * Detach a target
     */
    public function detachTarget(string $id, string $targetId, ?RequestOptions $options = null): void
    {
        $this->discard('detachTarget', ['id' => $id, 'target_id' => $targetId], null, [], $options);
    }

    /**
     * Get a listener
     */
    public function getListener(string $id, string $listenerId, ?RequestOptions $options = null): Result
    {
        return $this->result('getListener', ['id' => $id, 'listener_id' => $listenerId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getListenerByReference(string $id, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getListener($id, $id, $options),
            fn (array $filter): Page => $this->listListeners($id, array_replace($scope, $filter), $options),
            true,
            'listener',
        );
    }

    /**
     * Get a load balancer
     */
    public function getLoadBalancer(string $id, ?RequestOptions $options = null): Result
    {
        return $this->result('getLoadBalancer', ['id' => $id], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getLoadBalancerByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getLoadBalancer($id, $options),
            fn (array $filter): Page => $this->listLoadBalancers(array_replace($scope, $filter), $options),
            true,
            'load_balancer',
        );
    }

    /**
     * Get a routing rule
     */
    public function getRule(string $id, string $listenerId, string $ruleId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRule', ['id' => $id, 'listener_id' => $listenerId, 'rule_id' => $ruleId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRuleByReference(string $id, string $listenerId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRule($id, $listenerId, $id, $options),
            fn (array $filter): Page => $this->listRules($id, $listenerId, array_replace($scope, $filter), $options),
            true,
            'rule',
        );
    }

    /**
     * Get a target
     */
    public function getTarget(string $id, string $targetId, ?RequestOptions $options = null): Result
    {
        return $this->result('getTarget', ['id' => $id, 'target_id' => $targetId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getTargetByReference(string $id, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getTarget($id, $id, $options),
            fn (array $filter): Page => $this->listTargets($id, array_replace($scope, $filter), $options),
            true,
            'target',
        );
    }

    /**
     * Get a target group
     */
    public function getTargetGroup(string $id, ?RequestOptions $options = null): Result
    {
        return $this->result('getTargetGroup', ['id' => $id], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getTargetGroupByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getTargetGroup($id, $options),
            fn (array $filter): Page => $this->listTargetGroups(array_replace($scope, $filter), $options),
            true,
            'target_group',
        );
    }

    /**
     * List this load balancer's listeners
     * @param array<string, mixed> $query
     */
    public function listListeners(string $id, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listListeners', ['id' => $id], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listListenersAll(string $id, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listListeners($id, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List the LB's instance replicas with live health
     * @param array<string, mixed> $query
     */
    public function listLoadBalancerReplicas(string $id, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listLoadBalancerReplicas', ['id' => $id], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listLoadBalancerReplicasAll(string $id, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listLoadBalancerReplicas($id, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List load balancers
     * @param array<string, mixed> $query
     */
    public function listLoadBalancers(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listLoadBalancers', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listLoadBalancersAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listLoadBalancers(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List this listener's rules
     * @param array<string, mixed> $query
     */
    public function listRules(string $id, string $listenerId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRules', ['id' => $id, 'listener_id' => $listenerId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRulesAll(string $id, string $listenerId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRules($id, $listenerId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List target groups
     * @param array<string, mixed> $query
     */
    public function listTargetGroups(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listTargetGroups', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listTargetGroupsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listTargetGroups(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List targets in this group
     * @param array<string, mixed> $query
     */
    public function listTargets(string $id, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listTargets', ['id' => $id], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listTargetsAll(string $id, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listTargets($id, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Patch a listener (rotate cert, change default target group)
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateListener(string $id, string $listenerId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateListener', ['id' => $id, 'listener_id' => $listenerId], $body, [], $options);
    }

    /**
     * Scale or resize a load balancer
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateLoadBalancer(string $id, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateLoadBalancer', ['id' => $id], $body, [], $options);
    }

    /**
     * Update a routing rule (full replace)
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRule(string $id, string $listenerId, string $ruleId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRule', ['id' => $id, 'listener_id' => $listenerId, 'rule_id' => $ruleId], $body, [], $options);
    }

    /**
     * Update target group health checks, framing, or stickiness
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateTargetGroup(string $id, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateTargetGroup', ['id' => $id], $body, [], $options);
    }
}
