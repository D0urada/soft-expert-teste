<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\SellsList;
use App\Utils\Debug;

class SellsListRepository extends Repository
{
    private $table = SellsList::TABLE;

	private $model;

	public function __construct() {
		parent::__construct();

		$this->model = new SellsList;
	}

    public function all()
    {
        return $this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, SellsList::class);
    }

	public function insert($productList, $sell)
    {
		try {
			$this->connection->beginTransaction();

			$stmt = $this->connection->prepare("INSERT INTO {$this->table} ({$this->model->columns}) VALUES(?,?,?,?) RETURNING id");
		

			$stmt->execute(array(
				json_encode($productList), 
				json_encode($sell), 
				date("Y-m-d H:i:s"),
				date("Y-m-d H:i:s")
			));
	
			$this->connection->commit();
	
			$ultimo_id = $stmt->fetch(\PDO::FETCH_ASSOC);

		} catch (\Throwable $th) {
			$this->connection->rollBack();
			throw new Throwable("Error Processing Request", 1);
		}
    }
}
