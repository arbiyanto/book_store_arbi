<?php

namespace App\Models;

use Library\Model;

class Label extends Model{

	protected $table = "labels";

	public $fillable = ['label_name'];
}