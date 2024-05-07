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
				'tax' =>  24,
				'tax_value' =>  120,
				'end_value' =>  620,
				'type_id' => 1,
				'img_url' => 'https://source.unsplash.com/random/200x250?sig=incrementingIdentifier',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Product 2',
				'value' =>  525,
				'tax' =>  24,
				'tax_value' =>  126,
				'end_value' =>  651,
				'type_id' => 1,
				'img_url' => 'https://source.unsplash.com/random/200x250?sig=incrementingIdentifier',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Product 3',
				'value' =>  548,
				'tax' =>  55,
				'tax_value' =>  301.4,
				'end_value' =>  849.4,
				'type_id' => 2,
				'img_url' => 'https://source.unsplash.com/random/200x250?sig=incrementingIdentifier',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'name' => 'Product 4',
				'value' =>  592,
				'tax' =>  55,
				'tax_value' =>  325.6,
				'end_value' =>  917.6,
				'type_id' => 2,
				'img_url' => 'https://source.unsplash.com/random/200x250?sig=incrementingIdentifier',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			]
		];

		$posts = $this->table('products');
        $posts->insert($dataProducts)
              ->saveData();
    }
}
