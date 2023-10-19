<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domain\AbstractDomain;
use OvhSwift\Exceptions\InvalidConfigException;
use OvhSwift\Providers\AbstractAccessor;
use PHPUnit\Framework\TestCase;

abstract class AbstractDomainTester extends TestCase
{
    protected AbstractDomain $domain;
    protected AbstractAccessor $accessor;

    public function __construct(string $name)
    {
        $domainName = $this->getDomainName();
        $this->domain = new $domainName($this->getGetter(), $this->getSetter());

        parent::__construct($name);
    }

    abstract function getDomainName(): string;

    abstract function getGetter(): AbstractAccessor;
    abstract function getSetter(): AbstractAccessor;
}