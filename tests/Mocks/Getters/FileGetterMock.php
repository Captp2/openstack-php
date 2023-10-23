<?php

namespace OvhSwift\Tests\Mocks\Getters;

use Faker\Factory;
use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Interfaces\Getters\IGetFiles;

class FileGetterMock extends AbstractAccessor implements IGetFiles
{
    const FILE_ID = 1;
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
                'id' => $faker->randomNumber(),
                'fileName' => $faker->name(),
                'filePath' => $faker->filePath(),
                'mimeType' => $faker->mimeType()
            ]);
        }

        $this->mockedFiles[] = new File([
            'id' => self::FILE_ID,
            'fileName' => self::FILE_NAME,
            'filePath' => self::FILE_PATH,
            'mimeType' => self::MIME_TYPE
        ]);
    }

    /**
     * @param string $fileName
     * @return File|null
     */
    public function getFileByName(string $fileName): ?File
    {
        foreach ($this->mockedFiles as $mockedFile) {
            if ($mockedFile->fileName === $fileName) {
                return $mockedFile;
            }
        }

        return null;
    }
}