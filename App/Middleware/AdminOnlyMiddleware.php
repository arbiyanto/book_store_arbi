<?php

namespace App\Middleware;

use Library\Auth;

class AdminOnlyMiddleware {

	public static function boot() {
		if(!in_array(Auth::user()->role_id, ['2','3'])) return 'redirect' ;
	}

}