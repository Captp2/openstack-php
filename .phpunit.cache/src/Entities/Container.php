<?php

namespace OvhSwift\Entities;

use DateTime;

class Container extends AbstractEntity
{
    public string $name;
    public string $itemCount;
    public string $size;
    public DateTime $lastModified;
}