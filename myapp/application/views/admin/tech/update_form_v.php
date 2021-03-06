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
                <h1 class="page-header">기술현황</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        기술현황 추가
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form action="/admin/tech/update/<?=$tech->tech_id?>" method="POST">
                            <div class="form-group">
                                <label>기술현황 이름</label>
                                <input class="form-control"
                                       placeholder="기술현황 이름"
                                       value="<?=$tech->tech_name?>"
                                       name="tech_name">
                            </div>

                            <div class="form-group">
                                <label>기술현황 일련번호</label>
                                <input class="form-control"
                                       placeholder="기술현황 일련번호"
                                       value="<?=$tech->tech_number?>"
                                       name="tech_number">
                            </div>

                            <div>
                                <label>기술현황 이미지</label>
                                <input type="file"
                                       id="tech_image_file"
                                       onchange="upload_image('tech_image_file', 'tech_image')"/>
                                <input type="hidden"
                                       name="tech_image"
                                       id="tech_image"
                                       value="<?=$tech->tech_image?>"/>
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
                if( $('input[name="tech_name"]').val() == '' ) {
                    alert("기술현황 이름을 입력해주세요.");
                    return;
                }

                if( $('input[name="tech_number"]').val() == '' ) {
                    alert("기술현황 일련번호를 입력해주세요.");
                    return;
                }

                if( $('input[name="tech_image"]').val() === '' ) {
                    alert('기술현황 이미지를 선택해주세요.');
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
                url: "/admin/tech/upload_tech_image",
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
