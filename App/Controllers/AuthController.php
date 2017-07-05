<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use Library\Auth;
use App\Models\User;
use App\Models\Cart;

class AuthController extends Controller{

	protected $role = ['2','3'];

	/*public function registerPage() {;
		if(Auth::user() && in_array(Auth::user()->role_id, $this->role)) 
			return Response::redirect('admin/dashboard');
		return view('page/register', ['title'=>'Mendaftar Sebagai Admin'], 'admin');
	}*/

	public function loginPage() {
		if(Auth::user() && in_array(Auth::user()->role_id, $this->role)) 
			return Response::redirect('admin/dashboard');
		return view('page/login', ['title'=>'Mesuk Sebagai Admin'], 'admin');
	}


	public function register() {
		$error = false;
		$request = filter(Request::only(['username','email','password'])->all());
		$user = new User;
		$check = $user
		->where('email', $request['email'])
		->orWhere('username', $request['username'])
		->select('username','email')
		->first();

		if(isset($check->email) && $check->email==$request['email']){
			$message['email'] = "email sudah terpakai";
			$error = true;
		}

		if(isset($check->username) && $check->username==$request['username']){
			$message['username'] = "username sudah terpakai";
			$error = true;
		}

		if($error===true) {
			return Response::json($message);
		}

		$request['password'] = password_hash($request['password'], PASSWORD_DEFAULT);
		$request['role_id'] = 1;
		

		$insert = $user->create($request);

		if($insert){
			$data['status'] = "success";
			$data['message'] = "berhasil mendaftar!";
 			
 			$lastid = $user->lastId();
 			$this->makeCart();
 			Auth::skip($lastid);

		}else{
			$data['status'] = "error";
			$data['message'] = "gagal mendaftar";
		}

		return Response::json($data);
	}

	protected function makeCart() {
		if(isset($_SESSION['cart'])) {
			$c = new Cart;
			$user_cart = $c->where('user_id', Auth::user()->id)->get();

			$cart = $_SESSION['cart'];

			for($x=0; $x < count($cart); $x++) {
				$cart[$x]['user_id'] = Auth::user()->id;
			}

			if(count($user_cart) < 1) {
				$cart = $c->create($cart);
			} 

			session_destroy($_SESSION['cart']);
		}
	}

	public function login($type) {
		$request = filter(Request::only(['username','password'])->all());

		$auth = Auth::attempt(['username'=>$request['username'], 'password'=> $request['password'], 'email'=> $request['username']]);
		if($auth) {
			if($type=="admin") {
				if(!in_array(Auth::user()->role_id, $this->role)) {
					Auth::logout();
					return Response::json(['status'=> 'Tidak dapat login, bukan admin', 'message'=> 'error'], 401);
				}
			}
			$this->makeCart();
			return Response::json(['status'=> 'success', 'message'=> 'berhasil login!'], 200);
		}else{
			return Response::json(['status'=> 'error', 'message'=> 'username atau password salah'], 401);
		}
		
	}

	public function logout() {
		Auth::logout();
		return Response::redirect('');
	}

}