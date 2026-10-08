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
final class Workspace extends AbstractService
{
    protected const SERVICE = 'workspace';
    protected const ENDPOINT = 'https://workspace.basaltic.sh';
    protected const OPERATIONS = [
        'addUser' => [
            'id' => 'addUser',
            'method' => 'POST',
            'path' => '/v1/users',
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
                    'groups' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'addUserToGroup' => [
            'id' => 'addUserToGroup',
            'method' => 'POST',
            'path' => '/v1/users/{user_id}/groups',
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
        'assignAccountRole' => [
            'id' => 'assignAccountRole',
            'method' => 'POST',
            'path' => '/v1/accounts/{account_id}/role-assignments',
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
        'attachGroupPolicy' => [
            'id' => 'attachGroupPolicy',
            'method' => 'POST',
            'path' => '/v1/groups/{group_id}/policies',
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
        'attachUserPolicy' => [
            'id' => 'attachUserPolicy',
            'method' => 'POST',
            'path' => '/v1/users/{user_id}/policies',
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
        'cancelInvitation' => [
            'id' => 'cancelInvitation',
            'method' => 'DELETE',
            'path' => '/v1/invitations/{invitation_id}',
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
        'createAccount' => [
            'id' => 'createAccount',
            'method' => 'POST',
            'path' => '/v1/accounts',
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
        'createGroup' => [
            'id' => 'createGroup',
            'method' => 'POST',
            'path' => '/v1/groups',
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
        'deleteAccount' => [
            'id' => 'deleteAccount',
            'method' => 'DELETE',
            'path' => '/v1/accounts/{account_id}',
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
        'deleteGroup' => [
            'id' => 'deleteGroup',
            'method' => 'DELETE',
            'path' => '/v1/groups/{group_id}',
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
        'deleteGroupInlinePolicy' => [
            'id' => 'deleteGroupInlinePolicy',
            'method' => 'DELETE',
            'path' => '/v1/groups/{group_id}/inline-policies/{policy_name}',
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
        'deleteOrganization' => [
            'id' => 'deleteOrganization',
            'method' => 'DELETE',
            'path' => '/v1/organizations/{organization_id}',
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
        'deleteUserInlinePolicy' => [
            'id' => 'deleteUserInlinePolicy',
            'method' => 'DELETE',
            'path' => '/v1/users/{user_id}/inline-policies/{policy_name}',
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
        'detachGroupPolicy' => [
            'id' => 'detachGroupPolicy',
            'method' => 'DELETE',
            'path' => '/v1/groups/{group_id}/policies/{policy_id}',
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
        'detachUserPolicy' => [
            'id' => 'detachUserPolicy',
            'method' => 'DELETE',
            'path' => '/v1/users/{user_id}/policies/{policy_id}',
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
        'getAccount' => [
            'id' => 'getAccount',
            'method' => 'GET',
            'path' => '/v1/accounts/{account_id}',
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
        'getAccountResources' => [
            'id' => 'getAccountResources',
            'method' => 'GET',
            'path' => '/v1/accounts/{account_id}/resources',
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
        'getGroup' => [
            'id' => 'getGroup',
            'method' => 'GET',
            'path' => '/v1/groups/{group_id}',
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
        'getGroupInlinePolicy' => [
            'id' => 'getGroupInlinePolicy',
            'method' => 'GET',
            'path' => '/v1/groups/{group_id}/inline-policies/{policy_name}',
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
        'getInvitation' => [
            'id' => 'getInvitation',
            'method' => 'GET',
            'path' => '/v1/invitations/{invitation_id}',
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
        'getOrganization' => [
            'id' => 'getOrganization',
            'method' => 'GET',
            'path' => '/v1/organizations/{organization_id}',
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
        'getUser' => [
            'id' => 'getUser',
            'method' => 'GET',
            'path' => '/v1/users/{user_id}',
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
        'getUserInlinePolicy' => [
            'id' => 'getUserInlinePolicy',
            'method' => 'GET',
            'path' => '/v1/users/{user_id}/inline-policies/{policy_name}',
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
        'getUserPermissionBoundary' => [
            'id' => 'getUserPermissionBoundary',
            'method' => 'GET',
            'path' => '/v1/users/{user_id}/permission-boundary',
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
        'listAccountRoleAssignments' => [
            'id' => 'listAccountRoleAssignments',
            'method' => 'GET',
            'path' => '/v1/accounts/{account_id}/role-assignments',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'role_assignments',
        ],
        'listAccountRoles' => [
            'id' => 'listAccountRoles',
            'method' => 'GET',
            'path' => '/v1/account-roles',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'account_roles',
        ],
        'listAccounts' => [
            'id' => 'listAccounts',
            'method' => 'GET',
            'path' => '/v1/accounts',
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
            'items_key' => 'accounts',
        ],
        'listGroupInlinePolicies' => [
            'id' => 'listGroupInlinePolicies',
            'method' => 'GET',
            'path' => '/v1/groups/{group_id}/inline-policies',
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
        'listGroupPolicies' => [
            'id' => 'listGroupPolicies',
            'method' => 'GET',
            'path' => '/v1/groups/{group_id}/policies',
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
        'listGroupUsers' => [
            'id' => 'listGroupUsers',
            'method' => 'GET',
            'path' => '/v1/groups/{group_id}/users',
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
            'items_key' => 'users',
        ],
        'listGroups' => [
            'id' => 'listGroups',
            'method' => 'GET',
            'path' => '/v1/groups',
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
            'items_key' => 'groups',
        ],
        'listInvitations' => [
            'id' => 'listInvitations',
            'method' => 'GET',
            'path' => '/v1/invitations',
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
            'items_key' => 'invitations',
        ],
        'listOrganizations' => [
            'id' => 'listOrganizations',
            'method' => 'GET',
            'path' => '/v1/organizations',
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
            'items_key' => 'organizations',
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
        'listPolicyGroups' => [
            'id' => 'listPolicyGroups',
            'method' => 'GET',
            'path' => '/v1/policies/{policy_id}/groups',
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
            'items_key' => 'groups',
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
        'listPolicyUsers' => [
            'id' => 'listPolicyUsers',
            'method' => 'GET',
            'path' => '/v1/policies/{policy_id}/users',
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
            'items_key' => 'users',
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
        'listUserGroups' => [
            'id' => 'listUserGroups',
            'method' => 'GET',
            'path' => '/v1/users/{user_id}/groups',
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
            'items_key' => 'groups',
        ],
        'listUserInlinePolicies' => [
            'id' => 'listUserInlinePolicies',
            'method' => 'GET',
            'path' => '/v1/users/{user_id}/inline-policies',
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
        'listUserPolicies' => [
            'id' => 'listUserPolicies',
            'method' => 'GET',
            'path' => '/v1/users/{user_id}/policies',
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
        'listUsers' => [
            'id' => 'listUsers',
            'method' => 'GET',
            'path' => '/v1/users',
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
            'items_key' => 'users',
        ],
        'putGroupInlinePolicy' => [
            'id' => 'putGroupInlinePolicy',
            'method' => 'PUT',
            'path' => '/v1/groups/{group_id}/inline-policies/{policy_name}',
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
        'putUserInlinePolicy' => [
            'id' => 'putUserInlinePolicy',
            'method' => 'PUT',
            'path' => '/v1/users/{user_id}/inline-policies/{policy_name}',
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
        'removeAccountRoleAssignment' => [
            'id' => 'removeAccountRoleAssignment',
            'method' => 'DELETE',
            'path' => '/v1/accounts/{account_id}/role-assignments/{assignment_id}',
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
        'removeUser' => [
            'id' => 'removeUser',
            'method' => 'DELETE',
            'path' => '/v1/users/{user_id}',
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
        'removeUserFromGroup' => [
            'id' => 'removeUserFromGroup',
            'method' => 'DELETE',
            'path' => '/v1/users/{user_id}/groups/{group_id}',
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
        'removeUserPermissionBoundary' => [
            'id' => 'removeUserPermissionBoundary',
            'method' => 'DELETE',
            'path' => '/v1/users/{user_id}/permission-boundary',
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
        'setUserPermissionBoundary' => [
            'id' => 'setUserPermissionBoundary',
            'method' => 'PUT',
            'path' => '/v1/users/{user_id}/permission-boundary',
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
        'updateAccount' => [
            'id' => 'updateAccount',
            'method' => 'PATCH',
            'path' => '/v1/accounts/{account_id}',
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
        'updateGroup' => [
            'id' => 'updateGroup',
            'method' => 'PATCH',
            'path' => '/v1/groups/{group_id}',
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
        'updateOrganization' => [
            'id' => 'updateOrganization',
            'method' => 'PATCH',
            'path' => '/v1/organizations/{organization_id}',
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
    ];

    /**
     * Add user to organization
     * @param array<string, mixed>|\stdClass $body
     */
    public function addUser(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('addUser', [], $body, [], $options);
    }

    /**
     * Add user to group
     * @param array<string, mixed>|\stdClass $body
     */
    public function addUserToGroup(string $userId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('addUserToGroup', ['user_id' => $userId], $body, [], $options);
    }

    /**
     * Assign account role
     * @param array<string, mixed>|\stdClass $body
     */
    public function assignAccountRole(string $accountId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('assignAccountRole', ['account_id' => $accountId], $body, [], $options);
    }

    /**
     * Attach policy to group
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachGroupPolicy(string $groupId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('attachGroupPolicy', ['group_id' => $groupId], $body, [], $options);
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
     * Attach policy to user
     * @param array<string, mixed>|\stdClass $body
     */
    public function attachUserPolicy(string $userId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('attachUserPolicy', ['user_id' => $userId], $body, [], $options);
    }

    /**
     * Cancel invitation
     */
    public function cancelInvitation(string $invitationId, ?RequestOptions $options = null): void
    {
        $this->discard('cancelInvitation', ['invitation_id' => $invitationId], null, [], $options);
    }

    /**
     * Create account
     * @param array<string, mixed>|\stdClass $body
     */
    public function createAccount(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createAccount', [], $body, [], $options);
    }

    /**
     * Create group
     * @param array<string, mixed>|\stdClass $body
     */
    public function createGroup(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createGroup', [], $body, [], $options);
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
     * Delete account
     */
    public function deleteAccount(string $accountId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteAccount', ['account_id' => $accountId], null, [], $options);
    }

    /**
     * Delete group
     */
    public function deleteGroup(string $groupId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteGroup', ['group_id' => $groupId], null, [], $options);
    }

    /**
     * Delete a group's inline policy by name
     */
    public function deleteGroupInlinePolicy(string $groupId, string $policyName, ?RequestOptions $options = null): void
    {
        $this->discard('deleteGroupInlinePolicy', ['group_id' => $groupId, 'policy_name' => $policyName], null, [], $options);
    }

    /**
     * Delete organization
     */
    public function deleteOrganization(string $organizationId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteOrganization', ['organization_id' => $organizationId], null, [], $options);
    }

    /**
     * Delete policy
     */
    public function deletePolicy(string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('deletePolicy', ['policy_id' => $policyId], null, [], $options);
    }

    /**
     * Delete a user's inline policy by name
     */
    public function deleteUserInlinePolicy(string $userId, string $policyName, ?RequestOptions $options = null): void
    {
        $this->discard('deleteUserInlinePolicy', ['user_id' => $userId, 'policy_name' => $policyName], null, [], $options);
    }

    /**
     * Detach policy from group
     */
    public function detachGroupPolicy(string $groupId, string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('detachGroupPolicy', ['group_id' => $groupId, 'policy_id' => $policyId], null, [], $options);
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
     * Detach policy from user
     */
    public function detachUserPolicy(string $userId, string $policyId, ?RequestOptions $options = null): void
    {
        $this->discard('detachUserPolicy', ['user_id' => $userId, 'policy_id' => $policyId], null, [], $options);
    }

    /**
     * Get account
     */
    public function getAccount(string $accountId, ?RequestOptions $options = null): Result
    {
        return $this->result('getAccount', ['account_id' => $accountId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getAccountByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getAccount($id, $options),
            fn (array $filter): Page => $this->listAccounts(array_replace($scope, $filter), $options),
            true,
            'account',
        );
    }

    /**
     * Check account resource presence
     */
    public function getAccountResources(string $accountId, ?RequestOptions $options = null): Result
    {
        return $this->result('getAccountResources', ['account_id' => $accountId], null, [], $options);
    }

    /**
     * Get group
     */
    public function getGroup(string $groupId, ?RequestOptions $options = null): Result
    {
        return $this->result('getGroup', ['group_id' => $groupId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getGroupByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getGroup($id, $options),
            fn (array $filter): Page => $this->listGroups(array_replace($scope, $filter), $options),
            true,
            'group',
        );
    }

    /**
     * Get a group's inline policy by name
     */
    public function getGroupInlinePolicy(string $groupId, string $policyName, ?RequestOptions $options = null): Result
    {
        return $this->result('getGroupInlinePolicy', ['group_id' => $groupId, 'policy_name' => $policyName], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getGroupInlinePolicyByReference(string $groupId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getGroupInlinePolicy($groupId, $id, $options),
            fn (array $filter): Page => $this->listGroupInlinePolicies($groupId, array_replace($scope, $filter), $options),
            true,
            'inline_policy',
        );
    }

    /**
     * Get invitation
     */
    public function getInvitation(string $invitationId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInvitation', ['invitation_id' => $invitationId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getInvitationByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getInvitation($id, $options),
            fn (array $filter): Page => $this->listInvitations(array_replace($scope, $filter), $options),
            true,
            'invitation',
        );
    }

    /**
     * Get organization
     */
    public function getOrganization(string $organizationId, ?RequestOptions $options = null): Result
    {
        return $this->result('getOrganization', ['organization_id' => $organizationId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getOrganizationByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getOrganization($id, $options),
            fn (array $filter): Page => $this->listOrganizations(array_replace($scope, $filter), $options),
            true,
            'organization',
        );
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
     * Get user
     */
    public function getUser(string $userId, ?RequestOptions $options = null): Result
    {
        return $this->result('getUser', ['user_id' => $userId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getUserByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getUser($id, $options),
            fn (array $filter): Page => $this->listUsers(array_replace($scope, $filter), $options),
            true,
            'user',
        );
    }

    /**
     * Get a user's inline policy by name
     */
    public function getUserInlinePolicy(string $userId, string $policyName, ?RequestOptions $options = null): Result
    {
        return $this->result('getUserInlinePolicy', ['user_id' => $userId, 'policy_name' => $policyName], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getUserInlinePolicyByReference(string $userId, string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getUserInlinePolicy($userId, $id, $options),
            fn (array $filter): Page => $this->listUserInlinePolicies($userId, array_replace($scope, $filter), $options),
            true,
            'inline_policy',
        );
    }

    /**
     * Get a user's permission boundary
     */
    public function getUserPermissionBoundary(string $userId, ?RequestOptions $options = null): Result
    {
        return $this->result('getUserPermissionBoundary', ['user_id' => $userId], null, [], $options);
    }

    /**
     * List account role assignments
     */
    public function listAccountRoleAssignments(string $accountId, ?RequestOptions $options = null): Page
    {
        return $this->page('listAccountRoleAssignments', ['account_id' => $accountId], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listAccountRoleAssignmentsAll(string $accountId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listAccountRoleAssignments($accountId, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List assigned account roles
     */
    public function listAccountRoles(?RequestOptions $options = null): Page
    {
        return $this->page('listAccountRoles', [], null, [], $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listAccountRolesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listAccountRoles($options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List accounts
     * @param array<string, mixed> $query
     */
    public function listAccounts(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listAccounts', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listAccountsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listAccounts(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List a group's inline policies
     * @param array<string, mixed> $query
     */
    public function listGroupInlinePolicies(string $groupId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listGroupInlinePolicies', ['group_id' => $groupId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listGroupInlinePoliciesAll(string $groupId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listGroupInlinePolicies($groupId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List group policies
     * @param array<string, mixed> $query
     */
    public function listGroupPolicies(string $groupId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listGroupPolicies', ['group_id' => $groupId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listGroupPoliciesAll(string $groupId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listGroupPolicies($groupId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List group users
     * @param array<string, mixed> $query
     */
    public function listGroupUsers(string $groupId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listGroupUsers', ['group_id' => $groupId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listGroupUsersAll(string $groupId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listGroupUsers($groupId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List groups
     * @param array<string, mixed> $query
     */
    public function listGroups(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listGroups', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listGroupsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listGroups(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List invitations
     * @param array<string, mixed> $query
     */
    public function listInvitations(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInvitations', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInvitationsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInvitations(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List organizations
     * @param array<string, mixed> $query
     */
    public function listOrganizations(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listOrganizations', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listOrganizationsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listOrganizations(array_replace($query, ['marker' => $marker]), $options),
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
     * List groups with policy
     * @param array<string, mixed> $query
     */
    public function listPolicyGroups(string $policyId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPolicyGroups', ['policy_id' => $policyId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPolicyGroupsAll(string $policyId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPolicyGroups($policyId, array_replace($query, ['marker' => $marker]), $options),
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
     * List users with policy
     * @param array<string, mixed> $query
     */
    public function listPolicyUsers(string $policyId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPolicyUsers', ['policy_id' => $policyId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPolicyUsersAll(string $policyId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPolicyUsers($policyId, array_replace($query, ['marker' => $marker]), $options),
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
     * List user groups
     * @param array<string, mixed> $query
     */
    public function listUserGroups(string $userId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listUserGroups', ['user_id' => $userId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listUserGroupsAll(string $userId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listUserGroups($userId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List a user's inline policies
     * @param array<string, mixed> $query
     */
    public function listUserInlinePolicies(string $userId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listUserInlinePolicies', ['user_id' => $userId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listUserInlinePoliciesAll(string $userId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listUserInlinePolicies($userId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List user policies
     * @param array<string, mixed> $query
     */
    public function listUserPolicies(string $userId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listUserPolicies', ['user_id' => $userId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listUserPoliciesAll(string $userId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listUserPolicies($userId, $query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List users
     * @param array<string, mixed> $query
     */
    public function listUsers(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listUsers', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listUsersAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listUsers(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Create or replace a group's inline policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putGroupInlinePolicy(string $groupId, string $policyName, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putGroupInlinePolicy', ['group_id' => $groupId, 'policy_name' => $policyName], $body, [], $options);
    }

    /**
     * Create or replace a user's inline policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function putUserInlinePolicy(string $userId, string $policyName, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('putUserInlinePolicy', ['user_id' => $userId, 'policy_name' => $policyName], $body, [], $options);
    }

    /**
     * Remove account role assignment
     */
    public function removeAccountRoleAssignment(string $accountId, string $assignmentId, ?RequestOptions $options = null): void
    {
        $this->discard('removeAccountRoleAssignment', ['account_id' => $accountId, 'assignment_id' => $assignmentId], null, [], $options);
    }

    /**
     * Remove user from organization
     */
    public function removeUser(string $userId, ?RequestOptions $options = null): void
    {
        $this->discard('removeUser', ['user_id' => $userId], null, [], $options);
    }

    /**
     * Remove user from group
     */
    public function removeUserFromGroup(string $userId, string $groupId, ?RequestOptions $options = null): void
    {
        $this->discard('removeUserFromGroup', ['user_id' => $userId, 'group_id' => $groupId], null, [], $options);
    }

    /**
     * Remove a user's permission boundary
     */
    public function removeUserPermissionBoundary(string $userId, ?RequestOptions $options = null): void
    {
        $this->discard('removeUserPermissionBoundary', ['user_id' => $userId], null, [], $options);
    }

    /**
     * Set a user's permission boundary
     * @param array<string, mixed>|\stdClass $body
     */
    public function setUserPermissionBoundary(string $userId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('setUserPermissionBoundary', ['user_id' => $userId], $body, [], $options);
    }

    /**
     * Update account
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateAccount(string $accountId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateAccount', ['account_id' => $accountId], $body, [], $options);
    }

    /**
     * Update group
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateGroup(string $groupId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateGroup', ['group_id' => $groupId], $body, [], $options);
    }

    /**
     * Update organization
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateOrganization(string $organizationId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateOrganization', ['organization_id' => $organizationId], $body, [], $options);
    }

    /**
     * Update policy
     * @param array<string, mixed>|\stdClass $body
     */
    public function updatePolicy(string $policyId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updatePolicy', ['policy_id' => $policyId], $body, [], $options);
    }
}
