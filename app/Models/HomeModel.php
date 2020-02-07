<?php namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model {

    protected $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function noticeTable(){
        $builder = $this->db->table("news");
        return $builder;
    }

    public function button(){
        $closureFun = function($row){
            return <<<EOF
                <button class="btn btn-outline-info" onclick="openInfo('{$row["body"]}')"  data-toggle="modal" data-target="#exampleModal">info{$row["id"]}</button>
            EOF;
        };
        return $closureFun;
    }

    public function initTable(){
        $builder = $this->db->table("news");
        $setting = [
            "setTable" => $builder,
            "setDefaultOrder" => [
                ["id","DESC"],
                ["body","DESC"]
            ],
            "setSearch" => ["title","slug"],
            "setOrder"  => [null,"title","slug"],
            "setOutput" => [
                function($row){
                    return <<<EOF
                        <button class="btn btn-outline-info" onclick="openInfo('{$row["body"]}')"  data-toggle="modal" data-target="#exampleModal">info{$row["id"]}</button>
                    EOF;
                },
                "title",
                "slug"
            ]
        ];
        return $setting;
    }

}
