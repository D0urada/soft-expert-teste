<?php 

use App\Http\Response;
use App\Controller;

$router->get('/', [
	function(){
		return new Response(200, (new Controller\HomeController())->index());
	}
]);

$router->get('/sells-list', [
	function(){
		return new Response(200, (new Controller\SellsListController())->index());
	}
]);

$router->get('/store', [
	function(){
		return new Response(200, (new Controller\StoreController())->index());
	}
]);

$router->post('/productcts/create', [
	function($request){
		return new Response(200, (new Controller\ProductsController())->create($request));
	}
]);
