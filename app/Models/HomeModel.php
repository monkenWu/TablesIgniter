<?php namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model {

    public $db;

    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function noticeTable(){
        $closureFun =  function(&$db){
            return $db->table("news");
        };
        return $closureFun;
    }

    public function noticeButton(){
        $closureFun = function(array $row){
            return <<<EOF
                <button onclick="delNews('{$row["id"]}')">del</button>
            EOF;
        };
        return $closureFun;
    }

}
