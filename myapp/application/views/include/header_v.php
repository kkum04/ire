<header>
    <nav id="top_header">
        <div class="container">
            <ul id="nav_list">
                <li>
                    <a href="/">HOME</a>
                </li>
                <li>
                    <a href="#">회사소개</a>
                    <ul id="company_list">
                        <li>
                            <a href="/company/ceo">인사말</a>
                        </li>
                        <li>
                            <a href="/company/history">회사연혁</a>
                        </li>
                        <li>
                            <a href="/company/way">오시는 길</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/tech">기술현황</a>
                </li>
                <li>
                    <a href="/customer">고객지원</a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="bottom_header">
        <div class="container">
            <div id="logo_wrap">
                <h1 id="logo">
                    <a href="#">
                        <img src="/static/images/common/logo.png" alt="이레스위치 로고"/>
                    </a>
                </h1>
                <div id="all_btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div id="m_gnb_wrap">
                <ul id="m_gnb">
                    <li class="m_gnb_dept_1">
                        <a href="#">회사소개</a>
                        <ul class="m_gnb_dept_2">
                            <li>
                                <a href="/company/ceo">인사말</a>
                            </li>
                            <li>
                                <a href="/company/history">회사연혁</a>
                            </li>
                            <li>
                                <a href="/company/way">오시는 길</a>
                            </li>
                        </ul>
                    </li>
                    <li class="m_gnb_dept_1">
                        <a href="#">제품소개</a>
                        <ul class="m_gnb_dept_2">
                            <?php foreach($categories as $category): ?>
                            <li>
                                <a href="/category/<?=$category->category_id?>">
                                    <?php echo $category->category_name?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="m_gnb_dept_1">
                        <a href="/tech">기술현황</a>
                    </li>
                    <li class="m_gnb_dept_1">
                        <a href="/customer">고객지원</a>
                    </li>
                </ul>
            </div>
            <ul id="top_menu">
                <?php foreach($categories as $category): ?>
                <li>
                    <a href="/category/<?=$category->category_id?>"><?php echo $category->category_name ?></a>
                    <div class="underline"></div>
                    <div class="sub_menu_box">
                        <div class="container">
                            <ul id="sub_menu_item">
                                <?php foreach($category->products as $product) : ?>
                                <li>
                                    <a href="/product/detail/<?=$product->product_id?>">
                                        <div class="img_area">
                                            <img src="<?=$product->product_image?>" />
                                        </div>
                                        <div class="txt_area">
                                            <p><?=$product->product_name?></p>
                                            <p><?=$product->product_type?></p>
                                        </div>
                                    </a>
                                </li>
                                <?php endforeach;; ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </div>
</header>