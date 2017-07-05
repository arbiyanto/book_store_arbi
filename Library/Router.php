<?php

namespace Library;

use \Exception;

class Router {

	protected $routes = [
		'GET' => [ 'no_param' => [], 'param' => [] ],
		'POST' => [ 'no_param' => [], 'param' => [] ],
		'PUT' => [ 'no_param' => [], 'param' => [] ],
		'DELETE' => [ 'no_param' => [], 'param' => [] ]
	],
	$routesParameter = [];

	public function register($method, $route) {

		if(preg_match('/^[a-zA-Z\/,0-9]*$/', $route[0])) {

			$this->routes[$method]['no_param'][$route[0]] = $route[1];

		}elseif(preg_match('/^[a-zA-Z\/,0-9,\{}]*$/', $route[0])){

			$this->routes[$method]['param'][$route[0]] = $route[1];

		}

	}

	public static function load($file) {
		$router = new static;

		require "App/{$file}";

		return $router;
	}

	public function get($uri, $controller) {
		$this->register('GET',[$uri,$controller]);
	}

	public function post($uri, $controller) {

		$this->register('POST',[$uri,$controller]);

	}

	public function put($uri, $controller) {

		$this->register('PUT',[$uri,$controller]);

	}

	public function delete($uri, $controller) {

		$this->register('DELETE',[$uri,$controller]);

	}

	public function direct($uri, $requestType) {


		if(array_key_exists($uri, $this->routes[$requestType]['no_param'])){

			return $this->callAction(
				...explode('@', $this->routes[$requestType]['no_param'][$uri])
			);

		}else{
			// check if this routes is parameter or not
			$routes = $this->routes[$requestType]['param']; // array of routes collection

			foreach($routes as $r_k => $r_v) {

				$routesCollection = explode('/', $r_k); // make routes in collection to array
				$routesUri = explode('/', $uri); // make routes in request uri to array

				for($x=0; $x < count($routesCollection); $x++) {

					// if routes collection have parameter
					if(preg_match('/\{[^}]*\}/', $routesCollection[$x])) {

						$y[] = (isset($routesUri[$x])) ? $routesUri[$x] : null; // replace parameter to request uri
						$key[ str_replace(array('{','}'),'', $routesCollection[$x]) ] = (isset($routesUri[$x])) ? $routesUri[$x] : null; // make parameter have its own value

					}else{

						$y[] = $routesCollection[$x]; // let routes same as before

					}

				}
				/*print_r($routesCollection);*/

				$routesValidate = implode("/", $y); // make new URI to validate with Request URI

				// if new routes is same with request uri
				if($routesValidate==$uri){

					$this->routesParameter = $key;

					// call action
					return $this->callAction(
						...explode('@', $r_v)
					);

				}
				$y = [];
				$key = [];

			}

		}

		throw new Exception('Routes Not Found');
	}

	public function callAction($controller, $action) {
		$controllerFile = "App/Controllers/".$controller.".php";
	
		if(file_exists($controllerFile)) {
			require $controllerFile;
			$GLOBALS['method'] = $action;
			$c = "App\\Controllers\\".$controller;
			$controller = new $c;

			if(!method_exists($controller, $action)) {
				throw new Exception("Method doesn't exists");
			}

		}else{

			throw new Exception("Controller not found.");

		}

		return call_user_func_array(array($controller, $action), $this->routesParameter);
	}

}