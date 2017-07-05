<?php

namespace Library;

class Request{

	protected static $except = [], $only = [];

	public static function uri() {

		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		$uri = explode('/', $uri);

		if($_SERVER['SERVER_NAME']=="localhost"){
			unset($uri[1]);
		}

		$uri = implode('/', $uri);

		return $uri;
	}

	public static function method() {

		return $_SERVER['REQUEST_METHOD'];

	}

	public static function except($array) {
		static::$except = $array;
		return new static;
	}

	public static function only($array) {
		static::$only = $array;
		return new static;
	}

	public static function all() {

		if(!empty($_POST)):
			$objFileData = $_POST;
		else:
			$fileData = file_get_contents("php://input");
			$objFileData = json_decode($fileData,true);
		endif;

		if(!empty(static::$except)) {
			foreach($objFileData as $o_key => $o_val) {
				if(in_array($o_key, static::$except)) {
					unset($objFileData[$o_key]);
				}
			}
		}elseif(!empty(static::$only)) {
			foreach($objFileData as $o_key => $o_val) {
				if(in_array($o_key, static::$only)) {
					$newObject[$o_key] = $o_val;
				}
			}
			return $newObject;
		}
		
		return $objFileData;

	}

}