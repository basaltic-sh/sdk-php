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
final class Iam extends AbstractService
{
    protected const SERVICE = 'iam';
    protected const ENDPOINT = 'https://iam.basaltic.sh';
    protected const OPERATIONS = [
        'assumeRole' => [
            'id' => 'assumeRole',
            'method' => 'POST',
            'path' => '/v1/assume-role',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'policy' => [
                        'type' => 'object',
                        'properties' => [
                            'statements' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'resources' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_resources' => [
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
        'assumeRoleWithWebIdentity' => [
            'id' => 'assumeRoleWithWebIdentity',
            'method' => 'POST',
            'path' => '/v1/assume-role-with-web-identity',
            'authenticated' => false,
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
        'attachRolePolicy' => [
            'id' => 'attachRolePolicy',
            'method' => 'POST',
            'path' => '/v1/roles/{role_id}/policies',
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
        'attachServiceAccountPolicy' => [
            'id' => 'attachServiceAccountPolicy',
            'method' => 'POST',
            'path' => '/v1/service-accounts/{service_account_id}/policies',
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
        'authorizeOAuthClient' => [
            'id' => 'authorizeOAuthClient',
            'method' => 'POST',
            'path' => '/v1/oauth/authorize',
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
        'createPersonalSSHKey' => [
            'id' => 'createPersonalSSHKey',
            'method' => 'POST',
            'path' => '/v1/auth/ssh-keys',
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
        'createPolicy' => [
            'id' => 'createPolicy',
            'method' => 'POST',
            'path' => '/v1/policies',
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
                    'document' => [
                        'type' => 'object',
                        'properties' => [
                            'statements' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'resources' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_resources' => [
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
        'createRole' => [
            'id' => 'createRole',
            'method' => 'POST',
            'path' => '/v1/roles',
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
                    'trust_policy' => [
                        'type' => 'object',
                        'properties' => [
                            'principals' => [
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
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createServiceAccount' => [
            'id' => 'createServiceAccount',
            'method' => 'POST',
            'path' => '/v1/service-accounts',
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
        'createServiceAccountCredential' => [
            'id' => 'createServiceAccountCredential',
            'method' => 'POST',
            'path' => '/v1/service-accounts/{service_account_id}/credentials',
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
        'createServiceAccountSSHKey' => [
            'id' => 'createServiceAccountSSHKey',
            'method' => 'POST',
            'path' => '/v1/service-accounts/{service_account_id}/ssh-keys',
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
        'deletePersonalSSHKey' => [
            'id' => 'deletePersonalSSHKey',
            'method' => 'DELETE',
            'path' => '/v1/auth/ssh-keys/{ssh_key_id}',
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
        'deletePolicy' => [
            'id' => 'deletePolicy',
            'method' => 'DELETE',
            'path' => '/v1/policies/{policy_id}',
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
        'deleteRole' => [
            'id' => 'deleteRole',
            'method' => 'DELETE',
            'path' => '/v1/roles/{role_id}',
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
        'deleteRoleInlinePolicy' => [
            'id' => 'deleteRoleInlinePolicy',
            'method' => 'DELETE',
            'path' => '/v1/roles/{role_id}/inline-policies/{policy_name}',
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
        'deleteServiceAccount' => [
            'id' => 'deleteServiceAccount',
            'method' => 'DELETE',
            'path' => '/v1/service-accounts/{service_account_id}',
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
        'deleteServiceAccountCredential' => [
            'id' => 'deleteServiceAccountCredential',
            'method' => 'DELETE',
            'path' => '/v1/service-accounts/{service_account_id}/credentials/{credential_id}',
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
        'deleteServiceAccountInlinePolicy' => [
            'id' => 'deleteServiceAccountInlinePolicy',
            'method' => 'DELETE',
            'path' => '/v1/service-accounts/{service_account_id}/inline-policies/{policy_name}',
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
        'deleteServiceAccountSSHKey' => [
            'id' => 'deleteServiceAccountSSHKey',
            'method' => 'DELETE',
            'path' => '/v1/service-accounts/{service_account_id}/ssh-keys/{ssh_key_id}',
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
        'detachRolePolicy' => [
            'id' => 'detachRolePolicy',
            'method' => 'DELETE',
            'path' => '/v1/roles/{role_id}/policies/{policy_id}',
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
        'detachServiceAccountPolicy' => [
            'id' => 'detachServiceAccountPolicy',
            'method' => 'DELETE',
            'path' => '/v1/service-accounts/{service_account_id}/policies/{policy_id}',
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
        'getOAuthToken' => [
            'id' => 'getOAuthToken',
            'method' => 'POST',
            'path' => '/v1/oauth/token',
            'authenticated' => false,
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
        'getPersonalLinuxIdentity' => [
            'id' => 'getPersonalLinuxIdentity',
            'method' => 'GET',
            'path' => '/v1/auth/linux-identity',
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
        'getPolicy' => [
            'id' => 'getPolicy',
            'method' => 'GET',
            'path' => '/v1/policies/{policy_id}',
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
        'getRole' => [
            'id' => 'getRole',
            'method' => 'GET',
            'path' => '/v1/roles/{role_id}',
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
        'getRoleInlinePolicy' => [
            'id' => 'getRoleInlinePolicy',
            'method' => 'GET',
            'path' => '/v1/roles/{role_id}/inline-policies/{policy_name}',
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
        'getRolePermissionBoundary' => [
            'id' => 'getRolePermissionBoundary',
            'method' => 'GET',
            'path' => '/v1/roles/{role_id}/permission-boundary',
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
        'getSTSSession' => [
            'id' => 'getSTSSession',
            'method' => 'GET',
            'path' => '/v1/sts-sessions/{session_id}',
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
        'getServiceAccount' => [
            'id' => 'getServiceAccount',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}',
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
        'getServiceAccountInlinePolicy' => [
            'id' => 'getServiceAccountInlinePolicy',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/inline-policies/{policy_name}',
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
        'getServiceAccountLinuxIdentity' => [
            'id' => 'getServiceAccountLinuxIdentity',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/linux-identity',
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
        'getServiceAccountPermissionBoundary' => [
            'id' => 'getServiceAccountPermissionBoundary',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/permission-boundary',
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
        'listPersonalSSHKeys' => [
            'id' => 'listPersonalSSHKeys',
            'method' => 'GET',
            'path' => '/v1/auth/ssh-keys',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'ssh_keys',
        ],
        'listPolicies' => [
            'id' => 'listPolicies',
            'method' => 'GET',
            'path' => '/v1/policies',
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
            'items_key' => 'policies',
        ],
        'listPolicyRoles' => [
            'id' => 'listPolicyRoles',
            'method' => 'GET',
            'path' => '/v1/policies/{policy_id}/roles',
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
            'items_key' => 'roles',
        ],
        'listPolicyServiceAccounts' => [
            'id' => 'listPolicyServiceAccounts',
            'method' => 'GET',
            'path' => '/v1/policies/{policy_id}/service-accounts',
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
            'items_key' => 'service_accounts',
        ],
        'listRegions' => [
            'id' => 'listRegions',
            'method' => 'GET',
            'path' => '/v1/regions',
            'authenticated' => false,
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
            'items_key' => 'regions',
        ],
        'listRoleInlinePolicies' => [
            'id' => 'listRoleInlinePolicies',
            'method' => 'GET',
            'path' => '/v1/roles/{role_id}/inline-policies',
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
            'items_key' => 'inline_policies',
        ],
        'listRolePolicies' => [
            'id' => 'listRolePolicies',
            'method' => 'GET',
            'path' => '/v1/roles/{role_id}/policies',
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
            'items_key' => 'policies',
        ],
        'listRoles' => [
            'id' => 'listRoles',
            'method' => 'GET',
            'path' => '/v1/roles',
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
            'items_key' => 'roles',
        ],
        'listSTSSessions' => [
            'id' => 'listSTSSessions',
            'method' => 'GET',
            'path' => '/v1/sts-sessions',
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
                'role' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'principal' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'principal_type' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'active_only' => [
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
            'items_key' => 'sts_sessions',
        ],
        'listServiceAccountCredentials' => [
            'id' => 'listServiceAccountCredentials',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/credentials',
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
            'items_key' => 'credentials',
        ],
        'listServiceAccountInlinePolicies' => [
            'id' => 'listServiceAccountInlinePolicies',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/inline-policies',
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
            'items_key' => 'inline_policies',
        ],
        'listServiceAccountPolicies' => [
            'id' => 'listServiceAccountPolicies',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/policies',
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
            'items_key' => 'policies',
        ],
        'listServiceAccountSSHKeys' => [
            'id' => 'listServiceAccountSSHKeys',
            'method' => 'GET',
            'path' => '/v1/service-accounts/{service_account_id}/ssh-keys',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'ssh_keys',
        ],
        'listServiceAccounts' => [
            'id' => 'listServiceAccounts',
            'method' => 'GET',
            'path' => '/v1/service-accounts',
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
            'items_key' => 'service_accounts',
        ],
        'putRoleInlinePolicy' => [
            'id' => 'putRoleInlinePolicy',
            'method' => 'PUT',
            'path' => '/v1/roles/{role_id}/inline-policies/{policy_name}',
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
                                        'actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'resources' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_resources' => [
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
        'putServiceAccountInlinePolicy' => [
            'id' => 'putServiceAccountInlinePolicy',
            'method' => 'PUT',
            'path' => '/v1/service-accounts/{service_account_id}/inline-policies/{policy_name}',
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
                                        'actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'resources' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_resources' => [
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
        'removeRolePermissionBoundary' => [
            'id' => 'removeRolePermissionBoundary',
            'method' => 'DELETE',
            'path' => '/v1/roles/{role_id}/permission-boundary',
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
        'removeServiceAccountPermissionBoundary' => [
            'id' => 'removeServiceAccountPermissionBoundary',
            'method' => 'DELETE',
            'path' => '/v1/service-accounts/{service_account_id}/permission-boundary',
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
        'revokeOAuthToken' => [
            'id' => 'revokeOAuthToken',
            'method' => 'POST',
            'path' => '/v1/oauth/revoke',
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
        'revokeSTSSession' => [
            'id' => 'revokeSTSSession',
            'method' => 'DELETE',
            'path' => '/v1/sts-sessions/{session_id}',
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
        'setRolePermissionBoundary' => [
            'id' => 'setRolePermissionBoundary',
            'method' => 'PUT',
            'path' => '/v1/roles/{role_id}/permission-boundary',
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
        'setServiceAccountPermissionBoundary' => [
            'id' => 'setServiceAccountPermissionBoundary',
            'method' => 'PUT',
            'path' => '/v1/service-accounts/{service_account_id}/permission-boundary',
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
        'updatePolicy' => [
            'id' => 'updatePolicy',
            'method' => 'PATCH',
            'path' => '/v1/policies/{policy_id}',
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
                    'document' => [
                        'type' => 'object',
                        'properties' => [
                            'statements' => [
                                'type' => 'array',
                                'items' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_actions' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'resources' => [
                                            'type' => 'array',
                                            'items' => [],
                                        ],
                                        'not_resources' => [
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
        'updateRole' => [
            'id' => 'updateRole',
            'method' => 'PATCH',
            'path' => '/v1/roles/{role_id}',
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
                    'trust_policy' => [
                        'type' => 'object',
                        'properties' => [
                            'principals' => [
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
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'updateServiceAccount' => [
            'id' => 'updateServiceAccount',
            'method' => 'PATCH',
            'path' => '/v1/service-accounts/{service_account_id}',
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
     * Assume role
     * @param array<string, mixed>|\stdClass $body
     */
    public function assumeRole(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('assumeRole', [], $body, [], $options);
    }

    /**
     * Assume role with web identity
     * @param array<string, mixed>|\stdClass $body
     */
    public function assumeRoleWithWebIdentity(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('assumeRoleWithWebIdentity', [], $body, [], $options);
    }

    /**
     * Attach policy to role
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachRolePolicy(string $roleId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('attachRolePolicy', ['role_id' => $roleId], $body, [], $options);
    }

    /**
     * Attach policy to service account
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachServiceAccountPolicy(string $serviceAccountId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('attachServiceAccountPolicy', ['service_account_id' => $serviceAccountId], $body, [], $options);
    }

    /**
     * Approve a CLI login and issue an authorization code
     * @param array<string, mixed>|\stdClass $body
     */
    public function authorizeOAuthClient(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('authorizeOAuthClient', [], $body, [], $options);
    }

    /**
     * Add personal SSH key
     * @param array<string, mixed>|\stdClass $body
     */
    public function createPersonalSSHKey(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createPersonalSSHKey', [], $body, [], $options);
    }

    /**
     * Create policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function createPolicy(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createPolicy', [], $body, [], $options);
    }

    /**
     * Create role
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRole(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRole', [], $body, [], $options);
    }

    /**
     * Create service account
     * @param array<string, mixed>|\stdClass $body
     */
    public function createServiceAccount(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createServiceAccount', [], $body, [], $options);
    }

    /**
     * Create credential
     * @param array<string, mixed>|\stdClass $body
     */
    public function createServiceAccountCredential(string $serviceAccountId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createServiceAccountCredential', ['service_account_id' => $serviceAccountId], $body, [], $options);
    }

    /**
     * Add service-account SSH key
     * @param array<string, mixed>|\stdClass $body
     */
    public function createServiceAccountSSHKey(string $serviceAccountId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createServiceAccountSSHKey', ['service_account_id' => $serviceAccountId], $body, [], $options);
    }

    /**
     * Revoke personal SSH key
     */
    public function deletePersonalSSHKey(string $sshKeyId, ?RequestOptions $options = null): void
    {
        $this->discard('deletePersonalSSHKey', ['ssh_key_id' => $sshKeyId], null, [], $options);
    }

    /**
     * Delete policy
     */
    public function deletePolicy(string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('deletePolicy', ['policy_id' => $policyId], null, [], $options);
    }

    /**
     * Delete role
     */
    public function deleteRole(string $roleId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRole', ['role_id' => $roleId], null, [], $options);
    }

    /**
     * Delete a role's inline policy by name
     */
    public function deleteRoleInlinePolicy(string $roleId, string $policyName, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRoleInlinePolicy', ['role_id' => $roleId, 'policy_name' => $policyName], null, [], $options);
    }

    /**
     * Delete service account
     */
    public function deleteServiceAccount(string $serviceAccountId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteServiceAccount', ['service_account_id' => $serviceAccountId], null, [], $options);
    }

    /**
     * Delete credential
     */
    public function deleteServiceAccountCredential(string $serviceAccountId, string $credentialId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteServiceAccountCredential', ['service_account_id' => $serviceAccountId, 'credential_id' => $credentialId], null, [], $options);
    }

    /**
     * Delete a service account's inline policy by name
     */
    public function deleteServiceAccountInlinePolicy(string $serviceAccountId, string $policyName, ?RequestOptions $options = null): void
    {
        $this->discard('deleteServiceAccountInlinePolicy', ['service_account_id' => $serviceAccountId, 'policy_name' => $policyName], null, [], $options);
    }

    /**
     * Revoke service-account SSH key
     */
    public function deleteServiceAccountSSHKey(string $serviceAccountId, string $sshKeyId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteServiceAccountSSHKey', ['service_account_id' => $serviceAccountId, 'ssh_key_id' => $sshKeyId], null, [], $options);
    }

    /**
     * Detach policy from role
     */
    public function detachRolePolicy(string $roleId, string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('detachRolePolicy', ['role_id' => $roleId, 'policy_id' => $policyId], null, [], $options);
    }

    /**
     * Detach policy from service account
     */
    public function detachServiceAccountPolicy(string $serviceAccountId, string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('detachServiceAccountPolicy', ['service_account_id' => $serviceAccountId, 'policy_id' => $policyId], null, [], $options);
    }

    /**
     * Exchange an access key for a bearer token
     * @param array<string, mixed>|\stdClass $body
     */
    public function getOAuthToken(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('getOAuthToken', [], $body, [], $options);
    }

    /**
     * Get personal Linux identity
     */
    public function getPersonalLinuxIdentity(?RequestOptions $options = null): Result
    {
        return $this->result('getPersonalLinuxIdentity', [], null, [], $options);
    }

    /**
     * Get policy
     */
    public function getPolicy(string $policyId, ?RequestOptions $options = null): Result
    {
        return $this->result('getPolicy', ['policy_id' => $policyId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getPolicyByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getPolicy($id, $options),
            fn (array $filter): Page => $this->listPolicies(array_replace($scope, $filter), $options),
            true,
            'policy',
        );
    }

    /**
     * Get role
     */
    public function getRole(string $roleId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRole', ['role_id' => $roleId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRoleByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRole($id, $options),
            fn (array $filter): Page => $this->listRoles(array_replace($scope, $filter), $options),
            true,
            'role',
        );
    }

    /**
     * Get a role's inline policy by name
     */
    public function getRoleInlinePolicy(string $roleId, string $policyName, ?RequestOptions $options = null): Result
    {
        return $this->result('getRoleInlinePolicy', ['role_id' => $roleId, 'policy_name' => $policyName], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getRoleInlinePolicyByReference(string $roleId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getRoleInlinePolicy($roleId, $id, $options),
            fn (array $filter): Page => $this->listRoleInlinePolicies($roleId, array_replace($scope, $filter), $options),
            true,
            'inline_policy',
        );
    }

    /**
     * Get a role's permission boundary
     */
    public function getRolePermissionBoundary(string $roleId, ?RequestOptions $options = null): Result
    {
        return $this->result('getRolePermissionBoundary', ['role_id' => $roleId], null, [], $options);
    }

    /**
     * Get STS session
     */
    public function getSTSSession(string $sessionId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSTSSession', ['session_id' => $sessionId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getSTSSessionByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getSTSSession($id, $options),
            fn (array $filter): Page => $this->listSTSSessions(array_replace($scope, $filter), $options),
            true,
            'sts_session',
        );
    }

    /**
     * Get service account
     */
    public function getServiceAccount(string $serviceAccountId, ?RequestOptions $options = null): Result
    {
        return $this->result('getServiceAccount', ['service_account_id' => $serviceAccountId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getServiceAccountByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getServiceAccount($id, $options),
            fn (array $filter): Page => $this->listServiceAccounts(array_replace($scope, $filter), $options),
            true,
            'service_account',
        );
    }

    /**
     * Get a service account's inline policy by name
     */
    public function getServiceAccountInlinePolicy(string $serviceAccountId, string $policyName, ?RequestOptions $options = null): Result
    {
        return $this->result('getServiceAccountInlinePolicy', ['service_account_id' => $serviceAccountId, 'policy_name' => $policyName], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getServiceAccountInlinePolicyByReference(string $serviceAccountId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getServiceAccountInlinePolicy($serviceAccountId, $id, $options),
            fn (array $filter): Page => $this->listServiceAccountInlinePolicies($serviceAccountId, array_replace($scope, $filter), $options),
            true,
            'inline_policy',
        );
    }

    /**
     * Get serviceaccount Linux identity
     */
    public function getServiceAccountLinuxIdentity(string $serviceAccountId, ?RequestOptions $options = null): Result
    {
        return $this->result('getServiceAccountLinuxIdentity', ['service_account_id' => $serviceAccountId], null, [], $options);
    }

    /**
     * Get a service account's permission boundary
     */
    public function getServiceAccountPermissionBoundary(string $serviceAccountId, ?RequestOptions $options = null): Result
    {
        return $this->result('getServiceAccountPermissionBoundary', ['service_account_id' => $serviceAccountId], null, [], $options);
    }

    /**
     * List personal SSH keys
     */
    public function listPersonalSSHKeys(?RequestOptions $options = null): Page
    {
        return $this->page('listPersonalSSHKeys', [], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPersonalSSHKeysAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPersonalSSHKeys($options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List policies
     * @param array<string, mixed> $query
     */
    public function listPolicies(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPolicies', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPoliciesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPolicies(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List roles with policy
     * @param array<string, mixed> $query
     */
    public function listPolicyRoles(string $policyId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPolicyRoles', ['policy_id' => $policyId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPolicyRolesAll(string $policyId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPolicyRoles($policyId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List service accounts with policy
     * @param array<string, mixed> $query
     */
    public function listPolicyServiceAccounts(string $policyId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPolicyServiceAccounts', ['policy_id' => $policyId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPolicyServiceAccountsAll(string $policyId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPolicyServiceAccounts($policyId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List regions (legacy IAM)
     * @param array<string, mixed> $query
     */
    public function listRegions(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRegions', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRegionsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRegions($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List a role's inline policies
     * @param array<string, mixed> $query
     */
    public function listRoleInlinePolicies(string $roleId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRoleInlinePolicies', ['role_id' => $roleId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRoleInlinePoliciesAll(string $roleId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRoleInlinePolicies($roleId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List role policies
     * @param array<string, mixed> $query
     */
    public function listRolePolicies(string $roleId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRolePolicies', ['role_id' => $roleId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRolePoliciesAll(string $roleId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRolePolicies($roleId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List roles
     * @param array<string, mixed> $query
     */
    public function listRoles(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRoles', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRolesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRoles(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List STS sessions
     * @param array<string, mixed> $query
     */
    public function listSTSSessions(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSTSSessions', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSTSSessionsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSTSSessions(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List credentials
     * @param array<string, mixed> $query
     */
    public function listServiceAccountCredentials(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listServiceAccountCredentials', ['service_account_id' => $serviceAccountId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listServiceAccountCredentialsAll(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listServiceAccountCredentials($serviceAccountId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List a service account's inline policies
     * @param array<string, mixed> $query
     */
    public function listServiceAccountInlinePolicies(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listServiceAccountInlinePolicies', ['service_account_id' => $serviceAccountId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listServiceAccountInlinePoliciesAll(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listServiceAccountInlinePolicies($serviceAccountId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List service account policies
     * @param array<string, mixed> $query
     */
    public function listServiceAccountPolicies(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listServiceAccountPolicies', ['service_account_id' => $serviceAccountId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listServiceAccountPoliciesAll(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listServiceAccountPolicies($serviceAccountId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List service-account SSH keys
     */
    public function listServiceAccountSSHKeys(string $serviceAccountId, ?RequestOptions $options = null): Page
    {
        return $this->page('listServiceAccountSSHKeys', ['service_account_id' => $serviceAccountId], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listServiceAccountSSHKeysAll(string $serviceAccountId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listServiceAccountSSHKeys($serviceAccountId, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List service accounts
     * @param array<string, mixed> $query
     */
    public function listServiceAccounts(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listServiceAccounts', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listServiceAccountsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listServiceAccounts(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Create or replace a role's inline policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putRoleInlinePolicy(string $roleId, string $policyName, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putRoleInlinePolicy', ['role_id' => $roleId, 'policy_name' => $policyName], $body, [], $options);
    }

    /**
     * Create or replace a service account's inline policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putServiceAccountInlinePolicy(string $serviceAccountId, string $policyName, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putServiceAccountInlinePolicy', ['service_account_id' => $serviceAccountId, 'policy_name' => $policyName], $body, [], $options);
    }

    /**
     * Remove a role's permission boundary
     */
    public function removeRolePermissionBoundary(string $roleId, ?RequestOptions $options = null): void
    {
        $this->discard('removeRolePermissionBoundary', ['role_id' => $roleId], null, [], $options);
    }

    /**
     * Remove a service account's permission boundary
     */
    public function removeServiceAccountPermissionBoundary(string $serviceAccountId, ?RequestOptions $options = null): void
    {
        $this->discard('removeServiceAccountPermissionBoundary', ['service_account_id' => $serviceAccountId], null, [], $options);
    }

    /**
     * Revoke a bearer token
     * @param array<string, mixed>|\stdClass $body
     */
    public function revokeOAuthToken(array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('revokeOAuthToken', [], $body, [], $options);
    }

    /**
     * Revoke STS session
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function revokeSTSSession(string $sessionId, array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('revokeSTSSession', ['session_id' => $sessionId], $body, [], $options);
    }

    /**
     * Set a role's permission boundary
     * @param array<string, mixed>|\stdClass $body
     */
    public function setRolePermissionBoundary(string $roleId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('setRolePermissionBoundary', ['role_id' => $roleId], $body, [], $options);
    }

    /**
     * Set a service account's permission boundary
     * @param array<string, mixed>|\stdClass $body
     */
    public function setServiceAccountPermissionBoundary(string $serviceAccountId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('setServiceAccountPermissionBoundary', ['service_account_id' => $serviceAccountId], $body, [], $options);
    }

    /**
     * Update policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function updatePolicy(string $policyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updatePolicy', ['policy_id' => $policyId], $body, [], $options);
    }

    /**
     * Update role
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRole(string $roleId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRole', ['role_id' => $roleId], $body, [], $options);
    }

    /**
     * Update service account
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateServiceAccount(string $serviceAccountId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateServiceAccount', ['service_account_id' => $serviceAccountId], $body, [], $options);
    }
}
