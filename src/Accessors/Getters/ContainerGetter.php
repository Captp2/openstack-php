<?php

namespace OvhSwift\Accessors\Getters;

use OvhSwift\Entities\Authentication;
use OvhSwift\Interfaces\Getters\IGetContainers;
use OvhSwift\Accessors\AbstractAccessor;

class ContainerGetter extends AbstractAccessor implements IGetContainers
{
    /**
     * @param Authentication $authentication
     * @return array
     */
    public function listContainers(Authentication $authentication): array
    {
        return [];
    }
}