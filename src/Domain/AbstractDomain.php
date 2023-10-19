<?php

namespace OvhSwift\Domain;

use OvhSwift\Exceptions\InvalidConfigException;
use OvhSwift\Exceptions\InvalidAccessor;

abstract class AbstractDomain
{
    const GETTER_INTERFACE = "GetterInterface";
    const SETTER_INTERFACE = "SetterInterface";


    const ACCESSORS = [
        self::GETTER_INTERFACE,
        self::SETTER_INTERFACE,
    ];

    protected string $getterInterface;
    protected object $setter;
    protected string $setterInterface;
    protected object $getter;

    /**
     * @throws InvalidConfigException
     * @throws InvalidAccessor
     */
    public function __construct(object $getter = null, object $setter = null)
    {
        $this->initProperties();
        $this->getter = $this->checkInterface($getter, $this->getterInterface, self::GETTER_INTERFACE);
        $this->setter = $this->checkInterface($setter, $this->setterInterface, self::SETTER_INTERFACE);
    }

    private function initProperties()
    {
        $this->getterInterface = $this->getGetterInterface();
        $this->setterInterface = $this->getSetterInterface();
        $this->getter = $this->getGetterAdapter();
        $this->setter = $this->getSetterAdapter();
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
            var_dump('Pas doverride');
            $accessor = new $accessor();
        }
        switch ($accessorType) {
            case (self::GETTER_INTERFACE):
                $accessor = $this->getGetterAdapter();
                break;
            case (self::SETTER_INTERFACE):
                $accessor = $this->getSetterAdapter();
                break;
        }

        if (!$accessor instanceof $accessorInterface) {
            throw new InvalidAccessor($accessor::class . " is not an instance of {$accessorInterface}");
        }

        return $accessor;
    }

    abstract function getGetterAdapter(): object;

    abstract function getSetterAdapter(): object;

    abstract function getGetterInterface(): string;

    abstract function getSetterInterface(): string;
}