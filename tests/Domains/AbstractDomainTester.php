<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Accessors\AbstractAccessor;
use PHPUnit\Framework\TestCase;

abstract class AbstractDomainTester extends TestCase
{
    protected AbstractDomain $domain;
    protected AbstractAccessor $accessor;

    protected string $domainName;
    protected string $getterClass;
    protected string $setterClass;

    public function __construct(string $name)
    {
        $this->domain = new $this->domainName(new $this->getterClass(), new $this->setterClass());

        parent::__construct($name);
    }
}