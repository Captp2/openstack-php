<?php

namespace OvhSwift\Domains;

use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Exceptions\RessourceValidationException;
use OvhSwift\Interfaces\API\Getters\IGetFiles;
use OvhSwift\Interfaces\API\Setters\ISetFiles;
use OvhSwift\Interfaces\SPI\IUseFiles;

class FileManager extends AbstractDomain
{
    /**
     * @var IUseFiles $spiAdapter
     */
    protected object $spiAdapter;

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

    /**
     * @param string $containerName
     * @param string $fileName
     * @param $fileData
     * @return void
     * @throws RessourceValidationException
     */
    public function uploadFile(string $containerName, string $fileName, string $fileType, $fileData): void
    {
        if(!$this->spiAdapter->validateFileName($fileName)) {
            throw new RessourceValidationException("Filename {$fileName} is invalid");
        }
        if(!$this->spiAdapter->validateFileType($fileType)) {
            throw new RessourceValidationException("Filetype {$fileType} is invalid");
        }
        if(!$this->spiAdapter->validateFileSize($this->getFileSize($fileData))) {
            throw new RessourceValidationException("Filesize is invalid");
        }
    }

    /**
     * @param $fileData
     * @return int
     *
     * @TODO find a way to do this shit
     */
    public function getFileSize($fileData)
    {
        return 123;
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