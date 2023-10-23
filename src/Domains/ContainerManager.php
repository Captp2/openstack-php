<?php

namespace OvhSwift\Domains;

use OvhSwift\Interfaces\Getters\IGetContainers;
use OvhSwift\Interfaces\Setters\ISetContainers;
use OvhSwift\Accessors\Getters\ContainerGetter;
use OvhSwift\Accessors\Setters\ContainerSetter;

class ContainerManager extends AbstractDomain
{
    /**
     * @return array
     */
    public function listContainers(): array
    {
        $authentication = (new Authenticator())->login();

        return $this->getter->listContainers($authentication);
    }

    /**
     * @return string
     */
    protected function getterClass(): string
    {
        return ContainerGetter::class;
    }

    /**
     * @return string
     */
    protected function setterClass(): string
    {
        return ContainerSetter::class;
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