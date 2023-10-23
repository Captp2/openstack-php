<?php

namespace OvhSwift\Entities;

use DateTime;

class Container extends AbstractEntity
{
    public string $id;
    public string $itemCount;
    public string $size;
    public DateTime $lastModified;
}