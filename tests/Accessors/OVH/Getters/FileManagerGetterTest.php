<?php

namespace OvhSwift\Tests\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Accessors\OVH\Getters\FileGetter;
use OvhSwift\Domains\Authenticator;
use OvhSwift\Entities\File;
use OvhSwift\Tests\Accessors\AbstractAccessorTester;

class FileManagerGetterTest extends AbstractAccessorTester
{

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
        $file = $this->accessor->getFileByName(self::CONTAINER_NAME, self::FILE_NAME);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals(self::FILE_NAME, $file->name);
        $this->assertEquals($this->authentication->swiftUrl . "/" . self::CONTAINER_NAME . "/" . self::FILE_NAME, $file->path);
        $this->assertEquals(60692, $file->size);
        $this->assertEquals("image/jpeg", $file->mimeType);
    }
}