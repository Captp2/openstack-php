<?php

namespace OvhSwift\Tests\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\FileGetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\File;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class FileManagerGetterTest extends AbstractAccessorTester
{
    const CONTAINER_NAME = 'swift-test';
    const FILE_NAME = 'Sidonie.jpg';
    const FILE_SIZE = 60692;

    protected string $accessorClass = FileGetter::class;

    /**
     * @var FileGetter
     */
    public AbstractAccessor $accessor;

    /**
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \OvhSwift\Exceptions\InvalidConfigException
     */
    public function testICanFindAFileByName(): void
    {
        $authentication = (new Authenticator())->login();

        $file = $this->accessor->getFileByName($authentication, self::CONTAINER_NAME, self::FILE_NAME);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(self::FILE_NAME, $file->fileName);
        $this->assertEquals($authentication->swiftUrl . "/" . self::CONTAINER_NAME . "/" . self::FILE_NAME, $file->filePath);
        $this->assertEquals(60692, $file->size);
        $this->assertEquals("image/jpeg", $file->mimeType);
    }
}