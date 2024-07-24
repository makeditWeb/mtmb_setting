        <!-- body -->
        <section class="detail_container pc">
            <div class="detail_page-content">
                <div class="left_arrows">
                    <img src="/resources/users/img/main/text/title_arrow.png" alt="텍스트 우측 하단 화살표 이미지">
                </div>
                <div class="detail_content-wrapper">
                    <div class="detail_header">
                        <h3>투자제안서</h3>
                        <img src="/resources/users/img/main/services/service_10.png">
                    </div>
                    <div class="detail_content_descript">
                        <h5>기업투자유치, 은행대출, 정책자금 등 대상이 얻을 수 있는 투자의 가치를 중점적으로 전달하는 것이 중요합니다</h5>
                        <p>개인 및 기관투자자, 은행, 정부기관이 요구하는 작성 방안과 요구 내용에 대한 높은 이해도를 바탕으로 디자인 완성도를 높이고 제안 대상에 따른 레이아웃을 적용합니다
                        </p>
                        <div class="detail_img_wrapper">
                            <div class="detail_img_left">
                                <img src="/resources/users/img/detailPage/investmentProposal/detail01.png">
                            </div>
                            <div class="detail_img_right">
                                <img src="/resources/users/img/detailPage/investmentProposal/detail02.png">
                                <img src="/resources/users/img/detailPage/investmentProposal/detail03.png">
                            </div>
                            <div class="detail_img_absoulte">
                                <img src="/resources/users/img/detailPage/investmentProposal/detail04.png">
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
                                <h3>투자제안서</h3>
                                <img src="/resources/users/img/main/services/service_10.png">
                            </div>

                        </div>
                        <div class="detail_content_descript">
                            <h5>기업투자유치, 은행대출, 정책자금 등 대상이 얻을 수 있는 투자의 가치를 중점적으로 전달하는 것이 중요합니다</h5>
                            <p>개인 및 기관투자자, 은행, 정부기관이 요구하는 작성 방안과 요구 내용에 대한 높은 이해도를 바탕으로 디자인 완성도를 높이고 제안 대상에 따른 레이아웃을
                                적용합니다 </p>
                            <div class="detail_img_wrapper">
                                <div class="detail_img_left">
                                    <img src="/resources/users/img/detailPage/investmentProposal/detail01.png">
                                </div>
                                <div class="detail_img_right">
                                    <img src="/resources/users/img/detailPage/investmentProposal/detail02.png">
                                    <img src="/resources/users/img/detailPage/investmentProposal/detail03.png">
                                </div>
                                <div class="detail_img_absoulte">
                                    <img src="/resources/users/img/detailPage/investmentProposal/detail04.png">
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
        <!-- e:right_fixed -->
    </div>




<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>
<script src="/resources/users/js/business.js"></script>

</body>

</html>