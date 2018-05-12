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
                        기술현황
                    </a>
                    <ul class="sub_nav_dp2 dp2_1">
                        <li>
                            <a href="/category">제품소개</a>
                        </li>
                        <li>
                            <a href="/tech">기술현황</a>
                        </li>
                        <li>
                            <a href="/customer">고객지원</a>
                        </li>
                    </ul>
                </li>
                <li class="sub_nav_dp1 dp1_2 narr">
                    <a href="#">
                        기술현황
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--//sub_navi-->

    <section>
        <article class="sub_bg" id="technique">
            <div class="container">
                <h3 class="sub_title">기술현황</h3>
                <div class="sub_content_box">
                    <ul>
                        <?php
                        $sub_teches = array_chunk($teches, 4);
                        ?>

                        <?php foreach($sub_teches as $teches): ?>
                        <li class="tech row">
                            <ul class="tech col">
                                <?php foreach($teches as $tech):?>
                                <li>
                                    <img class="tech img" src="<?=$tech->tech_image?>"/>
                                    <dl class="tech txt">
                                        <dt><?=$tech->tech_name?></dt>
                                        <dd><?=$tech->tech_number?></dd>
                                    </dl>
                                    <a class="exp_btn" href="#"></a>
                                    <a class="dl_btn" href="<?=$tech->tech_image?>" target="_blank" download></a>
                                    <div class="pu expend">
                                        <div class="pu_wrap tech_wrap">
                                            <a class="close_btn" href="#">
                                                <img src="/static/images/common/close_btn.png"/>
                                            </a>
                                            <div class="tech_expand">
                                                <img src="<?=$tech->tech_image?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </article>
    </section>

    <?php
    echo $this->footer;
    echo $this->sitemap;
    ?>

</div>


<script>
    $(function () {
        $('.exp_btn').click(function () {
            $(this).parent('li').find('.pu.expend').fadeIn(300);
        });

        $('.pu,.close_btn').click(function () {
            $('.pu.expend').fadeOut(300);
        })
    });
</script>

</body>
</html>