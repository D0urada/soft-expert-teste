<?php

namespace App\Utils;

use App\Utils\Debug;

class View
{
	const PATH = '/var/www/html/src/Views/';

	const TYPE = '.html';

	/**
	 * @var array
	 */
	private static $vars = [];

	/**
	 * Metodo responsavel por definir os dados iniciais da classe
	 * @param array $vars
	 */
	public static function init($vars =[])
	{
		self::$vars = $vars;
	}

	/**
	 * Metodo responsavel por retornar o conteudo de uma view
	 * @param string $view
	 * @return string
	 */
	private function getContentView($view) : string
	{
		$file = self::PATH.$view.self::TYPE;

		return file_exists($file) ? file_get_contents($file) : 'Arquivo não existe.';
	}

	/**
	 * Metodo responsavel por retornar o conteudo de uma renderizado view
	 * @param string $view
	 * @param array $vars (string/numeric)
	 * @return string
	 */
	public function render($view, $vars = []) : string
	{
		$contentView = $this->getContentView($view);

		$vars = array_merge(self::$vars, $vars);

		$keys = array_keys($vars);
		$keys = array_map(function($item){
			return '{{'.$item.'}}';
		},$keys);

		return str_replace($keys,array_values($vars),$contentView);
	}

	/**
	 * chave do array e variaveis
	 * @param string $view
	 * @param array $vars (string/numeric)
	 * @return string
	 */
	public function keys($vars = []) : array
	{
		$keys = array_keys($vars);
		$keys = array_map(function($item){
			return '{{'.$item.'}}';
		}, $keys);
		
		return $keys;
	}
	
}

