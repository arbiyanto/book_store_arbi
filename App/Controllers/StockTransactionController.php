<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use Library\App;
use Library\Auth;

use App\Models\StockTransaction;
use App\Models\Book;

class StockTransactionController extends Controller{

	public function store() {
		$request = Request::all();
		$request['date'] = strtotime($request['date']);

		$StockTransaction = new StockTransaction;
		$insert = $StockTransaction->create($request);

		// update book stock
		$b = new Book;
		$book = $b->where('id', $request['book_id'] )->first();
		$update = $b->where('id', $request['book_id'])->update(['stock'=> $book->stock + $request['amount'] ]);

		if($insert){
			$data['status'] = "success";
			$data['message'] = "stok buku berhasil ditambahkan";
			$status = 200;
		}else{
			$data['status'] = "error";
			$data['message'] = "stok buku gagal ditambahkan";
			$status = 401;
		}

		return Response::json($data, $status);
	}

}