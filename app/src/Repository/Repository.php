<?php

declare(strict_types=1);

namespace App\Repository;

use App\Database\Connection;

abstract class Repository
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getInstance()->getPdo();
    }
}