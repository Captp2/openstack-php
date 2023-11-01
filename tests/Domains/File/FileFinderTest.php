<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Entities\File;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Tests\Domains\AbstractDomainTester;
use OvhSwift\Tests\Mocks\API\Getters\FileGetterMock;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

class FileFinderTest extends AbstractFileTester
{
    /**
     * @return void
     */
    public function testICanFindAFileByName(): void
    {
        $file = $this->getDomain(new FileUserMock())->findByName('test', FileGetterMock::FILE_NAME);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(FileGetterMock::FILE_NAME, $file->name);
        $this->assertEquals(FileGetterMock::FILE_PATH, $file->path);
    }

    /**
     * @return void
     */
    public function testICantFindAFileByName(): void
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->getDomain(new FileUserMock())->findByName('test', '1234');
    }
}