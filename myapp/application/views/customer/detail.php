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
                             고객지원
                        </a>
                        <ul class="sub_nav_dp2 dp2_1 narr">
                            <li>
                                <a href="#">회사소개</a>
                            </li>
                            <li>
                                <a href="#">제품소개</a>
                            </li>
                            <li>
                                <a href="#">기술현황</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub_nav_dp1 dp1_2 narr">
                        <a href="#">
                            공지사항 
                        </a>
                    </li>
                </ul>
	        </div>
	    </div>
	    <!--//sub_navi-->
	    
        <section>
            <article class="sub_bg" id="notice_detail">
               <div class="container">
                    <h3 class="sub_title">고객지원</h3>
                    <div class="sub_content_box">
                        <div class="customer_title">
                            <h3>공지사항</h3>
                            <div class="cs">
                                <p class="cs_txt">
                                <span>전화상담 |</span>
                                055-329-3855</p>
                            </div>
                        </div>
                        <div class="tb_wrap">
                            <table>
                                  <colgroup>
                                        <col style="width:;">
                                        <col style="width:25%;">
                                 </colgroup>
                                   <thead>
                                       <tr>
                                           <th class="align_left">
                                               안녕하세요 이레스위치입니다.
                                           </th>
                                           <th>2018-02-21</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr>
                                           <td colspan="2" class="align_left detail">
                                               안녕하세요? 이레스위치입니다.<br/>
                                           </td>
                                       </tr>
                                   </tbody>
                            </table>
                        </div>
                        <div class="btn_list">
                            <a href="#">
                                목록
                            </a>
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