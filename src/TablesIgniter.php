<?php namespace tablesigniter;
/**
 * TablesIgniter
 *
 * TablesIgniter 基於 CodeIgniter4 。它將可以幫助你在 使用 server side mode 中使用 jQuery Datatables。 
 * TablesIgniter based on CodeIgniter4. This  library will help you use jQuery Datatables in server side mode.
 * @package    CodeIgniter
 * @subpackage libraries
 * @category   library
 * @version    1.0
 * @author    monkenWu <610877102@mail.nknu.edu.tw>
 * @link      https://github.com/monkenWu/TablesIgniter
 *        
 */

use Closure;

class TablesIgniter{

    protected $db;
    protected $builder;
    protected $outputColumn;
    protected $defaultOrder = [];
    protected $searchLike = false;

    public function __construct(&$db){
        $this->db =& $db;
    }

    public function setTable(Closure $fun){
        $this->builder = $fun($this->db);
        return $this;
    }

    public function setSearch(array $like){
        $this->searchLike = $like;
        return $this;
    }

    /**
     * 設定預設排序項目
     * 
     * @param string $item
     * @param string $type
     * @return mixed
     */
    public function setDefaultOrder($item,$type="ASC"){
        $this->defaultOrder[] = array($item, $type);
        return $this;
    }

    /**
     * 設定實際輸出的序列
     * @param array $columns
     * @return mixed
     */
    public function setOutput(array $column){
        $this->outputColumn = $column;
        return $this;
    }

    /**
     * 搜索總筆數
     */
    private function getFiltered(){
        $bui = $this->extraConfig($this->builder);
        $query = $bui->countAll();  
        return $query; 
    }

    /**
     * 總筆數
     */
    private function getTotal(){
        //$this->extra_config();
        $bui = $this->builder;
        $query = $bui->countAllResults();  
        return $query;  
    }

    /**
     * 執行查詢
     * 在此停止ci->db類別紀錄規則
     * @return  array
     */
    private function getQuery(){
        $bui = $this->extraConfig($this->builder);
        if(isset($_POST["length"])){
            if($_POST["length"] != -1) {  
                $bui->limit($_POST['length'], $_POST['start']);
            }
        }
        $query = $bui->get();
        return $query;
    }

    /**
     * 合成每列資料的內容。
     * 
     * @param array $row
    * @return array     
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
     * 查詢是否有有排序或搜索的要求
     */
    private function extraConfig($bui){
        if(!empty($_POST["search"]["value"])){  
            foreach ($this->searchLike as $field) {
                $bui->orLike($field,$_POST["search"]["value"]);
            }
        }
        if(isset($_POST["order"])){  
            $bui->orderby($_POST['order']['0']['column'], $_POST['order']['0']['dir']);  
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
     * @return string
     */
    public function getDatatable(){
        if($result = $this->getQuery()){
            $data = array();
            //print_r($result->getResult('array'));
            foreach ($result->getResult('array') as $row){
                $data[] = $this->getOutputData($row);
            }
            $output = array(
                "draw" => (int)$_POST["draw"] ?? -1,
                "recordsTotal" => $this->getTotal(),
                "recordsFiltered" => $this->getFiltered(),
                "data" => $data
            );
            return json_encode($output);
        }
        return $data;
    }

}