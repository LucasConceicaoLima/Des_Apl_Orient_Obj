<?php 
namespace Daoo\Aula03\controller;

use Daoo\Aula03\controller\api\Controller as ApiController;
use Daoo\Aula03\controller\web\Controller as WebController;

class Route
{
	private static $query;
	public static function routes(Array $routes)
	{

		$url_path = trim($_SERVER['REQUEST_URI'], '/');
		self::$query = explode('/', $url_path);

		// error_log("Routes array: \n".print_r($routes, TRUE));
		error_log("Query array: \n".print_r(self::$query, TRUE));
		
		$controller = WebController::class;
		$type = 'web';

		if(self::$query[0]=="api"){
			array_shift(self::$query);
			$controller = ApiController::class;
			$type='api';
		}

		$class = null;
		$method = null;
		$param = null;

		error_log("Route: $url_path"); 
		
		if (self::$query) {
			$class_name = self::$query[0];
			if (count(self::$query) > 1) {
				$method = self::$query[1];
				$param = (count(self::$query) > 2) ? self::$query[2] : null;
			}

			if (isset($routes[$type][$class_name])) {
				$class = new $routes[$type][$class_name];
				if ($class instanceof $controller) {
					if ($method && method_exists($class, $method)) {
						if ($param) {
							$class->$method($param);
						} else {
							$class->$method();
						}
					} else {
						if (method_exists($class, 'index'))
							$class->index();
						else $class = null;
					}
				}
			}
		}
		if (!$class) header('HTTP/1.0 404 Not Found');
	}
}