<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class SellsListSeed extends AbstractSeed
{
    public function run(): void
    {
		$data = [
			[
				'products_json' =>  '{"sell_product_0":"[{\"product_name\":\"Product 1\",\"value\":\"500\",\"tax\":\"24\",\"tax_value\":\"120\",\"end_value\":\"620\",\"type_name\":\"Tipo 1\",\"type_id\":\"1\"}]","sell_product_1":"[{\"product_name\":\"Product 2\",\"value\":\"525\",\"tax\":\"24\",\"tax_value\":\"126\",\"end_value\":\"651\",\"type_name\":\"Tipo 1\",\"type_id\":\"1\"}]","sell_product_2":"[{\"product_name\":\"Product 3\",\"value\":\"548\",\"tax\":\"55\",\"tax_value\":\"301.4\",\"end_value\":\"849.4\",\"type_name\":\"Tipo 2\",\"type_id\":\"2\"}]"}',
				'sell_json' =>  '{"sell_values":{"sell_value":1573,"sell_tax_value":547,"sell_end_value":2120}}',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'products_json' =>  '{"sell_product_0":"[{\"product_name\":\"Product 4\",\"value\":\"592\",\"tax\":\"55\",\"tax_value\":\"325.6\",\"end_value\":\"917.6\",\"type_name\":\"Tipo 2\",\"type_id\":\"2\"}]","sell_product_1":"[{\"product_name\":\"Product 3\",\"value\":\"548\",\"tax\":\"55\",\"tax_value\":\"301.4\",\"end_value\":\"849.4\",\"type_name\":\"Tipo 2\",\"type_id\":\"2\"}]"}',
				'sell_json' =>  '{"sell_values":{"sell_value":1140,"sell_tax_value":626,"sell_end_value":1766}}',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'products_json' =>  '{"sell_product_0":"[{\"product_name\":\"Product 1\",\"value\":\"500\",\"tax\":\"24\",\"tax_value\":\"120\",\"end_value\":\"620\",\"type_name\":\"Tipo 1\",\"type_id\":\"1\"}]","sell_product_1":"[{\"product_name\":\"Product 2\",\"value\":\"525\",\"tax\":\"24\",\"tax_value\":\"126\",\"end_value\":\"651\",\"type_name\":\"Tipo 1\",\"type_id\":\"1\"}]"}',
				'sell_json' =>  '{"sell_values":{"sell_value":1025,"sell_tax_value":246,"sell_end_value":1271}}',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			],
			[
				'products_json' =>  '{"sell_product_0":"[{\"product_name\":\"Product 1\",\"value\":\"500\",\"tax\":\"24\",\"tax_value\":\"120\",\"end_value\":\"620\",\"type_name\":\"Tipo 1\",\"type_id\":\"1\"}]","sell_product_1":"[{\"product_name\":\"Product 2\",\"value\":\"525\",\"tax\":\"24\",\"tax_value\":\"126\",\"end_value\":\"651\",\"type_name\":\"Tipo 1\",\"type_id\":\"1\"}]","sell_product_2":"[{\"product_name\":\"Product 3\",\"value\":\"548\",\"tax\":\"55\",\"tax_value\":\"301.4\",\"end_value\":\"849.4\",\"type_name\":\"Tipo 2\",\"type_id\":\"2\"}]","sell_product_3":"[{\"product_name\":\"Product 4\",\"value\":\"592\",\"tax\":\"55\",\"tax_value\":\"325.6\",\"end_value\":\"917.6\",\"type_name\":\"Tipo 2\",\"type_id\":\"2\"}]"}',
				'sell_json' =>  '{"sell_values":{"sell_value":2165,"sell_tax_value":872,"sell_end_value":3037}}',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			]
		];

		$posts = $this->table('sells_list');
        $posts->insert($data)
              ->saveData();
    }
}
