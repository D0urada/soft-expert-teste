<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class SellsListSeed extends AbstractSeed
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
		$data = [
			[
				'sell_json' =>  '{aaaaaaaaaaaaaaaaaaaaaa}',
				'created' => date('Y-m-d H:i:s'),
				'updated' => date('Y-m-d H:i:s')
			]
		];

		$posts = $this->table('sells_list');
        $posts->insert($data)
              ->saveData();
    }
}