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
                            제품 추가
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="/admin/product/insert_product" method="POST">
                                <div class="form-group">
                                    <label>제품 이름</label>
                                    <input class="form-control" placeholder="제품 이름" name="name">
                                </div>

                                <div class="form-group">
                                    <label>제품 이미지</label>
                                    <input id="upload" type="file" onchange="upload_image()"/>
                                    <input name="product_image" type="hidden" value="" />
                                </div>

                                <div class="form-group" >
                                    <label>상품 카테고리</label>
                                    <select class="form-control" id="primary_category">
                                        <?php foreach($primary_category as $category): ?>
                                            <option value="<?php echo $category->id;?>">
                                                <?php echo $category->name;?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>

                                    <select class="form-control" name="category" id="category">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>규격</label>
                                    <input class="form-control" placeholder="50cm(w) x 100cm(h) x 60cm" name="size">
                                </div>

                                <div class="form-group">
                                    <label>재질</label>
                                    <input class="form-control" placeholder="참나무" name="quality">
                                </div>

                                <div class="form-group">
                                    <label>특징</label>
                                    <input class="form-control" name="feature">
                                </div>

                                <div class="form-group">
                                    <label>상세</label>
                                    <textarea class="form-control" name="detail"></textarea>
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
            CKEDITOR.replace( 'detail', {
                customConfig: '/js/ckeditor/config.js'
            } );

            $('#cur_category').change(function (){
                $('form').submit();
            });

            $('#primary_category').change( function () {
                var parent_category = $('#primary_category option:selected').val();

                $.ajax({
                    type: "GET",
                    url: "/admin/product/get_product_category/" + parent_category,
                    success: function (data) {
                        $('#category').html('');

                        var category_list = $.parseJSON(data);
                        $.each(category_list, function( index, value ) {
                            $('<option></option>').val(value.id)
                                .text(value.name)
                                .appendTo('#category');
                        });
                    }
                });
            });
            $('#primary_category').trigger('change');

            $('#btn_insert').click(function (){
                if( $('input[name="name"]').val() == '' ) {
                    alert("제품 이름을 입력해주세요.");
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
                url: "/admin/product/upload_product_image",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.search("ERROR") !== -1) {
                        alert(data);
                        return false;
                    }

                    $('input[name="product_image"]').val(data);
                }
            });
        }
    </script>

</body>

</html>
