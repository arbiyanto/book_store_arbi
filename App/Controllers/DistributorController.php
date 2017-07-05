<?php

namespace App\Controllers;

use Library\Controller;
use Library\Request;
use Library\Response;
use Library\App;
use Library\Auth;

use App\Models\Distributor;

class DistributorController extends Controller{

	public function getDistributor($id) {
		$d = new Distributor;
		$data = $d->where('id', $id)->first();

		if($data) {
			return Response::json($data, 200);	
		}else{
			return Response::json(['status'=>'error','message'=>'gagal untuk load data'], 401);
		}	
	}

	public function getAllDistributor() {
		$Distributor = new Distributor;
		$data = $Distributor->select('id', 'distributor_name')->get();

		if($data) {
			return Response::json($data, 200);	
		}else{
			return Response::json(['status'=>'error','message'=>'gagal untuk load data'], 401);
		}
	}

	public function store() {
		$request = Request::all();

		$Distributors = new Distributor;

		$insert = $Distributors->create($request);

		$lastId = $Distributors->lastId();

		$request = array_merge(['id'=>$lastId], $request);

		if($insert){
			$data['status'] = "success";
			$data['message'] = "Distributor berhasil ditambahkan";
			$data['distributor'] = $request;
			$status = 200;
		}else{
			$data['status'] = "error";
			$data['message'] = "Distributor gagal ditambahkan";
			$status = 401;
		}

		return Response::json($data, $status);
	}

	public function update($id) {
		$request = Request::all();

		if(isset($request['date'])) {
			$request['date'] = strtotime($request['date']);
		}

		$update = new Distributor;
		$update->where('id', $id)->save($request);

		if($update){
			$data['status'] = "success";
			$data['message'] = "Distributor berhasil diubah";
			$data['distributor'] = $request;
		}else{
			$data['status'] = "error";
			$data['message'] = "Distributor gagal diubah";
		}

		return Response::json($data);
	}

	public function delete($id) {
		$delete = new Distributor;
		$delete->where('id', $id)->delete();

		if($delete){
			$data['status'] = "success";
			$data['message'] = "Distributor berhasil dihapus";
		}else{
			$data['status'] = "error";
			$data['message'] = "Distributor gagal dihapus";
		}

		return Response::json($data);
	}

}