<?php

namespace App\Repository;

use App\Model\Types;
use App\Utils\Debug;

class TypesRepository extends Repository
{
    private $table = Types::TABLE;

	public function all(): array
    {
        return $this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Types::class);
    }

	public function getTypeNameById(int $typeId)
	{
		$result = $this->connection->query(
			"SELECT name FROM {$this->table}
			WHERE id = {$typeId}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Types::class);

		return $result[0]->name;
	}

}