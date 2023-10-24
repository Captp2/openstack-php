<?php

namespace OvhSwift\Tests\Mocks\SPI;

use OvhSwift\App;
use OvhSwift\Interfaces\SPI\IUseFiles;

class FileUserMock extends App implements IUseFiles
{
    public bool $validateFileSize = true;
    public bool $validateFileType = true;
    public bool $validateFileName = true;

    public function __construct(array $attributes = null)
    {
        parent::__construct($attributes);
    }

    public function validateFileSize(int $fileSize): bool
    {
        ray($this);
        return $this->validateFileSize;
    }

    public function validateFileType(string $fileType): bool
    {
        return $this->validateFileType;
    }

    public function validateFileName(string $fileName): bool
    {
        return $this->validateFileName;
    }
}