<?php
session_start();
ob_start();
require 'bootstrap/bootstrap.php';

use Library\Router;
use Library\Request;

$router = new Router;
try{
	Router::load('routes.php')->direct(
		Request::uri(),
		Request::method()
	);
}catch(Exception $e) {
	die($e->getMessage());
}
