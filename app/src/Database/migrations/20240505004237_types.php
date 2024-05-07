<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Types extends AbstractMigration
{
	public function up(): void
    {
		$table = $this->table('types');

		$table
			->addColumn('name', 'string', ['limit' => 100])
			->addColumn('tax', 'decimal')
			->addColumn('created', 'datetime')
			->addColumn('updated', 'datetime', ['null' => true])
			->create();
    }

	
	public function down(): void
    {
		$this->table('types')->drop()->save();
    }
}
