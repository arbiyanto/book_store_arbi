<?php

namespace Library;

use Library\Database\QueryBuilder;

class Model extends QueryBuilder{

	public
		$primaryKey = "id",
		$fillable = [],
		$hidden;

	protected static $method = [], $id = null;

	// execute method in base model
	public function _eloquent($data) {
		$method = static::$method;

		foreach($method as $m) {
			$data->$m = $this->$m($m);
		}

		return $data;
	}

	public function getClassName() {
		return static::class;
	}

	// same as where
	public static function find($id) {
		$self = new static;
		$primaryKey = $self->primaryKey;
		$data = parent::where($primaryKey, $id)->first();

		if(!empty(static::$method)){
			if($data) {
				static::$id = $data->$primaryKey;
				$data = $self->_eloquent($data);
			}
		}
		
		return $data;
	}

	public function create($data) {
		foreach($this->fillable as $fill){

			// for mass insert
			if(isset($data[0])) {
				
				for($x=0;$x < count($data); $x++) {
					if(isset($data[$x][$fill])) 
						$i[$x][$fill] = (!empty($data[$x][$fill])) ? $data[$x][$fill] : null;
				}

			}

			// insert manual
			elseif(isset($data[$fill])) {
				$i[$fill] = (!empty($data[$fill])) ? $data[$fill] : null;
			}

		}

		$insert = parent::insert($i);

		return $insert;
	}

	public function save($data) {

		foreach($this->fillable as $fill){

			// for mass insert
			if(isset($data[0])) {
				
				for($x=0;$x < count($data); $x++) {
					if(isset($data[$x][$fill])) 
						$i[$x][$fill] = (!empty($data[$x][$fill])) ? $data[$x][$fill] : null;
				}

			}

			// insert manual
			elseif(isset($data[$fill])) {
				$i[$fill] = (!empty($data[$fill])) ? $data[$fill] : null;
			}

		}

		$update = parent::update($i);

		return $update;
	}

	// fill method property
	public static function with($method = []) {
		static::$method = $method;
		return new static;
	}

	// replace get method then execute exclude to remove some property
	public static function all() {
		$self = new static;
		return $self->table($self->table)->get();
	}

	// replace first method then execute exclude to remove some property
	public function first($template = null) {
		$primaryKey = $this->primaryKey;
		$data = Parent::first();

		if(empty($template)){
			if(!empty(static::$method)) {
				if($data) {
					static::$id = $data;
					$data = $this->_eloquent($data);
				}
			}
		}

		$this->removeOption();

		return $data;
	}

	public function removeOption() {
		static::$method = null;
	}
	
	// one to one relationship
	public function hasOne($model, $foreignKey = null, $localKey = null) {
		if(!empty($localKey)) $this->primaryKey = $localKey;
		$foreignKey = (!empty($foreignKey)) ? $foreignKey : strtolower($this->getClassName().'_id'); 
		$i = $this->primaryKey;

		$model = "App\\Models\\".$model;
		$model = new $model;
		$statement = $model->where($foreignKey, static::$id->$i)->first('not empty');
		return $statement;
	}

	// one to many relationship
	public function hasMany($model, $foreignKey = null, $localKey = null) {
		if(!empty($localKey)) $this->primaryKey = $localKey;
		$foreignKey = (!empty($foreignKey)) ? $foreignKey : strtolower($this->getClassName().'_id');
		$i = $this->primaryKey;

		$model = "App\\Models\\".$model;
		$model = new $model;
		$statement = $model->where($foreignKey, static::$id->$i)->get();
		return $statement;
	}

	// one to many inverse relationship
	public function belongsTo($model, $foreignKey = null, $otherKey = null) {
		$model = "App\\Models\\".$model;
		$model = new $model;

		$primaryKey = (!empty($otherKey)) ? $otherKey : $model->primaryKey;
		$foreignKey = (!empty($foreignKey)) ? $foreignKey : strtolower($model->getClassName().'_id');

		$statement = $model->where($primaryKey, static::$id->$foreignKey)->first('not empty');
		return $statement;
	}

	// many to many relationship
	public function belongsToMany($model, $tableKey, $foreignKey1 = null, $foreignKey2 = null) {
		$model = "App\\Models\\".$model;
		$model = new $model;

		$foreignKey = (!empty($foreignKey1)) ? $foreignKey1 : strtolower($this->getClassName().'_id');
		$foreignKey2 = (!empty($foreignKey2)) ? $foreignKey2 : strtolower($model->getClassName().'_id');
		$query = new QueryBuilder;
		$manyTable = $query->where($foreignKey1, static::$id)->table($tableKey)->get();

		foreach($manyTable as $many) {
			$model->orWhere($model->primaryKey, $many->$foreignKey2);
		}

		$statement = $model->get();

		return $statement;
	}

	// has many through relationship


	// polymorphic relationship
/*	public function morphTo() {
		$method_name = func_get_arg(0);
		$statement = $this->where($method_name.'_id', static::$id)->get();
		return $statement;
	}*/

	public function morphMany($model, $method) {
		$model = "App\\Models\\".$model;
		$model = new $model;
		
		$i = $this->primaryKey;

		$statement = $model
		->where($method.'_id', static::$id->$i)
		->where($method.'_type', $this->getClassName())
		->get();
		
		return $statement;
	}

}


// hidden column remove
	/*public function _exclude($data, $hidden) {
		if(!empty($hidden)) {

			if(is_object($data)) {

				foreach($data as $key=>$value) {
					if(in_array($key, $hidden)) {
						unset($data->$key);
					}

				}

			}else {
				for($x=0;$x < count($data); $x++){

					$data[$x] = get_object_vars($data[$x]);
					foreach($data[$x] as $key=>$value) {
						if(in_array($key, $hidden)) {
							unset($data[$x][$key]);
						}
					}

				}
			}

		}
		
		return $data;
	}*/