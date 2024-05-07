<?php 

declare(strict_types=1);

namespace App\Model;

use App\Utils\Debug;

class SellsList
{
    public $id;

    public $products_json;

    public $sell_json;

	public $created;

    public $updated;

    public const TABLE = 'sells_list';

	public $columns = 'products_json, sell_json, created, updated';
}