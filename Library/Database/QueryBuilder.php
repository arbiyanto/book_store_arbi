<?php

namespace Library\Database;

use Library\App;
use \PDO;

class QueryBuilder{


	protected
		$pdo,
		$table,
		$join = [],
		$select = null,
		$order = null,
		$limit = null,
		$where = [], 
		$whereData = [];
	
		

	public function __construct() {
		$this->pdo = Connection::make(App::get('config')['database']);
	}

	public function table($table){
		$this->table = $table;
		return $this;
	}

	public function _execute($query, $data = []) {
		$optionWhere = (!empty($this->where)) ? " WHERE ".substr(implode("", $this->where), 4) : null ;
		$optionJoin = implode("", $this->join);
		$optionOrder = $this->order;
		$optionLimit = $this->limit;

		$data = (!empty($this->whereData)) ? array_merge($data,$this->whereData) : $data;

		$statement = $this->pdo->prepare($query.$optionJoin.$optionWhere.$optionOrder.$optionLimit);
		/*print_r($statement);*/
		$statement->execute($data);

		$this->_removeOption();

		return $statement;
	}

	public function _removeOption() {
		$this->where = [];
		$this->whereData = [];
		$this->join = [];
		$this->order = null;
		$this->limit = null;

		return $this;
	}

	public  function _convert($data) {
		foreach($data as $k => $k_v):
			$m[':'.$k] = $k_v;
		endforeach;
		return $m;
	}

	public function _match($data) {
		foreach($data as $k => $k_v):
			$m[] = $k."=:{$k}";
		endforeach;
		$m = implode(",", $m);
		return [$m, $this->_convert($data)];
	}



	public  function select() {
		$this->select = implode(",", func_get_args() );
		return $this;
	}

	public function where($column1, $column2, $optional = null, $logic = " AND ") {
		$parameter = str_replace('.', '_', $column1); // remove . seperator table
		$where = (empty($optional)) ? "{$column1}=:w_{$parameter}" : "{$column1} {$column2} :w_{$parameter}" ;
		$whereData = (empty($optional)) ? $column2 :  $optional;

		$this->where[] = $logic.$where;
		$this->whereData[":w_{$parameter}"] = $whereData;

		return $this;
	}

	public function orWhere($column1, $column2, $optional = null, $logic = " OR ") {
		$parameter = str_replace('.', '_', $column1); // remove . seperator table
		$where = (empty($optional)) ? "{$column1}=:w_{$parameter}" : "{$column1} {$column2} :w_{$parameter}" ;
		$whereData = (empty($optional)) ? $column2 :  $optional;

		$this->where[] = $logic.$where;
		$this->whereData[":w_{$parameter}"] = $whereData;

		return $this;
	}

	public function insert($data) {
		$table =  $this->table;

		if(isset($data[0])) {
			$v = array();
			foreach($data as $d) {
				$v = array_merge($v, array_values($d));

				$c = count($d) - 1;
				$arr = array_fill(0, $c, '?');

				$placeholder[] = '('.implode(',', $arr).')';
			}

			$column = implode(',', array_keys($data[0]));
			$values = implode(',', $placeholder);

			$query = "INSERT INTO {$table} ({$column}) VALUES {$values}";

		}else{
			$newData = $this->_convert($data);

			$column = implode(",", array_keys($data));
			$paramValue = implode(",", array_keys($newData));

			$query = "INSERT INTO {$table} ({$column}) VALUES({$paramValue});";
		}

		return $this->_execute($query,$data);
	}

	public function update($data) {
		$table = $this->table;
		$newData = $this->_match($data);

		$query = "UPDATE {$table} SET {$newData[0]} ";
		
		return $this->_execute($query,$newData[1]);
	}

	public function delete() {
		$table = $this->table;

		$query = "DELETE FROM {$table} ";

		return $this->_execute($query);
	}

	public function join($table, $foreignKey1, $operator, $foreignKey2, $relation = "INNER") {
		$this->join[] = " {$relation} JOIN {$table} ON {$foreignKey1}{$operator}{$foreignKey2}";
		return $this;
	}

	public function rightJoin($table, $foreignKey1, $operator, $foreignKey2, $relation = "RIGHT") {
		$this->join[] = " {$relation} JOIN {$table} ON {$foreignKey1}{$operator}{$foreignKey2}";
		return $this;
	}

	public function leftJoin($table, $foreignKey1, $operator, $foreignKey2, $relation = "LEFT") {
		$this->join[] = " {$relation} JOIN {$table} ON {$foreignKey1}{$operator}{$foreignKey2}";
		return $this;
	}

	public function selectAll() {
		$table = $this->table;
		$query = "SELECT * FROM {$table}";

		$statement = $this->_execute($query);

		return $statement->fetchAll(PDO::FETCH_CLASS);
	}

	public function get() {
		$table = $this->table;
		$select = (empty($this->select)) ? "*" : $this->select;
		$query = "SELECT {$select} FROM {$table} ";
		$statement = $this->_execute($query, []);
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}

	public function first() {
		$table = $this->table;
		$select = (empty($this->select)) ? "*" : $this->select;
		$query = "SELECT {$select} FROM {$table} ";
		$statement = $this->_execute($query, []);
		return $statement->fetchObject();
	}

	public function run($query, $data = []) {
		$result = $this->_execute($query, $data);
		/*if(substr($query, 0, 5)=="select") {
			return $result->fetchAll(PDO::FETCH_CLASS);
		}*/

		return $result;
	}

	public function limit($limit, $offset = null) {
		$offset = (!empty($offset)) ? 'OFFSET '.$offset : null;
		$this->limit = " LIMIT {$limit} ".$offset;
		return $this;
	}

	public function orderBy($column, $sort) {
		$this->order = " ORDER BY {$column} {$sort}";
		return $this;
	}

	public function count(){
		$select = (empty($this->select)) ? "*" : $this->select;

		$query = "SELECT {$select} FROM {$this->table} ";
		$execute = $this->_execute($query, []);
		return $execute->rowCount();
	}

	public function lastId() {
		return $this->pdo->lastInsertId();
	}

	/*public function insert($parameters) {
		$sql = sprintf(
			'INSERT INTO %s (%s) VALUES (%s)',
			$this->table,
			implode(', ', array_keys($parameters)),
			':' . implode(', :', array_keys($parameters))
		);

		try{
			
			$statement = $this->pdo->prepare($sql);

			$statement->execute($parameters);

			return $statement;

		}catch (PDOException $e) {

			die('Something went wrong'.$e->getMessage());

		}
		
	}*/
}