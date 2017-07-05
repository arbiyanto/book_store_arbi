<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use App\Models\Category;


class CategoryController extends Controller{

	public function __construct() {
		$this->middleware('auth',['only'=>['index']])->redirect('login');
		$this->middleware('auth', ['except'=> ['detail','category']]);
	}

	public function index() {
		$category = new Category;
		$data = $category->orderBy('category_name','ASC')->get();
		return view('page/admin/category', ['title'=>'Daftar Kategori Buku','data'=>$data], 'admin');
	}

	public function category() {
		$c = new Category;
		$data = $c->orderBy('category_name','ASC')->get();
		return Response::json($data, 200);
	}

	public function detail($id) {
		$ct = new Category;
		$data = $ct->where('id', $id)->first();
		if($data)
			return Response::json($data, 200);
		else
			return Response::json(['status'=>'error','message'=>'error checking data'], 401);
		
	}

	public function store() {
		$request = Request::all();

		$category = new Category;

		$insert = $category->create($request);
		$lastId = $category->lastId();

		if($insert){
			$data['status'] = "success";
			$data['message'] = "kategori berhasil ditambahkan";
			$data['category'] = ['id'=>$lastId, 'category_name'=>$request['category_name']];
		}else{
			$data['status'] = "error";
			$data['message'] = "kategori gagal ditambahkan";
		}

		return Response::json($data);
	}

	public function update($id) {
		$request = Request::all();

		$update = new Category;
		$update->where('id', $id)->save($request);

		if($update){
			$data['status'] = "success";
			$data['message'] = "kategori berhasil diubah";
			$data['category'] = ['id'=>$id, 'category_name'=>$request['category_name']];
		}else{
			$data['status'] = "error";
			$data['message'] = "kategori gagal diubah";
		}

		return Response::json($data);
	}

	public function delete($id) {
		$request = Request::all();

		$delete = new Category;
		$delete->where('id', $id)->delete();

		if($delete){
			$data['status'] = "success";
			$data['message'] = "kategori berhasil dihapus";
		}else{
			$data['status'] = "error";
			$data['message'] = "kategori gagal dihapus";
		}

		return Response::json($data);
	}

}