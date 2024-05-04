<?php 

use App\Http\Response;
use App\Controller;

$router->get('/pagina/{idPagina}', [
	function($idPagina){
		return new Response(200, 'Pagina'.$idPagina);
	}
]);

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

$router->get('/pagina/{idPagina}/{acao}', [
	function($idPagina, $acao){
		return new Response(200, 'Pagina'.$idPagina.' - '.$acao);
	}
]);