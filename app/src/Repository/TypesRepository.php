<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Types;
use App\Utils\Debug;

class TypesRepository extends Repository
{
    private $table = Types::TABLE;

	private $model;

	public function __construct() {
		parent::__construct();

		$this->model = new Types;
	}

	public function all()
    {
		$result = $this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Types::class);

        return $result;
    }

	public function getTypeNameById($typeId)
	{
		$result = $this->connection->query(
			"SELECT name FROM {$this->table}
			WHERE id = {$typeId}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Types::class);

		return $result[0]->name;
	}

	public function getTypeAllById($typeId)
	{
		$result = $this->connection->query(
			"SELECT * FROM {$this->table}
			WHERE id = {$typeId}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Types::class);

		if($result == NULL) {
			return NULL;
		} else {
			return $result[0];
		}
	}

	public function insert($type)
    {
		try {
			$this->connection->beginTransaction();

			$stmt = $this->connection->prepare("INSERT INTO {$this->table} ({$this->model->columns}) VALUES(?,?,?,?) RETURNING id ");
		
			$stmt->execute(array(
				$type['type-name'], 
				$type['type-tax'],
				date("Y-m-d H:i:s"),
				date("Y-m-d H:i:s")
			));
	
			$this->connection->commit();
	
			$ultimo_id = $stmt->fetch(\PDO::FETCH_ASSOC);
	
			return $this->getTypeAllById($ultimo_id['id']);

		} catch (\Throwable $th) {
			$this->connection->rollBack();
			throw new Throwable("Error Processing Request", 1);
		}
    }
}