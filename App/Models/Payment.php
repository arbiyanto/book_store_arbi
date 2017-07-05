<?php

namespace App\Models;

use Library\Model;

class Payment extends Model{

	public $table = "payments";

	public $fillable = ['user_id','payment_number','payment_method','status','created_at','updated_at'];
}