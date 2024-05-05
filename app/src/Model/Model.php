<?php

declare(strict_types=1);

namespace App\Model;

class Model
{
    private int $id;

    private string $name;

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