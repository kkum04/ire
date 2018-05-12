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
                    <li class="sub_nav_dp1 dp1_2">
                        <a href="#">
                            인사말 
                        </a>
                        <ul class="sub_nav_dp2  dp2_2">
                            <li>
                                <a href="/company/history">회사연혁</a>
                            </li>
                            <li>
                                <a href="/company/way">오시는 길</a>
                            </li>
                        </ul>
                    </li>
                </ul>
	        </div>
	    </div>
	    <!--//sub_navi-->
	    
        <section>
            <article class="sub_visual">
               <div class="container">
                   <h3>
                       이레스위치를 방문해 주셔서 대단히 감사합니다.
                   </h3>
               </div>
            </article>
            <article class="sub_bg" id="company_ceo">
               <div class="container">
                    <h3 class="sub_title">인사말</h3>
                    <div class="sub_content_box">
                        <p id="ceo_txt">
                        안녕하십니까?<br/>
                        저희 이레스위치는 <span>CONVEYOR BELT 비상스위치를 전문 생산하는 기업</span>으로
                        최고의 설비와 기능으로 새로운 아이템 개발하고 최고의 제품을 생산하여
                        더 좋은 가격으로 생산 현장에 공급하여 안전을 도모하는 기업이 되겠습니다.
                        앞으로도 많은 성원과 격려 부탁드리겠습니다.
                        </p>
                        <p id="ceo_sign">
                            (주)이레스위치 대표이사 <span> 이 성 원</span>
                        </p>
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