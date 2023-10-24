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

    public function testICanFindAFileByName()
    {
        $authentication = (new Authenticator())->login();

        $file = $this->accessor->getFileByName($authentication, 'swift-test', 'Sidonie.jpg');

        ray($file);

        $this->assertInstanceOf(File::class, $file);
        $this->assertEquals('Sidonie.jpg', $file->fileName);
    }
}