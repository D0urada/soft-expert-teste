<?php 

declare(strict_types=1);

namespace App\Model;

use App\Utils\Debug;

class Types
{
    public $id;

    public $name;

    public $tax;

    public $created;

    public $updated;

	public $columns = 'name, tax, created, updated';

    public const TABLE = 'types';

}