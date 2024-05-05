<?php 

use App\Http\Response;
use App\Controller;

$router->get('/', [
	function(){
		return new Response(200, (new Controller\HomeController())->index());
	}
]);

$router->get('/sobre', [
	function(){
		return new Response(200, 'teste');
	}
]);

$router->get('/sells_list', [
	function(){
		return new Response(200, (new Controller\SellsListController())->index());
	}
]);

$router->get('/store', [
	function(){
		return new Response(200, (new Controller\StoreController())->index());
	}
]);

$router->get('/pagina/{idPagina}/{acao}', [
	function($idPagina, $acao){
		return new Response(200, 'Pagina'.$idPagina.' - '.$acao);
	}
]);

$router->post('/depoimentos', [
	function($request){
		return new Response(200, (new Controller\StoreController())->index());
	}
]);