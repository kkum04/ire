<!doctype html>

<html>
<head>
    <title>이레스위치</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link href="/static/css/common.css" type="text/css" rel="stylesheet">
    <link href="/static/css/main.css" type="text/css" rel="stylesheet">
    <link href="/static/css/tab.css" type="text/css" rel="stylesheet">
    <link href="/static/css/m.css" type="text/css" rel="stylesheet">
    <link href="/static/css/sub.css" type="text/css" rel="stylesheet">
    <link href="/static/css/sub_tab.css" type="text/css" rel="stylesheet">
    <link href="/static/css/sub_m.css" type="text/css" rel="stylesheet">


    <script src="/static/js/jquery-3.3.1.js"></script>
    <script src="/static/js/common.js"></script>
</head>

<body>
<div id="wrap">
    <?php echo $this->header ?>
    <!--sub_navi-->
    <div id="sub_nav">
        <div class="container">
            <ul>
                <li class="sub_nav_home">
                    <a href="/"></a>
                </li>
                <li class="sub_nav_dp1 dp1_1">
                    <a href="#">
                        제품소개
                    </a>
                    <ul class="sub_nav_dp2 dp2_1">
                        <li>
                            <a href="/company/ceo">회사소개</a>
                        </li>
                        <li>
                            <a href="/tech">기술현황</a>
                        </li>
                        <li>
                            <a href="/customer">고객지원</a>
                        </li>
                    </ul>
                </li>
                <li class="sub_nav_dp1 dp1_3">
                    <a href="#">
                        PULL CORD SWITCH
                    </a>
                    <ul class="sub_nav_dp2 dp2_2">
                        <?php foreach($cur_category_products as $category_product): ?>
                        <li>
                            <a href="<?="/product/detail/{$category_product->product_id}"?>">
                                <?=$category_product->product_name?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--//sub_navi-->

    <section>
        <article class="sub_bg" id="product_dt_pull">
            <div class="container">
                <h3 class="sub_title"><?=$product->category_name?></h3>
                <div class="sub_content_box">
                    <div class="prod_detail_wrap">
                        <div class="prod_detail intro">
                            <div class="intro_img">
                                <img src="<?=$product->product_image?>" alt="제품 이미지"/>
                            </div>

                            <div class="intro_box">
                                <dl class="intro_title">
                                    <dt><?=$product->category_name?></dt>
                                    <dd><?=$product->product_name.' '.$product->product_type?></dd>
                                </dl>
                                <div class="intro_btn">
                                    <?php if($product->description_file): ?>
                                    <a href="<?=$product->description_file?>" target="_blank" alt="제품설명서">
                                        제품설명서
                                    </a>
                                    <?php endif;?>


                                    <?php if($product->cad_file):?>
                                    <a href="<?=$product->cad_file?>" target="_blank" alt="외형도">
                                        외형도(Auto-CAD)
                                    </a>
                                    <?php endif;?>
                                </div>

                                <?php if($product->description != ''): ?>
                                <div class="intro_txt">
                                    <?=$product->description?>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>

                        <?php if($product->product_spec): ?>
                        <div class="prod_detail spec">
                            <h4><span>제품사양</span></h4>
                            <ul>
                                <?php foreach(explode("\n", $product->product_spec) as $line): ?>
                                <li><?=$line?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif;?>

                        <?php if($product->product_feature != ''): ?>
                        <div class="prod_detail feat">
                            <h4><span>제품특징</span></h4>
                            <ul>
                                <?php foreach(explode("\n", $product->product_feature) as $line): ?>
                                    <li><?=$line?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="btn_list">
                        <a href="/category/<?=$product->category_id?>">
                            목록
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <?php echo $this->footer ?>
    <?php echo $this->sitemap ?>
</div>
<script>
    $( function () {
        $('.exp_btn.prod_dt_exp').click( function () {
            $('.pu.expend').fadeIn(300);
        });

        $('.pu,.close_btn').click( function () {
            $('.pu.expend').fadeOut(300);
        })
    });
</script>


</body>
</html>