<?php

declare(strict_types=1);

namespace Basaltic\Tests;

use Basaltic\Client;
use Basaltic\RequestOptions;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class RotationTest extends TestCase
{
    public function testRotationRequestsPreserveFalseTokensAndVersions(): void
    {
        $http = new QueueClient([
            new Response(200, [], '{"rotation":{"enabled":false,"rotation_period_days":90,"next_rotation_at":null}}'),
            new Response(202, [], '{"rotation":{"id":"rotation","status":"pending","key_version":null}}'),
            new Response(200, [], '{"signature_valid":true}'),
        ]);
        $client = new Client(['access_token' => 'token', 'region' => 'test-1', 'http_client' => $http]);
        $policy = $client->kms()->setKeyRotation('key', ['enabled' => false, 'rotation_period_days' => 90]);
        self::assertFalse($policy['rotation']['enabled']);
        self::assertSame('PUT', $http->requests[0]->getMethod());
        self::assertSame(['enabled' => false, 'rotation_period_days' => 90], json_decode((string) $http->requests[0]->getBody(), true));
        $rotation = $client->kms()->rotateKeyOnDemand('key', new RequestOptions(idempotencyKey: 'rotation-request'));
        self::assertSame('pending', $rotation['rotation']['status']);
        self::assertNull($rotation['rotation']['key_version']);
        self::assertSame('rotation-request', $http->requests[1]->getHeaderLine('Idempotency-Key'));
        self::assertSame('/v1/keys/key/rotate', $http->requests[1]->getUri()->getPath());
        $client->kms()->verify('key', ['message' => 'bXNn', 'signature' => 'c2ln', 'key_version' => 1]);
        self::assertSame(1, json_decode((string) $http->requests[2]->getBody(), true)['key_version']);
    }
}
