<?php

namespace OvhSwift\Domains;

use OvhSwift\Interfaces\API\Getters\IGetContainers;
use OvhSwift\Interfaces\API\Setters\ISetContainers;

class ContainerManager extends AbstractDomain
{
    protected bool $useSpi = false;

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