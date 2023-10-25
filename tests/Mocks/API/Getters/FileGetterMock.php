<?php

namespace OvhSwift\Tests\Mocks\API\Getters;

use Faker\Factory;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\Authentication;
use OvhSwift\Entities\File;
use OvhSwift\Interfaces\API\Getters\IGetFiles;

class FileGetterMock extends AbstractAccessor implements IGetFiles
{
    const FILE_NAME = 'Sidonie.png';
    const FILE_PATH = 'tmp/Sidonie.png';
    const MIME_TYPE = 'image/png';

    private array $mockedFiles;

    public function __construct()
    {
        parent::__construct();

        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $this->mockedFiles[] = new File([
                'name' => $faker->name(),
                'path' => $faker->filePath(),
                'mimeType' => $faker->mimeType()
            ]);
        }

        $this->mockedFiles[] = new File([
            'name' => self::FILE_NAME,
            'path' => self::FILE_PATH,
            'mimeType' => self::MIME_TYPE
        ]);
    }

    /**
     * @param string $fileName
     * @return File|null
     */
    public function getFileByName(Authentication $authentication, $containerName, $fileName): ?File
    {
        foreach ($this->mockedFiles as $mockedFile) {
            if ($mockedFile->name === $fileName) {
                return $mockedFile;
            }
        }

        return null;
    }
}