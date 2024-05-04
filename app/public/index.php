<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

define('URL', 'http://localhost:8080');

use App\Http\Router;
use App\Utils\Debug;
use App\Utils\View;

View::init([
	'URL' => URL
]);

$router = new Router(URL);

include ('/var/www/html/routers/pages.php');

$router->run()->sendResponse();

?>
