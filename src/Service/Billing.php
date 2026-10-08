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
final class Billing extends AbstractService
{
    protected const SERVICE = 'billing';
    protected const ENDPOINT = 'https://billing.basaltic.sh';
    protected const OPERATIONS = [
        'getBillingProfile' => [
            'id' => 'getBillingProfile',
            'method' => 'GET',
            'path' => '/v1/profile',
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
        'getCurrentUsage' => [
            'id' => 'getCurrentUsage',
            'method' => 'GET',
            'path' => '/v1/usage',
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
        'getFiscalInvoiceXml' => [
            'id' => 'getFiscalInvoiceXml',
            'method' => 'GET',
            'path' => '/v1/fiscal-invoices/{document_id}/xml',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/xml',
            'items_key' => null,
        ],
        'getInvoice' => [
            'id' => 'getInvoice',
            'method' => 'GET',
            'path' => '/v1/invoices/{invoice_id}',
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
        'getInvoicePdf' => [
            'id' => 'getInvoicePdf',
            'method' => 'GET',
            'path' => '/v1/invoices/{invoice_id}/pdf',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/pdf',
            'items_key' => null,
        ],
        'listCredits' => [
            'id' => 'listCredits',
            'method' => 'GET',
            'path' => '/v1/credits',
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
            'items_key' => 'credits',
        ],
        'listFiscalInvoices' => [
            'id' => 'listFiscalInvoices',
            'method' => 'GET',
            'path' => '/v1/fiscal-invoices',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'invoice' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'fiscal_documents',
        ],
        'listInvoices' => [
            'id' => 'listInvoices',
            'method' => 'GET',
            'path' => '/v1/invoices',
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
            'items_key' => 'invoices',
        ],
        'listPayments' => [
            'id' => 'listPayments',
            'method' => 'GET',
            'path' => '/v1/payments',
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
            'items_key' => 'payments',
        ],
        'listPrices' => [
            'id' => 'listPrices',
            'method' => 'GET',
            'path' => '/v1/prices',
            'authenticated' => false,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [
                'service' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'resource_type' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'sku' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'family' => [
                    'style' => 'form',
                    'explode' => true,
                ],
                'at' => [
                    'style' => 'form',
                    'explode' => true,
                ],
            ],
            'body_required' => false,
            'content_type' => '',
            'body_shape' => [],
            'accept' => 'application/json',
            'items_key' => 'prices',
        ],
        'listTransactions' => [
            'id' => 'listTransactions',
            'method' => 'GET',
            'path' => '/v1/transactions',
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
            'items_key' => 'transactions',
        ],
        'updateBillingProfile' => [
            'id' => 'updateBillingProfile',
            'method' => 'PUT',
            'path' => '/v1/profile',
            'authenticated' => true,
            'required_query' => [],
            'required_headers' => [],
            'query_encoding' => [],
            'body_required' => true,
            'content_type' => 'application/json',
            'body_shape' => [
                'type' => 'object',
                'properties' => [
                    'missing_fields' => [
                        'type' => 'array',
                        'items' => [],
                    ],
                ],
            ],
            'accept' => 'application/json',
            'items_key' => null,
        ],
    ];

    /**
     * Read the organization billing profile
     */
    public function getBillingProfile(?RequestOptions $options = null): Result
    {
        return $this->result('getBillingProfile', [], null, [], $options);
    }

    /**
     * Get month-to-date usage total
     */
    public function getCurrentUsage(?RequestOptions $options = null): Result
    {
        return $this->result('getCurrentUsage', [], null, [], $options);
    }

    /**
     * Download issued NFS-e XML
     */
    public function getFiscalInvoiceXml(string $documentId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('getFiscalInvoiceXml', ['document_id' => $documentId], null, [], $options);
    }

    /**
     * Get an invoice with its line items
     */
    public function getInvoice(string $invoiceId, ?RequestOptions $options = null): Result
    {
        return $this->result('getInvoice', ['invoice_id' => $invoiceId], null, [], $options);
    }

    /** @param array<string, mixed> $scope */
    public function getInvoiceByReference(string $reference, array $scope = [], ?RequestOptions $options = null): Result
    {
        unset($scope['name'], $scope['crn'], $scope['marker']);
        $scope['limit'] = 2;
        return Reference::resolve(
            $reference,
            fn (string $id): Result => $this->getInvoice($id, $options),
            fn (array $filter): Page => $this->listInvoices(array_replace($scope, $filter), $options),
            false,
            null,
        );
    }

    /**
     * Download an invoice as a PDF statement
     */
    public function getInvoicePdf(string $invoiceId, ?RequestOptions $options = null): ResponseInterface
    {
        return $this->download('getInvoicePdf', ['invoice_id' => $invoiceId], null, [], $options);
    }

    /**
     * List credit grants
     * @param array<string, mixed> $query
     */
    public function listCredits(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listCredits', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listCreditsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listCredits(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List fiscal invoice issuance and delivery status
     * @param array<string, mixed> $query
     */
    public function listFiscalInvoices(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listFiscalInvoices', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listFiscalInvoicesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listFiscalInvoices($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List invoices
     * @param array<string, mixed> $query
     */
    public function listInvoices(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listInvoices', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listInvoicesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listInvoices(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List invoice payments
     * @param array<string, mixed> $query
     */
    public function listPayments(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPayments', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPaymentsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPayments(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List catalog prices
     * @param array<string, mixed> $query
     */
    public function listPrices(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listPrices', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listPricesAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listPrices($query, $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * List ledger transactions
     * @param array<string, mixed> $query
     */
    public function listTransactions(array $query = [], ?RequestOptions $options = null): Page
    {
        return $this->page('listTransactions', [], null, $query, $options);
    }

    /** @param array<string, mixed> $query
     * @return \Generator<int, mixed>
     */
    public function listTransactionsAll(array $query = [], ?RequestOptions $options = null): \Generator
    {
        return Page::iterate(
            fn (string $marker): Page => $this->listTransactions(array_replace($query, ['marker' => $marker]), $options),
            (string) ($query['marker'] ?? ''),
        );
    }

    /**
     * Save organization billing details
     * @param array<string, mixed>|\stdClass $body
     */
    public function updateBillingProfile(array|\stdClass $body, ?RequestOptions $options = null): Result
    {
        return $this->result('updateBillingProfile', [], $body, [], $options);
    }
}
