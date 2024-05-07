<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SellsList extends AbstractMigration
{
	public function up(): void
    {
		$table = $this->table('sells_list');

		$table
			->addColumn('sell_json', 'string', ['limit' => 10000])
			->addColumn('created', 'datetime')
			->addColumn('updated', 'datetime', ['null' => true])
			->create();
    }

	
	public function down(): void
    {
		$this->table('sells_list')->drop()->save();
    }
}
