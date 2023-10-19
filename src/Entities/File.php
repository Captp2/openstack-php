<?php

namespace OvhSwift\Entities;

class File extends AbstractEntity
{
    public int $id;
    public string $fileName;
    public string $filePath;
    public string $mimeType;
}