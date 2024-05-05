<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;


class HomeController extends PageController
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function index() 
	{
		$content = $this->view->render('home');

		$title = 'Home - Soft Expert Teste - Júlia Dourado';

		return $this->getPage($title, $content);

	}
	
}
