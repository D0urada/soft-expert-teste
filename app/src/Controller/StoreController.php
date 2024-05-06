<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;
use App\Utils\MathOperations;
use \App\Repository\ProductsRepository;
use \App\Repository\TypesRepository;

class StoreController extends PageController
{
	private $productsRepository;

	private $typesRepository;

	private $mathOperations;

	public function __construct() 
	{
		parent::__construct();
		$this->productsRepository = new ProductsRepository();
		$this->mathOperations = new MathOperations();
		$this->typesRepository = new TypesRepository();
	}

	public function index() 
	{
		$content = $this->view->render('store', [
			'name' => 'store',
			'products' => $this->getProducts(),
			'cart' => $this->renderCart(),
			'products_add_modal' => $this->renderProductsModal()
		]);

		$title = 'Loja - Soft Expert Teste - Júlia Dourado';

		return $this->getPage($title, $content);

	}

	private function getProducts()
	{
		$results = $this->productsRepository->all();

		$result = null;



		foreach ($results as $key => $product) {
			$result .= $this->view->render('products', [
				'name' => $product->name,
				'value' => $product->value,
				'tax_value' => $product->tax_value,
				'img_url' => $product->img_url,
				'full_value' => $this->mathOperations->percentage($product->tax_value, $product->value) + intval($product->value),
				'type' => $this->getTypeNameById($product->type_id)
			]);
		} 

		return $result;
	}

	private function getTypeNameById($typeId)
	{
		return $this->typesRepository->getTypeNameById($typeId);
	}

	private function renderCart()
	{
		$result = $this->view->render('cart');

		return $result;
	}

	private function renderProductsModal()
	{
		$result = $this->view->render('products_add_modal');

		return $result;
	}
	
}
