<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ire Admin</title>

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
                <h1 class="page-header">메인배너</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        메인배너 수정
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="/admin/banner/main/update/<?=$main_banner->banner_id?>" method="POST">
                            <div class="form-group">
                                <label>TEXT1</label>
                                <textarea class="form-control"
                                          placeholder="TEXT1"
                                          name="text1"><?=$main_banner->text1?></textarea>
                            </div>

                            <div class="form-group">
                                <label>TEXT2</label>
                                <textarea class="form-control"
                                          placeholder="TEXT2"
                                          name="text2"><?=$main_banner->text2?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Button TEXT</label>
                                <input class="form-control"
                                       placeholder="button text"
                                       value="<?=$main_banner->button_text?>"
                                       name="button_text">
                            </div>

                            <div class="form-group">
                                <label>링크</label>
                                <input class="form-control"
                                       placeholder="링크"
                                       value="<?=$main_banner->link?>"
                                       name="link">
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

                <button class="btn btn-primary" id="btn_update">수정</button>
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
    <!-- Custom Theme JavaScript -->
    <script src="/bootstrap_admin/dist/js/sb-admin-2.js"></script>

    <script>
        $(function (){
            $('#btn_update').click(function (){
                if( $('input[name="button_text"]').val() == '' ) {
                    alert("버튼 텍스트를 입력하세요.");
                    return;
                }

                if( $('input[name="link"]').val() == '' ) {
                    alert("링크를 입력하세요.");
                    return;
                }

                $('form').submit();
            });
        });
    </script>

</body>

</html>
