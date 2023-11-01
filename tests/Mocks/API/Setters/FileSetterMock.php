<?php

namespace OvhSwift\Tests\Mocks\API\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\API\Setters\ISetFiles;

class FileSetterMock extends AbstractAccessor implements ISetFiles
{
    public AccessorResponse $uploadFileResponse;
    public AccessorResponse $deleteFileResponse;

    public function uploadFile(string $containerName, string $fileName, string $filePath, bool $createContainer = false): AccessorResponse
    {
        return $this->uploadFileResponse;
    }

    public function deleteFile(string $containerName, string $fileName): AccessorResponse
    {
        return $this->deleteFileResponse;
    }
}