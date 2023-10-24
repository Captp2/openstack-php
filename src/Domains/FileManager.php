<?php

namespace OvhSwift\Domains;

use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Interfaces\API\Getters\IGetFiles;
use OvhSwift\Interfaces\API\Setters\ISetFiles;

class FileManager extends AbstractDomain
{
    /**
     * @param string $fileName
     * @return mixed
     * @throws RessourceNotFoundException
     */
    public function findByName(string $containerName, string $fileName): File
    {
        if (!$file = $this->getter->getFileByName($this->authentication, $containerName, $fileName)) {
            throw new RessourceNotFoundException("File {$fileName} not found in {$containerName}");
        }

        return $file;
    }

    public function uploadFile(string $containerName, string $fileName, $fileData): void
    {

    }

    /**
     * @return string
     */
    protected function getterInterface(): string
    {
        return IGetFiles::class;
    }

    /**
     * @return string
     */
    protected function setterInterface(): string
    {
        return ISetFiles::class;
    }
}