<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Entities\Authentication;

interface ISetFiles
{
    public function uploadFile(string $containerName, string $fileName, string $filePath): AccessorResponse;

    public function deleteFile(string $containerName, string $fileName): AccessorResponse;
}