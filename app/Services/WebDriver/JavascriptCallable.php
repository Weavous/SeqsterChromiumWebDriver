<?php

declare(strict_types=1);

namespace App\Services\WebDriver;

use App\Traits\Create;

class JavascriptCallable
{
    use Create;

    protected array $options = [];

    /**
     * Constructor
     * 
     * @param string $location The script filename that we want to trigger.
     */
    public function __construct(public readonly string $location)
    {
        //
    }

    public function with(array $options = []): Self
    {
        $this->options = $options;

        return $this;
    }

    public function call(): string
    {
        return sprintf(file_get_contents($this->location), ...array_values($this->options));
    }
}
