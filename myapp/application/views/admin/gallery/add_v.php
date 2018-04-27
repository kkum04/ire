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
                    <h1 class="page-header">갤러리</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            갤러리 추가
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="/admin/gallery/insert_gallery" method="POST">
                                <div class="form-group">
                                    <label>갤러리 제목</label>
                                    <input class="form-control" placeholder="갤러리 제목" name="title">
                                </div>

                                <div class="form-group">
                                    <label>갤러리 이미지</label>
                                    <input id="upload" type="file" onchange="upload_image()"/>
                                    <input name="image" type="hidden" value="" />
                                </div>

                                <div class="form-group" >
                                    <label>갤러리 카테고리</label>
                                    <select class="form-control" name="category">
                                        <?php foreach($gallery_category_list as $category): ?>
                                            <option value="<?php echo $category->id;?>">
                                                <?php echo $category->name;?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>상세</label>
                                    <textarea class="form-control" name="content"></textarea>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <button class="btn btn-primary" id="btn_insert">추가</button>
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
            CKEDITOR.replace( 'content', {
                customConfig: '/js/ckeditor/config.js'
            } );

            $('#cur_category').change(function (){
                $('form').submit();
            });

            $('#btn_insert').click(function (){
                if( $('input[name="name"]').val() == '' ) {
                    alert("갤러리 이름을 입력해주세요.");
                    return;
                }

                $('form').submit();
            });
        });

        function upload_image() {
            var formData = new FormData();

            formData.append('upload_field', 'upload');
            formData.append('upload', $("#upload")[0].files[0]);

            $.ajax({
                type: "POST",
                url: "/admin/gallery/upload_gallery_image",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.search("ERROR") !== -1) {
                        alert(data);
                        return false;
                    }

                    $('input[name="image"]').val(data);
                }
            });
        }
    </script>

</body>

</html>
