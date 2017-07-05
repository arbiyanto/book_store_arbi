<?php
namespace Library;

class Middleware {

	protected $middleware,$method,$redirect = false, $redirectLocation = null;

	public function __construct($middleware = null, $method = []) {
		$this->middleware = $middleware;
		$this->method = $method;
	}

	public function forceGate() {
		$presentMethod = $GLOBALS['method'];
		$middleware = "App\\Middleware\\". ucfirst($this->middleware) . 'Middleware';

		$gate = new $middleware;
		
		if(empty($this->method)) 
			if($gate->boot()==='redirect') $this->redirect = true;

		if(!empty($this->method)) {

			foreach($this->method as $m => $m_v) {
				$check = $this->$m($presentMethod,$m_v);

				if($check) {
					if($gate->boot()==='redirect') {
						$this->redirect = true;
					}
				}
				
			}

		}
	}

	public function except($presentMethod, $methodArray) {
		if(in_array($presentMethod, $methodArray)) 
			return false;
		else
			return true;
	}

	public function only($presentMethod, $methodArray) {
		if(in_array($presentMethod, $methodArray)) 
			return true;
		else
			return false;
	}

	public function redirect($location) {
		$this->redirectLocation = $location;
	}

	public function __destruct() {
		if($this->redirect) {
			if(!empty($this->redirectLocation)) {
				$url = fullurl();
				header("Location: {$url}/{$this->redirectLocation}");
			}else{
				header("HTTP/1.0 401 Unauthorized", false, 401);
				die('401 Unauthorized');
			}
		}
	}

}