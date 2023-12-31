<?php

namespace OvhSwift\Tests\Accessors\OVH\Setters\File;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Accessors\OVH\Getters\FileGetter;
use OvhSwift\Accessors\OVH\Setters\FileSetter;
use OvhSwift\Entities\File;
use OvhSwift\Interfaces\API\Setters\ISetFiles;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class FileDeleteTest extends AbstractAccessorTester
{
    protected string $accessorClass = FileSetter::class;

    const CONTAINER_NAME = 'swift-test-2';
    const FILE_NAME = 'Sidonie2.jpg';
    const FILE_PATH = __DIR__ . '/../../../../Utils/Sidonie2.jpg';
    const MIME_TYPE = 'image/jpeg';

    /**
     * @var ISetFiles
     */
    public AbstractAccessor $accessor;

    /**
     * @return void
     */
    public function testICanUploadAFile(): void
    {
        $response = ($this->accessor->uploadFile(
            self::CONTAINER_NAME,
            self::FILE_NAME,
            self::FILE_PATH
        ));

        $this->assertInstanceOf(AccessorResponse::class, $response);
        $this->assertTrue($response->success);

        $file = (new FileGetter(['authentication' => $this->authentication]))->getFileByName(self::CONTAINER_NAME, self::FILE_NAME);
        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(self::FILE_NAME, $file->name);
        $this->assertEquals($this->authentication->swiftUrl . "/" . self::CONTAINER_NAME . "/" . self::FILE_NAME, $file->path);
        $this->assertEquals(self::MIME_TYPE, $file->mimeType);
    }

    /**
     * @return void
     */
    public function testICanDeleteAFile(): void
    {
        $this->accessor->uploadFile(
            self::CONTAINER_NAME,
            self::FILE_NAME,
            self::FILE_PATH
        );

        $this->accessor->deleteFile(self::CONTAINER_NAME, self::FILE_NAME);
        $this->assertNull((new FileGetter(['authentication' => $this->authentication]))->getFileByName(
            self::CONTAINER_NAME,
            self::FILE_NAME)
        );
    }

    /**
     * @return void
     */
    public function testICantDeleteAFileFromUnknownContainer(): void
    {
        $response = $this->accessor->deleteFile(
            self::$faker->text(25),
            self::FILE_NAME,
        );

        $this->assertInstanceOf(AccessorResponse::class, $response);
        $this->assertFalse($response->success);
        $this->assertEquals(404, $response->code);
        $this->assertEquals("Resource not found", $response->message);
    }
}