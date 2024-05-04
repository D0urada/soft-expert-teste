<?php

namespace App\Http;

use App\Utils\Debug;

use \Closure;
use \Exception;

class Router
{
	/**
	 * raiz do projeto 
	 * @var string
	 */
	private $url = '';

	/**
	 * prefixo de todas as rotas
	 * @var string
	 */
	private $prefix = '';

	/**
	 * guarda todas as rotas
	 * @var array
	 */
	private $routes = [];

	/**
	 * instancia de requests
	 * @var Request
	 */
	private $request;

	public function __construct() {
		$this->request = new Request();
		$this->url = 'teste';
		$this->setPrefix();
	}

	private function setPrefix()
	{
		$parseUrl = parse_url($this->url);

		$this->prefix = $parseUrl['path'] ?? '';

	}

	private function addRoute($metods, $route, $params)
	{	
		foreach ($params as $key => $value) {
			if($value instanceof Closure){
				$params['controller'] = $value;
				unset($params[$key]);
				continue;
			}
		}

		// Fatal error: Uncaught ArgumentCountError: Too few arguments to function {closure}(), 0 passed and exactly 1 expected in /var/www/html/routers/pages.php:7 Stack trace: #0 [internal function]: {closure}() #1 /var/www/html/src/Http/Router.php(136): call_user_func_array(Object(Closure), Array) #2 /var/www/html/public/index.php(18): App\Http\Router->run() #3 {main} thrown in /var/www/html/routers/pages.php on line 7

		$params['variables'] = [];

		$patternVariable = '/{(.*?)}/';

		if(preg_match_all($patternVariable, $route, $matches)) {
			$route = preg_replace($patternVariable,  '(.*?)', $route);
			$params['variables'] = $matches[1];
		}

		$patternRoute = '/^'.str_replace('/', '\/', $route).'$/';

		$this->routes[$patternRoute][$metods] = $params;
	}

	public function get($route, $params = [])
	{		

		$this->addRoute('GET', $route, $params);
	}

	public function post($route, $params = [])
	{
		$this->addRoute('POST', $route, $params);
	}

	public function put($route, $params = [])
	{
		$this->addRoute('PUT', $route, $params);
	}

	public function delete($route, $params = [])
	{
		$this->addRoute('DELETE', $route, $params);
	}

	private function getUri()
	{
		$uri = $this->request->getUri();

		$xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

		return end($xUri);
	}

	private function getRoute()
	{
		$uri = $this->getUri();

		$httpMethod = $this->request->getHttpMethod();

		foreach ($this->routes as $patternRoute => $methods) {
			if(preg_match($patternRoute,$uri,$matches)){
				if($methods[$httpMethod]){
					return $methods[$httpMethod];
				}
			} else {
				continue;
			}

			throw new Exception('methodo não permitido', 405);
		}

		throw new Exception('url não encontrada', 404);
	}

	public function run()
	{
		try {
			$route = $this->getRoute();

			if(!isset($route['controller'])) {
				throw new Exception('urla não pode ser processada', 500);
			}

			$args = [];

			return call_user_func_array($route['controller'], $args);

		} catch (Exception $e) {
			return new Response($e->getCode(), $e->getMessage());
		}
	}
}
