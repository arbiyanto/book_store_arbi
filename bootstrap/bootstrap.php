<?php

// autoload all file
foreach(require 'config/autoload.php' as $f) {
	require $f.'.php';
}

if(!function_exists('classAutoLoader')) {
	function classAutoLoader($class) {
		$fileName = str_replace('\\', '/',$class.'.php');
		if(is_file($fileName)&&!class_exists($class)) require $fileName;
	}
}

date_default_timezone_set("Asia/Bangkok");

spl_autoload_register('classAutoLoader');

use Library\App;
use Library\Database\QueryBuilder;


// take array data from config and throw it to key binding
App::bind('config', require 'config/database.php');

// query builder configuration
App::bind('database', new QueryBuilder());

