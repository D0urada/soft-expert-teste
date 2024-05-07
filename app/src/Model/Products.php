<?php 

declare(strict_types=1);

namespace App\Model;

use App\Utils\Debug;

class Products
{
    public $id;

    public $name;

    public $value;

    public $tax;

    public $tax_value;

    public $end_value;

    public $type_id;

    public $img_url;

    public $created;

    public $updated;

	public $columns = 'name, value, tax, tax_value, end_value, type_id, img_url, created, updated';

    public const TABLE = 'products';
}