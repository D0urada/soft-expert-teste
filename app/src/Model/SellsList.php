<?php 

declare(strict_types=1);

namespace App\Model;

use App\Utils\Debug;

class SellsList
{
    public $id;

    public $sell_json;

	public $created;

    public $updated;

    public const TABLE = 'sells_list';
}