<?php

namespace App\Models;

use Library\Model;

class Book extends Model{
	
	public $table = "books";

	public $fillable = ['category_id','title','description','noisbn','author','publisher','date','stock','baseprice','sellprice','tax','discount'
	,'picture','status','updated_by'];

	public function category() {
		$this->belongsTo('Category', 'category_id');
	}
}