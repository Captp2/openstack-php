<?php

namespace OvhSwift\Accessors\OVH\Getters;

use OvhSwift\Accessors\AbstractAccessor;
use OvhSwift\Entities\File;
use OvhSwift\Interfaces\Getters\IGetFiles;

class FileGetter extends AbstractAccessor implements IGetFiles
{
    public function getFileByName(string $fileName): ?File
    {
        // TODO: Implement getFileByName() method.
    }
}