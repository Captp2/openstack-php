<?php

namespace OvhSwift\Interfaces\SPI;

interface IUseFiles
{
    public function validateFileSize(int $fileSize): bool;

    public function validateMimeType(string $fileType): bool;

    public function validateFileName(string $fileName): bool;
}