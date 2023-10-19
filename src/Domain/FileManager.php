<?php

namespace OvhSwift\Domain;

use OvhSwift\Interface\IFetchContainers;

class FileManager extends AbstractDomain
{
    protected null|string $dataProviderInterface = IFetchContainers::class;

    /**
     * @return array
     */
    public function listContainers(): array
    {
        return $this->dataProvider->listContainers();
    }
}