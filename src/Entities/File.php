<?php

namespace OvhSwift\Entities;

class File extends AbstractEntity
{
    public string $name;
    public string $path;
    public string $mimeType;
    public int $size;
    public $data;
}