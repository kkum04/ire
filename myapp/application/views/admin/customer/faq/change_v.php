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
                    <h1 class="page-header">FAQ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            FAQ 수정
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="/admin/customer/faq/update/<?php echo $faq_info->id?>" method="POST">
                                <div class="form-group">
                                    <label>제목</label>
                                    <input class="form-control"
                                           placeholder="FAQ 제목"
                                           name="title"
                                           value="<?php echo $faq_info->title?>">
                                </div>

                                <div class="form-group">
                                    <label>내용</label>
                                    <textarea class="form-control" name="contents" rows="10"><?php echo $faq_info->contents ?></textarea>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <button class="btn btn-primary" id="btn_change">수정</button>
                    <a class="btn btn-primary" href="/admin/customer/faq/lists">목록</a>
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

    <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

    <script>
        $(function (){
            $('#btn_change').click(function (){
                if( $('input[name="title"]').val() == '' ) {
                    alert("FAQ 제목을 입력해 주세요.");
                    return;
                }

                if( $('[name="contents"]').val() == '' ) {
                    alert('FAQ 내용을 입력해 주세요.');
                    return;
                }

                $('form').submit();
            });
        });

    </script>

</body>

</html>
