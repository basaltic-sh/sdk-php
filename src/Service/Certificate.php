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
final class Certificate extends AbstractService
{
    protected const SERVICE = 'certificate';
    protected const ENDPOINT = 'https://certificate.{region}.basaltic.sh';
    protected const OPERATIONS = [
        'createCertificate' => [
            'id' => 'createCertificate',
            'method' => 'POST',
            'path' => '/v1/certificates',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'domains' => [
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
        'deleteCertificate' => [
            'id' => 'deleteCertificate',
            'method' => 'DELETE',
            'path' => '/v1/certificates/{certificate_id}',
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
        'getCertificate' => [
            'id' => 'getCertificate',
            'method' => 'GET',
            'path' => '/v1/certificates/{certificate_id}',
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
        'getCertificateMaterial' => [
            'id' => 'getCertificateMaterial',
            'method' => 'GET',
            'path' => '/v1/certificates/{certificate_id}/material',
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
        'listCertificates' => [
            'id' => 'listCertificates',
            'method' => 'GET',
            'path' => '/v1/certificates',
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
            'items_key' => 'certificates',
        ],
        'revokeCertificate' => [
            'id' => 'revokeCertificate',
            'method' => 'POST',
            'path' => '/v1/certificates/{certificate_id}/revoke',
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
     * Create certificate
     * @param array<string, mixed>|\stdClass $body
     */
    public function createCertificate(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('createCertificate', [], $body, [], $options);
    }

    /**
     * Delete certificate
     */
    public function deleteCertificate(string $certificateId, ?RequestOptions $options = null): void
    {
        $this->discard('deleteCertificate', ['certificate_id' => $certificateId], null, [], $options);
    }

    /**
     * Get certificate
     */
    public function getCertificate(string $certificateId, ?RequestOptions $options = null): Result
    {
        return $this->result('getCertificate', ['certificate_id' => $certificateId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getCertificateByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getCertificate($id, $options),
            fn (array $filter): Page => $this->listCertificates(array_replace($scope, $filter), $options),
            true,
            'certificate',
        );
    }

    /**
     * Fetch certificate material (leaf, chain, private key)
     */
    public function getCertificateMaterial(string $certificateId, ?RequestOptions $options = null): Result
    {
        return $this->result('getCertificateMaterial', ['certificate_id' => $certificateId], null, [], $options);
    }

    /**
     * List certificates
     * @param array<string, mixed> $query
     */
    public function listCertificates(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listCertificates', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listCertificatesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listCertificates(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Revoke certificate
     */
    public function revokeCertificate(string $certificateId, ?RequestOptions $options = null): Result
    {
        return $this->result('revokeCertificate', ['certificate_id' => $certificateId], null, [], $options);
    }
}
