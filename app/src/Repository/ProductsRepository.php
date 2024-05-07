<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Products;
use App\Utils\Debug;

class ProductsRepository extends Repository
{
    private $table = Products::TABLE;

	private $model;

	public function __construct() {
		parent::__construct();

		$this->model = new Products;
	}

    public function all(): array
    {
        return $this->connection->query(
			"SELECT * FROM {$this->table}
			ORDER BY created DESC"
		)->fetchAll(\PDO::FETCH_CLASS, Products::class);
    }

	public function insert($product, $type)
    {
		try {
			$this->connection->beginTransaction();

			$stmt = $this->connection->prepare("INSERT INTO {$this->table} ({$this->model->columns}) VALUES(?,?,?,?,?,?,?,?,?)");
		
			$stmt->execute(array(
				$product['name'], 
				$product['price'], 
				$type->tax, 
				$product['values']['percentageValue'], 
				$product['values']['endValue'],
				$type->id, 
				$product['imgUrl'],
				date("Y-m-d H:i:s"),
				date("Y-m-d H:i:s")
			));
	
			$this->connection->commit();

			$stmt->fetch(\PDO::FETCH_ASSOC);

			return true;

		} catch (\Throwable $th) {
			$this->connection->rollBack();
			throw new Throwable("Error Processing Request", 1);
		}
    }
}