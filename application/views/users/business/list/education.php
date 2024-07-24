        <!-- body -->
        <section class="detail_container pc">
            <div class="detail_page-content">
                <div class="left_arrows">
                    <img src="/resources/users/img/main/text/title_arrow.png" alt="텍스트 우측 하단 화살표 이미지">
                </div>
                <div class="detail_content-wrapper">
                    <div class="detail_header">
                        <h3>교육자료</h3>
                        <img src="/resources/users/img/main/services/service_14.png">
                    </div>
                    <div class="detail_content_descript">
                        <h5>교육목적의 PPT는 온·오프라인, 각각의 특성을 고려한 배치와 체계적인 이론 전달을 위한 페이지 구조가 요구됩니다
                        </h5>
                        <p>자료의 효과적인 활용을 위한 가로, 세로 형태 및 페이지네이션 제안과 영상, 오디오, 애니메이션 등 추가 요소를 개발하고 적용합니다
                        </p>
                        <div class="detail_img_wrapper">
                            <div class="detail_img_left">
                                <img src="/resources/users/img/detailPage/education/detail01.png">
                            </div>
                            <div class="detail_img_right">
                                <img src="/resources/users/img/detailPage/education/detail02.png">
                                <img src="/resources/users/img/detailPage/education/detail03.png">
                            </div>
                            <div class="detail_img_absoulte">
                                <img src="/resources/users/img/detailPage/education/detail04.png">
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
                                <h3>교육자료</h3>
                                <img src="/resources/users/img/main/services/service_14.png">
                            </div>

                        </div>
                        <div class="detail_content_descript">
                            <h5>교육목적의 PPT는 온·오프라인, 각각의 특성을 고려한 배치와 체계적인 이론 전달을 위한 페이지 구조가 요구됩니다</h5>
                            <p>자료의 효과적인 활용을 위한 가로, 세로 형태 및 페이지네이션 제안과 영상, 오디오, 애니메이션 등 추가 요소를 개발하고 적용합니다</p>
                            <div class="detail_img_wrapper">
                                <div class="detail_img_left">
                                    <img src="/resources/users/img/detailPage/education/detail01.png">
                                </div>
                                <div class="detail_img_right">
                                    <img src="/resources/users/img/detailPage/education/detail02.png">
                                    <img src="/resources/users/img/detailPage/education/detail03.png">
                                </div>
                                <div class="detail_img_absoulte">
                                    <img src="/resources/users/img/detailPage/education/detail04.png">
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

        <!-- s: footer -->
    </div>




<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>
<script src="/resources/users/js/business.js"></script>

</body>

</html>