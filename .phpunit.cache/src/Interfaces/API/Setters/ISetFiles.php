<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Accessors\AccessorResponse;

interface ISetFiles
{
    public function uploadFile(string $containerName, string $fileName, string $filePath, bool $createContainer = false): AccessorResponse;

    public function deleteFile(string $containerName, string $fileName): AccessorResponse;
}