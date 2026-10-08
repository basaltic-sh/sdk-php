# Basaltic PHP SDK

[![Public source checks](https://github.com/basaltic-sh/sdk-php/actions/workflows/public-checks.yml/badge.svg?branch=main)](https://github.com/basaltic-sh/sdk-php/actions/workflows/public-checks.yml)

The official PHP client for the [Basaltic](https://basaltic.sh) cloud platform.
Requires PHP 8.3 or later and Composer. Tested on PHP 8.3, 8.4 and 8.5.

This repository contains release snapshots. Development happens privately;
pull requests and other code contributions are not accepted here. For support,
see [the documentation](https://docs.basaltic.sh). Report vulnerabilities
privately to **security@basaltic.sh**, following [SECURITY.md](SECURITY.md).

## Installation

The package is available from this GitHub repository. Add it as a Composer VCS
repository, then require the versioned package (Packagist registration is not
required):

```bash
composer config repositories.basaltic vcs https://github.com/basaltic-sh/sdk-php
composer require basaltic-sh/sdk-php:^0.1
```

## Quick start

```php
<?php

require 'vendor/autoload.php';

use Basaltic\Client;
use Basaltic\RequestOptions;

// Reads BASALTIC_ACCESS_KEY_ID, BASALTIC_SECRET_ACCESS_KEY and BASALTIC_REGION.
$client = new Client();

$result = $client->compute()->createInstance(
    [
        'name' => 'web-01', 'flavor' => 'your-flavor', 'image' => 'your-image',
        'networks' => [['subnet' => 'your-subnet-uuid']],
    ],
    new RequestOptions(idempotencyKey: RequestOptions::newIdempotencyKey()),
);
echo $result['instance']['id'];

foreach ($client->compute()->listInstancesAll(['limit' => 50]) as $instance) {
    echo $instance['name'] . PHP_EOL;
}
```

Request bodies and filters use the API's field names as associative arrays.
Omitting a key leaves it unspecified; `null`, `false`, `0` and an empty string
are preserved. Schema-defined object fields such as `tags` serialize an empty
array as `{}`. Use `(object) []` for an empty object inside an unconstrained
JSON value. Unknown response fields are preserved.

JSON methods return an immutable `Result`: use array access or `toArray()`.
The API response envelope is retained (`$result['instance']`, for example).
`requestId()` and `response` expose request IDs, status and response headers.
Methods with no response body return `void`.

## Configuration and authentication

```php
$client = new Client([
    'access_key_id' => $keyId,
    'secret_access_key' => $secret,
    'region' => 'sa-saopaulo-1',
    'account_id' => $accountId,
]);

// An already-issued bearer token, including an assumed-role session:
$client = new Client(['access_token' => $token, 'region' => 'sa-saopaulo-1']);

// Public region discovery requires no credentials:
$public = new Client(['anonymous' => true]);
$regions = $public->catalog()->listRegions()->items();
```

| Environment variable | Meaning |
| --- | --- |
| `BASALTIC_ACCESS_KEY_ID` | Service account access key ID |
| `BASALTIC_SECRET_ACCESS_KEY` | Service account secret |
| `BASALTIC_ACCESS_TOKEN` | Existing token; takes precedence over environment key pairs |
| `BASALTIC_REGION` | Region for regional services |
| `BASALTIC_ACCOUNT_ID` | Account to act on, sent as `X-Account-Id` |
| `BASALTIC_DOMAIN` | API domain, default `basaltic.sh` |
| `BASALTIC_ENDPOINT_URL_COMPUTE` | Override a service endpoint; replace `COMPUTE` with any service name |

Explicit configuration wins over the environment. An explicitly supplied key
pair overrides an environment bearer token. An empty `region` or `account_id`
clears its environment default. Share one `Client`, or one `Config` between
clients, to share the in-memory token cache. Access keys are exchanged at
`https://iam.basaltic.sh/v1/oauth/token`; tokens refresh before expiry and once
after a 401. Static bearer tokens cannot refresh. The synchronous cache is
per PHP process and is not persisted to disk or shared across FPM workers.

Custom configuration accepts `token_provider` implementing `Auth\TokenProvider`
(optionally `RefreshableTokenProvider`), `http_client` implementing PSR-18,
`token_url`, and per-service `endpoints`, such as
`['compute' => 'https://compute.example.test']`. The default Guzzle transport
verifies TLS and does not follow redirects. `timeout` defaults to 30 seconds;
configure timeouts on your own transport when supplying `http_client`.
Global services do not require or use a region.

## Services and API reference

The [generated API reference](docs/api.md) lists all 401 operations, positional
path arguments, query fields, body fields and required headers.

| Regional | Global |
| --- | --- |
| `compute()` | `iam()` |
| `network()` | `workspace()` |
| `storage()` | `catalog()` |
| `loadbalancer()` | `dns()` |
| `certificate()` | `billing()` |
| `kms()` | `audit()` |
| `secrets()` | `quota()` |
| `telemetry()` | |

Database, registry, queue, notifications and email are not part of this release.
The native storage API is included; for S3/SigV4 use an AWS SDK configured for
the Basaltic S3 endpoint.

## Pagination and resource references

List operations return `Page`, preserving the original response keys and
providing `items()`, `hasMore()` and `marker()`. Generated `list...All()` methods
yield items lazily, retaining your filters across pages. Breaking the loop
stops requests immediately. Pagination uses `meta.has_more`, never page size.
Request errors, missing cursors and repeated cursors raise exceptions rather
than silently presenting a partial walk as complete.

Resources with matching get/list endpoints and exact filters also have
`get...ByReference()` methods:

```php
$instance = $client->compute()->getInstanceByReference('web-01');
echo $instance['id']; // Reference helpers return the resource without an envelope.
$subnet = $client->network()->getSubnetByReference('public', ['vpc' => 'production']);
```

A canonical UUID goes directly to the get endpoint; a CRN or name goes to the
list with the corresponding exact filter. A miss is never retried as another
kind. `AmbiguousReferenceException` means the scope needs narrowing.

## Errors, retries and per-call options

```php
use Basaltic\Exception\ApiException;

try {
    $result = $client->compute()->getInstance($id);
} catch (ApiException $e) {
    if ($e->isNotFound()) {
        // Missing, removed, or not visible to this account.
    } elseif ($e->isQuotaExceeded()) {
        // Raise the quota; this is distinct from isAccessDenied().
    }
    // Include $e->requestId and $e->operationId when reporting an API failure.
    throw $e;
}
```

Also available: `isUnauthorized()`, `isConflict()`, `isInvalidInput()`,
`isRateLimited()` and `isTransient()`. Inspect `statusCode`, `errorCode` and
`headers` for details; classify by helpers rather than resource-specific error
strings. `AuthenticationException` represents a failed token exchange,
`TransportException` a transport failure, and `ProtocolException` malformed
responses or pagination. Token exchange exceptions omit raw credential-bearing
requests and responses.

Four attempts are allowed by default for network errors and HTTP 429, 500,
502, 503 and 504. GET/HEAD/OPTIONS/PUT/DELETE can retry; POST/PATCH need an
idempotency key. Streaming uploads are never retried. Backoff uses full jitter
from `base_delay` (0.2 seconds) up to `max_delay` (20 seconds). `Retry-After`
is respected; if it exceeds `max_delay`, the SDK returns the error rather than
retrying early. Set `max_attempts` to 1 to disable retries.

Every method accepts trailing `RequestOptions` with `accountId`,
`idempotencyKey`, `maxAttempts` and operation-specific `headers`. Keep one
idempotency key for one logical mutation, including application retries.
Managed authorization, account, host and idempotency headers cannot be
overridden through the general headers array.

## Binary bodies and serial consoles

Binary operations return a PSR-7 response. Consume and close its body:

```php
$response = $client->compute()->getConsoleScreenshot($id);
try {
    file_put_contents('console.png', $response->getBody()->getContents());
} finally {
    $response->getBody()->close();
}
```

Upload methods accept a string, PHP resource or PSR-7 stream. Form-based
telemetry methods accept associative arrays, including repeated query fields.

`startSerialConsole()` prepares an authenticated PSR-7 HTTP upgrade request;
it does **not** open or implement a WebSocket session. Pass its URI and headers
to your WebSocket client. For browser consoles, use `createSerialConsoleTicket()`
and pass its short-lived `ticket` as the console URL's query parameter instead
of exposing a bearer token in a URL.

## Development checks and releases

```bash
composer install --no-interaction
composer check
```

Checks are offline and do not need cloud credentials. Generated PHP is committed;
consumers and public CI need neither the generator nor API specifications.
Protected private GitLab tags publish one filtered bot-authored snapshot per
version. Existing public versions are immutable. This is a v0.x SDK while the
API surface settles.

Apache 2.0. See [LICENSE](LICENSE).
