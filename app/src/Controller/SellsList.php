<?php

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;

class SellsList extends Page
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function index() 
	{
		$content = $this->view->render('sells_list', [
			'name' => 'sells_list'
		]);

		$title = 'Lista de Vendas';

		return $this->getPage($title, $content);

	}
	
}
