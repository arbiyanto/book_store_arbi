<?php

namespace App\Models;

use Library\Model;

class Cart extends Model{

	protected $table = "carts";

	public $fillable = ['book_id','user_id','amount','status','created_at','updated_at'];
}