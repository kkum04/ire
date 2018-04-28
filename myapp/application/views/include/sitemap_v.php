<div class="pu pc_site_map">
    <div class="pu_wrap">
        <a class="close_btn" href="#">
            <img src="/static/images/common/close_btn.png">
        </a>
        <div class="pu_con">
            <dl class="pu_title">
                <dt>사이트맵</dt>
                <dd>
                    이레스위치의 모든 페이지를 한눈에 보실 수 있습니다.
                </dd>
            </dl>

            <ul class="site_map">
                <li class="site_map_top">
                    <a href="#">회사소개</a>
                    <ul class="site_map_sub">
                        <li>
                            <span>·</span>
                            <a href="/company/ceo">인사말</a>
                        </li>
                        <li>
                            <span>·</span>
                            <a href="/company/history">회사연혁</a>
                        </li>
                        <li>
                            <span>·</span>
                            <a href="/company/way">오시는 길</a>
                        </li>
                    </ul>
                </li>
                <li class="site_map_top">
                    <a>제품소개</a>
                    <ul class="site_map_sub">
                        <?php foreach($categories as $category): ?>
                            <li>
                                <span>·</span>
                                <a href="/category/<?=$category->category_id?>"><?=$category->category_name?></a>
                                <ul class="site_map_prod">

                                    <?php foreach($category->products as $product):?>
                                        <li>
                                            <a href="/product/detail/<?=$product->product_id?>">
                                                <?=$product->product_name.' '.$product->product_type?>
                                            </a>
                                        </li>
                                    <?php endforeach;?>

                                </ul>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li class="site_map_top">
                    <a href="/tech">기술현황</a>
                    <ul class="site_map_sub">
                        <li>
                            <span>·</span>
                            <a href="/tech">기술현황</a>
                        </li>
                    </ul>
                </li>
                <li class="site_map_top">
                    <a href="/customer">고객지원</a>
                    <ul class="site_map_sub">
                        <li>
                            <span>·</span>
                            <a href="/customer">공지사항</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>