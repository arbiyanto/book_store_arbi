<?php

namespace Library;

use Library\Middleware;


class Controller {

	public function middleware($middleware, $array = []) {
		$gate = new Middleware($middleware, $array);
		$gate->forceGate();
		return $gate;
	}

	public function redirect($location) {
		$redirect = new Middleware;
		$redirect->redirect($location);
		return $redirect;
	}

}