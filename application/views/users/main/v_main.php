<body>
    <div class="wrap">
        <!-- s:pc -->
        <!-- s:header -->
        <header class="header" id="header">
            <div class="header_wrap">
                <ul class="header_i">
                    <li class="menu mo" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                        <span class="i i_menu"></span>
                    </li>
                    <li class="menu pc" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                        <span class="i i_menu"></span>
                    </li>
                    <li>
                        <a href="/">
                            <span class="i i_home_main"></span>
                            <!-- <img src="/resources/users/img/header_logo.png" alt=""> -->
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        <!-- e:header -->

        <?php
        $business_list_show = array_filter($business_list, function ($item) {
            return $item['use_menu'] === true;
        });

        $this->load->view('/users/include/_2_nav_offcanvas', ['business_list' => $business_list_show]);
        ?>

        <!-- s:fullpage -->
        <div id="fullpage" class="pc">
            <div class="section section_01" id="section_01">
                <div class="sc_wrap">
                    <h1>고객 맞춤형 디자인 전문기업</h1>
                    <img class="main_logo" src="/resources/users/img/main_logo.png" alt="Biz Design">
                    <h6>고객이 원하는</h6>
                </div>
                <div class="main_cont_01">
                    <ul>
                        <li>
                            <dl>
                                <dt>가치</dt>
                                <dd>Value</dd>
                                <dd>+</dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>비용</dt>
                                <dd>Cost</dd>
                                <dd>+</dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>소통</dt>
                                <dd>Communication</dd>
                                <dd>+</dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="swiper_cont">
                    <div class="swiper listSwiper listSwiper_pc">
                        <div class="swiper-wrapper">
                            <?php
                            $i = 0;
                            foreach ($business_list_show as $list) {
                            ?>
                                <div class="swiper-slide slide_<?= sprintf('%02d', $i) ?> move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                    <div class="slide_box">
                                        <img src="/resources/users/img/business/colorful/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                        <h5><?= $list['name'] ?></h5>
                                    </div>
                                    <div class="slide_imgbox">
                                        <img src="/resources/users/img/business/picture/<?= $list['segment'] ?>.jpg" alt="<?= $list['name'] ?>">
                                        <h5><?= $list['name'] ?></h5>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
            <div class="section section_02" id="section_02">
                <div class="container box">
                    <div class="row">
                        <div class="col-6">
                            <div class="main_cont_02 justify-content-end">
                                <h2>디자인<br>견적요청</h2>
                                <button type="button" class="link_to_consulting">
                                    <img src="/resources/users/img/btn_start.png" alt="">
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="main_cont_02 justify-content-start">
                                <ul>
                                    <li>
                                        <img src="/resources/users/img/step_1.png" alt="">
                                        <p>고객 <br class="mo">의뢰</p>
                                    </li>
                                    <li>
                                        <img src="/resources/users/img/step_2.png" alt="">
                                        <p>담당자 <br class="mo">상담</p>
                                    </li>
                                    <li>
                                        <img src="/resources/users/img/step_3.png" alt="">
                                        <p>디자이너 <br class="mo">소통</p>
                                    </li>
                                    <li>
                                        <img src="/resources/users/img/step_4.png" alt="">
                                        <p>수정 및 <br class="mo">컨펌</p>
                                    </li>
                                    <li>
                                        <img src="/resources/users/img/step_5.png" alt="">
                                        <p>서비스 <br class="mo">제공</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="cont_partner">
                                <h3 class="sc_title move_page" data-url="/consulting?section=partner">파트너사<button type="button"><i class="i i_more"></i></button></h3>
                                <div class="cont_swiper">
                                    <?php
                                    $partbanner_list_mod = array_chunk($partbanner_list, ceil(count($partbanner_list) / 2));
                                    ?>
                                    <div class="swiper partnerSwiper partnerSwiperOne">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($partbanner_list_mod[0] as $list) {
                                            ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="swiper partnerSwiper partnerSwiperOne m-0">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($partbanner_list_mod[1] as $list) {
                                            ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="cont_portfolio type2">
                                <h3 class="sc_title move_page" data-url="/consulting?section=portfolio">포트폴리오<button type="button"><i class="i i_more"></i></button></h3>
                                <div class="cont_swiper">
                                    <div class="swiper portfolioSwiper">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($portfolio_list as $list) {
                                                $img = json_decode($list->img_name)[0];
                                            ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="section section_03" id="section_03">
                <div class="container-xl">
                    <div class="main_cont_03">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <div class="service_title">
                                    <h1 class="title">All Service</h1>
                                    <p class="desc">고객을 위한 분야별 전문 디자인 서비스를 제공합니다.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row box_list_01">
                                    <div class="col-6 move_page" data-url="/business/list/proposal">
                                        <div class="box op">
                                            <img src="/resources/users/img/business/symbol/proposal.png" alt="<?= $business_list['proposal']['name'] ?>">
                                            <div class="box_text">
                                                <h2><?= $business_list['proposal']['name'] ?></h2>
                                                <p class="ta_l">보고서 / 제안서<br>회사소개서 / 교육자료</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 move_page" data-url="/business/list/package">
                                        <div class="box">
                                            <img src="/resources/users/img/business/symbol/package.png" alt="<?= $business_list['package']['name'] ?>">
                                            <p><?= $business_list['package']['name'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-3 move_page" data-url="/business/list/webdesign">
                                        <div class="box">
                                            <img src="/resources/users/img/business/symbol/webdesign.png" alt="<?= $business_list['webdesign']['name'] ?>">
                                            <p><?= $business_list['webdesign']['name'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper_cont">
                                    <div class="swiper serviceIcon01">
                                        <div class="swiper-wrapper">
                                            <?php
                                            $business_list_show_no_top = array_filter($business_list_show, function ($item) {
                                                return $item['use_top'] === false;
                                            });

                                            $business_list_show_1 = [];
                                            $business_list_show_2 = [];
                                            $business_list_show_3 = [];
                                            $business_list_show_4 = [];

                                            $business_list_show_1 = array_slice($business_list_show_no_top, 0, 5);
                                            $business_list_show_2 = array_slice($business_list_show_no_top, 5, 5);
                                            $business_list_show_3 = array_slice($business_list_show_no_top, 10, 4);
                                            $business_list_show_4 = array_slice($business_list_show_no_top, 14, 4);

                                            foreach ($business_list_show_1 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }


                                            foreach ($business_list_show_1 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="swiper serviceIcon01 mt-3">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($business_list_show_2 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            foreach ($business_list_show_2 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 d-flex align-items-center">
                                <div class="cont_review">
                                    <h3 class="sc_title move_page" data-url="/consulting?section=review">만족도<button type="button"><i class="i i_more"></i></button></h3>
                                    <ul class="review_list">
                                        <?php
                                        foreach ($review_list as $list) {
                                        ?>
                                            <li>
                                                <dl>
                                                    <dt>
                                                        <ul class="star">
                                                            <li class="on">★</li>
                                                            <li class="<?= ($list->score > 1) ? "on" : "" ?>"><?= ($list->score > 1) ? "★" : "☆" ?></li>
                                                            <li class="<?= ($list->score > 2) ? "on" : "" ?>"><?= ($list->score > 2) ? "★" : "☆" ?></li>
                                                            <li class="<?= ($list->score > 3) ? "on" : "" ?>"><?= ($list->score > 3) ? "★" : "☆" ?></li>
                                                            <li class="<?= ($list->score > 4) ? "on" : "" ?>"><?= ($list->score > 4) ? "★" : "☆" ?></li>
                                                        </ul>
                                                    </dt>
                                                    <dd class="cursor_hand get_review_info" data-idx="<?= $list->idx ?>"><?= $list->subject ?></dd>
                                                    <dd><?= $list->name ?></dd>
                                                </dl>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="swiper_cont">
                                    <div class="swiper serviceIcon02">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($business_list_show_3 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            foreach ($business_list_show_3 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="swiper serviceIcon02 mt-3">
                                        <div class="swiper-wrapper">
                                            <?php
                                            foreach ($business_list_show_4 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            foreach ($business_list_show_4 as $list) {
                                            ?>
                                                <div class="swiper-slide move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                                    <div class="box">
                                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                                        <p><?= $list['name'] ?></p>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section section_05 new" id="section_04">
                <div class="container">
                    <div class="main_cont_05">
                        <div class="sc_left">
                            <div class="sc_left_top">
                                <div class="work_top">
                                    <p><span>WORKS</span></p>
                                    <h1>PPT디자인</h1>
                                    <h6>전략적이고 성공적인 프리젠테이션을 위한 최적의 디자인 솔루션을 제공합니다.</h6>
                                </div>
                            </div>

                            <div class="sc_right_top">
                                <div class="swiper pptDesignSwiper">
                                    <div class="swiper-wrapper move_page" data-url="/business/list/proposal/">
                                        <?php
                                        foreach ($refrence_list as $list) {
                                            $img = json_decode($list->img_name)[0];
                                        ?>
                                            <div class="swiper-slide">
                                                <img src="<?= $img ?>">
                                            </div>
                                        <?php } ?>

                                        <?php
                                        foreach ($refrence_list as $list) {
                                            $img = json_decode($list->img_name)[0];
                                        ?>
                                            <div class="swiper-slide">
                                                <img src="<?= $img ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sc_bottom">
                            <div class="row">
                                <div class="col-4">
                                    <div class="ppt_box">
                                        <div class="ppt_header">
                                            <h2>보고용 PPT</h2>
                                            <p>심플한 구성과 다양한 시각자료 활용으로 효과적인 프리젠테이션 진행</p>
                                        </div>

                                        <div class="ppt_body move_page" data-url="/business?section=work&tab=0">
                                            <ul>
                                                <li>사업계획서</li>
                                                <li>업무보고서</li>
                                                <li>성과보고서</li>
                                                <li>IR자료</li>
                                                <li>연구보고서</li>
                                                <li>영업자료</li>
                                            </ul>
                                        </div>
                                        <div class="ppt_footer">
                                            <img src="/resources/users/img/ppt/ppt_01.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ppt_box">
                                        <div class="ppt_header">
                                            <h2>경쟁PT용 PPT</h2>
                                            <p>차별점을 강조하는 구성과 디자인으로 프로젝트 선정확률 극대화</p>
                                        </div>
                                        <div class="ppt_body move_page" data-url="/business?section=work&tab=0">
                                            <ul>
                                                <li>대리점입점</li>
                                                <li>대학사업제안</li>
                                                <li>입찰제안서</li>
                                                <li>투자제안서</li>
                                                <li>마케팅제안</li>
                                                <li>영업제휴</li>
                                            </ul>
                                        </div>
                                        <div class="ppt_footer">
                                            <img src="/resources/users/img/ppt/ppt_02.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="ppt_box">
                                        <div class="ppt_header">
                                            <h2>교육·홍보용 PPT</h2>
                                            <p>간단 명료한 디자인과 전략적인 구성으로 교육목표 및 효과적인 홍보 달성</p>
                                        </div>
                                        <div class="ppt_body move_page" data-url="/business?section=work&tab=0">
                                            <ul>
                                                <li>강의자료</li>
                                                <li>교육자료</li>
                                                <li>세미나 자료</li>
                                                <li>회사소개서</li>
                                                <li>제품소개서</li>
                                                <li>서비스소개서</li>
                                            </ul>
                                        </div>
                                        <div class="ppt_footer">
                                            <img src="/resources/users/img/ppt/ppt_03.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="section section_06" id="section_5">
                <div class="main_cont_06">
                    <div class="sc_left">
                        <div class="sc_left_top">
                            <div class="work_top">
                                <p><span>WORKS</span></p>
                                <h1>중소기업</h1>
                                <h6>사업의 방향과 기획 의도에 맞춘<br>고객이 원하는 디자인을 제공합니다.</h6>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box">명함</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">사원증</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">제품 카달록</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">회사 소개서</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">프로젝트 기획서</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">홍보전단</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">카드뉴스</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">팝업 광고</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">웹사이트 리뉴얼</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sc_left_bot"></div>
                    </div>
                    <div class="sc_right">
                        <div class="row">
                            <div class="col-9">
                                <div class="swiper workImg10">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide slide_01"></div>
                                        <div class="swiper-slide slide_02"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row m-0">
                                    <div class="col-2">
                                        <div class="w_img work_img_11"></div>
                                    </div>
                                    <div class="col-10">
                                        <div class="w_img work_img_12"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section section_07" id="section_06">
                <div class="main_cont_07">
                    <div class="sc_left">
                        <div class="sc_left_top">
                            <div class="work_top">
                                <p><span>WORKS</span></p>
                                <h1>공공기관</h1>
                                <h6>기관이 원하는 일정을 최우선으로<br>최적의 디자인을 제공합니다.</h6>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="box">규정가이드북</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">시설안내 리플렛</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">행사포스터</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">행사보고 소책자</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">전기간행 소식지</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">정책안내 브로셔</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">문서 템플릿</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">엑스배너</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="box">현수막</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sc_left_bot"></div>
                    </div>
                    <div class="sc_right">
                        <div class="row">
                            <div class="col-12">
                                <div class="w_img work_img_13"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="swiper workImg14">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide slide_01"></div>
                                        <div class="swiper-slide slide_02"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="w_img work_img_15"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="section section_04" id="section_07">
                <div class="main_cont_04">
                    <div class="sc_left">
                        <div class="sc_left_top">
                            <div class="work_top">
                                <p><span>WORKS</span></p>
                                <h1>월간디자인</h1>
                                <h6>설정 기간 중 분야별 요청 디자인들을 <br>통합 비용으로 제공합니다.</h6>
                                <ul class="work_list">
                                    <li>필요한 <span> 다양한 분야</span>의 디자인 작업들을</li>
                                    <li>내가원하는 <span>퀄리티를 보장</span>하면서</li>
                                    <li><span>합리적인 비용</span>으로 제작할 방법은 없을까?
                                        <button type="button"><i class="i i_more"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sc_left_bot">
                            <div class="row">
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <div class="w_img work_img_01"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sc_right">
                        <div class="row">
                            <div class="col-4">
                                <div class="w_img work_img_02"></div>
                                <div class="w_img work_img_03"></div>
                                <div class="w_img work_img_04"></div>
                            </div>
                            <div class="col-8">
                                <div class="w_img work_img_05"></div>
                                <div class="swiper workImg06">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide slide_01"></div>
                                        <div class="swiper-slide slide_02"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section section_08" id="section_08">
                <div class="main_cont_08">
                    <div class="container-fluid">
                        <div class="notice_wrap">
                            <div class="row">
                                <div class="col-5">
                                    <div class="company">
                                        Design<br>Outsourcing company
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h6><b>엠티엠비즈 디자인</b>은 고객과의 소통을 최우선으로<br>
                                        최적의 서비스 제안과 최고의 가치를 제공하여 고객이 원하는 목표를 달성할 수 있도록<br>
                                        디자인 서비스를 제공하는 고객 맞춤형 디자인 전문기업입니다.</h6>
                                </div>
                                <div class="col-2">
                                    <button type="button"><i class="i i_more"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-7">
                                <div class="sc_notice">
                                    <h3 class="sc_title move_page" data-url="/customer?section=notice">공지사항<button type="button"><i class="i i_more"></i></button>
                                    </h3>
                                    <ul>
                                        <?php
                                        foreach ($notice_list as $list) {
                                        ?>
                                            <li class="cursor_hand get_notice_info" data-idx="<?= $list->idx ?>"><?= $list->title ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <footer class="footer section fp-auto-height pc">
                <div class="ft_wrap">
                    <div class="row">
                        <div class="col-2">
                            <p><b>(주)엠티엠비코리아</b></p>
                        </div>
                        <div class="col-4">
                            <p>대표 : 정세종 <br> 서울특별시 강서구 양천로 424 데시앙플렉스 지식산업센터 1231호<br>
                                Tel : 02-3663-0332 Fax : 02-374-0335 E-mail : mtmb@mtmbkorea.com</p>
                        </div>
                        <div class="col-4">
                            <p>사업자번호 : 130-87-09598 통신판매업신고증 : 제 2023-서울강서-3726호
                                COPYRIGHT (c) 2021 MTMBKOREA Co., Ltd. ALL RIGHTS RESERVED.</p>
                        </div>
                        <div class="col-2">
                            <p>개인정보보호책임자 : 진동호</p>
                            <p><button class="btn btn-sm bg-white" onclick="location.href='/main/manager';">관리자</button></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- e:fullpage -->

        <!-- s:lnb -->
        <div class="lnb d-none" id="lnb">
            <div class="lnb_wrap">
                <div class="line_01"></div>
                <div class="line_02"></div>
                <div class="line_03"></div>
                <div class="lnb_menu_01">
                    <ul>
                        <li class="all_service">
                            <a href="/business">All Service </a>
                        </li>
                        <li>
                            <a href="/business?section=work&tab=0">PPT디자인</a>
                        </li>
                        <li>
                            <a href="/business?section=work&tab=1">공공기관</a>
                        </li>
                        <li>
                            <a href="/business?section=work&tab=2">중소기업</a>
                        </li>
                        <li>
                            <a href="/business?section=work&tab=3">월간디자인</a>
                        </li>
                    </ul>
                </div>
                <div class="lnb_menu_02">
                    <ul>
                        <li>
                            <a href="/consulting">견적요청</a>
                        </li>
                        <li>
                            <a href="/consulting?section=portfolio">포트폴리오</a>
                        </li>
                        <li>
                            <a href="/consulting?section=partner">파트너사</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- e:lnb -->
        <!-- e:pc -->

        <!-- s:mo -->
        <div class="mo">
            <!-- s:section_01-->
            <section class="section_01" id="top">
                <div class="sc_wrap">
                    <h1>고객 맞춤형 디자인 전문기업</h1>
                    <img class="main_logo" src="/resources/users/img/main_logo.png" alt="Biz Design">
                    <h6>고객이 원하는</h6>
                </div>
                <div class="main_cont_01">
                    <ul>
                        <li>
                            <dl>
                                <dt>가치</dt>
                                <dd>Value</dd>
                                <dd>+</dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>비용</dt>
                                <dd>Cost</dd>
                                <dd>+</dd>
                            </dl>
                        </li>
                        <li>
                            <dl>
                                <dt>소통</dt>
                                <dd>Communication</dd>
                                <dd>+</dd>
                            </dl>
                        </li>
                    </ul>
                </div>
                <div class="swiper_cont">
                    <div class="swiper listSwiper listSwiper_mo">
                        <div class="swiper-wrapper">
                            <?php
                            $i = 0;
                            foreach ($business_list_show as $list) {
                            ?>
                                <div class="swiper-slide slide_<?= sprintf('%02d', $i) ?> move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                    <div class="slide_box">
                                        <img src="/resources/users/img/business/colorful/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                        <h5><?= $list['name'] ?></h5>
                                    </div>
                                    <div class="slide_imgbox">
                                        <img src="/resources/users/img/business/picture/<?= $list['segment'] ?>.jpg" alt="<?= $list['name'] ?>">
                                        <h5><?= $list['name'] ?></h5>
                                    </div>
                                </div>
                            <?php
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </section>
            <!-- e:section_01-->

            <!-- s:section_02-->
            <section class="section_02">
                <div class="sc_wrap">
                    <div class="main_cont_02">
                        <h2>디자인<br>견적요청</h2>
                        <button type="button" class="link_to_consulting">
                            <img src="/resources/users/img/btn_start.png" alt="">
                        </button>
                    </div>
                    <div class="main_cont_02 mt_10">
                        <ul>
                            <li>
                                <img src="/resources/users/img/step_1.png" alt="">
                                <p>고객 <br class="mo">의뢰</p>
                            </li>
                            <li>
                                <img src="/resources/users/img/step_2.png" alt="">
                                <p>담당자 <br class="mo">상담</p>
                            </li>
                            <li>
                                <img src="/resources/users/img/step_3.png" alt="">
                                <p>디자이너 <br class="mo">소통</p>
                            </li>
                            <li>
                                <img src="/resources/users/img/step_4.png" alt="">
                                <p>수정 및 <br class="mo">컨펌</p>
                            </li>
                            <li>
                                <img src="/resources/users/img/step_5.png" alt="">
                                <p>서비스 <br class="mo">제공</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- e:section_02-->

            <!-- s:section_03-->
            <section class="section_03">
                <div class="sc_wrap">
                    <h3 class="sc_title move_page" data-url="/consulting?section=partner">파트너사<button type="button"><i class="i i_more"></i></button></h3>
                    <div class="cont_swiper cont_swiper_op mb-5">
                        <div class="swiper partnerSwiper partnerSwiperOne">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($partbanner_list as $list) {
                                ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="swiper partnerSwiper partnerSwiperOne m-0">
                            <div class="swiper-wrapper">
                                <?php
                                foreach (array_reverse($partbanner_list) as $list) {
                                ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <h3 class="sc_title move_page" data-url="/consulting?section=portfolio">포트폴리오<button type="button"><i class="i i_more"></i></button></h3>
                    <div class="cont_swiper mb-5">
                        <div class="swiper portfolioSwiper">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($portfolio_list as $list) {
                                    $img = json_decode($list->img_name)[0];
                                ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <h3 class="sc_title move_page" data-url="/consulting?section=review">만족도<button type="button"><i class="i i_more"></i></button></h3>
                    <ul class="review_list">
                        <?php
                        foreach ($review_list as $list) {
                        ?>
                            <li>
                                <dl>
                                    <dt>
                                        <ul class="star">
                                            <li class="on">★</li>
                                            <li class="<?= ($list->score > 1) ? "on" : "" ?>"><?= ($list->score > 1) ? "★" : "☆" ?></li>
                                            <li class="<?= ($list->score > 2) ? "on" : "" ?>"><?= ($list->score > 2) ? "★" : "☆" ?></li>
                                            <li class="<?= ($list->score > 3) ? "on" : "" ?>"><?= ($list->score > 3) ? "★" : "☆" ?></li>
                                            <li class="<?= ($list->score > 4) ? "on" : "" ?>"><?= ($list->score > 4) ? "★" : "☆" ?></li>
                                        </ul>
                                    </dt>
                                    <dd class="cursor_hand get_review_info" data-idx="<?= $list->idx ?>"><?= $list->subject ?></dd>
                                </dl>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!-- e:section_03-->

            <!-- s:section_04-->
            <section class="section_04">
                <div class="sc_top">
                    <h1>All Service</h1>
                    <p>고객을 위한 분야별 전문 디자인 서비스를 제공합니다.</p>
                </div>
                <div class="sc_wrap">
                    <div class="row box_list_01">
                        <div class="col-12">
                            <div class="box op move_page" data-url="/business/list/proposal">
                                <img src="/resources/users/img/business/symbol/proposal.png" alt="<?= $business_list['proposal']['name'] ?>">
                                <div class="box_text">
                                    <h2><?= $business_list['proposal']['name'] ?></h2>
                                    <p class="ta_l">보고서 / 제안서<br />회사소개서 / 교육자료</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box move_page" data-url="/business/list/webdesign">
                                <img src="/resources/users/img/business/symbol/webdesign.png" alt="<?= $business_list['webdesign']['name'] ?>">
                                <p><?= $business_list['webdesign']['name'] ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="box move_page" data-url="/business/list/package">
                                <img src="/resources/users/img/business/symbol/package.png" alt="<?= $business_list['package']['name'] ?>">
                                <p><?= $business_list['package']['name'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row box_list_02">
                        <?php
                        foreach ($business_list_show_no_top as $list) {
                        ?>
                            <div class="col-4">
                                <div class="box move_page" data-url="/business/list/<?= $list['segment'] ?>">
                                    <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                    <p><?= $list['name'] ?></p>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <!-- e:section_04-->

            <section class="section_06">
                <div class="sc_work">
                    <div class="work_top">
                        <p><span>WORKS</span></p>
                        <h1>PPT디자인</h1>
                        <h6>전략적이고 성공적인 프리젠테이션을 위한 최적의 디자인<br> 솔루션을 제공합니다.</h6>
                        <div class="row move_page" data-url="/business?section=work&tab=0">
                            <div class="col-4">
                                <div class="box">사업계획서</div>
                            </div>
                            <div class="col-4">
                                <div class="box">IR자료</div>
                            </div>
                            <div class="col-4">
                                <div class="box">연구보고서</div>
                            </div>
                            <div class="col-4">
                                <div class="box">대학사업제안</div>
                            </div>
                            <div class="col-4">
                                <div class="box">입찰제안서</div>
                            </div>
                            <div class="col-4">
                                <div class="box">투자제안서</div>
                            </div>
                            <div class="col-4">
                                <div class="box">강의자료</div>
                            </div>
                            <div class="col-4">
                                <div class="box">세미나자료</div>
                            </div>
                            <div class="col-4">
                                <div class="box">회사소개서</div>
                            </div>
                        </div>
                    </div>
                    <div class="work_img">
                        <div class="swiper pptDesignSwiper_mo">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($refrence_list as $list) {
                                    $img = json_decode($list->img_name)[0];
                                ?>
                                    <div class="swiper-slide">
                                        <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- <img src="/resources/users/img/work/m_work_05.png" alt=""> -->
                    </div>
                </div>
            </section>

            <section class="section_05">
                <div class="sc_work">
                    <div class="work_top">
                        <p><span>WORKS</span></p>
                        <h1>공공기관</h1>
                        <h6>기관이 원하는 일정을 최우선으로 최적의 디자인을 제공합니다.</h6>
                        <div class="row move_page" data-url="/business?section=work&tab=1">
                            <div class="col-4">
                                <div class="box">규정 가이드북</div>
                            </div>
                            <div class="col-4">
                                <div class="box">시설안내 리플렛</div>
                            </div>
                            <div class="col-4">
                                <div class="box">행사포스터</div>
                            </div>
                            <div class="col-4">
                                <div class="box">행사보고 소책자</div>
                            </div>
                            <div class="col-4">
                                <div class="box">정기간행 소식지</div>
                            </div>
                            <div class="col-4">
                                <div class="box">정책안내 브로셔</div>
                            </div>
                            <div class="col-4">
                                <div class="box">문서 템플릿</div>
                            </div>
                            <div class="col-4">
                                <div class="box">엑스배너</div>
                            </div>
                            <div class="col-4">
                                <div class="box">현수막</div>
                            </div>
                        </div>
                    </div>
                    <div class="work_img">
                        <img src="/resources/users/img/work/m_work_04.jpg" alt="">
                    </div>
                </div>
            </section>

            <section class="section_06">
                <div class="sc_work">
                    <div class="work_top">
                        <p><span>WORKS</span></p>
                        <h1>중소기업</h1>
                        <h6>사업의 방향과 기획 의도에 맞춘 고객이 원하는 디자인을 제공합니다.</h6>
                        <div class="row move_page" data-url="/business?section=work&tab=2">
                            <div class="col-4">
                                <div class="box">명함</div>
                            </div>
                            <div class="col-4">
                                <div class="box">사원증</div>
                            </div>
                            <div class="col-4">
                                <div class="box">제품 카달록</div>
                            </div>
                            <div class="col-4">
                                <div class="box">회사 소개서</div>
                            </div>
                            <div class="col-4">
                                <div class="box">프로젝트 기획서</div>
                            </div>
                            <div class="col-4">
                                <div class="box">홍보전단</div>
                            </div>
                            <div class="col-4">
                                <div class="box">카드뉴스</div>
                            </div>
                            <div class="col-4">
                                <div class="box">팝업 광고</div>
                            </div>
                            <div class="col-4">
                                <div class="box">웹사이트 리뉴얼</div>
                            </div>
                        </div>
                    </div>
                    <div class="work_img">
                        <img src="/resources/users/img/work/m_work_03.jpg" alt="">
                    </div>
                </div>
            </section>

            <section class="section_05">
                <div class="sc_work">
                    <div class="work_top">
                        <p><span>WORKS</span></p>
                        <h1>월간디자인</h1>
                        <h6>설정 기간 중 분야별 요청 디자인들을 통합 비용으로 제공합니다.</h6>
                        <ul class="work_list move_page" data-url="/business?section=work&tab=3">
                            <li>필요한 <span> 다양한 분야</span>의 디자인 작업들을</li>
                            <li>내가원하는 <span>퀄리티를 보장</span>하면서</li>
                            <li><span>합리적인 비용</span>으로 제작할 방법은 없을까?<button type="button"><i class="i i_more"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="work_img">
                        <img src="/resources/users/img/work/m_work_01.jpg" alt="">
                    </div>
                </div>
            </section>

            <!-- s:section_09-->
            <section class="section_09">
                <div class="sc_wrap">
                    <div class="logo_text">
                        <p>Design<br>Outsourcing company</p>
                    </div>
                    <img src="/resources/users/img/main_logo.png" alt="">
                    <p class="about"><b>엠티엠비즈 디자인</b>은 고객과의 소통을 최우선으로<br>
                        최적의 서비스 제안과 최고의 가치를 제공하여 고객이 원하는 목표를<br>
                        달성할 수 있도록 디자인 서비스를 제공하는 고객 맞춤형 디자인<br>
                        전문기업입니다.</p>
                </div>
                <div class="sc_notice">
                    <h3 class="sc_title move_page" data-url="/customer?section=notice">공지사항<button type="button"><i class="i i_more"></i></button></h3>
                    <ul>
                        <?php
                        foreach ($notice_list as $list) {
                        ?>
                            <li class="cursor_hand get_notice_info" data-idx="<?= $list->idx ?>"><?= $list->title ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!-- e:section_09-->

            <footer class="footer">
                <div class="ft_wrap">
                    <p><b>(주)엠티엠비코리아</b></p>
                    <p>대표 : 정세종 <br>서울특별시 강서구 양천로 424 데시앙플렉스 지식산업센터 1231호<br>
                        Tel : 02-3663-0332 Fax : 02-374-0335 E-mail : mtmb@mtmbkorea.com</p>
                    <p>사업자번호 : 130-87-09598 통신판매업신고증 : 제 2023-서울강서-3726호
                        COPYRIGHT (c) 2021 MTMBKOREA Co., Ltd. ALL RIGHTS RESERVED.</p>
                    <p>개인정보보호책임자 : 진동호</p>
                    <p><button class="btn btn-sm bg-white" onclick="location.href='/main/manager/';">관리자</button></p>
                </div>
            </footer>

        </div>
        <!-- e:mo -->

        <!-- s:top_fixed -->
        <div class="top" id="top_fixed">
            <button type="button" class="pc" onclick="location.href='#main'">TOP</button>
            <button type="button" class="mo" onclick="location.href='#top'">TOP</button>
        </div>
        <!-- e:top_fixed -->

    </div>


    <div class="modal fade write-modal view-modal" id="modal-review-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="reviewModalLabel">만족도</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_review">
                        <h5 id="modal-review-subject"></h5>
                        <ul class="data">
                            <li id="modal-review-regdate"></li>
                            <li>
                                <ul class="star" id="modal-review-score">
                                    <li class="on">★</li>
                                    <li>☆</li>
                                    <li>☆</li>
                                    <li>☆</li>
                                    <li>☆</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="modal_review_text" id="modal-review-content"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- s:게시글 조회 모달 -->
    <div class="modal fade write-modal view-modal" id="modal-notice-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="reviewModalLabel">공지사항</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_review">
                        <h5 id="modal-notice-subject"></h5>
                        <ul class="data">
                            <li id="modal-notice-regdate"></li>
                        </ul>
                    </div>
                    <div class="modal_review_text" id="modal-notice-content"></div>
                </div>
            </div>
        </div>
    </div>


    <?php foreach ($popup_list as $popup) { ?>
        <div class="popup-container" id="pop_container_<?= $popup->idx ?>" style="left: <?= $popup->location_left ?>px;top: <?= $popup->location_top ?>px;">
            <div style="width: <?= $popup->size_width ?>px;height: <?= $popup->size_height ?>px;">
                <h2><?= $popup->title ?></h2>
                <p><?= $popup->contents ?></p>
            </div>
            <div class="text-center">
                <input type="checkbox" id="pop_close_flag_<?= $popup->idx ?>" value="1" />
                <label for="pop_close_flag_<?= $popup->idx ?>">오늘 하루 보지 않기</label>
                <button type="button" class="btn btn-sm ms-3 btn-skyblue btn_close_popup" data-pop_idx="<?= $popup->idx ?>" data-pop_container="#pop_container_<?= $popup->idx ?>" data-pop_today_close="#pop_close_flag_<?= $popup->idx ?>">닫기</button>
            </div>
        </div>
    <?php } ?>
</body>

</html>

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js?<?= time() ?>"></script>
<script src="/resources/users/js/common.js?<?= time() ?>"></script>

<script>
    let modal_review_view;
    let curr_review_idx;

    let modal_notice_view;
    let curr_notice_idx;

    $(function() {
        modal_review_view = new bootstrap.Modal(document.getElementById("modal-review-view"), {
            keyboard: false,
        });

        modal_notice_view = new bootstrap.Modal(document.getElementById("modal-notice-view"), {
            keyboard: false,
        });

        $(document).on("click", ".get_review_info", function() {
            curr_review_idx = $(this).data("idx");
            view_review();
        });

        $(document).on("click", ".get_notice_info", function() {
            curr_notice_idx = $(this).data("idx");
            view_notice();
        });

        $(".btn_close_popup").on("click", function() {
            var pop_container = $(this).data("pop_container");
            var pop_today_close = $(this).data("pop_today_close");
            if ($(pop_today_close).is(":checked")) pop_close_today($(this).data("pop_idx"));
            $(pop_container).remove();
        });

        $(".link_to_consulting").on("click", function() {
            location.href = "/consulting";
            setCookie("show_consulting_first_step", "1", 1);
        });
    });

    function pop_close_today(popIdx) {
        $.post("/main/popupCloseToday", {
            idx: popIdx
        });
    }

    function view_review() {
        $.post("/consulting/reviewView", {
            idx: curr_review_idx
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                $("#modal-review-subject").text(result.data.subject);
                $("#modal-review-regdate").text(dateToIsoString(result.data.regdate));
                $("#modal-review-content").html(replaceToBr(result.data.contents));
                (result.data.score > 1) ? $("#modal-review-score li").eq(1).addClass("on").text("★"): $("#modal-review-score li").eq(1).removeClass("on").text("☆");
                (result.data.score > 2) ? $("#modal-review-score li").eq(2).addClass("on").text("★"): $("#modal-review-score li").eq(2).removeClass("on").text("☆");
                (result.data.score > 3) ? $("#modal-review-score li").eq(3).addClass("on").text("★"): $("#modal-review-score li").eq(3).removeClass("on").text("☆");
                (result.data.score > 4) ? $("#modal-review-score li").eq(4).addClass("on").text("★"): $("#modal-review-score li").eq(4).removeClass("on").text("☆");
                modal_review_view.show();
            }
        });
    }

    function view_notice() {
        $.post("/customer/noticeView", {
            idx: curr_notice_idx
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                $("#modal-notice-subject").text(result.data.title);
                $("#modal-notice-regdate").text(dateToIsoString(result.data.regdate));
                $("#modal-notice-content").html(replaceToBr(result.data.contents));
                modal_notice_view.show();
            }
        });
    }
</script>