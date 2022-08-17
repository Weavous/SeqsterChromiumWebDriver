<?php

declare(strict_types=1);

namespace App\Services\DirectoryResolver\File;

enum FileExtension
{
    case PDF;

    public function stringify(): string
    {
        return match ($this) {
            FileExtension::PDF => 'pdf'
        };
    }
}
