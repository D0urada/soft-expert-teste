<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;
    private PDO $pdo;
    private string $charset = 'utf8mb4';

    private const OPTIONS = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    private function __construct()
    {
        $dsn = "pgsql:host={$_ENV['POSTGRES_HOST']};dbname={$_ENV['POSTGRES_DB']};port={$_ENV['POSTGRES_PORT']}";

        try {
            $this->pdo = new PDO($dsn, $_ENV['POSTGRES_USER'], $_ENV['POSTGRES_PASSWORD'], self::OPTIONS);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), (int) $exception->getCode());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}