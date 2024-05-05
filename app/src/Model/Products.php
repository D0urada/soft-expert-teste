<?php 

declare(strict_types=1);

namespace App\Model;

use App\Utils\Debug;

class Products
{
    public $id;

    public $name;

    public $value;

    public $tax_value;

    public $type_id;

    public $img_url;

    public $created;

    public $updated;

    public const TABLE = 'products';
}