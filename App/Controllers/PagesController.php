<?php

namespace App\Controllers;

use Library\Controller;
use Library\Auth;
use Library\App;
use App\Models\Book;
use Library\Response;

class PagesController extends Controller{

	public function __construct() {
		$this->middleware('auth', ['only'=>['adminDashboard']]);
		$this->middleware('adminOnly', ['only'=>['adminDashboard']]);
	}

	public function adminadmin() {
		return Response::redirect('admin/login');
	}

	public function index() {
		$newbooks = App::get('database')
		->table('books')
		->select('id','title','author','sellprice','discount','tax','picture')
		->orderBy('date', 'DESC')
		->limit('6')
		->get();

		$bestseller = App::get('database')
		->table('book_to_labels')
		->select('books.*', 'book_to_labels.book_id','book_to_labels.label_id')
		->join('books', 'book_to_labels.book_id', '=', 'books.id')
		->where('book_to_labels.label_id', '1')
		->limit('6')
		->get();

		for($x=0;$x < count($newbooks); $x++){
			$newbooks[$x]->price = number_format(ceil($newbooks[$x]->sellprice + ($newbooks[$x]->sellprice * $newbooks[$x]->tax / 100)
			- ($newbooks[$x]->sellprice * $newbooks[$x]->discount / 100) ), 0, ',','.' );
			if(strlen($newbooks[$x]->title) > 37) {
				$newbooks[$x]->title = substr($newbooks[$x]->title,0,38).'...';
			}
		}

		for($y=0;$y < count($bestseller); $y++){
			$bestseller[$y]->price = number_format(ceil($bestseller[$y]->sellprice + ($bestseller[$y]->sellprice * $bestseller[$y]->tax / 100)
			- ($bestseller[$y]->sellprice * $bestseller[$y]->discount / 100) ), 0, ',','.' );
			if(strlen($bestseller[$y]->title) > 37) {
				$bestseller[$y]->title = substr($bestseller[$y]->title,0,38).'...';
			}
		}

		

		return view('page/public/home', ['newbooks'=>$newbooks, 'bestseller'=>$bestseller]);
	}

	public function booksList() {
		if(isset($_GET['label'])) {
			$book = new Book;
			$data = $book->orderBy('date', 'DESC')->get();

			$sort = '"Terlaris"';
		}else {
			$book = new Book;
			$data = $book->orderBy('date', 'DESC')->get();

			$sort = '"Terbaru"';
		}

		for($x=0;$x < count($data); $x++){
			$data[$x]->price = number_format(ceil($data[$x]->sellprice + ($data[$x]->sellprice * $data[$x]->tax / 100)
			- ($data[$x]->sellprice * $data[$x]->discount / 100) ), 0, ',','.' );
			if(strlen($data[$x]->title) > 37) {
				$data[$x]->title = substr($data[$x]->title,0,38).'...';
			}
		}

		return view('page/public/books-list', ['data'=> $data,'sort'=>$sort]);
	}

	public function booksDetail($id) {
		$book = new Book;
		$data = $book
		->select('books.*', 'categories.category_name')
		->join('categories', 'books.category_id','=','categories.id')
		->where('books.id', $id)
		->first();

		$data->label = App::get('database')
		->table('book_to_labels')
		->where('book_to_labels.book_id', $id)
		->join('labels', 'book_to_labels.label_id','=', 'labels.id')
		->get();

		$other_book = [];
		if(count($data->label) > 0){
			foreach($data->label as $l) {
				if(count($other_book) > 0) {
					$t = App::get('database')
					->table('book_to_labels')
					->select('book_to_labels.label_id','book_to_labels.book_id','books.title','books.*')
					->where('book_to_labels.label_id', $l->label_id)
					->where('book_to_labels.book_id', '<>', $data->id)
					->join('books', 'book_to_labels.book_id','=','books.id')
					->limit('4')
					->get();

					array_merge($other_book, $t);
				}else {
					$other_book = App::get('database')
					->table('book_to_labels')
					->select('book_to_labels.label_id','book_to_labels.book_id','books.title','books.*')
					->where('book_to_labels.label_id', $l->label_id)
					->where('book_to_labels.book_id', '<>', $data->id)
					->join('books', 'book_to_labels.book_id','=','books.id')
					->limit('4')
					->get();
				}
				
				if(count($other_book) >= 4) {

					if(count($other_book) > 4) {
						for($x=4; $x < count($other_book); $x++) {
							unset($other_book[$x]);
						}
					}

					break;
				}
			}
		}
		
		if(count($other_book) < 4) {
			$other_book = App::get('database')
			->table('books')
			->where('category_id', $data->category_id)
			->where('id', '<>', $data->id)
			->orWhere('publisher', $data->publisher)
			->where('id', '<>', $data->id)
			->limit('4')
			->get();
		}

		$data->price = number_format(ceil($data->sellprice + ($data->sellprice * $data->tax / 100)
			- ($data->sellprice * $data->discount / 100) ), 0, ',','.' );

		$data->sellprice = number_format($data->sellprice, 0, ',', '.');

		$data->status_stock = ($data->stock > 0 ) ? 'Stok '.$data->stock : 'Stok Habis';
		return view('page/public/books-detail',['title'=> 'Buku '.$data->title ,'data' => $data,'other_books'=> $other_book]);
	}

	public function cart() {
		return view('page/public/carts');
	}

	public function dashboard() {

		return view('page/public/dashboard');
	}

	public function adminDashboard() {
		return view('page/admin/dashboard', [], 'admin');
	}

}