<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Entities\Authentication;

interface ISetFiles
{
    public function uploadFile(Authentication $authentication, string $containerName, string $fileName, string $filePath): bool;

    public function deleteFile(Authentication $authentication, string $containerName, string $fileName): bool;
}