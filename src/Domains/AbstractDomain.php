<?php

namespace OvhSwift\Domains;

use OvhSwift\App;
use OvhSwift\Exceptions\InvalidConfigException;

abstract class AbstractDomain extends App
{
    protected object $setter;
    protected object $getter;

    abstract protected function getterClass(): string;
    abstract protected function setterClass(): string;
    abstract protected function getterInterface(): string;
    abstract protected function setterInterface(): string;

    /**
     * @param object|null $getter
     * @param object|null $setter
     * @throws InvalidConfigException
     */
    public function __construct(object $getter = null, object $setter = null)
    {
        parent::__construct();
        $this->getter = $getter ?? new ($this->getterClass());
        $this->setter = $setter ?? new ($this->setterClass());

        $this->validateInstance($this->getter, $this->getterInterface());
        $this->validateInstance($this->setter, $this->setterInterface());
    }

    /**
     * @param object $instance
     * @param string $interface
     * @return void
     * @throws InvalidConfigException
     */
    protected function validateInstance(object $instance, string $interface): void
    {
        if (!$instance instanceof $interface) {
            throw new InvalidConfigException(get_class($instance) . " does not implement " . $interface);
        }
    }
}
