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
final class Email extends AbstractService
{
    protected const SERVICE = 'email';
    protected const ENDPOINT = 'https://email.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'addSuppressionOverride' => [
            'id' => 'addSuppressionOverride',
            'method' => 'POST',
            'path' => '/v1/configuration-sets/{configuration_set_id}/suppression-overrides',
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
        'beginDKIMRotation' => [
            'id' => 'beginDKIMRotation',
            'method' => 'POST',
            'path' => '/v1/identities/{identity_id}/dkim/rotate',
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
        'cancelDKIMRotation' => [
            'id' => 'cancelDKIMRotation',
            'method' => 'DELETE',
            'path' => '/v1/identities/{identity_id}/dkim/rotate',
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
        'createConfigurationSet' => [
            'id' => 'createConfigurationSet',
            'method' => 'POST',
            'path' => '/v1/configuration-sets',
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
                    'suppression_overrides' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'createIPPool' => [
            'id' => 'createIPPool',
            'method' => 'POST',
            'path' => '/v1/ip-pools',
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
        'createIdentity' => [
            'id' => 'createIdentity',
            'method' => 'POST',
            'path' => '/v1/identities',
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
        'createRecipientRule' => [
            'id' => 'createRecipientRule',
            'method' => 'POST',
            'path' => '/v1/identities/{identity_id}/recipient-rules',
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
        'createSuppression' => [
            'id' => 'createSuppression',
            'method' => 'POST',
            'path' => '/v1/suppressions',
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
        'createTemplate' => [
            'id' => 'createTemplate',
            'method' => 'POST',
            'path' => '/v1/templates',
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
        'deleteConfigurationSet' => [
            'id' => 'deleteConfigurationSet',
            'method' => 'DELETE',
            'path' => '/v1/configuration-sets/{configuration_set_id}',
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
        'deleteIPPool' => [
            'id' => 'deleteIPPool',
            'method' => 'DELETE',
            'path' => '/v1/ip-pools/{ip_pool_id}',
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
        'deleteIdentity' => [
            'id' => 'deleteIdentity',
            'method' => 'DELETE',
            'path' => '/v1/identities/{identity_id}',
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
        'deleteRecipientRule' => [
            'id' => 'deleteRecipientRule',
            'method' => 'DELETE',
            'path' => '/v1/identities/{identity_id}/recipient-rules/{rule_id}',
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
        'deleteSuppression' => [
            'id' => 'deleteSuppression',
            'method' => 'DELETE',
            'path' => '/v1/suppressions/{suppression_id}',
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
        'deleteTemplate' => [
            'id' => 'deleteTemplate',
            'method' => 'DELETE',
            'path' => '/v1/templates/{template_id}',
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
        'describeConfigurationSet' => [
            'id' => 'describeConfigurationSet',
            'method' => 'GET',
            'path' => '/v1/configuration-sets/{configuration_set_id}',
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
        'describeDedicatedIP' => [
            'id' => 'describeDedicatedIP',
            'method' => 'GET',
            'path' => '/v1/dedicated-ips/{dedicated_ip_id}',
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
        'describeIPPool' => [
            'id' => 'describeIPPool',
            'method' => 'GET',
            'path' => '/v1/ip-pools/{ip_pool_id}',
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
        'describeIdentity' => [
            'id' => 'describeIdentity',
            'method' => 'GET',
            'path' => '/v1/identities/{identity_id}',
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
        'describeReceivedMessage' => [
            'id' => 'describeReceivedMessage',
            'method' => 'GET',
            'path' => '/v1/received-messages/{message_id}',
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
        'describeRecipientRule' => [
            'id' => 'describeRecipientRule',
            'method' => 'GET',
            'path' => '/v1/identities/{identity_id}/recipient-rules/{rule_id}',
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
        'describeSentMessage' => [
            'id' => 'describeSentMessage',
            'method' => 'GET',
            'path' => '/v1/sent-messages/{message_id}',
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
        'describeSuppression' => [
            'id' => 'describeSuppression',
            'method' => 'GET',
            'path' => '/v1/suppressions/{suppression_id}',
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
        'describeTemplate' => [
            'id' => 'describeTemplate',
            'method' => 'GET',
            'path' => '/v1/templates/{template_id}',
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
        'downloadReceivedAttachment' => [
            'id' => 'downloadReceivedAttachment',
            'method' => 'GET',
            'path' => '/v1/received-messages/{message_id}/attachments/{attachment_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/octet-stream',
            'items_key' => null,
        ],
        'downloadReceivedMessage' => [
            'id' => 'downloadReceivedMessage',
            'method' => 'GET',
            'path' => '/v1/received-messages/{message_id}/raw',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'message/rfc822',
            'items_key' => null,
        ],
        'downloadSentAttachment' => [
            'id' => 'downloadSentAttachment',
            'method' => 'GET',
            'path' => '/v1/sent-messages/{message_id}/attachments/{attachment_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/octet-stream',
            'items_key' => null,
        ],
        'downloadSentMessage' => [
            'id' => 'downloadSentMessage',
            'method' => 'GET',
            'path' => '/v1/sent-messages/{message_id}/raw',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'message/rfc822',
            'items_key' => null,
        ],
        'finalizeDKIMRotation' => [
            'id' => 'finalizeDKIMRotation',
            'method' => 'POST',
            'path' => '/v1/identities/{identity_id}/dkim/rotate/finalize',
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
        'getReceivedMessageContent' => [
            'id' => 'getReceivedMessageContent',
            'method' => 'GET',
            'path' => '/v1/received-messages/{message_id}/content',
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
        'getReceivingConfiguration' => [
            'id' => 'getReceivingConfiguration',
            'method' => 'GET',
            'path' => '/v1/identities/{identity_id}/receiving',
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
        'getSentMessageContent' => [
            'id' => 'getSentMessageContent',
            'method' => 'GET',
            'path' => '/v1/sent-messages/{message_id}/content',
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
        'getSentMessageEngagement' => [
            'id' => 'getSentMessageEngagement',
            'method' => 'GET',
            'path' => '/v1/sent-messages/{message_id}/engagement',
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
        'listConfigurationSets' => [
            'id' => 'listConfigurationSets',
            'method' => 'GET',
            'path' => '/v1/configuration-sets',
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
            'items_key' => 'configuration_sets',
        ],
        'listDMARCReports' => [
            'id' => 'listDMARCReports',
            'method' => 'GET',
            'path' => '/v1/identities/{identity_id}/dmarc-reports',
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
                'from' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'to' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'records',
        ],
        'listDedicatedIPs' => [
            'id' => 'listDedicatedIPs',
            'method' => 'GET',
            'path' => '/v1/dedicated-ips',
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
                'ip_pool' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'dedicated_ips',
        ],
        'listIPPools' => [
            'id' => 'listIPPools',
            'method' => 'GET',
            'path' => '/v1/ip-pools',
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
            'items_key' => 'ip_pools',
        ],
        'listIdentities' => [
            'id' => 'listIdentities',
            'method' => 'GET',
            'path' => '/v1/identities',
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
            'items_key' => 'identities',
        ],
        'listReceivedMessages' => [
            'id' => 'listReceivedMessages',
            'method' => 'GET',
            'path' => '/v1/received-messages',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'identity' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'recipient' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'review_reason' => [
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
        'listRecipientRules' => [
            'id' => 'listRecipientRules',
            'method' => 'GET',
            'path' => '/v1/identities/{identity_id}/recipient-rules',
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
            'items_key' => 'rules',
        ],
        'listRejections' => [
            'id' => 'listRejections',
            'method' => 'GET',
            'path' => '/v1/rejections',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'before' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'limit' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'identity' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'reason' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'rejections',
        ],
        'listSentMessages' => [
            'id' => 'listSentMessages',
            'method' => 'GET',
            'path' => '/v1/sent-messages',
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
                'identity' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'status' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'recipient' => [
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
        'listSuppressions' => [
            'id' => 'listSuppressions',
            'method' => 'GET',
            'path' => '/v1/suppressions',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'crn' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'reason' => [
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
            'items_key' => 'suppressions',
        ],
        'listTemplates' => [
            'id' => 'listTemplates',
            'method' => 'GET',
            'path' => '/v1/templates',
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
            'items_key' => 'templates',
        ],
        'releaseDedicatedIP' => [
            'id' => 'releaseDedicatedIP',
            'method' => 'DELETE',
            'path' => '/v1/dedicated-ips/{dedicated_ip_id}',
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
        'removeSuppressionOverride' => [
            'id' => 'removeSuppressionOverride',
            'method' => 'DELETE',
            'path' => '/v1/configuration-sets/{configuration_set_id}/suppression-overrides/{address}',
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
        'requestDedicatedIP' => [
            'id' => 'requestDedicatedIP',
            'method' => 'POST',
            'path' => '/v1/dedicated-ips',
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
        'sendMessage' => [
            'id' => 'sendMessage',
            'method' => 'POST',
            'path' => '/v1/sent-messages',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'attachments' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                        ],
                    ],
                    'to' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                    'content' => [
                        'type' => 'object',
                        'properties' => [
                            'template_data' => [
                                'type' => 'object',
                            ],
                        ],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
        'sendMessageBatch' => [
            'id' => 'sendMessageBatch',
            'method' => 'POST',
            'path' => '/v1/sent-messages/batch',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'messages' => [
                        'type' => 'array',
                        'items' => [
                            'type' => 'object',
                            'properties' => [
                                'attachments' => [
                                    'type' => 'array',
                                    'items' => [
                                        'type' => 'object',
                                    ],
                                ],
                                'to' => [
                                    'type' => 'array',
                                    'items' => [],
                                ],
                                'content' => [
                                    'type' => 'object',
                                    'properties' => [
                                        'template_data' => [
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
        'setBIMI' => [
            'id' => 'setBIMI',
            'method' => 'PATCH',
            'path' => '/v1/identities/{identity_id}/bimi',
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
        'setMailFromDomain' => [
            'id' => 'setMailFromDomain',
            'method' => 'PATCH',
            'path' => '/v1/identities/{identity_id}/mail-from-domain',
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
        'updateConfigurationSet' => [
            'id' => 'updateConfigurationSet',
            'method' => 'PATCH',
            'path' => '/v1/configuration-sets/{configuration_set_id}',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'suppression_overrides' => [
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
        'updateDedicatedIP' => [
            'id' => 'updateDedicatedIP',
            'method' => 'PATCH',
            'path' => '/v1/dedicated-ips/{dedicated_ip_id}',
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
        'updateIPPool' => [
            'id' => 'updateIPPool',
            'method' => 'PATCH',
            'path' => '/v1/ip-pools/{ip_pool_id}',
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
        'updateIdentity' => [
            'id' => 'updateIdentity',
            'method' => 'PATCH',
            'path' => '/v1/identities/{identity_id}',
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
        'updateReceivingConfiguration' => [
            'id' => 'updateReceivingConfiguration',
            'method' => 'PATCH',
            'path' => '/v1/identities/{identity_id}/receiving',
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
        'updateRecipientRule' => [
            'id' => 'updateRecipientRule',
            'method' => 'PATCH',
            'path' => '/v1/identities/{identity_id}/recipient-rules/{rule_id}',
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
        'updateSuppression' => [
            'id' => 'updateSuppression',
            'method' => 'PATCH',
            'path' => '/v1/suppressions/{suppression_id}',
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
        'updateTemplate' => [
            'id' => 'updateTemplate',
            'method' => 'PATCH',
            'path' => '/v1/templates/{template_id}',
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
        'verifyBIMI' => [
            'id' => 'verifyBIMI',
            'method' => 'POST',
            'path' => '/v1/identities/{identity_id}/bimi/verify',
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
        'verifyIdentity' => [
            'id' => 'verifyIdentity',
            'method' => 'POST',
            'path' => '/v1/identities/{identity_id}/verify',
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
        'verifyMailFromDomain' => [
            'id' => 'verifyMailFromDomain',
            'method' => 'POST',
            'path' => '/v1/identities/{identity_id}/mail-from-domain/verify',
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
    ];

    /**
     * Add a suppression override address
     * @param array<string, mixed>|\stdClass $body
     */
    public function addSuppressionOverride(string $configurationSetId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('addSuppressionOverride', ['configuration_set_id' => $configurationSetId], $body, [], $options);
    }

    /**
     * Begin DKIM key rotation
     */
    public function beginDKIMRotation(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('beginDKIMRotation', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Cancel in-progress DKIM rotation
     */
    public function cancelDKIMRotation(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('cancelDKIMRotation', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Create a configuration set
     * @param array<string, mixed>|\stdClass $body
     */
    public function createConfigurationSet(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createConfigurationSet', [], $body, [], $options);
    }

    /**
     * Create an IP pool
     * @param array<string, mixed>|\stdClass $body
     */
    public function createIPPool(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createIPPool', [], $body, [], $options);
    }

    /**
     * Create a sender identity
     * @param array<string, mixed>|\stdClass $body
     */
    public function createIdentity(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createIdentity', [], $body, [], $options);
    }

    /**
     * Create recipient rule
     * @param array<string, mixed>|\stdClass $body
     */
    public function createRecipientRule(string $identityId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createRecipientRule', ['identity_id' => $identityId], $body, [], $options);
    }

    /**
     * Add a suppression entry
     * @param array<string, mixed>|\stdClass $body
     */
    public function createSuppression(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createSuppression', [], $body, [], $options);
    }

    /**
     * Create a template
     * @param array<string, mixed>|\stdClass $body
     */
    public function createTemplate(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createTemplate', [], $body, [], $options);
    }

    /**
     * Delete a configuration set
     */
    public function deleteConfigurationSet(string $configurationSetId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteConfigurationSet', ['configuration_set_id' => $configurationSetId], null, [], $options);
    }

    /**
     * Delete an IP pool
     */
    public function deleteIPPool(string $ipPoolId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteIPPool', ['ip_pool_id' => $ipPoolId], null, [], $options);
    }

    /**
     * Delete an identity
     */
    public function deleteIdentity(string $identityId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteIdentity', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Delete recipient rule
     */
    public function deleteRecipientRule(string $identityId, string $ruleId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteRecipientRule', ['identity_id' => $identityId, 'rule_id' => $ruleId], null, [], $options);
    }

    /**
     * Delete suppression
     */
    public function deleteSuppression(string $suppressionId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteSuppression', ['suppression_id' => $suppressionId], null, [], $options);
    }

    /**
     * Delete a template
     */
    public function deleteTemplate(string $templateId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteTemplate', ['template_id' => $templateId], null, [], $options);
    }

    /**
     * Describe a configuration set
     */
    public function describeConfigurationSet(string $configurationSetId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeConfigurationSet', ['configuration_set_id' => $configurationSetId], null, [], $options);
    }

    /**
     * Describe a dedicated IP
     */
    public function describeDedicatedIP(string $dedicatedIpId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeDedicatedIP', ['dedicated_ip_id' => $dedicatedIpId], null, [], $options);
    }

    /**
     * Describe an IP pool
     */
    public function describeIPPool(string $ipPoolId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeIPPool', ['ip_pool_id' => $ipPoolId], null, [], $options);
    }

    /**
     * Describe an identity
     */
    public function describeIdentity(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeIdentity', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Get received message metadata
     */
    public function describeReceivedMessage(string $messageId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeReceivedMessage', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * Get recipient rule
     */
    public function describeRecipientRule(string $identityId, string $ruleId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeRecipientRule', ['identity_id' => $identityId, 'rule_id' => $ruleId], null, [], $options);
    }

    /**
     * Describe a sent message
     */
    public function describeSentMessage(string $messageId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeSentMessage', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * Get suppression
     */
    public function describeSuppression(string $suppressionId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeSuppression', ['suppression_id' => $suppressionId], null, [], $options);
    }

    /**
     * Describe a template
     */
    public function describeTemplate(string $templateId, ?RequestOptions $options = null): Result
    {
        return $this->result('describeTemplate', ['template_id' => $templateId], null, [], $options);
    }

    /**
     * Download received attachment
     */
    public function downloadReceivedAttachment(string $messageId, string $attachmentId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('downloadReceivedAttachment', ['message_id' => $messageId, 'attachment_id' => $attachmentId], null, [], $options);
    }

    /**
     * Download received message
     */
    public function downloadReceivedMessage(string $messageId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('downloadReceivedMessage', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * Download sent attachment
     */
    public function downloadSentAttachment(string $messageId, string $attachmentId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('downloadSentAttachment', ['message_id' => $messageId, 'attachment_id' => $attachmentId], null, [], $options);
    }

    /**
     * Download sent message
     */
    public function downloadSentMessage(string $messageId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('downloadSentMessage', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * Finalize DKIM key rotation
     */
    public function finalizeDKIMRotation(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('finalizeDKIMRotation', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Get received message content
     */
    public function getReceivedMessageContent(string $messageId, ?RequestOptions $options = null): Result
    {
        return $this->result('getReceivedMessageContent', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * Get receiving configuration
     */
    public function getReceivingConfiguration(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('getReceivingConfiguration', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Get sent message content
     */
    public function getSentMessageContent(string $messageId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSentMessageContent', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * Sent message engagement
     */
    public function getSentMessageEngagement(string $messageId, ?RequestOptions $options = null): Result
    {
        return $this->result('getSentMessageEngagement', ['message_id' => $messageId], null, [], $options);
    }

    /**
     * List configuration sets
     * @param array<string, mixed> $query
     */
    public function listConfigurationSets(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listConfigurationSets', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listConfigurationSetsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listConfigurationSets(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List DMARC report records
     * @param array<string, mixed> $query
     */
    public function listDMARCReports(string $identityId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listDMARCReports', ['identity_id' => $identityId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listDMARCReportsAll(string $identityId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listDMARCReports($identityId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List dedicated IPs
     * @param array<string, mixed> $query
     */
    public function listDedicatedIPs(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listDedicatedIPs', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listDedicatedIPsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listDedicatedIPs(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List IP pools
     * @param array<string, mixed> $query
     */
    public function listIPPools(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listIPPools', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listIPPoolsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listIPPools(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List sender identities
     * @param array<string, mixed> $query
     */
    public function listIdentities(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listIdentities', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listIdentitiesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listIdentities(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List received messages
     * @param array<string, mixed> $query
     */
    public function listReceivedMessages(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listReceivedMessages', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listReceivedMessagesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listReceivedMessages(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List recipient rules
     * @param array<string, mixed> $query
     */
    public function listRecipientRules(string $identityId, array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRecipientRules', ['identity_id' => $identityId], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRecipientRulesAll(string $identityId, array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRecipientRules($identityId, array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List API-side send rejections
     * @param array<string, mixed> $query
     */
    public function listRejections(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listRejections', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listRejectionsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listRejections($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List sent messages
     * @param array<string, mixed> $query
     */
    public function listSentMessages(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSentMessages', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSentMessagesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSentMessages(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List suppression entries
     * @param array<string, mixed> $query
     */
    public function listSuppressions(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listSuppressions', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listSuppressionsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listSuppressions(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List templates
     * @param array<string, mixed> $query
     */
    public function listTemplates(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listTemplates', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listTemplatesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listTemplates(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Release a dedicated IP
     */
    public function releaseDedicatedIP(string $dedicatedIpId, ?RequestOptions $options = null): void
    {
        $this->discard('releaseDedicatedIP', ['dedicated_ip_id' => $dedicatedIpId], null, [], $options);
    }

    /**
     * Remove a suppression override address
     */
    public function removeSuppressionOverride(string $configurationSetId, string $address, ?RequestOptions $options = null): Result
    {
        return $this->result('removeSuppressionOverride', ['configuration_set_id' => $configurationSetId, 'address' => $address], null, [], $options);
    }

    /**
     * Request a dedicated IP
     * @param array<string, mixed>|\stdClass|null $body
     */
    public function requestDedicatedIP(array|\stdClass|null $body = null, ?RequestOptions $options = null): Result
    {
        return $this->result('requestDedicatedIP', [], $body, [], $options);
    }

    /**
     * Send a message
     * @param array<string, mixed>|\stdClass $body
     */
    public function sendMessage(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('sendMessage', [], $body, [], $options);
    }

    /**
     * Send message batch
     * @param array<string, mixed>|\stdClass $body
     */
    public function sendMessageBatch(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('sendMessageBatch', [], $body, [], $options);
    }

    /**
     * Set BIMI logo / VMC URLs
     * @param array<string, mixed>|\stdClass $body
     */
    public function setBIMI(string $identityId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('setBIMI', ['identity_id' => $identityId], $body, [], $options);
    }

    /**
     * Set custom MAIL FROM domain
     * @param array<string, mixed>|\stdClass $body
     */
    public function setMailFromDomain(string $identityId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('setMailFromDomain', ['identity_id' => $identityId], $body, [], $options);
    }

    /**
     * Update a configuration set
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateConfigurationSet(string $configurationSetId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateConfigurationSet', ['configuration_set_id' => $configurationSetId], $body, [], $options);
    }

    /**
     * Update a dedicated IP
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateDedicatedIP(string $dedicatedIpId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateDedicatedIP', ['dedicated_ip_id' => $dedicatedIpId], $body, [], $options);
    }

    /**
     * Update an IP pool
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateIPPool(string $ipPoolId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateIPPool', ['ip_pool_id' => $ipPoolId], $body, [], $options);
    }

    /**
     * Update identity
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateIdentity(string $identityId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateIdentity', ['identity_id' => $identityId], $body, [], $options);
    }

    /**
     * Update receiving configuration
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateReceivingConfiguration(string $identityId, array|\stdClass $body, ?RequestOptions $options = null): void
    {
        $this->discard('updateReceivingConfiguration', ['identity_id' => $identityId], $body, [], $options);
    }

    /**
     * Update recipient rule
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateRecipientRule(string $identityId, string $ruleId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateRecipientRule', ['identity_id' => $identityId, 'rule_id' => $ruleId], $body, [], $options);
    }

    /**
     * Update suppression
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateSuppression(string $suppressionId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateSuppression', ['suppression_id' => $suppressionId], $body, [], $options);
    }

    /**
     * Update a template
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateTemplate(string $templateId, array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateTemplate', ['template_id' => $templateId], $body, [], $options);
    }

    /**
     * Verify BIMI logo (+ optional VMC)
     */
    public function verifyBIMI(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('verifyBIMI', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Trigger DNS verification
     */
    public function verifyIdentity(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('verifyIdentity', ['identity_id' => $identityId], null, [], $options);
    }

    /**
     * Verify custom MAIL FROM domain MX
     */
    public function verifyMailFromDomain(string $identityId, ?RequestOptions $options = null): Result
    {
        return $this->result('verifyMailFromDomain', ['identity_id' => $identityId], null, [], $options);
    }
}
