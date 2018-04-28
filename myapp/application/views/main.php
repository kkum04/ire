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

    <script src="/static/js/jquery-3.3.1.js"></script>
    <script src="/static/js/common.js"></script>
</head>

<body>
<div id="wrap">
    <?php echo $this->header ?>
    <figure id="main_visual_wrap">
        <div id="main_visual">
            <?php
            foreach($main_banners as $index => $main_banner):?>
                <div class="visual_bg visual_0<?=$index?>">
                    <div class="container">
                        <div class="inner_main_txt">
                            <h2><?=nl2br($main_banner->text1)?></h2>
                            <p class="txt_2"><?=nl2br($main_banner->text2)?></p>
                            <a class="txt_but" href="<?=$main_banner->link?>"><?=$main_banner->button_text?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <div id="visual_but">
            <?php
            foreach($main_banners as $index => $main_banner){
                if( $index == 0 ) {
                    echo "<button type='button' class='but on'>1</button>";
                } else {
                    echo "<button type='button' class='but'>1</button>";
                }

            }
            ?>

        </div>
    </figure>
    <section id="qprod">
        <div class="container">
            <article class="con_title_wrap">
                <h2 class="qprod_title">PRODUCT</h2>
            </article>
            <article class="qprod_wrap">
                <div class="qprod_row_wrap">
                    <ul class="qprod_row">
                        <?php foreach($product_banners as $product_banner):?>
                        <li class="qprod_col">
                            <a href="/product/detail/<?=$product_banner->product_id?>">
                                <div class="qprod_img">
                                    <img src="<?=$product_banner->product_image?>" alt="product_image" />
                                </div>
                                <div class="qprod_txt">
                                    <p class="qprod_top_txt"><?=$product_banner->category_name?></p>
                                    <p class="qprod_bottom_txt"><?=$product_banner->product_name.' '.$product_banner->product_type?></p>
                                </div>
                            </a>
                        </li>
                        <?php endforeach;; ?>
                    </ul>
                </div>
                <div class="qprod_but prev"></div>
                <div class="qprod_but next"></div>
            </article>
        </div>
    </section>

    <?php echo $this->footer ?>

    <?php echo $this->sitemap ?>
</div>

</body>
</html>