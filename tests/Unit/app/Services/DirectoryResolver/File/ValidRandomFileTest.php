<?php

namespace Tests\Unit\app\Services\DirectoryResolver\File;

use App\Services\DirectoryResolver\File\FileExtension;
use App\Services\DirectoryResolver\File\RandomFile;

use Tests\TestCase;

class ValidRandomFileTest extends TestCase
{
    /**
     * @dataProvider filenameProvider
     */
    public function testFilenameCorrectlyGenerated(string $pattern, array $config, FileExtension $extension): void
    {
        $this->assertMatchesRegularExpression($pattern, RandomFile::create()->fromArray($config, $extension));
    }

    public function filenameProvider(): array
    {
        return [
            'shouldReturnOnlyFilenameWhenThereIsNoDirectoryConfig' => ['pattern' => "/\/storage\/[a-zA-Z0-9=]+.pdf/", 'config' => [], 'extension' => FileExtension::PDF],
            'shouldReturnFileAndDirectoryNameWhenThereIsSimpleDirectoryConfig' => ['pattern' => "/\/storage\/foo\/[a-zA-Z0-9=]+.pdf/", 'config' => ['foo'], 'extension' => FileExtension::PDF],
            'shouldReturnFileAndDirectoryNameWhenThereIsNestedDirectoryConfig' => ['pattern' => "/\/storage\/foo\/bar\/[a-zA-Z0-9=]+.pdf/", 'config' => ['foo', 'bar'], 'extension' => FileExtension::PDF]
        ];
    }
}
