<?php

namespace OvhSwift\Providers\Getters;

use OvhSwift\Interfaces\IGetContainers;
use OvhSwift\Providers\AbstractAccessor;

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