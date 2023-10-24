<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Domains\FileManager;
use OvhSwift\Tests\Domains\AbstractDomainTester;
use OvhSwift\Tests\Mocks\API\Getters\FileGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\FileSetterMock;

class AbstractFileTester extends AbstractDomainTester
{
    /**
     * @var FileManager $domain
     */
    public AbstractDomain $domain;
    protected string $domainName = FileManager::class;
    protected string $getterClass = FileGetterMock::class;
    protected string $setterClass = FileSetterMock::class;
}