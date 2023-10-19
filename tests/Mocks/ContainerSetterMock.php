<?php

namespace OvhSwift\Tests\Mocks;

use OvhSwift\Interfaces\ISetContainers;
use OvhSwift\Providers\AbstractAccessor;

class ContainerSetterMock extends AbstractAccessor implements ISetContainers
{
    public function createContainer(string $name): void
    {
        // TODO: Implement createContainer() method.
    }
}