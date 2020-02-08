<div class="card">
    <div class="card-body row">
        <div class="col-sm-12 col-md-6">
            <h5 class="card-title">快速開始</h5>
            <p class="card-text">建置簡單的 server-side processing mode DataTables</p>
            <table id="firstTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
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
                    <a class="nav-link active" data-toggle="tab" href="#ex-html-1" role="tab" aria-selected="true">HTML</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-js-1" role="tab" aria-selected="false">JavaScript</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-con-1" role="tab" aria-selected="false">Controller</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-model-1" role="tab" aria-selected="false">Model</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#ex-sql-1" role="tab" aria-selected="false">SQL</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ex-html-1" role="tabpanel">
                    <pre><code class="html"><?=htmlentities(
                        <<<EOF
                        <table id="firstTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>title</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                        </table>
                        EOF);
                    ?></code></pre>
                </div>
                <div class="tab-pane fade" id="ex-js-1" role="tabpanel">
                    <pre><code class="javascript"><?=htmlentities(
                        <<<EOF
                        $('#firstTable').DataTable({
                            "aoColumnDefs": [{ 
                                "bSortable": false,
                                "aTargets": [ 0,1,2 ] 
                            }],
                            "order":[],
                            "serverSide":true,
                            "searching": false,
                            "lengthChange":false,
                            "ajax":{
                                url:"<?=base_url('home/firstTable')?>",
                                type:'POST'
                            }
                        });
                        EOF);
                    ?></code></pre>
                </div>
                <div class="tab-pane fade" id="ex-con-1" role="tabpanel">
                    <pre><code class="php"><?= htmlentities(
                    <<<EOF
                    public function firstTable(){
                        \$model = new HomeModel();
                        \$table = new TablesIgniter();
                        \$table->setTable(\$model->noticeTable())
                              ->setOutput(["id","title","slug"]);
                        return \$table->getDatatable();
                    }
                    EOF);
                    ?></code></pre>
                    <ol>
                        <li>
                            呼叫 setTable() 方法必須傳入 <a href="https://codeigniter4.github.io/CodeIgniter4/database/query_builder.html" target="_blank">Query Builder</a> 物件，TablesIgniter 倚賴這個物件所定義的資料庫查詢內容。這個物件通常會在 Model 宣告。
                        </li>
                        <li>
                            呼叫 setOutput() 方法必須傳入陣列，陣列的順序將會影響到 DataTables 所呈現資料的順序，字串的定義與 setTable() 所查詢的結果的欄位名稱必須相同。
                        </li>
                        <li>
                            呼叫 getDatatable() 將會獲得符合 jQuery DataTables 要求的 json 字串。
                        </li>
                    </ol>
                </div>
                <div class="tab-pane fade" id="ex-model-1" role="tabpanel" >
                    <pre><code class="php"><?= htmlentities(
                    <<<EOF
                    public function noticeTable(){
                        \$builder = \$this->db->table("news");
                        return \$builder;
                    }
                    EOF);
                    ?></code></pre>
                    <ol>
                        <li>你可以自由使用 <a href="https://codeigniter4.github.io/CodeIgniter4/database/query_builder.html" target="_blank">Query Builder</a> 的所有方法，滿足你對資料庫查詢的所有需求，最後必須回傳 Query Builder 產生的物件。</li>
                    </ol>
                </div>
                <div class="tab-pane fade" id="ex-sql-1" role="tabpanel" >
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
            </div>

        </div>
    </div>
</div>
<script>
    $('#firstTable').DataTable({
        "aoColumnDefs": [{ 
            "bSortable": false,
            "aTargets": [ 0,1,2 ] 
        }],
        "order":[],
        "serverSide":true,
        "searching": false,
        "lengthChange":false,
        "ajax":{
            url:"<?=base_url('home/firstTable')?>",
            type:'POST'
        }
    });
</script>