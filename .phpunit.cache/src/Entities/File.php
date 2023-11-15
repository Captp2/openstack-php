<?php

namespace OvhSwift\Entities;

class File extends AbstractEntity
{
    const MAX_NAME_SIZE = 256;

    public string $name;
    public string $path;
    public string $mimeType;
    public int $size;
    public $data;
}
