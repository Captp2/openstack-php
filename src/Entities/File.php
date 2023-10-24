<?php

namespace OvhSwift\Entities;

class File extends AbstractEntity
{
    public string $fileName;
    public string $filePath;
    public string $mimeType;
    public int $size;
}