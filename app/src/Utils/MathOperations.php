<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\Debug;

class MathOperations
{
	public function percentage($percentage, $value)
	{
		if(is_string($percentage) || is_string($value)) {
			$percentage = intval($percentage);
			$value = intval($value);
		} 

		return ($percentage / 100) * $value;
	}

	public function taxCalc($value, $percentage)
	{
		$values = [];

		$values['percentageValue'] = $this->percentage($percentage, $value);
		
		$values['endValue'] = $values['percentageValue'] + intval($value);

		return $values;
	}
}
