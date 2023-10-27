<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Entities\Authentication;

interface ISetFiles
{
    public function uploadFile(string $containerName, string $fileName, string $filePath): bool;

    public function deleteFile(string $containerName, string $fileName): bool;
}