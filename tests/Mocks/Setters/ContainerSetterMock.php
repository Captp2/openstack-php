<?php

namespace OvhSwift\Tests\Mocks\Setters;

use OvhSwift\Interfaces\Setters\ISetContainers;
use OvhSwift\Accessors\AbstractAccessor;

class ContainerSetterMock extends AbstractAccessor implements ISetContainers
{
    public function createContainer(string $name): void
    {
        // TODO: Implement createContainer() method.
    }
}