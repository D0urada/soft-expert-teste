<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\Debug;

class MathOperations
{
	public function percentage($percentage, $total)
	{
		if(is_string($percentage) || is_string($total)) {
			$percentage = intval($percentage);
			$total = intval($total);
		} 

		return ($percentage / 100) * $total;
	}
}
