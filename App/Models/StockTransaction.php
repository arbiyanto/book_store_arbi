<?php

namespace App\Models;

use Library\Model;

class StockTransaction extends Model{

	protected $table = "stock_transaction";

	public $fillable = ['book_id','distributor_id','amount','date'];
}