<?php

namespace OvhSwift\Tests\Mocks\API\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;

class FileSetterMock extends AbstractAccessor implements \OvhSwift\Interfaces\API\Setters\ISetFiles
{
    public function uploadFile(Authentication $authentication, string $containerName, string $fileName, string $fileData)
    {
        // TODO: Implement uploadFile() method.
    }
}