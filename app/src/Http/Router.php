<?php

declare(strict_types=1);

namespace App\Http;

use Closure;
use Exception;
use ReflectionFunction;
use App\Utils\Debug;

class Router
{
  /**
   * URL completa do projeto 
   *
   * @var string
   */
  private $url = '';

  /**
   * Prefixo de todas as rotas
   *
   * @var string
   */
  private $prefix = '';

  /**
   * Índice de rotas
   *
   * @var array
   */
  private $routes = [];

  /**
   * Instância (objeto) da classe Request
   *
   * @var Request
   */
  private $request;

  public function __construct($url)
  {
    $this->url = $url;
    $this->request = new Request($this);
    self::setPrefix();
  }


  /**
   * Definir prefixo das rotas
   *
   * @return void
   */
  private function setPrefix()
  {
    $parseUrl = parse_url($this->url);

    $this->prefix = $parseUrl['path'] ?? '';
  }

  /**
   * Adicionar rota
   *
   * @param  string $method
   * @param  string $route
   * @param  array $params
   * @return void
   */
  private function addRoute($method, $route, $params = [])
  {
	foreach ($params as $key => $value) {
		if ($value instanceof Closure) {
		$params['controller'] = $value;
		unset($params[$key]);
		}
	}

	$params['middlewares'] = $params['middlewares'] ?? [];

	$params['variables'] = [];

	$varPattern = '/{(.*?)}/';
	if (preg_match_all($varPattern, $route, $matches)) {
		$route = preg_replace($varPattern, '(.*?)', $route);
		$params['variables'] = $matches[1];
	}

	$routePattern = '/^' . str_replace('/', '\/', $route) . '\/?$/';

	$this->routes[$routePattern][$method] = $params;
  }

  /**
   * Definir uma rota de GET
   *
   * @param  string $route
   * @param  array $params
   * @return void
   */
  public function get($route, $params = [])
  {
    $this->addRoute('GET', $route, $params);
  }

  /**
   * Definir uma rota de POST
   *
   * @param  string $route
   * @param  array $params
   * @return void
   */
  public function post($route, $params = [])
  {
    $this->addRoute('POST', $route, $params);
  }

  /**
   * Definir uma rota de PUT
   *
   * @param  string $route
   * @param  array $params
   * @return void
   */
  public function put($route, $params = [])
  {
    return $this->addRoute('PUT', $route, $params);
  }

  /**
   * Definir uma rota de DELETE
   *
   * @param  string $route
   * @param  array $params
   * @return void
   */
  public function delete($route, $params = [])
  {
    return $this->addRoute('DELETE', $route, $params);
  }


  /**
   * Retorna o URI sem o prefixo da rota
   *
   * @return string
   */
  private function getUri()
  {
    $uri = $this->request->getUri();

    $explodedUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
    return end($explodedUri);
  }

  /**
   * Retorna dados da rota atual
   *
   * @return array
   */
  private function getRoute()
  {
    $uri = $this->getUri();
    $httpMethod = $this->request->getHttpMethod();

    foreach ($this->routes as $routePattern => $method) {
      if (preg_match($routePattern, $uri, $matches)) {
        if (isset($method[$httpMethod])) {
          unset($matches[0]);

          $keys = $method[$httpMethod]['variables'];
          $method[$httpMethod]['variables'] = array_combine($keys, $matches);
          $method[$httpMethod]['variables']['request'] = $this->request;

          return $method[$httpMethod];
        }

        throw new Exception("Método não permitido", 405);
      }
    }

    // URL não encontrado
    throw new Exception("URL não encontrado", 404);
  }

  /**
   * Executar a rota atual
   *
   * @return Response Retorna a execução de fila de middlewares
   */
  public function run()
  {
    try {
      $route = $this->getRoute();

      if (!isset($route['controller'])) {
        throw new Exception("O URL não pôde ser processado", 500);
      }

      $args = [];

      $reflection = new ReflectionFunction($route['controller']);
      foreach ($reflection->getParameters() as $parameter) {
        $name = $parameter->getName();
        $args[$name] = $route['variables'][$name] ?? '';
      }

	  return call_user_func_array( $route['controller'], $args);
    } catch (Exception $error) {
      return new Response($error->getCode(), $error->getMessage());
    }
  }

  /**
   * Retorna o URL atual
   *
   * @return string
   */
  public function getCurrentUrl()
  {
    return $this->url . $this->getUri();
  }

  /**
   * Redirecionar URL
   *
   * @param string $route Endpoint para redirecionamento
   * @return void
   */
  public function redirect($route)
  {
    $fullUrl = $this->url . $route;

    header("location: {$fullUrl}");
    exit;
  }
}