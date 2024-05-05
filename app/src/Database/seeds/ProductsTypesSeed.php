<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class ProductsTypesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
		$dataTypes = [
			[
				'name' => 'Tipo 1',
				'tax' =>  24,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Tipo 2',
				'tax' =>  55,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			]
		];

		$posts = $this->table('types');
        $posts->insert($dataTypes)
              ->saveData();

		$dataProducts = [
			[
				'name' => 'Product 1',
				'value' =>  500,
				'tax_value' =>  24,
				'type_id' => 1,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Product 2',
				'value' =>  525,
				'tax_value' =>  24,
				'type_id' => 1,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Product 3',
				'value' =>  548,
				'tax_value' =>  55,
				'type_id' => 2,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Product 4',
				'value' =>  592,
				'tax_value' =>  55,
				'type_id' => 2,
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			]
		];

		$posts = $this->table('products');
        $posts->insert($dataProducts)
              ->saveData();
    }
}
