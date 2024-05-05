<?php

declare(strict_types=1);

namespace App\Model;

use App\Utils\Debug;

class Model
{
    public int $id;

    public string $name;

    public const TABLE = 'exemplo';

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}