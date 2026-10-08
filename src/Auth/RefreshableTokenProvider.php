<?php

declare(strict_types=1);

namespace Basaltic\Auth;

interface RefreshableTokenProvider extends TokenProvider
{
    public function invalidate(): void;
}
