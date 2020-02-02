<!DOCTYPE html>
<html>
<head>
    <title>tableIgniter example</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h2>ex1</h2>
    <table id="newsTable">
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>slug</th>
            </tr>
        </thead>
    </table>
    <table id="newsTablePaging">
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>slug</th>
            </tr>
        </thead>
    </table>
    <script>
        $('#newsTable').DataTable({
            "aoColumnDefs": [{ 
                "bSortable": false,
                "aTargets": [ 0 ] 
            }],
            "order": [],
            "serverSide":true,
            "ajax":{
                url:"<?=base_url('home/useTable')?>",
                type:'POST'
            }
        });

    </script>
</body>
</html>
