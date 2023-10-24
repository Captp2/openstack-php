<?php

namespace OvhSwift\Domains;

use OvhSwift\Interfaces\Getters\IGetContainers;
use OvhSwift\Interfaces\Setters\ISetContainers;

class ContainerManager extends AbstractDomain
{
    /**
     * @return array
     */
    public function listContainers(): array
    {
        return $this->getter->listContainers($this->authentication);
    }

    /**
     * @return string
     */
    protected function getterInterface(): string
    {
        return IGetContainers::class;
    }

    /**
     * @return string
     */
    protected function setterInterface(): string
    {
        return ISetContainers::class;
    }
}