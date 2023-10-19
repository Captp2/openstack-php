<?php

namespace OvhSwift\Tests;

use OvhSwift\Domain\FileManager;

class FileManagerTest extends AbstractDomainTester
{
    private string $domainName = FileManager::class;

    function getDomainName(): string
    {
        return $this->domainName;
    }

    public function testIReceiveAnEmptyArray()
    {
        
    }
}