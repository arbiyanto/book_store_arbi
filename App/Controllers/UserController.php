<?php

namespace App\Controllers;

use Library\Controller;
use Library\Auth;
use Library\Request;
use Library\Response;

use App\Models\User;
use App\Models\Payment;
use App\Models\Cart;
use Library\App;

class UserController extends Controller{

	public function editProfile() {
		$request = filter(Request::all());

		$u = Auth::user();

		$user = User::where('id', $u->id)->update($request);

		if($user) {
			return Response::json(['status'=>'success','message'=>'profil berhasil diubah'], 200);
		}else{
			return Response::json(['status'=>'error','message'=>'profil gagal diubah'], 401);
		}
	}

	public function payment() {
		$request = filter(Request::all());

		$invoince = ['user_id'=>Auth::user()->id, 'payment_number'=>rand(), 'status'=> 0, 'created_at'=>date("now")];
		$payment = Payment::create($invoince);

		$id = $payment->lastId();

		for($x=0;$x < count($request); $x++) {
			$request[$x]['payment_id'] = $id;
		}

		$insert = App::get('database')->table('cart_to_payment')->massInsert($request); //
	}

	public function addCart() {
		$request = Request::only(['book_id','amount'])->all();

		if(Auth::user()) {
			$cart = new Cart;
			$insert = $cart->insert(['book_id'=> $request['book_id'], 'amount'=> $request['amount']]);
		}else{
			$r = ['book_id'=>$request['book_id'], 'amount'=> $request['amount'] ];
			
			$_SESSION['cart'][] = $r;
		}

		if(!empty($_SESSION['cart'])) {
			$data['status'] = "success";
			$data['message'] = "berhasil menambahkan keranjang";
		}else{
			$data['status'] = "error";
			$data['message'] = "gagal menambahkan keranjang";
		}

		return Response::json($data);

	}

	public function getCart() {
		if(!Auth::user()) {
			if(isset($_SESSION['cart'])) {
				$cart['count'] = count($_SESSION['cart']);
				
				$cookie = $_SESSION['cart'];
				$d = new \App\Models\Book;
				foreach($cookie as $c) {
					$data[] = $d->select('title','picture','sellprice','tax','discount')->where('id', $c['book_id'])->first();
				}

				for($x=0; $x < count($data); $x++) {
					$data[$x]->price = number_format(ceil($data[$x]->sellprice + ($data[$x]->sellprice * $data[$x]->tax / 100)
			- ($data[$x]->sellprice * $data[$x]->discount / 100) ), 0, ',','.' );
					$data[$x]->amount = $cookie[$x]['amount'];
				}

				$cart['cart'] = $data;

				if($cart['count'] > 0 ){
					
				}else{
					$cart['message'] = "Belum ada barang ditambahkan";
				}
				return Response::json($cart);
			}else {
				return Response::json(['message'=>'Belum ada barang ditambahkan']);
			}
			
		}else {
			$data = App::get('database')->table('carts')->where('user_id', Auth::user()->id)->get();
			for($x=0; $x < count($data); $x++) {
					$data[$x]->price = number_format(ceil($data[$x]->sellprice + ($data[$x]->sellprice * $data[$x]->tax / 100)
			- ($data[$x]->sellprice * $data[$x]->discount / 100) ), 0, ',','.' );
					$data[$x]->amount = $cookie[$x]['amount'];
				}
			$cart['cart'] = $data;
			$cart['count'] = count($data);
			if($cart['count'] > 0 ){
				
			}else{
				$cart['message'] = "Belum ada barang ditambahkan";
			}
			return Response::json($cart);
		}
	}

}
