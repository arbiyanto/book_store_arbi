<?php

namespace Library\Database;

use \PDO;

class Connection {

	public static function make($config) {
		try{
			
			/*return new PDO('mysql:host=127.0.0.1;dbname=linea','root','');*/
			return new PDO(
				$config['connection'].";port=".$config['port'].";dbname=".$config['name'],
				$config['username'],
				$config['password'],
				$config['options']
			);

		}catch (PDOException $e) {

		}
	}
}