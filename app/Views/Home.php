<!doctype html>
<html lang="zh-tw">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>tableIgniter example</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://bootstrap.hexschool.com/docs/4.2/examples/album/album.css" rel="stylesheet">
</head>
<body>
    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">TablesIgniter</h1>
                <p class="lead text-muted">
                    TablesIgniter 基於 CodeIgniter4 與 jQuery DataTables<br>
                    快速地建置符合 server-side processing mode 規則的 API
                </p>    
                <p>
                    <a href="#" class="btn btn-primary my-2">使用指南</a>
                    <a href="https://github.com/monkenWu/TablesIgniter" target="_blank" class="btn btn-secondary my-2">Git儲存庫</a>
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Composer 安裝套件</h5>
                                <p class="card-text">在運行著 CodeIgniter4 的專案根目錄下執行：</p>
                                <pre><code class="bash">composer require monken/tablesigniter</code></pre>
                                <h5 class="card-title">Controllers 引入套件</h5>
                                <p class="card-text">在欲使用本套件的控制器宣告：</p>
                                <pre><code class="php">use monken\TablesIgniter;</code></pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="album bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">快速開始</h5>
                                <p class="card-text">建置最精簡的 DataTables</p>
                        
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
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
                                                        <th>slug</th>
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
                                                "serverSide":true,
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
                                            \$table = new TablesIgniter(\$model->db);
                                            \$table->setTable(\$model->noticeTable())
                                                ->setOutput(["id","title","slug"]);
                                            return \$table->getDatatable();
                                        }
                                        EOF);
                                        ?></code></pre>
                                    </div>
                                    <div class="tab-pane fade" id="ex-model-1" role="tabpanel" >
                                        <pre><code class="php"><?= htmlentities(
                                        <<<EOF
                                        public \$db;
                                        public function __construct(){
                                            \$this->db = \Config\Database::connect();
                                        }
                                        public function noticeTable(){
                                            \$closureFun =  function(&\$db){
                                                return \$db->table("news");
                                            };
                                            return \$closureFun;
                                        }
                                        EOF);
                                        ?></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>在使用上發現任何問題，請至 Git 儲存庫進行詢問！</p>
            <p>版權宣告 2020</p>
        </div>
    </footer>
</body>
</html>
