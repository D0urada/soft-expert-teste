<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Products extends AbstractMigration
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
		$table = $this->table('products');

		$table
			->addColumn('name', 'string', ['limit' => 100])
			->addColumn('value', 'decimal')
			->addColumn('tax_value', 'decimal')
			->addColumn('type_id', 'integer')->addForeignKey('type_id', 'types', 'id', array('delete'=> 'CASCADE', 'update'=> 'CASCADE'))
			->addColumn('img_url', 'string', ['limit' => 100])
			->addColumn('created', 'datetime')
			->addColumn('updated', 'datetime', ['null' => true])
			->create();
    }

	
	public function down(): void
    {
		$this->table('products')->drop()->save();
    }
}
