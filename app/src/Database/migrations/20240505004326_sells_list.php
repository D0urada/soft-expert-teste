<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SellsList extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
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
