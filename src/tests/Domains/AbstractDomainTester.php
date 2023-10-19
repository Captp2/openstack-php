<?php

namespace OvhSwift\Tests;

use OvhSwift\Domain\AbstractDomain;
use OvhSwift\Exceptions\InvalidConfigException;
use PHPUnit\Framework\TestCase;

abstract class AbstractDomainTester extends TestCase
{
    protected AbstractDomain $domain;

    public function __construct(string $name)
    {
        $domainName = $this->getDomainName();
        $this->domain = new $domainName();

        parent::__construct($name);
    }

    abstract function getDomainName(): string;
}