<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Products extends AbstractMigration
{
	public function up(): void
    {
		$table = $this->table('products');

		$table
			->addColumn('name', 'string', ['limit' => 100])
			->addColumn('value', 'decimal')
			->addColumn('tax', 'decimal')
			->addColumn('tax_value', 'decimal')
			->addColumn('end_value', 'decimal')
			/**
			 * Coloquei o valor do imposto, a porcentagem e o valor final no produto, para evitar calculos depois na hora da venda e evitar que a informação se perda
			 * o id do tipo é para validação se o id existe e garantir que um produto sempre tenha um tipo, do que para fazer calculos
			 */
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
