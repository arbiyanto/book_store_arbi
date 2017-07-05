<?php

function fullurl() {
	$uri = explode('/', $_SERVER['REQUEST_URI']);
	$uri = ($_SERVER['SERVER_NAME']=="localhost") ? '/'.$uri[1] : $uri[0];
	
	return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$uri;
}

// viewing data
function view($view, $data = [], $template = null) {
	$template = (!empty($template)) ? $template : 'index';
	$globals = $data;
	if(!empty($data)) extract($data);

	$template = 'public/views/'.$template.'.view.php';

	if(file_exists($template)) return require_once $template;
	else throw new Exception("File not found");
}

// sub view
function subView($view, $data = []) {
	if(!empty($data)) extract($data);
	$view = 'public/views/'.$view.'.view.php';
	if(file_exists($view)) return require_once $view;
	else throw new Exception("File not found");
}

// filter data
function filter($data) {
	if(is_array($data)) {
		foreach($data as $d_key => $d_val) {
			$d[$d_key] = htmlspecialchars(trim($d_val));
		}
	}else{
		$d = htmlspecialchars(trim($d));
	}

	return $d;
} 
