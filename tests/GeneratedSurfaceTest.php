<?php

declare(strict_types=1);

namespace Basaltic\Tests;

use Basaltic\Client;
use Basaltic\Exception\AmbiguousReferenceException;
use Basaltic\Reference;
use Basaltic\RequestOptions;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class GeneratedSurfaceTest extends TestCase
{
    public function testEveryGeneratedOperationEncodesArgumentsAndCanBeInvoked(): void
    {
        $count = 0;
        foreach (glob(__DIR__ . '/../src/Service/*.php') as $file) {
            $name = lcfirst(basename($file, '.php'));
            $http = new QueueClient([]);
            $client = new Client(['access_token' => 'test-token', 'region' => 'sa-saopaulo-1', 'http_client' => $http]);
            $service = $client->{$name}();
            $reflection = new \ReflectionObject($service);
            $operations = $reflection->getConstant('OPERATIONS');
            foreach ($operations as $id => $operation) {
                $method = $reflection->getMethod($id);
                $args = [];
                $values = [];
                foreach ($method->getParameters() as $param) {
                    if ($param->getName() === 'body') {
                        $args[] = in_array($operation['content_type'], ['application/json', 'application/x-www-form-urlencoded'], true) ? [] : 'payload';
                    } elseif ($param->getName() === 'query') {
                        $args[] = array_fill_keys($operation['required_query'], 'required-value');
                    } elseif ($param->getName() === 'options') {
                        $args[] = new RequestOptions(headers: array_fill_keys($operation['required_headers'], 'header-value'));
                    } else {
                        $value = 'position' . count($values) . '/ space?#';
                        $values[] = rawurlencode($value);
                        $args[] = $value;
                    }
                }
                if ($id === 'startSerialConsole') {
                    $request = $method->invokeArgs($service, $args);
                } else {
                    $http->queue[] = new Response(200, [], '{}');
                    $method->invokeArgs($service, $args);
                    $request = $http->requests[array_key_last($http->requests)];
                }
                $uri = (string) $request->getUri();
                self::assertStringNotContainsString('{', $uri, $id);
                $cursor = 0;
                foreach ($values as $value) {
                    $position = strpos($uri, $value, $cursor);
                    self::assertNotFalse($position, $id . ' argument missing or out of order');
                    $cursor = $position + strlen($value);
                }
                self::assertSame($operation['authenticated'] ? 'Bearer test-token' : '', $request->getHeaderLine('Authorization'), $id);
                $count++;
            }
        }
        self::assertSame(401, $count, 'Review the supported API surface when regenerating.');
    }

    public function testReferenceKindsHaveNoFallbackAndBothLookupsReturnResource(): void
    {
        self::assertSame('name', Reference::kind(' 550e8400-e29b-41d4-a716-446655440000'));
        self::assertSame('crn', Reference::kind('crn:compute:sa-saopaulo-1:account:instance/web'));
        $http = new QueueClient([
            new Response(200, [], '{"instance":{"id":"one"}}'),
            new Response(200, [], '{"instances":[{"id":"one"}],"meta":{"has_more":false}}'),
        ]);
        $client = new Client(['access_token' => 'token', 'region' => 'sa-saopaulo-1', 'http_client' => $http]);
        self::assertSame('one', $client->compute()->getInstanceByReference('550e8400-e29b-41d4-a716-446655440000')['id']);
        self::assertSame('one', $client->compute()->getInstanceByReference('web', ['name' => 'stale', 'marker' => 'stale'])['id']);
        self::assertSame('limit=2&name=web', $http->requests[1]->getUri()->getQuery());
    }

    public function testReferenceAmbiguityIsReported(): void
    {
        $http = new QueueClient([new Response(200, [], '{"instances":[{"id":"one"}],"meta":{"has_more":true,"marker":"next"}}')]);
        $client = new Client(['access_token' => 'token', 'region' => 'sa-saopaulo-1', 'http_client' => $http]);
        $this->expectException(AmbiguousReferenceException::class);
        $client->compute()->getInstanceByReference('web');
    }

    public function testRepeatedQueryNamesUseOpenApiFormEncoding(): void
    {
        self::assertSame('match%5B%5D=one&match%5B%5D=two&zero=0&flag=false', \Basaltic\Transport::encodeQuery([
            'match[]' => ['one', 'two'], 'zero' => 0, 'flag' => false, 'omitted' => null,
        ], []));
    }
}
