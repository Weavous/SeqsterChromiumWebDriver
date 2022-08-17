<?php

declare(strict_types=1);

namespace App\Services\WebDriver\Network;

class User
{
    public function __construct(public readonly string $login, public readonly string $secret)
    {
        //
    }
}
