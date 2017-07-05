<?php

namespace App\Models;

use Library\Model;

class User extends Model {

	protected $table = "users";

	public $fillable = ['username','email','password','picture','fullname','gender','address','phone','remember_token','created_at','updated_at','role_id'];

	public $primaryKey = "id"; // override primary key property

	public function profile() {
		return $this->hasOne('UserProfile'); // one to one relationship example
	}

	public function roles() {
        return $this->belongsTo('Role', 'role_id');
    }

}