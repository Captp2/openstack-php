<?php

namespace OvhSwift\Domain;

use OvhSwift\Interfaces\IGetContainers;
use OvhSwift\Interfaces\ISetContainers;
use OvhSwift\Providers\Getters\ContainerGetter;
use OvhSwift\Providers\Setters\ContainerSetter;

class ContainerManager extends AbstractDomain
{
    /**
     * @return array
     */
    public function listContainers(): array
    {
        return $this->getter->listContainers();
    }

    public function getGetterAdapter(): object
    {
        return new ContainerGetter();
    }

    public function getSetterAdapter(): object
    {
        return new ContainerSetter();
    }

    public function getGetterInterface(): string
    {
        return IGetContainers::class;
    }

    public function getSetterInterface(): string
    {
        return ISetContainers::class;
    }
}