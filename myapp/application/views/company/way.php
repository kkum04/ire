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
                            회사소개
                        </a>
                        <ul class="sub_nav_dp2 dp2_1">
                            <li>
                                <a href="#">제품소개</a>
                            </li>
                            <li>
                                <a href="#">기술현황</a>
                            </li>
                            <li>
                                <a href="#">고객지원</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub_nav_dp1 dp1_2">
                        <a href="#">
                            오시는 길 
                        </a>
                        <ul class="sub_nav_dp2  dp2_2">
                            <li>
                                <a href="#">인사말</a>
                            </li>
                            <li>
                                <a href="#">회사연혁</a>
                            </li>
                        </ul>
                    </li>
                </ul>
	        </div>
	    </div>
	    <!--//sub_navi-->
	    
        <section>
            <article class="sub_bg" id="company_way">
               <div class="container">
                    <h3 class="sub_title">오시는 길</h3>
                    <div class="sub_content_box">
                        <p id="way_name">이레스위치 공장</p>
                        <p id="way_adress">경남 김해시 상동면 동북로 473번길 278-30
                        <span>TEL  055-329-3855</span></p>
                        <div id="way_map">
                            <!-- 1. 약도 노드 -->
                            <div id="daumRoughmapContainer1520495928070" class="root_daum_roughmap root_daum_roughmap_landing"></div>

                            <!-- 2. 설치 스크립트 -->
                            <script charset="UTF-8" class="daum_roughmap_loader_script" src="http://dmaps.daum.net/map_js_init/roughmapLoader.js"></script>

                            <!-- 3. 실행 스크립트 -->
                            <script charset="UTF-8">

                                new daum.roughmap.Lander({
                                    "timestamp" : "1520495928070",
                                    "key" : "n5av",
                                    "mapWidth" : $('#way_map').width(),
                                    "mapHeight" : "450"
                                }).render();
                            </script>
                        </div>
                    </div>
                </div>
            </article>
	    </section>

        <?php
        echo $this->footer;
        echo $this->sitemap;
        ?>
	    
	</div>

	</body>
</html>