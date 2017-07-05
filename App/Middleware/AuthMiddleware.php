<?php

namespace App\Middleware;

use Library\Auth;

class AuthMiddleware {

	public static function boot() {
		if(empty(Auth::user())) return 'redirect' ;
	}

}