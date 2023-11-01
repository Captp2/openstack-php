<?php

namespace OvhSwift\Tests\Domains\File;

use OvhSwift\Accessors\AccessorResponse;
use OvhSwift\Domains\AbstractDomain;
use OvhSwift\Domains\FileManager;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Tests\Mocks\API\Setters\FileSetterMock;
use OvhSwift\Tests\Mocks\SPI\FileUserMock;

class FileDeleteTest extends AbstractFileTester
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
    public function testICantDeleteAFileToAnUnknownContainer(): void
    {
        $containerName = self::$faker->text(50);
        $this->expectException(RessourceNotFoundException::class);
        $this->expectExceptionMessage("Container {$containerName} does not exists");
        $response = $this->getDomain(new FileUserMock(), null, new FileSetterMock([
            'deleteFileResponse' => new AccessorResponse([
                'success' => false,
                'errors' => [
                    '404' => "Container {$containerName} does not exists"
                ]
            ])
        ]))->deleteFile($containerName, self::$faker->text(25));
    }
}