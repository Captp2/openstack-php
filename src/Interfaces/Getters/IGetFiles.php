<?php

namespace OvhSwift\Interfaces\Getters;

use OvhSwift\Entities\File;

interface IGetFiles
{
    public function getFileByName(string $fileName): ?File;
}
