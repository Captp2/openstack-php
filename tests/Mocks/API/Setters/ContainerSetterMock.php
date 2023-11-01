<?php

namespace OvhSwift\Tests\Mocks\API\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Interfaces\API\Setters\ISetContainers;

class ContainerSetterMock extends AbstractAccessor implements ISetContainers
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