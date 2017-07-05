<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use Library\App;
use Library\Auth;

use App\Models\Book;

class BooksController extends Controller{

	public function index() {
		$book = new Book;
		$data = $book->select("{$book->table}.*, categories.category_name")
		->join('categories', $book->table.'.category_id', '=','categories.id')
		->get();

		for($x=0;$x < count($data); $x++){
			if(strlen($data[$x]->title) > 37) {
				$data[$x]->title = substr($data[$x]->title,0,38).'...';
			}
		}

		return view('page/admin/books', ['title'=>'Daftar Buku','data'=>$data], 'admin');
	}

	public function create() {
		return view('page/admin/books-add', ['title'=>'Tambahkan Buku'], 'admin');
	}

	public function getBooks($id) {
		$book = new Book;
		$data = $book->where('id',$id)->first();

		$data->da = $data->date;
		unset($data->date);

		if($data) {
			return Response::json($data, 200);	
		}else{
			return Response::json(['status'=>'error','message'=>'gagal untuk load data'], 401);
		}
		
	}

	public function getAllBooks() {
		$book = new Book;
		$data = $book->select('id', 'title')->get();

		if($data) {
			return Response::json($data, 200);	
		}else{
			return Response::json(['status'=>'error','message'=>'gagal untuk load data'], 401);
		}
	}

	public function store() {
		$request = Request::all();

		$books = new Book;
		$request['date'] = strtotime($request['date']);
		$request['tax'] = (empty($request['tax'])) ? '0' : $request['tax'];
		$request['discount'] = (empty($request['discount'])) ? '0' : $request['discount'];
		$request['updated_by'] = Auth::user()->id;

		$insert = $books->create($request);

		$lastId = $books->lastId();

		$request = array_merge(['id'=>$lastId], $request);

		if($insert){
			$data['status'] = "success";
			$data['message'] = "buku berhasil ditambahkan";
			$data['books'] = $request;
			$status = 200;
		}else{
			$data['status'] = "error";
			$data['message'] = "buku gagal ditambahkan";
			$status = 401;
		}

		return Response::json($data, $status);
	}

	public function update($id) {
		$request = Request::all();

		if(isset($request['date'])) {
			$request['date'] = strtotime($request['date']);
		}

		$request['updated_by'] = Auth::user()->id;

		$update = new Book;
		$update->where('id', $id)->save($request);

		if($update){
			$data['status'] = "success";
			$data['message'] = "buku berhasil diubah";

			$book = $update->select('books.*', 'categories.category_name')
			->join('categories', 'books.category_id','=','categories.id')
			->where('books.id', $id)
			->first();

			$book->title = substr($book->title, 0, 38). "...";

			$data['books'] = $book;
		}else{
			$data['status'] = "error";
			$data['message'] = "buku gagal diubah";
		}

		return Response::json($data);
	}

	public function delete($id) {
		$delete = new Book;
		$delete->where('id', $id)->delete();

		if($delete){
			$data['status'] = "success";
			$data['message'] = "buku berhasil dihapus";
		}else{
			$data['status'] = "error";
			$data['message'] = "buku gagal dihapus";
		}

		return Response::json($data);
	}

	public function uploadPicture() {
		$fileType = pathinfo(basename($_FILES['image']['name']),PATHINFO_EXTENSION);

		$filename = strtotime("now").rand().'.'.$fileType;
		$destination = 'public/img/upload/' . $filename;
		
		if(move_uploaded_file( $_FILES['image']['tmp_name'] , $destination )) {
			Response::json(['content'=>$filename], 200);
		}else{
			Response::json(['status'=>'error', 'message'=>'gagal upload file'], 401);
		}
		
	}

}