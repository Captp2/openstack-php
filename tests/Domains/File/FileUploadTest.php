<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Exceptions\RessourceValidationException;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

class FileUploadTest extends AbstractFileTester
{
    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidSize(): void
    {
        $this->expectException(RessourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileSize' => false]))->uploadFile('container', 'name', 'type', 'data');
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidFileType(): void
    {
        $this->expectException(RessourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileType' => false]))->uploadFile('container', 'name', 'type', 'data');
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidFileName(): void
    {
        $this->expectException(RessourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileName' => false]))->uploadFile('container', 'name', 'type', 'data');
    }
}