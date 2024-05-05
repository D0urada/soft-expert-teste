<?php

namespace App\Repository;

use App\Model\Products;
use App\Utils\Debug;

class ProductsRepository extends Repository
{
    private $table = Products::TABLE;

    public function all(): array
    {
        return $this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Products::class);
    }

	public function insert($values): array
    {
		Debug::dd($values);

        // return $this->connection->query(
		// 	INSERT INTO {$this->table} ()
		// 	VALUES (value1, value2, value3, ...)
		// 	"SELECT * FROM {$this->table}"
		// )->fetchAll(\PDO::FETCH_CLASS, Products::class);
    }
}