<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo '갤러리 사진 제목';?></title>
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon"/>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <![endif]-->
</head><!--/head-->
<body>
    <?php echo $this->header?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>갤러리</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <?php foreach($gallery_category_list as $gallery_category):?>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/gallery/lists/<?php echo $gallery_category->id?>">
                                                <?php echo $gallery_category->name?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>

                            <?php endforeach;?>
                        </div>
                        <?php echo $this->left_shortcut ?>
                    </div>
				</div>
				<div class="col-sm-9" id="gallery_content">
                    <h2 class="title"><?php echo $gallery_info->category_name?></h2>
                    <h3><?php echo $gallery_info->title;?>
                        <span class="gallery_date">
                            <?php echo date_format(new DateTime($gallery_info->created_at),'Y-m-d');?>
                        </span>
                    </h3>

                    <div>
                        <?php echo $gallery_info->content?>
                    </div>

                    <div class="pager-area">
                        <ul class="pager pull-right">
                            <?php if( $previous_gallery != null ):?>
                            <li><a href="/gallery/detail/<?php echo $previous_gallery->id?>">이전</a></li>
                            <?php endif;?>

                            <?php if( $next_gallery != null ):?>
                            <li><a href="/gallery/detail/<?php echo $next_gallery->id?>">다음</a></li>
                            <?php endif;?>
                        </ul>
                    </div>
				</div>	
			</div>
		</div>
	</section>
    <?php echo $this->footer?>
    <script src="/js/jquery.js"></script>
	<script src="/js/price-range.js"></script>
	<script src="/js/jquery.scrollUp.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.prettyPhoto.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>