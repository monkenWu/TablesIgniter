<?php namespace App\Controllers;

use App\Models\HomeModel;
use monken\TablesIgniter;

class Home extends BaseController{
  	
	public function index(){
		return view('Home_view');
	}

	public function useTable(){
		$model = new HomeModel();
		$table = new TablesIgniter($model->db);
		$table->setTable($model->noticeTable())
			  ->setDefaultOrder("id","DESC")
			  ->setSearch(["title","slug"])
			  ->setOutput([$model->noticeButton(),
						    "title",
							"slug"]);
		echo $table->getDatatable();
	}
}
