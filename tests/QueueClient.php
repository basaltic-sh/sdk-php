<?php

declare(strict_types=1);

namespace Basaltic\Tests;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class QueueClient implements ClientInterface
{
    /** @var list<RequestInterface> */
    public array $requests = [];

    /** @param list<ResponseInterface|\Throwable|callable> $queue */
    public function __construct(public array $queue)
    {
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $this->requests[] = $request;
        $next = array_shift($this->queue);
        if ($next instanceof \Throwable) {
            throw $next;
        }
        if (is_callable($next)) {
            $next = $next($request);
        }
        if (!$next instanceof ResponseInterface) {
            throw new \LogicException('Unexpected HTTP request in offline test.');
        }
        return $next;
    }
}
