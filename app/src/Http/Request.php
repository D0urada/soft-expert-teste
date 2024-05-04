<?php

namespace App\Http;

use App\Utils\Debug;

class Request
{
	/**
	 * metodo http da requisição
	 * @var string
	 */
	private $httpMethod;

	/**
	 * uri da pagina
	 * @var string
	 */
	private $uri;

	/**
	 * parametros da url ($_GET)
	 * @var array
	 */
	private $queryParams = [];

	/**
	 * variaveis recebidas do post da pagina ($_post)
	 * @var array
	 */
	private $postVars = [];

	/**
	 * cabeçadlho da requisição
	 * @var array
	 */
	private $headers = [];

	public function __construct() 
	{
		$this->httpMethod 	= $_SERVER['REQUEST_METHOD'] ?? '';
		$this->uri 			= $_SERVER['REQUEST_URI'] ?? '';
		$this->queryParams 	= $_GET ?? [];
		$this->postVars 	= $_POST ?? [];
		$this->headers 		= getallheaders();
	}

	public function getHttpMethod()
	{
		return $this->httpMethod;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function getQueryParams()
	{
		return $this->queryParams;
	}

	public function getPostVars()
	{
		return $this->postVars;
	}

	public function getHeaders()
	{
		return $this->headers;
	}
}
