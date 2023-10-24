<?php

namespace OvhSwift\Interfaces\API\Setters;

use OvhSwift\Entities\Authentication;

interface ISetFiles
{
    public function uploadFile(Authentication $authentication, string $containerName, string $fileName, string $fileData);
}