<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use Library\App;
use Library\Auth;

use App\Models\Payment;

class PaymentController extends Controller{

	public function index() {
		$payment = new Payment;
		$data = App::get('database')
		->table('payments')
		->select('payments.*','users.username','users.email')
		->where('status','1')
		->orWhere('status','2')
		->join('users','payments.user_id', '=','users.id')
		->get();

		for($x=0;$x < count($data); $x++) {
			$data[$x]->created_at = strtotime($data[$x]->created_at);
		}


		return view('page/admin/payment', $data, 'admin');
	}

	public function detail($id) {
		$p= new Payment;
		$data = $p
		->select('payments.*','users.username','users.email','users.phone','users.address','users.picture')
		->where('payments.id', $id)
		->join('users','payments.user_id', '=','users.id')
		->first();

		$cart = App::get('database')
		->table('cart_to_payment')
		->where('cart_to_payment.payment_id', $id)
		->join('carts','cart_to_payment.cart_id','=','carts.id')
		->join('books','carts.book_id','=','books.id')
		->get();

		$total = 0;
		$book_total = 0;

		for($x=0; $x < count($cart); $x++) {
			$cart[$x]->price = ($cart[$x]->sellprice*$cart[$x]->amount) + ($cart[$x]->sellprice * $cart[$x]->tax/100) 
			- ($cart[$x]->sellprice * $cart[$x]->discount/100);

			$book_total = $book_total + $cart[$x]->amount;
			$total = $total + $cart[$x]->price;
		}

		$data->cart = $cart;
		$data->total = $total;
		$data->book_total = $book_total;

		if($data) {
			return Response::json($data, 200);	
		}else{
			return Response::json(['status'=>'error','message'=>'gagal untuk load data'], 401);
		}	
	}

	public function getAllPayment() {
		$Payment = new Payment;
		$data = $Payment->select('id', 'Payment_name')->get();

		if($data) {
			return Response::json($data, 200);	
		}else{
			return Response::json(['status'=>'error','message'=>'gagal untuk load data'], 401);
		}
	}

	public function store() {
		$request = Request::all();

		$Payments = new Payment;

		$insert = $Payments->create($request);

		$lastId = $Payments->lastId();

		$request = array_merge(['id'=>$lastId], $request);

		if($insert){
			$data['status'] = "success";
			$data['message'] = "Payment berhasil ditambahkan";
			$data['Payment'] = $request;
			$status = 200;
		}else{
			$data['status'] = "error";
			$data['message'] = "Payment gagal ditambahkan";
			$status = 401;
		}

		return Response::json($data, $status);
	}

	public function update($id) {
		$request = Request::all();

		$request['updated_at'] = date('Y-m-d H:i:s',strtotime("NOW"));

		$update = new Payment;
		$update->where('id', $id)->save($request);

		if($update){
			$data['status'] = "success";
			$data['message'] = "Transaksi berhasil diubah";
			$data['Payment'] = $request;
		}else{
			$data['status'] = "error";
			$data['message'] = "Transaksi gagal diubah";
		}

		return Response::json($data);
	}

	public function delete($id) {
		$delete = new Payment;
		$delete->where('id', $id)->delete();

		if($delete){
			$data['status'] = "success";
			$data['message'] = "Payment berhasil dihapus";
		}else{
			$data['status'] = "error";
			$data['message'] = "Payment gagal dihapus";
		}

		return Response::json($data);
	}

}