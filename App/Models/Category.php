<?php

namespace App\Models;

use Library\Model;

class Category extends Model{

	protected $table = "categories";

	public $fillable = ['category_name'];
}