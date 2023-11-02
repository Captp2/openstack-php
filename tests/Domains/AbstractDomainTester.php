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

    public function getDomain(?object $adapterClass = null, $getter = null, $setter = null)
    {
        ray($setter);
        $authentication = (new Authenticator())->login();
        return new $this->domainName($adapterClass,
            $getter ?? new $this->getterClass(['authentication' => $authentication]),
            $setter ?? new $this->setterClass(['authentication' => $authentication])
        );
    }
}