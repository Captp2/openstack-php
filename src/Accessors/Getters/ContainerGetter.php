<?php

namespace OvhSwift\Accessors\Getters;

use OvhSwift\Interfaces\Getters\IGetContainers;
use OvhSwift\Accessors\AbstractAccessor;

class ContainerGetter extends AbstractAccessor implements IGetContainers
{
    /**
     * @return array
     */
    public function listContainers(): array
    {
        return [];
    }
}