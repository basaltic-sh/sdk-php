<?php

declare(strict_types=1);

namespace Basaltic\Tests;

use Basaltic\Client;
use Basaltic\Exception\AuthenticationException;
use Basaltic\Exception\ApiException;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class AuthTest extends TestCase
{
    public function testSharedTokenRefreshAndRevocation(): void
    {
        $now = 1000.0;
        $http = new QueueClient([
            new Response(200, [], '{"access_token":"first","expires_in":100,"token_type":"Bearer"}'),
            new Response(200, [], '{}'), new Response(200, [], '{}'),
            new Response(200, [], '{"access_token":"second","expires_in":3600}'),
            new Response(200, [], '{}'), new Response(401),
            new Response(200, [], '{"access_token":"third","expires_in":3600}'),
            new Response(200, [], '{}'),
        ]);
        $client = new Client([
            'access_key_id' => 'key', 'secret_access_key' => 'secret', 'region' => 'sa-saopaulo-1',
            'http_client' => $http, 'clock' => static function () use (&$now): float {
                return $now;
            },
        ]);
        $client->compute()->getInstance('a');
        $client->network()->getVPC('b');
        self::assertCount(3, $http->requests);
        self::assertSame('Basic ' . base64_encode('key:secret'), $http->requests[0]->getHeaderLine('Authorization'));
        self::assertSame('grant_type=client_credentials', (string) $http->requests[0]->getBody());
        $now = 1095;
        $client->compute()->getInstance('a');
        self::assertSame('Bearer second', $http->requests[4]->getHeaderLine('Authorization'));
        $client->compute()->getInstance('a');
        self::assertCount(8, $http->requests);
        self::assertSame('Bearer third', $http->requests[7]->getHeaderLine('Authorization'));
    }

    public function testAuthenticationFailureNeverContainsCredentials(): void
    {
        $http = new QueueClient([new Response(401, [], '{"error":"invalid_client","error_description":"echo-secret"}')]);
        $client = new Client(['access_key_id' => 'key', 'secret_access_key' => 'echo-secret', 'http_client' => $http]);
        try {
            $client->iam()->listRoles();
            self::fail('Expected auth error');
        } catch (AuthenticationException $error) {
            self::assertSame('invalid_client', $error->errorCode);
            self::assertStringNotContainsString('echo-secret', (string) $error);
            self::assertNull($error->getPrevious());
        }
    }

    public function testStaticToken401IsNotRetried(): void
    {
        $http = new QueueClient([new Response(401)]);
        $client = new Client(['access_token' => 'token', 'http_client' => $http]);
        $this->expectException(ApiException::class);
        try {
            $client->iam()->listRoles();
        } finally {
            self::assertCount(1, $http->requests);
        }
    }
}
