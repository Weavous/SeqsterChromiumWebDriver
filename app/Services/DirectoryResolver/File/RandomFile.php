<?php

declare(strict_types=1);

namespace App\Services\DirectoryResolver\File;

use App\Traits\Create;
use Illuminate\Support\Str;

class RandomFile
{
    use Create;

    public function fromArray(array $config, string $format): string
    {
        $dir = storage_path(implode(DIRECTORY_SEPARATOR, $config));

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        return sprintf("%s%s%s", $dir, DIRECTORY_SEPARATOR, sprintf("%s.%s", base64_encode(Str::random(16)), $format));
    }
}
