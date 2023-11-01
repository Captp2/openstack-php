<?php

namespace OvhSwift\Domains;

use OvhSwift\Accessors\OVH\Getters\ContainerGetter;
use OvhSwift\Accessors\OVH\Setters\ContainerSetter;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\OpenStackException;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Exceptions\ResourceValidationException;
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
     * @var ContainerGetter $getter
     */
    protected object $getter;

    /**
     * @var ContainerSetter $setter
     */
    protected object $setter;

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listContainers(): array
    {
        return $this->getter->listContainers($this->authentication);
    }

    /**
     * @param string $name
     * @return bool
     * @throws OpenStackException
     * @throws ResourceValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createContainer(string $name): bool
    {
        if (strlen($name) >= File::MAX_NAME_SIZE) {
            throw new OpenStackException("Container name must not be greater than " . File::MAX_NAME_SIZE);
        }
        if (!$this->spiAdapter->validateContainerName($name)) {
            throw new ResourceValidationException("{$name} is not a valid container name");
        }

        try {
            return $this->setter->createContainer($name);
        } catch (\Exception $e) {
            throw new OpenStackException($e->getMessage());
        }
    }

    /**
     * @param string $name
     * @return bool
     * @throws OpenStackException
     * @throws ResourceNotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteContainer(string $name): bool
    {
        $response = $this->setter->deleteContainer($name);
        if (!$response->success) {
            if (isset($response->errors['404'])) {
                throw new ResourceNotFoundException($response->errors['404']);
            }

            throw new OpenStackException($response->errors['code']);
        }

        return true;
    }

    /**
     * @param string $name
     * @return array
     * @throws OpenStackException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listItems(string $name): array
    {
        try {
            $items = $this->getter->listItems($name);
        } catch (\Exception $e) {
            if (!$e instanceof ResourceNotFoundException) {
                throw new OpenStackException($e->getMessage());
            }
        }

        return $items;
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