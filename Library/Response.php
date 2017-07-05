<?php

namespace Library;

class Response {

	protected $template = null;

	public static function json($data, $param = 200) {
		header('Content-Type: application/json');
		if(!empty($param)):
			header($_SERVER["SERVER_PROTOCOL"], true, $param);
			header('Status: {$param}', TRUE, $param);
		endif;
		echo json_encode($data);
	}

	public static function redirect($location) {
		$url = fullurl();
		header("Location: {$url}/{$location}");
	}

	public static function back() {
		echo '<script>history.go(-1);</script>';
	}

}