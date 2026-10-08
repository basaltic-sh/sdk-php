<?php

declare(strict_types=1);

namespace Basaltic;

use Basaltic\Exception\AmbiguousReferenceException;
use Basaltic\Exception\ApiException;

final class Reference
{
    public static function kind(string $reference): string
    {
        if (str_starts_with($reference, 'crn:')) {
            if (substr_count($reference, ':') !== 4) {
                throw new \InvalidArgumentException('A CRN must have five colon-separated segments.');
            }
            return 'crn';
        }
        return preg_match('/^[a-fA-F0-9]{8}(?:-[a-fA-F0-9]{4}){3}-[a-fA-F0-9]{12}$/D', $reference) ? 'id' : 'name';
    }

    /**
     * @param callable(string): Result $get
     * @param callable(array<string, mixed>): Page $list
     */
    public static function resolve(string $reference, callable $get, callable $list, bool $hasName, ?string $envelope = null): Result
    {
        $kind = self::kind($reference);
        if ($kind === 'id') {
            $result = $get($reference);
            if ($envelope === null) {
                return $result;
            }
            $item = $result[$envelope];
            if (!is_array($item)) {
                throw new \Basaltic\Exception\ProtocolException('Reference lookup is missing its resource envelope.');
            }
            return new Result($item, $result->response);
        }
        if ($kind === 'name' && !$hasName) {
            throw new \InvalidArgumentException('This resource requires a UUID or CRN.');
        }
        $page = $list([$kind => $reference]);
        $items = $page->items();
        if (count($items) > 1 || $page->hasMore()) {
            throw new AmbiguousReferenceException('Reference matches more than one resource; narrow its parent scope.');
        }
        if ($items === []) {
            throw new ApiException(404, 'REFERENCE_NOT_FOUND', 'No resource matches the reference.', $page->requestId(), 'resolveReference');
        }
        if (!is_array($items[0])) {
            throw new \Basaltic\Exception\ProtocolException('Reference lookup returned a non-object resource.');
        }
        return new Result($items[0], $page->response);
    }
}
