<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\SellsList;
use App\Utils\Debug;

class SellsListRepository extends Repository
{
    private $table = SellsList::TABLE;

    public function all()
    {
        return $this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, SellsList::class);
    }

	public function teste()
    {
        return '$this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, SellsList::class)';
    }
}