<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;

class Home extends Page
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function index() 
	{
		$content = $this->view->render('home', [
			'name' => 'home'
		]);

		$title = 'Home Page';

		return $this->getPage($title, $content);

	}
	
}
