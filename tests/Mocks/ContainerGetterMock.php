<?php

namespace OvhSwift\Tests\Mocks;

use OvhSwift\Interfaces\IGetContainers;
use OvhSwift\Providers\AbstractAccessor;

class ContainerGetterMock extends AbstractAccessor implements IGetContainers
{
    public function listContainers(): array
    {
        return [];
    }
}