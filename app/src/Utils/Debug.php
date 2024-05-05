<?php

declare(strict_types=1);

namespace App\Utils;

class Debug
{
	/**
	 * debug
	 */
	public static function debug($debug = [])
	{
		echo "<pre>";
		print_r($debug);
		echo "</pre>";
		exit;
	}
}
