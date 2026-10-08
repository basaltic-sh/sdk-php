<?php

declare(strict_types=1);

namespace Basaltic\Auth;

interface TokenProvider
{
    public function token(): string;
}
