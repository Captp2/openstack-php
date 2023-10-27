<?php

namespace OvhSwift\Tests\Mocks\API\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;

class FileSetterMock extends AbstractAccessor implements \OvhSwift\Interfaces\API\Setters\ISetFiles
{
    public function uploadFile(string $containerName, string $fileName, string $filePath): bool
    {
        // TODO: Implement uploadFile() method.
    }

    public function deleteFile(string $containerName, string $fileName): bool
    {
        // TODO: Implement deleteFile() method.
    }
}