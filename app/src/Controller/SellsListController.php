<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;
use \App\Repository\SellsListRepository;

class SellsListController extends PageController
{
	private $sellsListRepository;

	public function __construct() 
	{
		parent::__construct();
		$this->sellsListRepository = new SellsListRepository();
	}

	public function index() 
	{
		$content = $this->view->render('sells_list', [
			'name' => 'sells_list',
			'sells' => $this->getSells(),
			'cart' => $this->renderCart()
		]);

		$title = 'Lista de Vendas - Soft Expert Teste - Júlia Dourado';

		return $this->getPage($title, $content);

	}

	private function getSells()
	{
		$sells = 'teste';

		$results = $this->sellsListRepository->all();

		$result = null;

		foreach ($results as $key => $sell) {
			$result .= $this->view->render('sells', [
				'sell_json' => $sell->sell_json
			]);
		} 

		return $result;
	}

	private function renderCart()
	{
		$result = $this->view->render('cart');

		return $result;
	}
}
