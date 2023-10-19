<?php

namespace OvhSwift\Domain;

use OvhSwift\Exceptions\InvalidConfigException;
use OvhSwift\Exceptions\InvalidAccessor;

abstract class AbstractDomain
{
    protected null|object $dataProvider;
    protected null|string $dataProviderInterface;
    protected null|object $dataWriter;
    protected null|object $dataWriterInterface;

    /**
     * @throws InvalidConfigException
     * @throws InvalidAccessor
     */
    public function __construct(object $dataProvider = null, object $dataWriter = null)
    {
        $this->dataProvider = $this->checkInterface($dataProvider, $this->dataProviderInterface, "DataProviderInterface");
        $this->dataWriter = $this->checkInterface($dataWriter, $this->dataWriterInterface, "DataWriterInterface");
    }

    /**
     * @param $accessor
     * @param $accessorInterface
     * @param string $accessorType
     * @return void
     * @throws InvalidAccessor
     * @throws InvalidConfigException
     */
    private function checkInterface($accessor, $accessorInterface, string $accessorType): object
    {
        if (is_null($accessor)) {
            if (is_null($accessorInterface)) {
                throw new InvalidConfigException(static::class . " must implement a {$accessorType}");
            }
            $accessor = new $accessorInterface();
        }
        if (!$accessor instanceof $accessorInterface) {
            throw new InvalidAccessor("{$accessor::class} is not an instance of {$accessorInterface}");
        }

        return $accessor;
    }
}