<?php

namespace OvhSwift\Domains;

use OvhSwift\Exceptions\RessourceValidationException;
use OvhSwift\Interfaces\API\Getters\IGetContainers;
use OvhSwift\Interfaces\API\Setters\ISetContainers;
use OvhSwift\Interfaces\SPI\IUseContainers;

class ContainerManager extends AbstractDomain
{
    /**
     * @var IUseContainers
     */
    protected object $spiAdapter;

    /**
     * @return array
     */
    public function listContainers(): array
    {
        return $this->getter->listContainers($this->authentication);
    }

    /**
     * @param string $name
     * @return void
     * @throws RessourceValidationException
     */
    public function createContainer(string $name)
    {
        if (!$this->spiAdapter->validateContainerName($name)) {
            throw new RessourceValidationException("{$name} is not a valid container name");
        }
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