<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;

class Page
{
	public $view;

	public $debug;

	public function __construct() 
	{
		$this->view = new View();
		$this->debug = new Debug();
	}

	/**
	 * retorna o conteudo da pagina
	 */
	public function getPage($title = null, $content = null) 
	{
		return $this->view->render('page', [
			'title' => $title,
			'header' => $this->getHeader(),
			'footer' => $this->getFooter(),
			'content' => $content
		]);

	}

	private function getHeader()
	{
		return $this->view->render('header');
	}

	private function getFooter()
	{
		return $this->view->render('footer');
	}
}
