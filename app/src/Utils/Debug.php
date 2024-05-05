<?php

declare(strict_types=1);

namespace App\Utils;

class Debug
{
	/**
	 * print
	 */
	public static function print($debug = [])
	{
		echo "<pre>";
		print_r($debug);
		echo "</pre>";
		exit;
	}

	/**
	 * dd
	 */
	public static function dd($debug = [])
	{
		echo "<pre>";
		var_dump($debug);
		echo "</pre>";
		die;
	}
}
