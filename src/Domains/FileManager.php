<?php

namespace OvhSwift\Domains;

use OvhSwift\Entities\File;
use OvhSwift\Exceptions\RessourceNotFoundException;
use OvhSwift\Interfaces\Getters\IGetFiles;
use OvhSwift\Interfaces\Setters\ISetFiles;

class FileManager extends AbstractDomain
{
    /**
     * @param string $fileName
     * @return mixed
     * @throws RessourceNotFoundException
     */
    public function findByName(string $fileName): File
    {
        if(!$file = $this->getter->getFileByName($fileName)) {
            throw new RessourceNotFoundException("File {$fileName} not found");
        }

        return $file;
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