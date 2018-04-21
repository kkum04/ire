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
                    <h1 class="page-header">제품</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            제품 수정
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <form action="/admin/product/update/<?=$product->product_id?>" method="POST">
                                <div class="form-group">
                                    <label>제품 이름</label>
                                    <input class="form-control"
                                           placeholder="제품 이름"
                                           value="<?=$product->product_name?>"
                                           name="product_name">
                                </div>

                                <div>
                                    <label>제품 이미지</label>
                                    <input type="file"
                                           id="product_image_file"
                                           onchange="upload_image('product_image_file', 'product_image')"/>
                                    <input type="hidden"
                                           value="<?=$product->product_image?>"
                                           name="product_image"
                                           id="product_image" />
                                </div>

                                <div class="form-group">
                                    <label>제품 카테고리</label>
                                    <select class="form-control" name="category_id">
                                        <?php
                                        foreach($categories as $category)
                                        {
                                            if( $product->category_id == $category->category_id ) {
                                                echo "<option value='{$category->category_id}' selected>{$category->category_name}</option>";
                                            }else {
                                                echo "<option value='{$category->category_id}'>{$category->category_name}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>제품 설명서</label>
                                    <input type="file"
                                           id="description_image_file"
                                           onchange="upload_image('description_image_file', 'description_file')"/>
                                    <input type="hidden"
                                           value="<?=$product->description_file?>"
                                           name="description_file"
                                           id="description_file" />
                                </div>

                                <div class="form-group">
                                    <label>외형도</label>
                                    <input type="file"
                                           id="cad_image_file"
                                           onchange="upload_image('cad_image_file', 'cad_File')" />
                                    <input type="hidden"
                                           value="<?=$product->cad_file?>"
                                           name="cad_file"
                                           id="cad_File"/>
                                </div>

                                <div class="form-group">
                                    <label>제품 설명</label>
                                    <textarea name="description" class="form-control"><?=$product->description?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>제품 사양</label>
                                    <textarea name="product_spec" class="form-control"><?=$product->product_spec?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>제품 특징</label>
                                    <textarea name="product_feature" class="form-control"><?=$product->product_feature?></textarea>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <button class="btn btn-primary" id="btn_change">수정</button>
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
            $('#btn_change').click(function (){
                if( $('input[name="product_name"]').val() === '' ) {
                    alert('제품 이름을 입력해주세요.');
                    return;
                }

                if( $('input[name="product_image"]').val() === '' ) {
                    alert('제품 이미지를 입력해주세요.');
                    return;
                }

                $('form').submit();
            });
        });

        function upload_image(fieldId, inputId) {
            var formData = new FormData();

            formData.append('upload_field', 'upload');
            formData.append('upload', $("#" + fieldId)[0].files[0]);

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

                    $('#' + inputId).val(data);
                }
            });
        }
    </script>

</body>

</html>
