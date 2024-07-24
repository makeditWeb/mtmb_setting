        <!-- body -->
        <section class="detail_container pc">
            <div class="detail_page-content">
                <div class="left_arrows">
                    <img src="/resources/users/img/main/text/title_arrow.png" alt="텍스트 우측 하단 화살표 이미지">
                </div>
                <div class="detail_content-wrapper">
                    <div class="detail_header">
                        <h3>입찰제안서</h3>
                        <img src="/resources/users/img/main/services/service_09.png">
                    </div>
                    <div class="detail_content_descript">
                        <h5>기관이 선호하는 레이아웃과 문안 구성 양식을 바탕으로 차별성이 강조되는 표현이 요구됩니다</h5>
                        <p>제출기관의 성향 파악과 구성 양식의 분석을 디자인에 적용하며 핵심에 집중하는 디자인전략으로 선정확률을 높일 수 있는 결과물을 제공합니다
                        </p>
                        <div class="detail_img_wrapper">
                            <div class="detail_img_left">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail01.png">
                            </div>
                            <div class="detail_img_right">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail02.png">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail03.png">
                            </div>
                            <div class="detail_img_absoulte">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail04.png">
                            </div>
                        </div>
                    </div>
                    <div class="detail_portfolio">
                        <?php
                        foreach ($reference_list as $list) {
                            $img = json_decode($list->img_name)[0];
                        ?>
                            <div class="select_reference detail_portfolio_list" data-curridx="<?= $list->idx ?>" style="padding:5px;">
                                <p class="portfolio_title"><?= $list->title ?></p>
                                <div class="portfolio_img">
                                    <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div> 
        </section>

        <section class="detail_container mo">
            <div class="content_wrap">
                <div class="detail_page-content">

                    <div class="detail_content-wrapper">
                        <div class="detail_header">
                            <div class="left_header_mo">
                                <img src="/resources/users/img/main/text/title_arrow.png" alt="텍스트 우측 하단 화살표 이미지">
                            </div>
                            <div class="right_header_mo">
                                <h3>입찰제안서</h3>
                                <img src="/resources/users/img/main/services/service_09.png">
                            </div>

                        </div>
                        
                        <div class="detail_content_descript">
                            <h5>기관이 선호하는 레이아웃과 문안 구성 양식을 바탕으로 차별성이 강조되는 표현이 요구됩니다</h5>
                            <p>제출기관의 성향 파악과 구성 양식의 분석을 디자인에 적용하며 핵심에 집중하는 디자인전략으로 선정확률을 높일 수 있는 결과물을 제공합니다</p>
                            <div class="detail_img_wrapper">
                                <div class="detail_img_left">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail01.png">
                                </div>
                                <div class="detail_img_right">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail02.png">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail03.png">
                                </div>
                                <div class="detail_img_absoulte">
                                <img src="/resources/users/img/detailPage/biddingProposal/detail04.png">
                                </div>
                            </div>
                        </div>
                         <div class="detail_portfolio">
                            <?php
                            foreach ($reference_list as $list) {
                                $img = json_decode($list->img_name)[0];
                            ?>
                                <div class="select_reference detail_portfolio_list" data-curridx="<?= $list->idx ?>" style="padding:5px;">
                                    <p class="portfolio_title"><?= $list->title ?></p>
                                    <div class="portfolio_img">
                                        <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div> 
            </div>
        </section>


        <!-- s:right_fixed -->
        <div class="right-fixed">
            <button>
                <img src='/resources/users/img/icon/i_kakao_button.png' />
            </button>
            <button onclick="location.href='/'">
                <img src='/resources/users/img/icon/i_home_button.png' />
            </button>
            <button onclick="window.history.back()">
                <img src='/resources/users/img/icon/i_back_button.png' />
            </button>
            <button onclick="location.href='#pageTop'">
                <img src='/resources/users/img/icon/i_top_button.png' />
            </button>
        </div>
    </div>



<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>
<script src="/resources/users/js/business.js"></script>
</body>
</html>