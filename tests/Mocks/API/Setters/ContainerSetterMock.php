<?php

namespace OvhSwift\Tests\Mocks\API\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;

class ContainerSetterMock extends AbstractAccessor implements \OvhSwift\Interfaces\API\Setters\ISetContainers
{
    public AccessorResponse $createResponse;
    public AccessorResponse $deleteResponse;

    public function createContainer(string $name): AccessorResponse
    {
        return $this->createResponse;
    }

    public function deleteContainer(string $name): AccessorResponse
    {
        return $this->deleteResponse;
    }
}