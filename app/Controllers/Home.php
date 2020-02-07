<?php namespace App\Controllers;

use App\Models\HomeModel;
use monken\TablesIgniter;

class Home extends BaseController{
  	
	public function index(){
		return view('Home');
	}

	public function firstTable(){
		$model = new HomeModel();
		$table = new TablesIgniter();
		$table->setTable($model->noticeTable())
			  ->setOutput(["id","title","slug"]);
		return $table->getDatatable();
	}

	public function tableSecPattern(){
		$model = new HomeModel();
		$table = new TablesIgniter($model->initTable());
		return $table->getDatatable();
	}

	public function fullTable(){
		$model = new HomeModel();
		$table = new TablesIgniter();
		$table->setTable($model->noticeTable())
			  ->setDefaultOrder("id","DESC")
			  ->setSearch(["title","slug"])
			  ->setOrder([null,"title","slug"])
			  ->setOutput([$model->button(),"title","slug"]);
		return $table->getDatatable();
	}
}
