<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use Library\App;
use App\Models\Label;


class LabelController extends Controller{

	public function __construct() {
		$this->middleware('auth',['only'=>['index']])->redirect('login');
		$this->middleware('auth', ['except'=> ['detail','Label']]);
	}

	public function index() {
		$label = new Label;
		$data = $label->orderBy('label_name','ASC')->get();

		$labelbooks = App::get('database')
		->table('book_to_labels')
		->select('book_to_labels.*, books.title, labels.label_name')
		->join('books','book_to_labels.book_id','=','books.id')
		->join('labels','book_to_labels.label_id','=','labels.id')
		->get();

		return view('page/admin/label', ['title'=>'Daftar label Buku','data'=>$data,'labelbooks'=>$labelbooks], 'admin');
	}

	public function label() {
		$c = new Label;
		$data = $c->orderBy('label_name','ASC')->get();
		return Response::json($data, 200);
	}

	public function detail($id) {
		$ct = new Label;
		$data = $ct->where('id', $id)->first();
		if($data)
			return Response::json($data, 200);
		else
			return Response::json(['status'=>'error','message'=>'error checking data'], 401);
		
	}

	public function store() {
		$request = Request::all();

		$Label = new Label;

		$insert = $Label->create($request);
		$lastId = $Label->lastId();

		if($insert){
			$data['status'] = "success";
			$data['message'] = "label berhasil ditambahkan";
			$data['label'] = ['id'=>$lastId, 'label_name'=>$request['label_name']];
		}else{
			$data['status'] = "error";
			$data['message'] = "label gagal ditambahkan";
		}

		return Response::json($data);
	}

	public function update($id) {
		$request = Request::all();

		$update = new Label;
		$update->where('id', $id)->save($request);

		if($update){
			$data['status'] = "success";
			$data['message'] = "label berhasil diubah";
			$data['Label'] = ['id'=>$id, 'Label_name'=>$request['Label_name']];
		}else{
			$data['status'] = "error";
			$data['message'] = "label gagal diubah";
		}

		return Response::json($data);
	}

	public function delete($id) {
		$delete = new Label;
		$delete->where('id', $id)->delete();

		if($delete){
			$data['status'] = "success";
			$data['message'] = "label berhasil dihapus";
		}else{
			$data['status'] = "error";
			$data['message'] = "label gagal dihapus";
		}

		return Response::json($data);
	}

	public function labelBooksStore() {
		$request = Request::only(['label_id','book_id'])->all();

		$label_id = $request['label_id'];
		$book_id = $request['book_id'];

		$check = App::get('database')
		->table('book_to_labels')
		->where('label_id', $label_id)
		->where('book_id', $book_id)
		->count();

		if($check > 0) {
			return Response::json(['status'=>'error','message'=>'sudah ada'], 200);
		}

		$insert = App::get('database')
		->table('book_to_labels')
		->insert(['label_id'=>$label_id, 'book_id'=>$book_id]);

		if($insert){
			$data['status'] = "success";
			$data['message'] = "label berhasil ditambahkan";
			$data['labelbooks'] = App::get('database')
			->table('book_to_labels')
			->select('book_to_labels.*, books.title, labels.label_name')
			->where('book_to_labels.label_id', $label_id)
			->where('book_to_labels.book_id', $book_id)
			->join('books','book_to_labels.book_id','=','books.id')
			->join('labels','book_to_labels.label_id','=','labels.id')
			->first();
			$status = 200;
		}else{
			$data['status'] = "error";
			$data['message'] = "label gagal ditambahkan";
			$status = 401;
		}

		return Response::json($data, $status);
	}

	public function labelBooksDelete($id) {
		$delete = App::get('database')
		->table('book_to_labels')
		->where('id', $id)->delete();

		if($delete){
			$data['status'] = "success";
			$data['message'] = "label berhasil dihapus";
		}else{
			$data['status'] = "error";
			$data['message'] = "label gagal dihapus";
		}

		return Response::json($data);
	}

}