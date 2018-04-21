<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>61 Timber Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap_admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/bootstrap_admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/bootstrap_admin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/bootstrap_admin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/bootstrap_admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bootstrap_admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php echo $this->left_menu;?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">제품</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            제품 목록
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="/admin/product" class="row" method="get">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label>상품 카테고리</label>
                                        <select class="form-control" id="cur_category" name="cur_category">
                                            <?php foreach($categories as $category)
                                            {
                                                if( $category->category_id == $cur_category_id ) {
                                                    echo "<option value='{$category->category_id}' selected>{$category->category_name}</option>";
                                                } else {
                                                    echo "<option value='{$category->category_id}'>{$category->category_name}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>



                            <table width="100%" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>순서</th>
                                        <th>카테고리</th>
                                        <th>이름</th>
                                        <th>수정</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($products as $product): ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <a class="btn btn-primary"
                                               href="/admin/product/update_order/<?=$product->product_id?>/prev">
                                                ▲
                                            </a>
                                            <a class="btn btn-primary"
                                               href="/admin/product/update_order/<?=$product->product_id?>/next">
                                                ▼
                                            </a>
                                        </td>
                                        <td><?=$product->category_name?></td>
                                        <td><?=$product->product_name?></td>
                                        <td>
                                            <a class="btn btn-default"
                                               href="/admin/product/update_form/<?=$product->product_id?>">
                                                수정
                                            </a>
                                            <a class="btn btn-danger btn_delete_category"
                                                href="/admin/product/delete/<?=$product->product_id?>">
                                                삭제
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>

                            <a class="btn btn-default"
                               href="/admin/product/create_form">
                                추가
                            </a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/bootstrap_admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bootstrap_admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/bootstrap_admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="/bootstrap_admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/bootstrap_admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="/bootstrap_admin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/bootstrap_admin/dist/js/sb-admin-2.js"></script>


    <script>
        $(function (){
            $('.btn_delete_category').click(function (){
                return confirm("제품을 삭제 하시겠습니까?");
            });

            $('#cur_category').change(function (){
                $('form').submit();
            });
        });
    </script>

</body>

</html>
