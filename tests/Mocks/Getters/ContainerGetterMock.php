<?php

namespace OvhSwift\Tests\Mocks\Getters;

use OvhSwift\Interfaces\Getters\IGetContainers;
use OvhSwift\Accessors\AbstractAccessor;

class ContainerGetterMock extends AbstractAccessor implements IGetContainers
{
    public function listContainers(): array
    {
        return [];
    }
}