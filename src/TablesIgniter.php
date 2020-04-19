<?php namespace monken;
/**
 * TablesIgniter
 *
 * TablesIgniter 基於 CodeIgniter4 。它將可以幫助你在 使用 server side mode 中使用 jQuery Datatables。 
 * TablesIgniter based on CodeIgniter4. This  library will help you use jQuery Datatables in server side mode.
 * @package    CodeIgniter4
 * @subpackage libraries
 * @category   library
 * @version    1.1.0
 * @author    monkenWu <610877102@mail.nknu.edu.tw>
 * @link      https://github.com/monkenWu/TablesIgniter
 *        
 */

use Closure;

class TablesIgniter{

    protected $builder;
    protected $outputColumn;
    protected $defaultOrder = [];
    protected $searchLike = [];
    protected $order = [];

    public function __construct(array $init = []){
        if(!empty($init)){
            if(isset($init["setTable"]))
                $this->setTable($init["setTable"]);
            if(isset($init["setOutput"]))
                $this->setOutput($init["setOutput"]);
            if(isset($init["setDefaultOrder"])){
                foreach ($init["setDefaultOrder"] as $value) {
                    $this->setDefaultOrder($value[0],$value[1]);
                }
            }
            if(isset($init["setSearch"]))
                $this->setSearch($init["setSearch"]);
            if(isset($init["setOrder"]))
                $this->setOrder($init["setOrder"]);
        }
    }

    /**
     * 設定欄位
     */
    public function setTable($builder){
        $this->builder = clone $builder;
        return $this;
    }

    /**
     * 設定參與搜索欄位
     */
    public function setSearch(array $like){
        $this->searchLike = $like;
        return $this;
    }

    /**
     * 設定排序項目
     */
    public function setOrder(array $order){
        $this->order = $order;
        return $this;
    }

    /**
     * 設定預設排序項目
     */
    public function setDefaultOrder($item,$type="ASC"){
        $this->defaultOrder[] = array($item, $type);
        return $this;
    }

    /**
     * 設定實際輸出的序列
     */
    public function setOutput(array $column){
        $this->outputColumn = $column;
        return $this;
    }

    private function getBuilder(){
        return clone $this->builder;
    }

    /**
     * 搜索總筆數
     */
    private function getFiltered(){
        $bui = $this->extraConfig($this->getBuilder());
        $query = $bui->countAllResults();
        return $query; 
    }

    /**
     * 總筆數
     */
    private function getTotal(){
        $bui = $this->getBuilder();
        $query = $bui->countAllResults(); 
        return $query;  
    }

    /**
     * 執行查詢
     * 在此停止ci->db類別紀錄規則
     * @return  array
     */
    private function getQuery(){
        $bui = $this->extraConfig($this->getBuilder());
        if(isset($_POST["length"])){
            if($_POST["length"] != -1) {  
                $bui->limit($_POST['length'], $_POST['start']);
            }
        }
        //print_r($bui);
        $query = $bui->get();
        //print_r($this->getBuilder());
        return $query;
    }

    /**
     * 合成每列資料的內容。
     */
    private function getOutputData($row){
        $subArray = array();
        foreach ($this->outputColumn as $colKey => $data) {
            if(gettype($data) != "string"){
                $subArray[] = $data($row);
            }else{
                $subArray[] = $row[$data];
            }
        }
        return $subArray;
    }

    /**
     * 查詢是否有排序或搜索的要求
     */
    private function extraConfig($bui){
        if(!empty($_POST["search"]["value"])){  
            foreach ($this->searchLike as  $key => $field) {
                if($key == 0){
                    $bui->like($field,$_POST["search"]["value"]);
                }else{
                    $bui->orLike($field,$_POST["search"]["value"]);
                }
            }
        }
        if(isset($_POST["order"])){
            if(!empty($this->order)){
                if($this->order[$_POST['order']['0']['column']] != null){
                    $bui->orderby($this->order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
                }else{
                    if(count($this->defaultOrder)!=0){
                        foreach ($this->defaultOrder as $value) {
                            $bui->orderby($value[0], $value[1]); 
                        }
                    }
                }
            }else{
                if(count($this->defaultOrder)!=0){
                    foreach ($this->defaultOrder as $value) {
                        $bui->orderby($value[0], $value[1]); 
                    }
                }
            }
        }else{
            if(count($this->defaultOrder)!=0){
                foreach ($this->defaultOrder as $value) {
                    $bui->orderby($value[0], $value[1]); 
                }
            }
        }
        return $bui;
    }

    /**
     * 取得完整的Datatable Json字串
     */
    public function getDatatable($isJson=true){
        if($result = $this->getQuery()){
            $data = array();
            foreach ($result->getResult('array') as $row){
                $data[] = $this->getOutputData($row);
            }
            $output = array(
                "draw" => (int)$_POST["draw"] ?? -1,
                "recordsTotal" => $this->getTotal(),
                "recordsFiltered" => $this->getFiltered(),
                "data" => $data
            );
            return $isJson ? json_encode($output) : $output;
        }
        return $data;
    }

}
