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
                    <a href="#"></a>
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
                        <?=$category->category_name?>
                    </a>
                    <ul class="sub_nav_dp2  dp2_2">

                        <?php foreach($categories as $cur_category): ?>
                        <li>
                            <a href="/category/<?=$cur_category->category_id?>"><?= $cur_category->category_name?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--//sub_navi-->

    <section>
        <article class="sub_bg" id="product_lst_belt">
            <div class="container">
                <h3 class="sub_title"><?=$category->category_name?></h3>
                <div class="sub_content_box">
                    <ul>
                        <li class="prod row">
                            <ul class="prod col">
                                <?php foreach($category_products as $product):?>
                                <li>
                                    <a href="/product/detail/<?=$product->product_id?>">
                                        <img class="prod img" src="<?=$product->product_image?>" />
                                        <div class="prod txt">
                                            <?=$product->product_name.' '.$product->product_type?>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </article>
    </section>

    <?php echo $this->footer ?>
    <?php echo $this->sitemap ?>
</div>

</body>
</html>