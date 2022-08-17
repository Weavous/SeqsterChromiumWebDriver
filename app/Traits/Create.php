<?php

namespace App\Traits;

trait Create
{
    /**
     * Create an instance.
     *
     * @return new Self
     */
    public static function create(...$args): Self
    {
        return new Self(...$args);
    }
}
