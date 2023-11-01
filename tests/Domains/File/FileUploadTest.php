<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceValidationException;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

class FileUploadTest extends AbstractFileTester
{
    private File $file;

    /**
     * @var FileManager $domain
     */
    public AbstractDomain $domain;

    public function setUp(): void
    {
        $this->file = new File([
            'name' => self::$faker->name(),
            'path' => self::$faker->filePath(),
            'mimeType' => self::$faker->mimeType(),
            'size' => self::$faker->numberBetween(1, 255),
            'data' => self::$faker->name(),
        ]);
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidSize(): void
    {
        $this->expectException(RessourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileSize' => false]))->uploadFile('swift-test', $this->file);
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidFileType(): void
    {
        $this->expectException(RessourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileType' => false]))->uploadFile('swift-test', $this->file);
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidFileName(): void
    {
        $this->expectException(RessourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileName' => false]))->uploadFile('swift-test', $this->file);
    }
}