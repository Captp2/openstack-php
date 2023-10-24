<?php

namespace OvhSwift\Tests\Mocks\SPI;

use OvhSwift\App;
use OvhSwift\Interfaces\SPI\IUseFiles;

class FileUserMock extends App implements IUseFiles
{
    public function validateFileSize(int $fileSize): bool
    {
        return false;
    }

    public function validateFileType(string $fileType): bool
    {
        return false;
    }

    public function validateFileName(string $fileName): bool
    {
        return false;
    }
}