<?php

namespace App\Models;

use Library\Model;

class Distributor extends Model{

	protected $table = "distributor";

	public $fillable = ['distributor_name','distributor_address'];
}