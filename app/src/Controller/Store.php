<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;

class Store extends Page
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function index() 
	{
		$content = $this->view->render('store', [
			'name' => 'store'
		]);

		$title = 'Loja';

		return $this->getPage($title, $content);

	}
	
}
