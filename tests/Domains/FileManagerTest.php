<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Tests\Mocks\Getters\FileGetterMock;
use OvhSwift\Tests\Mocks\Setters\FileSetterMock;

class FileManagerTest extends AbstractDomainTester
{
    protected string $domainName = FileManager::class;
    protected string $getterClass = FileGetterMock::class;
    protected string $setterClass = FileSetterMock::class;

    /**
     * @return void
     */
    public function testICanFindAFileByName()
    {
        $file = $this->domain->findByName(FileGetterMock::FILE_NAME);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(FileGetterMock::FILE_NAME, $file->fileName);
        $this->assertEquals(FileGetterMock::FILE_ID, $file->id);
        $this->assertEquals(FileGetterMock::FILE_PATH, $file->filePath);
    }

    /**
     * @return void
     */
    public function testICantFindAFileByName()
    {
        $this->expectExceptionMessage("File 1234 not found");
        $this->domain->findByName('1234');
    }
}