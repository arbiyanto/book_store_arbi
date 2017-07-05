<?php

return [

	'database' => [

		'name' => 'book_store_arbi',

		'username' => 'root',

		'password' => '',

		'connection' => 'mysql:host=127.0.0.1',

		'port' => '3307',
		
		'options' => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]

	]
	
];