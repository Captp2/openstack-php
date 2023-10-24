<?php

namespace OvhSwift\Interfaces\API\Getters;

use OvhSwift\Entities\Authentication;
use OvhSwift\Entities\File;

interface IGetFiles
{
    public function getFileByName(Authentication $authentication, string $containerName, string $fileName): ?File;
}
