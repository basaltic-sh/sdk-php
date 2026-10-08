<?php

declare(strict_types=1);

namespace Basaltic\Tests;

use Basaltic\Client;
use Basaltic\Config;
use Basaltic\Exception\ApiException;
use Basaltic\Exception\ProtocolException;
use Basaltic\RequestOptions;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class RuntimeTest extends TestCase
{
    private function client(QueueClient $http, array $options = []): Client
    {
        return new Client(array_replace([
            'access_token' => 'test-token', 'region' => 'sa-saopaulo-1', 'account_id' => 'account-a',
            'http_client' => $http, 'sleep' => static function (float $delay): void {
            },
        ], $options));
    }

    public function testEndpointPathQueryAndAccountOverride(): void
    {
        $http = new QueueClient([new Response(200, ['X-Request-Id' => 'request-1'], '{"instance":{"id":"one"}}')]);
        $result = $this->client($http)->compute()->getInstance('a/b ?#..', new RequestOptions(accountId: 'account-b'));
        $request = $http->requests[0];
        self::assertSame('https://compute.sa-saopaulo-1.basaltic.sh/v1/instances/a%2Fb%20%3F%23%2E%2E', (string) $request->getUri());
        self::assertSame('Bearer test-token', $request->getHeaderLine('Authorization'));
        self::assertSame('account-b', $request->getHeaderLine('X-Account-Id'));
        self::assertSame('one', $result['instance']['id']);
        self::assertSame('request-1', $result->requestId());
    }

    public function testJsonPreservesNullFalseZeroAndEmptyMaps(): void
    {
        $http = new QueueClient([new Response(202, [], '{"instance":{"id":"one"}}')]);
        $this->client($http)->compute()->createInstance([
            'name' => 'web', 'flavor' => 'small', 'tags' => [],
            'extra_false' => false, 'extra_zero' => 0, 'extra_null' => null,
        ], new RequestOptions(idempotencyKey: 'logical-create-1'));
        $json = (string) $http->requests[0]->getBody();
        self::assertStringContainsString('"tags":{}', $json);
        self::assertStringContainsString('"extra_false":false', $json);
        self::assertStringContainsString('"extra_zero":0', $json);
        self::assertStringContainsString('"extra_null":null', $json);
        self::assertSame('logical-create-1', $http->requests[0]->getHeaderLine('Idempotency-Key'));
    }

    public function testMissingRegionFailsBeforeSending(): void
    {
        $http = new QueueClient([]);
        $this->expectException(\InvalidArgumentException::class);
        try {
            $this->client($http, ['region' => ''])->compute()->getInstance('one');
        } finally {
            self::assertCount(0, $http->requests);
        }
    }

    public function testPublicCatalogIsAnonymousButPrivateOperationsFail(): void
    {
        $http = new QueueClient([new Response(200, [], '{"regions":[]}')]);
        $client = $this->client($http, ['anonymous' => true, 'region' => '']);
        self::assertSame([], $client->catalog()->listRegions()->items());
        self::assertSame('', $http->requests[0]->getHeaderLine('Authorization'));
        self::assertSame('catalog.basaltic.sh', $http->requests[0]->getUri()->getHost());
        $this->expectException(\LogicException::class);
        try {
            $client->iam()->listRoles();
        } finally {
            self::assertCount(1, $http->requests);
        }
    }

    public function testPaginationIsLazyKeepsFiltersAndRespectsHasMore(): void
    {
        $http = new QueueClient([
            new Response(200, [], '{"instances":[{"id":"a"}],"meta":{"marker":"cursor/+ one","has_more":true}}'),
            new Response(200, [], '{"instances":[{"id":"b"}],"meta":{"has_more":false}}'),
        ]);
        $query = ['limit' => 500, 'current_state' => 'running'];
        $iterator = $this->client($http)->compute()->listInstancesAll($query);
        self::assertCount(0, $http->requests);
        self::assertSame([['id' => 'a'], ['id' => 'b']], iterator_to_array($iterator, false));
        self::assertCount(2, $http->requests);
        self::assertStringContainsString('marker=cursor%2F%2B%20one', $http->requests[1]->getUri()->getQuery());
        self::assertStringContainsString('current_state=running', $http->requests[1]->getUri()->getQuery());
        self::assertSame(['limit' => 500, 'current_state' => 'running'], $query);
    }

    public function testBreakingPaginationDoesNotPrefetch(): void
    {
        $http = new QueueClient([new Response(200, [], '{"instances":[{"id":"a"}],"meta":{"marker":"b","has_more":true}}')]);
        foreach ($this->client($http)->compute()->listInstancesAll() as $item) {
            self::assertSame('a', $item['id']);
            break;
        }
        self::assertCount(1, $http->requests);
    }

    public function testCursorCycleRaisesInsteadOfSilentlyTruncating(): void
    {
        $http = new QueueClient([
            new Response(200, [], '{"instances":[],"meta":{"marker":"a","has_more":true}}'),
            new Response(200, [], '{"instances":[],"meta":{"marker":"b","has_more":true}}'),
            new Response(200, [], '{"instances":[],"meta":{"marker":"a","has_more":true}}'),
        ]);
        $this->expectException(ProtocolException::class);
        iterator_to_array($this->client($http)->compute()->listInstancesAll());
    }

    public function testPostWithoutKeyIsNeverRetried(): void
    {
        $http = new QueueClient([new Response(503)]);
        $this->expectException(ApiException::class);
        try {
            $this->client($http)->compute()->createInstance(['name' => 'web']);
        } finally {
            self::assertCount(1, $http->requests);
        }
    }

    public function testRetryReusesIdempotencyKeyAndBody(): void
    {
        $bodies = [];
        $capture = static function ($request) use (&$bodies): Response {
            $bodies[] = $request->getBody()->getContents();
            return new Response(count($bodies) === 1 ? 503 : 200, [], '{}');
        };
        $http = new QueueClient([$capture, $capture]);
        $this->client($http)->compute()->createInstance(['name' => 'web'], new RequestOptions(idempotencyKey: 'same'));
        self::assertCount(2, $http->requests);
        self::assertSame($bodies[0], $bodies[1]);
        self::assertSame('same', $http->requests[1]->getHeaderLine('Idempotency-Key'));
    }

    public function testRetryAfterIsHonoredAndExcessiveDelayReturnsError(): void
    {
        $waits = [];
        $http = new QueueClient([new Response(429, ['Retry-After' => '3']), new Response(200, [], '{}')]);
        $client = $this->client($http, ['sleep' => static function (float $delay) use (&$waits): void {
            $waits[] = $delay;
        }]);
        $client->compute()->getInstance('one');
        self::assertSame([3.0], $waits);
        $http->queue[] = new Response(429, ['Retry-After' => '999']);
        $this->expectException(ApiException::class);
        try {
            $client->compute()->getInstance('one');
        } finally {
            self::assertSame([3.0], $waits);
            self::assertCount(3, $http->requests);
        }
    }

    public function testNetworkFailureRetriesOnlySafeOperations(): void
    {
        $http = new QueueClient([
            new ConnectException('network failed with secret detail', new Request('GET', 'https://example.test')),
            new Response(200, [], '{}'),
        ]);
        $this->client($http)->compute()->getInstance('one');
        self::assertCount(2, $http->requests);
    }

    public function testErrorClassificationAndRequestIdFallback(): void
    {
        $http = new QueueClient([new Response(403, ['X-Request-Id' => 'r-1'], '{"error":{"code":"COMPUTE_QUOTA_EXCEEDED","message":"Limit reached"}}')]);
        try {
            $this->client($http)->compute()->getInstance('one');
            self::fail('Expected API error');
        } catch (ApiException $error) {
            self::assertTrue($error->isQuotaExceeded());
            self::assertFalse($error->isAccessDenied());
            self::assertSame('r-1', $error->requestId);
            self::assertSame('getInstance', $error->operationId);
        }
    }

    public function testBinaryResponseStaysOpenAndUploadStreamIsNotRetried(): void
    {
        $http = new QueueClient([new Response(200, ['Content-Type' => 'image/png'], "\x89PNG")]);
        $response = $this->client($http)->compute()->getConsoleScreenshot('one');
        self::assertSame("\x89PNG", $response->getBody()->read(4));
        $response->getBody()->close();
        $stream = fopen('php://temp', 'w+');
        fwrite($stream, 'contents');
        rewind($stream);
        $http->queue[] = new Response(503);
        $this->expectException(ApiException::class);
        try {
            $this->client($http)->storage()->putObject('bucket', 'key', $stream);
        } finally {
            self::assertCount(2, $http->requests);
        }
    }

    public function testMalformedSuccessAndRedirectAreNotTreatedAsResults(): void
    {
        $http = new QueueClient([new Response(200, [], 'not json'), new Response(302, ['Location' => 'https://other.test'])]);
        $client = $this->client($http);
        try {
            $client->compute()->getInstance('one');
            self::fail('Expected protocol error');
        } catch (ProtocolException) {
            self::assertCount(1, $http->requests);
        }
        $this->expectException(ApiException::class);
        $client->compute()->getInstance('one');
    }

    public function testWebSocketRequestIsPreparedWithoutOpeningHttpSession(): void
    {
        $http = new QueueClient([]);
        $request = $this->client($http)->compute()->startSerialConsole('instance', ['backlog_bytes' => 0]);
        self::assertSame('websocket', $request->getHeaderLine('Upgrade'));
        self::assertSame('Bearer test-token', $request->getHeaderLine('Authorization'));
        self::assertSame('backlog_bytes=0', $request->getUri()->getQuery());
        self::assertCount(0, $http->requests);
    }

    public function testEnvironmentAndExplicitCredentialsPrecedence(): void
    {
        putenv('BASALTIC_ACCESS_TOKEN=environment-token');
        putenv('BASALTIC_ENDPOINT_URL_COMPUTE=https://override.test/prefix');
        try {
            $http = new QueueClient([new Response(200, [], '{"access_token":"minted","expires_in":3600}'), new Response(200, [], '{}')]);
            $client = new Client(['access_key_id' => 'key', 'secret_access_key' => 'secret', 'http_client' => $http]);
            $client->compute()->getInstance('id');
            self::assertSame('https://override.test/prefix/v1/instances/id', (string) $http->requests[1]->getUri());
            self::assertSame('Bearer minted', $http->requests[1]->getHeaderLine('Authorization'));
        } finally {
            putenv('BASALTIC_ACCESS_TOKEN');
            putenv('BASALTIC_ENDPOINT_URL_COMPUTE');
        }
    }
}
