<?php

namespace OvhSwift\Domains;

use OvhSwift\App;
use OvhSwift\Entities\Authentication;
use OvhSwift\Exceptions\InvalidConfigException;

abstract class AbstractDomain extends App
{
    protected object $setter;
    protected object $getter;
    protected object $authentication;
    protected object $spiAdapter;
    protected bool $useSpi = true;

    abstract protected function getterInterface(): string;

    abstract protected function setterInterface(): string;

    /**
     * @param object|null $getter
     * @param object|null $setter
     * @throws InvalidConfigException
     */
    public function __construct(object $spiAdapter = null, object $getter = null, object $setter = null)
    {
        parent::__construct();
        $this->authentication = Authenticator::login();
        $accessorsMap = $this->getOption('ovh.accessors.' . static::class);
        $this->getter = $getter ?? (new $accessorsMap['getter']());
        $this->setter = $setter ?? (new $accessorsMap['setter']());

        if ($this->useSpi) {
            $this->spiAdapter = $spiAdapter;
            $this->validateInstance($spiAdapter, $this->getOption('ovh.spi.' . static::class));
        }
        $this->validateInstance($this->getter, $this->getterInterface());
        $this->validateInstance($this->setter, $this->setterInterface());
    }

    /**
     * @param object $instance
     * @param string $interface
     * @return void
     * @throws InvalidConfigException
     */
    private function validateInstance(object $instance, string $interface): void
    {
        if (!$instance instanceof $interface) {
            throw new InvalidConfigException(get_class($instance) . " does not implement " . $interface);
        }
    }
}
