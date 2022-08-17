<?php

namespace Tests\Unit\app\Services\DirectoryResolver\File;

use App\Services\DirectoryResolver\File\FileExtension;

use Tests\TestCase;

class FileExtensionTest extends TestCase
{
    public function testEnumResponse()
    {
        $this->assertEquals((fn (FileExtension $extension) => $extension->stringify())(FileExtension::PDF), 'pdf');
    }
}
