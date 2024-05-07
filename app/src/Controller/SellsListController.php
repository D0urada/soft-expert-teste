<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;
use \App\Repository\SellsListRepository;
use App\Http\Request;
use App\Http\Response;

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
			'sells' => $this->renderSells()
		]);

		$title = 'Lista de Vendas - Soft Expert Teste - Júlia Dourado';

		return $this->getPage($title, $content);

	}

	private function renderSells()
	{
		$results = $this->sellsListRepository->all();

		$result = null;

		foreach ($results as $key => $sell) {

			$result .= $this->view->render('sells', [
				'sell_name' =>  'Venda numero '.$sell->id,
				'sell_data' =>  $sell->created,
				'sell_table_products' =>  $this->renderSellsProductsTable(json_decode($sell->products_json)),
				'sell_table' =>  $this->renderSellsTable(json_decode($sell->sell_json))
			]);
		} 

		return $result;
	}

	private function renderSellsProductsTable($products_json)
	{
		$results = $products_json;

		$result = null;

		foreach ($results as $key => $productSell) {

			$productSellDecode = json_decode($productSell)[0];

			$result .= $this->view->render('sell_table_products', [
				'product_sell_name' => $productSellDecode->{'product_name'},
				'product_sell_value' => $productSellDecode->{'value'},
				'product_sell_tax' => $productSellDecode->{'tax'},
				'product_sell_tax_value' => $productSellDecode->{'tax_value'},
				'product_sell_end_value' => $productSellDecode->{'end_value'},
				'product_sell_type_name' => $productSellDecode->{'type_name'}
			]);
		} 

		return $result;
	}

	private function renderSellsTable($sells_json)
	{
		$results = $sells_json;

		$result = null;

		foreach ($results as $key => $sellDecoded) {

			$result .= $this->view->render('sell_table', [
				'sell_value' => $sellDecoded->sell_value,
				'sell_tax_value' => $sellDecoded->sell_tax_value,
				'sell_end_value' => $sellDecoded->sell_end_value
			]);
		} 

		return $result;
	}

		/**
	 * @param Request $request
	 */
	public function create($request)
	{
		try {
			$postVars = $request->getPostVars();

			if(!empty($postVars)) {

				$sell = [
					'sell_values' => [
						'sell_value' => 0,
						'sell_tax_value' => 0,
						'sell_end_value' => 0
					]
				];

				foreach ($postVars as $key => $product) {
					$product = json_decode($product)[0];
	
					$sell['sell_values']['sell_value'] 	 	=   intval(intval($sell['sell_values']['sell_value']) + intval($product->{'value'}));
					$sell['sell_values']['sell_tax_value']  =   intval($sell['sell_values']['sell_tax_value']) + intval($product->{'tax_value'});
					$sell['sell_values']['sell_end_value']  =   intval($sell['sell_values']['sell_end_value']) + intval($product->{'end_value'});
				}

				$this->sellsListRepository->insert($postVars, $sell);

				return new Response(200, 'Venda efetuada');
			} else {
				return new Response(400, 'Venda vazia');
			}

		  } catch (\Exception $error) {
			Debug::dd($error);
			return new Response($error->getCode(), $error->getMessage());
		  }
	}

}
