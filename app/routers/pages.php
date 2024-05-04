<?php 

use App\Http\Response;
use App\Controller;

$router->get('/', [
	function(){
		return new Response(200, (new Controller\Home())->index());
	}
]);

$router->get('/sobre', [
	function(){
		return new Response(200, 'teste');
	}
]);

$router->get('/sells_list', [
	function(){
		return new Response(200, (new Controller\SellsList())->index());
	}
]);

$router->get('/store', [
	function(){
		return new Response(200, (new Controller\Store())->index());
	}
]);

$router->get('/pagina/{idPagina}/{acao}', [
	function($idPagina, $acao){
		return new Response(200, 'Pagina'.$idPagina.' - '.$acao);
	}
]);