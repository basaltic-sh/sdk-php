<?php

declare(strict_types=1);

namespace Basaltic\Tests;

use PHPUnit\Framework\TestCase;

final class ReleaseExamplesTest extends TestCase
{
    public function testInstallExampleSelectsTheReleaseApiMinor(): void
    {
        $readme = file_get_contents(__DIR__ . '/../README.md');
        self::assertNotFalse($readme);
        self::assertSame(1, preg_match('/composer require basaltic-sh\/sdk-php:\^(\d+\.\d+)\b/', $readme, $example));
        // Composer derives package versions from tags, not composer.json.
        // The tag pipelines must reject a README that installs an older API.
        $tag = getenv('RELEASE_TAG') ?: getenv('CI_COMMIT_TAG') ?: getenv('GITHUB_REF_NAME');
        if (is_string($tag) && preg_match('/^v(\d+\.\d+)\.\d+(?:-[A-Za-z0-9.-]+)?$/', $tag, $release) === 1) {
            self::assertSame($release[1], $example[1], 'README constraint must select the released API minor');
        }
    }
}
