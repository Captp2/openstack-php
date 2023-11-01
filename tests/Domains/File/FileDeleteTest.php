<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\ResourceNotFoundException;
use OvhSwift\Tests\Mocks\API\Setters\FileSetterMock;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

class FileDeleteTest extends AbstractFileTester
{
    /**
     * @var FileManager $domain
     */
    public AbstractDomain $domain;

    /**
     * @return void
     */
    public function testICantDeleteAFileToAnUnknownContainer(): void
    {
        $containerName = self::$faker->text(50);
        $this->expectException(ResourceNotFoundException::class);
        $this->expectExceptionMessage("Resource not found");
        $this->getDomain(new FileUserMock(), null, new FileSetterMock([
            'deleteFileResponse' => new AccessorResponse([
                'success' => false,
                'errors' => [
                    '404' => "Resource not found"
                ]
            ])
        ]))->deleteFile($containerName, self::$faker->text(25));
    }
}