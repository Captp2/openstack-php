<?php

namespace OvhSwift\Tests\Mocks\API\Setters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;

class ContainerSetterMock extends AbstractAccessor implements \OvhSwift\Interfaces\API\Setters\ISetContainers
{
    public function createContainer(string $name): bool
    {
        // TODO: Implement createContainer() method.
    }

    public function deleteContainer(string $name): bool
    {
        // TODO: Implement deleteContainer() method.
    }
}