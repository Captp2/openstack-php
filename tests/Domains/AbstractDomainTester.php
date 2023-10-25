<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Tests\AbstractTester;

abstract class AbstractDomainTester extends AbstractTester
{
    protected AbstractDomain $domain;
    protected AbstractAccessor $accessor;

    protected string $domainName;
    protected string $getterClass;
    protected string $setterClass;

    public function getDomain(?object $adapterClass = null)
    {
        return new $this->domainName($adapterClass, new $this->getterClass(), new $this->setterClass());
    }
}