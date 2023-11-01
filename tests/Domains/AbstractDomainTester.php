<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Tests\AbstractTester;

abstract class AbstractDomainTester extends AbstractTester
{
    protected AbstractDomain $domain;
    protected AbstractAccessor $accessor;

    protected string $domainName;
    protected string $getterClass;
    protected string $setterClass;

    public function getDomain(?object $adapterClass = null, $getterClass = null, $setterClass = null)
    {
        $authentication = (new Authenticator())->login();
        return new $this->domainName($adapterClass,
            $getterClass ?? new $this->getterClass(['authentication' => $authentication]),
            $setterClass ?? new $this->setterClass(['authentication' => $authentication])
        );
    }
}