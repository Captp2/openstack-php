<?php

namespace OvhSwift\Tests\Domains;

use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Tests\Mocks\API\Getters\FileGetterMock;
use OvhSwift\Tests\Mocks\API\Setters\FileSetterMock;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

class FileManagerTest extends AbstractDomainTester
{
    protected string $domainName = FileManager::class;
    protected string $getterClass = FileGetterMock::class;
    protected string $setterClass = FileSetterMock::class;

    /**
     * @return void
     */
    public function testICanFindAFileByName(): void
    {
        $file = $this->getDomain(new FileUserMock())->findByName('test', FileGetterMock::FILE_NAME);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(FileGetterMock::FILE_NAME, $file->fileName);
        $this->assertEquals(FileGetterMock::FILE_ID, $file->id);
        $this->assertEquals(FileGetterMock::FILE_PATH, $file->filePath);
    }

    /**
     * @return void
     */
    public function testICantFindAFileByName(): void
    {
        $this->expectException(RessourceNotFoundException::class);
        $this->getDomain(new FileUserMock())->findByName('test', '1234');
    }
}