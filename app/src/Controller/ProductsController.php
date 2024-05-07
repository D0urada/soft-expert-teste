<?php

declare(strict_types=1);

namespace App\Controller;

use App\Utils\View;
use App\Utils\Debug;
use App\Utils\MathOperations;
use \App\Repository\ProductsRepository;
use \App\Repository\TypesRepository;
use App\Http\Request;
use App\Http\Response;

class ProductsController extends PageController
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

	/**
	 * @param Request $request
	 */
	public function create($request)
	{
		try {
			$postVars = $request->getPostVars();

			// tratamento para url, ja que não é obrigatoria
			if(empty($postVars['imgUrl'])) {
				$postVars['imgUrl'] = "https://source.unsplash.com/random/200x250?sig=incrementingIdentifier";
			} 

			// detecta se precisa cadastrar um novo tipo 
			if(!isset($postVars['type-select'])) {
				$type = $this->typesRepository->insert($postVars);
			} else {
				$type = $this->typesRepository->getTypeAllById($postVars['type-select']);
			}

			// cadastra o produto
			if(isset($type)) {
				$postVars['values'] = $this->mathOperations->taxCalc($postVars['price'], $type->tax);

				$this->productsRepository->insert($postVars, $type);

				return new Response(200, 'produto Cadastrado'); 
			} else {
				return new Response(400, 'Esse tipo não é valido');
			}	  

		  } catch (\Exception $error) {
			Debug::dd($error);
			return new Response($error->getCode(), $error->getMessage());
		  }
	}
}
