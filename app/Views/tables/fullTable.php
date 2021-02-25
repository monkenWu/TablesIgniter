<div class="card mb-5">
    <div class="card-body row">
        <div class="col-sm-12 col-md-6">
            <h5 class="card-title">完整示範</h5>
            <p class="card-text">建立完整功能的 DataTables，TablesIgniter可以滿足你所需要的「串接HTML」、「搜索」、「排序」等常見功能。</p>
            <table id="fullTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>action</th>
                        <th>title</th>
                        <th>date</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="col-sm-12 col-md-6">
            <h5 class="card-title">程式碼</h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#ex-html-2" role="tab" aria-selected="true">HTML</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-js-2" role="tab" aria-selected="false">JavaScript</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-con-2" role="tab" aria-selected="false">Controller-1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-model-2" role="tab" aria-selected="false">Model-1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-sql-2" role="tab" aria-selected="false">SQL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-con-2-1" role="tab" aria-selected="false">Controller-2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-model-2-1" role="tab" aria-selected="false">Model-2</a>
                </li>
                
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ex-html-2" role="tabpanel">
                    <pre><code class="html"><?=htmlentities(
                        <<<EOF
                        <table id="fullTable">
                            <thead>
                                <tr>
                                    <th>action</th>
                                    <th>title</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        EOF);
                    ?></code></pre>
                </div>
                <div class="tab-pane fade" id="ex-js-2" role="tabpanel">
                    <pre><code class="javascript"><?=htmlentities(
                        <<<EOF
                        $('#fullTable').DataTable({
                            "aoColumnDefs": [{ 
                                "bSortable": false,
                                "aTargets": [ 0,1 ] 
                            }],
                            "order":[],
                            "serverSide":true,
                            "ajax":{
                                url:"<?=base_url('home/fullTable')?>",
                                type:'POST'
                            }
                        });
                        function openInfo(body){
                            $('.modal-body').html(body);
                        }
                        EOF);
                    ?></code></pre>
                </div>
                <div class="tab-pane fade" id="ex-con-2" role="tabpanel">
                    <pre><code class="php"><?= htmlentities(
                    <<<EOF
                    public function fullTable(){
                        \$model = new HomeModel();
                        \$table = new TablesIgniter();
                        \$table->setTable(\$model->noticeTable())
                              ->setDefaultOrder("id","DESC")
                              ->setSearch(["title","date"])
                              ->setOrder([null,null,"date"])
                              ->setOutput([\$model->button(),"title","date"]);
                        return \$table->getDatatable();
                    }
                    EOF);
                    ?></code></pre>
                    <ol>
                        <li>
                            呼叫 setTable() 方法必須傳入 <a href="https://codeigniter4.github.io/CodeIgniter4/database/query_builder.html" target="_blank">Query Builder</a> 物件，TablesIgniter 倚賴這個物件所定義的資料庫查詢內容。這個物件通常會在 Model 宣告。
                        </li>
                        <li>
                            呼叫 setDefaultOrder() 方法必須傳入兩個參數，分別是欄位名稱及排序方法，它影響到的是預設的資料排序方式。若同時讓兩個欄位進行排序，只需重複呼叫這個方法即可。
                        </li>
                        <li>
                            呼叫 setSearch() 方法必須將一個陣列傳入其中。陣列中定義的欄位名稱與執行搜索功能時，TablesIgniter 進行模糊比對的欄位相關。
                        </li>
                        <li>
                            呼叫 setOrder() 方法時必須將一個陣列傳入其中。陣列中所定義的欄位名稱其順序與setOutput() 所輸出的順序相關。若某一列資料不參與排序，則傳入null即可。
                        </li>
                        <li>
                            呼叫 setOutput() 方法必須將一個陣列傳入其中，陣列的順序將會影響到 DataTables 所呈現資料的順序。陣列中字串的定義與 setTable() 所查詢結果的欄位名稱必須相同。
                            若某些欄位有 HTML 串接或者是額外處理資料的需求，setTable() 的陣列也可以將閉包（匿名函數）傳入其中，可以將額外的處裡邏輯寫在閉包內。
                        </li>
                        <li>
                            呼叫 getDatatable() 將會獲得符合 jQuery DataTables 要求的 json 字串。
                        </li>
                    </ol>
                </div>
                <div class="tab-pane fade" id="ex-model-2" role="tabpanel" >
                    <pre><code class="php"><?= htmlentities(
                    <<<EOF
                    public function noticeTable(){
                        \$builder = \$this->db->table("news");
                        return \$builder;
                    }
                    public function button(){
                        \$closureFun = function(\$row){
                            return <<<EOF
                                <button class="btn btn-outline-info" onclick="openInfo('{\$row["body"]}')"  data-toggle="modal" data-target="#exampleModal">info{\$row["id"]}</button>
                            \EOF;
                        };
                        return \$closureFun;
                    }
                    EOF);
                    ?></code></pre>
                    <ol>
                        <li>noticeTable()：你可以自由使用符合 <a href="https://codeigniter4.github.io/CodeIgniter4/database/query_builder.html" target="_blank">Query Builder</a> 語法的所有方法，滿足你對資料庫查詢的所有需求，最後必須回傳 Query Builder 產生的物件。</li>
                        
                        <li>button()：自定資料內容必須使用閉包進行包裝，閉包的引數「 $row 」是資料庫查詢成功的結果，你只能使用陣列造訪從資料庫回傳的資料。請注意，閉包的回傳值必須是字串。</li>
                    </ol>

                </div>
                <div class="tab-pane fade" id="ex-sql-2" role="tabpanel" >
                    <pre><code class="sql"><?= htmlentities(
                    <<<EOF
                    CREATE TABLE `news` (
                        `id` int(11) NOT NULL,
                        `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
                        `date` date NOT NULL,
                        `body` text COLLATE utf8_unicode_ci NOT NULL
                    )
                    EOF);
                    ?></code></pre>
                </div>
                <div class="tab-pane fade " id="ex-con-2-1" role="tabpanel">
                    <pre><code class="php"><?= htmlentities(
                    <<<EOF
                    public function tableSecPattern(){
                        \$model = new HomeModel();
                        \$table = new TablesIgniter(\$model->initTable());
                        return \$table->getDatatable();
                    }
                    EOF);
                    ?></code></pre>
                    <ol>
                        <li>
                            若你希望在 Controller 初始化 TablesIgniter 時就完成所有的設定，請將設定用的陣列傳入其中。在這個情形下，這個陣列通常會在 Model 宣告。
                        </li>
                    </ol>
                </div>
                <div class="tab-pane fade" id="ex-model-2-1" role="tabpanel">
                    <pre><code class="php"><?= htmlentities(
                    <<<EOF
                    public function initTable(){
                        \$builder = \$this->db->table("news");
                        \$setting = [
                            "setTable" => \$builder,
                            "setDefaultOrder" => [
                                ["id","DESC"],
                                ["body","DESC"]
                            ],
                            "setSearch" => ["title","date"],
                            "setOrder"  => [null,null,"date"],
                            "setOutput" => [
                                function(\$row){
                                    return <<<EOF
                                        <button class="btn btn-outline-info" onclick="openInfo('{\$row["body"]}')"  data-toggle="modal" data-target="#exampleModal">info{\$row["id"]}</button>
                                    \EOF;
                                },
                                "title",
                                "date"
                            ]
                        ];
                        return \$setting;
                    } 
                    EOF);
                    ?></code></pre>
                    <ol>
                        <li>
                            initTable() 方法中所定義的陣列，其各項索引名稱與範例 Controller-1 所操作的方法名稱相同，陣列中值的資料結構也是相同的。
                        </li>
                        <li>
                            若你需要，你也可以在初始化時只定義部分內容，再將其他設定移至 Controller 實作，就像 Controller-1 那樣。
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">News Body</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#fullTable').DataTable({
        "aoColumnDefs": [{ 
            "bSortable": false,
            "aTargets": [ 0,1 ] 
        }],
        "order":[],
        "serverSide":true,
        "ajax":{
            url:"<?=base_url('home/fullTable')?>",
            type:'POST'
        }
    });

    function openInfo(body){
        $('.modal-body').html(body);
    }
    
</script>