<?php

namespace OvhSwift\Domains;

use OvhSwift\Interfaces\Getters\IGetFiles;
use OvhSwift\Interfaces\Setters\ISetFiles;

class FileManager extends AbstractDomain
{
    public function findByName(string $fileName)
    {
        return $this->getter->getFileByName($fileName);
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