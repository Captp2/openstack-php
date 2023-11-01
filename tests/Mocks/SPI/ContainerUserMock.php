<?php

namespace OvhSwift\Tests\Mocks\SPI;

use OvhSwift\App;
use OvhSwift\Interfaces\SPI\IUseContainers;

class ContainerUserMock extends App implements IUseContainers
{
    public bool $validateContainerName = true;

    public function validateContainerName(): bool
    {
        return $this->validateContainerName;
    }
}