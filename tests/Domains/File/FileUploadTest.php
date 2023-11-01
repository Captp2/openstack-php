<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Exceptions\ResourceValidationException;
use OvhSwift\Tests\Mocks\API\Setters\FileSetterMock;
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
        $this->expectException(ResourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileSize' => false]))->uploadFile('swift-test', $this->file);
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidFileType(): void
    {
        $this->expectException(ResourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileType' => false]))->uploadFile('swift-test', $this->file);
    }

    /**
     * @return void
     */
    public function testICantUploadAFileWithInvalidFileName(): void
    {
        $this->expectException(ResourceValidationException::class);
        $this->getDomain(new FileUserMock(['validateFileName' => false]))->uploadFile('swift-test', $this->file);
    }

    /**
     * @return void
     */
    public function testICantUploadAFileToUnknownContainer(): void
    {
        $this->expectException(ResourceNotFoundException::class);
        $this->expectExceptionMessage("Resource not found");
        $this->getDomain(
            new FileUserMock(),
            null,
            new FileSetterMock([
                'deleteFileResponse' => new AccessorResponse([
                    'success' => false,
                    'errors' => [
                        '404' => "Resource not found"
                    ]
                ])
            ])
        )->uploadFile('test-123', $this->file);
    }
}