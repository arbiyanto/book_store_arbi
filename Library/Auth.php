<?php

namespace Library;
use App\Models\User;

class Auth {

	protected static $user = null;

	public function getUser($remember_token) {
		$u = new User;
		$user = $u->with(['roles'])->where('remember_token', $remember_token)->first();
		$hidden = $u->hidden;

		if(!empty($hidden)) {

			foreach($hidden as $h) {
				if(array_key_exists($h, $user)) {
					unset($user[$h]);
				}
			}	

		}
		
		return $user;
	}

	public static function setToken($id) {
		$remember_token = password_hash(mt_rand(), PASSWORD_BCRYPT);
 		$user = new User;
		$saveToken = $user->where('id', $id)->update(['remember_token'=> $remember_token]);
		setcookie('token', $remember_token, time()+60*60*24*30, '/');

		return $remember_token;
	}

	// ['username'=>'$username','password'=>'$password']
	public static function attempt($credentials) {
		$keys = array_keys($credentials);
		$user = new User;
		$check = $user->where($keys[0], $credentials['username']);

		if(isset($credentials['username'])) {
			$check->orWhere($keys[0],$credentials['email']);
		}

		$user = $check->first();

		if(count($user) < 1) {
			return false;
		}

		if(isset($user->password) && password_verify($credentials['password'], $user->password)){
			$token = Auth::setToken($user->id);
			static::$user = Auth::getUser($token);
			return 	true;
		}else{
			return false;
		}

	}

	public function skip($id) {
		$d =  Auth::setToken($id);
		return $d;
	}

	public static function user() {
		
		if(isset($_COOKIE['token'])) {
			$remember_token = $_COOKIE['token'];
		}else{
			if(!empty(static::$user)) return static::$user;
			return false;
		}
		
		if(empty(static::$user)) static::$user = Auth::getUser($remember_token);
		if(!empty(static::$user)) return static::$user;
	}

	public function logout() {
		setcookie('token', "", 0, '/');
		Auth::$user = null;
	}

}