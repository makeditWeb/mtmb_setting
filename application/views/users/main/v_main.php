<body id='pageTop'>
    <div class="wrap">
        <!-- s:pc -->
        <!-- s:header -->
        <header class="header" id="header">
            <div class="header_wrap">
                <ul class="header_i">
                    <li class="menu mo" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                        aria-controls="offcanvasTop">
                        <div class="menu_wrap off">
                            <p class="menu_line n1"></p>
                            <p class="menu_line n2"></p>
                            <p class="menu_line n3"></p>
                        </div>
                    </li>
                    <li class="menu pc" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop"
                        aria-controls="offcanvasTop">
                        <div class="menu_wrap off">
                            <p class="menu_line n1"></p>
                            <p class="menu_line n2"></p>
                            <p class="menu_line n3"></p>
                        </div>
                    </li>
                    <li>
                        <a href='/'><span class='logo_text'>MTMBPPT</span></a>
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

        <!-- s: (모바일) offcanvas -->
        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">

                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row">
                    <div class="col-6 col-lg-12">
                        <dl>
                            <dt>
                                <a href="/company">회사소개</a>
                            </dt>
                            <dd>
                                <a href="/company#about">- 인사말</a>
                            </dd>
                            <dd class='pc'>
                                <a href="/company#location">- 위치</a>
                            </dd>
                            <dd class='mo'>
                                <a href="/company#locationMobile">- 위치</a>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <a href="/business">비지니스</a>
                            </dt>
                            <dd>
                                <a href="/business">- 전체서비스</a>
                            </dd>
                            <dd>
                                <a href="/business?pptIndex=1">- 제안서</a>
                            </dd>
                            <dd>
                                <a href="/business?pptIndex=2">- 소개서</a>
                            </dd>
                            <dd>
                                <a href="/business?pptIndex=3">- 보고서</a>
                            </dd>
                            <dd>
                                <a href="/business?pptIndex=4">- 교육•강의</a>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <a href="/consulting">견적문의</a>
                            </dt>
                            <dd>
                                <a href="/consulting">- 견적문의</a>
                            </dd>
                            <dd class='pc'>
                                <a href="/consulting#reviewList">- 이용후기</a>
                            </dd>
                            <dd class='mo'>
                                <a href="/consulting#reviewListMobile">- 이용후기</a>
                            </dd>
                            <dd class='pc'>
                                <a href="/consulting#partnerCompany">- 파트너사</a>
                            </dd>
                            <dd class='mo'>
                                <a href="/consulting#partnerCompanyMobile">- 파트너사</a>
                            </dd>

                            <dd class='pc'>
                                <a href="/consulting#portfolioWrap">- 포트폴리오</a>
                            </dd>
                            <dd class='mo'>
                                <a href="/consulting#portfolioWrapMobile">- 포트폴리오</a>
                            </dd>
                        </dl>
                        <dl>
                            <dt>
                                <a href="/customer">고객센터</a>
                            </dt>
                            <dd>
                                <a href="/customer">- 공지사항</a>
                            </dd>
                            <dd>
                                <a href="/customer#serviceQna">- 문의하기</a>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-6 mo">
                        <dl>
                            <dd>
                                <a href="/business/list/businessPlan">사업계획서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/workReport">업무보고서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/performanceReport">성과보고서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/irReport">IR보고서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/researchReport">연구보고서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/salesReport">영업보고서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/storeProposal">입점제안서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/businessProposal">사업제안서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/biddingProposal">입찰제안서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/investmentProposal">투자제안서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/marketingProposal">마케팅제안서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/partnershipProposal">제휴제안서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/lectureMaterials">강의자료</a>
                            </dd>
                            <dd>
                                <a href="/business/list/education">교육자료</a>
                            </dd>
                            <dd>
                                <a href="/business/list/seminarMaterials">세미나자료</a>
                            </dd>
                            <dd>
                                <a href="/business/list/company">회사소개서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/productIntroduction">제품소개서</a>
                            </dd>
                            <dd>
                                <a href="/business/list/serviceIntroduction">서비스소개서</a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <!-- e: (모바일) offcanvas -->

        <!-- s:fullpage -->
        <div id="fullpage" class="pc">
            <div class="section section_01" id="section_01">
                <div class='sc_wrap'>
                    <div class='title_wrap'>
                        <div class='top_wrap'>
                            <div class='description_wrap'>
                                <span>고객이 원하는</span>
                                <span>PPT Design</span>
                            </div>
                            <span>Value</span>
                        </div>
                        <h1>Cost</h1>
                        <h2>Result</h2>
                    </div>

                    <div class='content_01'>
                        <div class='swiper section01_listSwiper'>
                            <div class='swiper-wrapper'>
                                <a href='/business?pptIndex=1' class='swiper-slide content'>
                                    <div class='proposal'>
                                        <span>Proposal<br />document</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=4' class='swiper-slide content'>
                                    <div class='lecture'>
                                        <span>Lecture <br />materials</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=2' class='swiper-slide content'>
                                    <div class='introduction'>
                                        <span>Introduction</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=4' class='swiper-slide content'>
                                    <div class='educational'>
                                        <span>Educational<br />materials</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=3' class='swiper-slide content'>
                                    <div class='business'>
                                        <span>Business report</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=1' class='swiper-slide content'>
                                    <div class='proposal'>
                                        <span>Proposal<br />document</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=4' class='swiper-slide content'>
                                    <div class='lecture'>
                                        <span>Lecture <br />materials</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=2' class='swiper-slide content'>
                                    <div class='introduction'>
                                        <span>Introduction</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=4' class='swiper-slide content'>
                                    <div class='educational'>
                                        <span>Educational<br />materials</span>
                                    </div>
                                </a>
                                <a href='/business?pptIndex=3' class='swiper-slide content'>
                                    <div class='business'>
                                        <span>Business report</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class='swiper-hero-progress-wrap'>
                            <div class="swiper-hero-progress"></div>
                        </div>


                        <a href='/business?pptIndex=2' class='content-panel active'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/introduction-1.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>소개서</span>
                                    <span>Introduction</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=1' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/proposal-report-1.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>제안서</span>
                                    <span>Proposal document</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=3' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/business-report-1.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>보고서</span>
                                    <span>Business report</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=4' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/education-1.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>교육자료</span>
                                    <span>Educational meterials</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=4' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/education-2.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>강의자료</span>
                                    <span>Lecture meterials</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=2' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/introduction-2.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>소개서</span>
                                    <span>Introduction</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=1' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/proposal-report-2.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>제안서</span>
                                    <span>Proposal document</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=3' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/business-report-2.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>보고서</span>
                                    <span>Business report</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=4' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/education-1.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>교육자료</span>
                                    <span>Educational meterials</span>
                                </div>
                            </div>
                        </a>

                        <a href='/business?pptIndex=4' class='content-panel'>
                            <div class='img-wrap'>
                                <img src='resources/users/img/main/contentImage/education-2.png' />
                            </div>
                            <div class='right-wrap'>
                                <img src='resources/users/img/main/section01/arrow.png' />
                                <div class='description_wrap'>
                                    <span>강의자료</span>
                                    <span>Lecture meterials</span>
                                </div>
                            </div>
                        </a>

                        <div class="scroll-controller">
                            <div class="arrow_wrap">
                                <svg id='section_01_list_swiper_up' width="18" height="18" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 15l6-6 6 6" />
                                </svg>
                                <div class="line"></div>
                                <svg id='section_01_list_swiper_down' width="18" height="18" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <img class='scroll_img' src='resources/users/img/scroll_mouse.png' />
            </div>

            <div class="section section_02" id="section_02">
                <div class='content_02'>
                    <div class='consulting_box'>
                        <div class='left_wrap'>
                            <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                            <ul>
                                <li>
                                    <img src="resources/users/img/main/step_1.png" alt="상담 문의">
                                    <p>문의</p>
                                </li>
                                <li class="arrow_between">
                                    <img src="resources/users/img/icon/between_arrows.png">
                                </li>
                                <li>
                                    <img src="resources/users/img/main/step_2.png" alt="상담 진행">
                                    <p>상담</p>
                                </li>
                                <li class="arrow_between">
                                    <img src="resources/users/img/icon/between_arrows.png">
                                </li>
                                <li>
                                    <img src="resources/users/img/main/step_3.png" alt="화상 대면 미팅">
                                    <p>화상 · 대면 미팅</p>
                                </li>
                                <li class="arrow_between">
                                    <img src="resources/users/img/icon/between_arrows.png">
                                </li>
                                <li>
                                    <img src="resources/users/img/main/step_4.png" alt="작업 진행">
                                    <p>진행</p>
                                </li>
                                <li class="arrow_between">
                                    <img src="resources/users/img/icon/between_arrows.png">
                                </li>
                                <li>
                                    <img src="resources/users/img/main/step_5.png" alt="작업 수정">
                                    <p>수정</p>
                                </li>
                                <li class="arrow_between">
                                    <img src="resources/users/img/icon/between_arrows.png">
                                </li>
                                <li>
                                    <img src="resources/users/img/main/step_6.png" alt="작업 완료">
                                    <p>완료</p>
                                </li>
                            </ul>
                        </div>

                        <a href="consulting?consultingIndex=2" class='right_wrap'>
                            <span>견적문의
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </span>
                            <span>Start</span>
                        </a>
                    </div>
                    <div class='made_it_wrap'>
                        <div class='text_wrap'>
                            <div class='title_wrap'>
                                <h2>We made it</h2>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                            <a href='consulting#portfolioWrap' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>전체보기</span>
                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>
                        <div class='made_it_list swiper weMadeItSwiper'>
                            <div class='swiper-wrapper'>
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

            <div class="section section_03" id="section_03">
                <div class='content_03'>
                    <div class='all_service_wrap'>
                        <div class='title_wrap'>
                            <span>ALL Service</span>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>

                        <div class='service_list'>
                                 <?php
                                $index = 1; // 인덱스 초기값 설정
                                foreach ($business_list_show as $list) {
                                    $formattedIndex = sprintf("%02d", $index);
                                ?>
                                    <a href="/business/list/<?= $list['segment'] ?>/" class='service_wrap'>
                                        <img src='resources/users/img/main/services/service_<?= $formattedIndex ?>.png'   />
                                        <div class='service_text'>
                                            <span><?= $list['name'] ?></span>
                                            <img src='resources/users/img/icon/main_i_right.png' alt='Right Arrow' />
                                        </div>
                                    </a>
                                <?php
                                    $index++; 
                                } 
                                ?> 
                        </div>
                    </div>

                    <div class="partner_container marquee">
                        <ul class="partner_wrap marquee-content">
                            <?php
                                foreach ($partbanner_list as $list) {
                                ?>
                                    <li class='marquee-item'>
                                        <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                                    </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class='review_wrap'>
                        <div class='text_wrap'>
                            <div class='title_wrap'>
                                <h2>Review</h2>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                            <a href='consulting#reviewList' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>전체보기</span>
                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>
                        <ul class='review_list'>
                            <?php
                            foreach ($review_list as $list) {
                            ?>
                                <li class='review_box cursor_hand get_review_info' data-idx="<?= $list->idx ?>">
                                    <span class='review_title cursor_hand get_review_info' data-idx="<?= $list->idx ?>"><?= $list->subject ?></span>
                                    <span class='review_author'><?= $list->name ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="section section_04" id="section_04">
                <div class='title_wrap'>
                    <span>PPT</span>
                    <img src='resources/users/img/main/text/title_arrow.png' />
                </div>
                <div class='content_04'>
                    <div class='left_wrap'>
                        <div class='title'>
                            <span>Proposal<br />document</span>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>
                        <div class='sub_title'>
                            <span>제안서</span>
                            <span class="sub_tiitle_text">
                                차별성 높은 표현력과 설득력 있는 스토리 구성을 통해<br />
                                우리만의 경쟁력을 극대화합니다.
                            </span>
                        </div>
                        <div class='more_info'>
                            <span><a href='business?pptIndex=1'>용역제안</a></span>
                            <span><a href='business?pptIndex=1'>제휴제안</a></span>
                            <span><a href='business?pptIndex=1'>입찰제안</a></span>
                            <span><a href='business?pptIndex=1'>마케팅제안</a></span>
                            <span><a href='business?pptIndex=1'>영업제안</a></span>
                            <span><a href='business?pptIndex=1'>투자제안</a></span>
                        </div>

                        <a href='business?pptIndex=1' class='view_all_wrap_link'>
                            <div class='view_all_wrap'>
                                <span>상세보기</span>
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="section section_05" id="section_05">
                <div class="content_05">
                    <div class='content_container'>
                        <div class='left_wrap'>
                            <img src='resources/users/img/main/content_05.png' />
                            <div class='introduction_list swiper introducationSwiper'>
                                <div class=' swiper-wrapper'>
                                    <?php
                                            foreach ($refrence_list as $list) {
                                                $img = json_decode($list->img_name)[0];
                                            ?>
                                                <div class="swiper-slide">
                                                    <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                                </div>
                                    <?php } ?>
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
                        </div>
                        <div class='right_wrap'>
                            <div class='title'>
                                <span>Introduction</span>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                            <div class='sub_title'>
                                <span>소개서</span>
                                <span>
                                    임팩트 강한 키워드와 논리적 정보전달을 통해<br />
                                    신뢰성과 긍정적 이미지를 유도합니다
                                </span>
                            </div>
                            <div class='more_info'>
                                <span><a href='business?pptIndex=2'>회사소개</a></span>
                                <span><a href='business?pptIndex=2'>사업소개</a></span>
                                <span><a href='business?pptIndex=2'>제품소개</a></span>
                            </div>
                            <a href='business?pptIndex=2' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>상세보기</span>
                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section section_06" id="section_06">
                <div class='content_06'>
                    <div class='left_wrap'>
                        <div class='title'>
                            <span>Business<br />report</span>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>
                        <div class='sub_title'>
                            <span>보고서</span>
                            <span>
                                가독성 높은 디자인과 데이터 시각화를 통해<br />
                                원하는 성과목표 메시지를 명확하게 전달합니다
                            </span>
                        </div>
                        <div class='more_info'>
                            <span><a href='business?pptIndex=3'>업무보고</a></span>
                            <span><a href='business?pptIndex=3'>성과보고</a></span>
                            <span><a href="business?pptIndex=3">IR보고</a></span>
                        </div>

                        <a href='business?pptIndex=3' class='view_all_wrap_link'>
                            <div class='view_all_wrap'>
                                <span>상세보기</span>
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </div>
                        </a>
                    </div>
                    <img src='resources/users/img/main/content_06.png' />
                </div>
            </div>

            <div class="section section_07" id="section_07">
                <div class='content_07'>
                    <div class='top_wrap'>
                        <div class='left_wrap'>
                            <div class='title'>
                                <span>Educational<br />materials</span>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                            <div class='sub_title'>
                                <span>교육<span class='dot'>•</span>강의</span>
                                <span>
                                    이해도 높은 구성력과 간결한 메시지를 통해 <br/>
                                    참석자와의 원활한 소통과 공감대를 형성합니다
                                </span>
                            </div>
                            <div class='more_info'>
                                <span><a href='business?pptIndex=4'>강의교재</a></span>
                                <span><a href='business?pptIndex=4'>교육책자</a></span>
                                <span><a href='business?pptIndex=4'>세미나자료</a></span>
                            </div>

                            <a href='business?pptIndex=4' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>상세보기</span>
                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>

                        <img src='resources/users/img/main/content_07.png' />
                    </div>

                    <div class='education_list'>
                        <img src='resources/users/img/main/education_02.png' />
                        <img src='resources/users/img/main/education_01.png' />
                        <img src='resources/users/img/main/education_03.png' />
                    </div>
                </div>
            </div>

            <div class="section section_08 fp-auto-height" id="section_08">
                <div class="content_08">
                    <div class='top_wrap'>
                        <div class='about_wrap'>
                            <div class='title'>
                                <span>About</span>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>

                            <div class='description_wrap'>
                                <span class='description_01'>
                                    PPT Design<br /> Outsourcing company
                                </span>

                                <span class='description_02'>
                                    MTMBPPT는 고객과의 소통을 최우선으로<br />
                                    최적의 디자인과 최고의 가치를 제공하고 고객이 원하는 목표를 달성할 수 있도록<br />
                                    디자인 서비스를 제공하는 고객 맞춤형 PPT디자인 전문 기업입니다.
                                </span>
                            </div>

                            <a href='/company' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>상세보기</span>

                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>

                        <div class='notice_wrap'>
                            <div class='title'>
                                <span>Notice</span>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>

                            <ul class='notice_list'>
                                <?php
                                    foreach ($notice_list as $list) {
                                    ?>
                                        <li class='notice_box cursor_hand get_notice_info' data-idx="<?= $list->idx ?>">
                                            <span class='notice_title'><?= $list->title ?></span>
                                        </li>
                                <?php } ?>
                            </ul>
                            <a href='/customer' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>상세보기</span>

                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class='portfolio_container'>
                        <div class='title'>
                            <span>Portfolio</span>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>

                        <ul class='portfolio_list' id='portfolioList'>
                            <?php
                            foreach ($portfolio_list as $list) {
                                // $img = json_decode($list->img_name)[0];
                                $img = htmlspecialchars(json_decode($list->img_name)[0], ENT_QUOTES, 'UTF-8');
                                $currIdx = htmlspecialchars($list->idx, ENT_QUOTES, 'UTF-8');
                                $title = htmlspecialchars($list->title, ENT_QUOTES, 'UTF-8');
                                ?>
                                <li class="portfolio_wrap select_portfolio" data-curridx="<?= $currIdx ?>" style="width: 300px; height: 300px;">
                                    <div class="portfolio_img_inner">
                                        <img src="<?= $img ?>" alt="<?= $title ?>" loading="lazy" >
                                    </div>
                                    <div class="hover_overlay">
                                        <div class="hover_top">
                                            <img src='resources/users/img/main/view_detail.png' />
                                            <span><?= $title ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- e:fullpage -->

        <!-- s:lnb -->
        <div class="lnb" id="lnb">
            <div class="lnb_wrap">
                <div class="lnb_menu_01">
                    <ul>
                        <li>
                            <a href="business" class='all-ppt'>ALL PPT</a>
                        </li>
                        <li>
                            <a href="business?pptIndex=1">제안서</a>
                        </li>
                        <li>
                            <a href="business?pptIndex=2">소개서</a>
                        </li>
                        <li>
                            <a href="business?pptIndex=3">보고서</a>
                        </li>
                        <li>
                            <a href="business?pptIndex=4">교육강의</a>
                        </li>
                    </ul>
                </div>
                <div class="lnb_menu_02">
                    <ul>
                        <li>
                            <a href="consulting">견적문의</a>
                        </li>
                        <li>
                            <a href="consulting#portfolioWrap">포트폴리오</a>
                        </li>
                        <li>
                            <a href="consulting#partnerCompany">파트너사</a>
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
            <section class="section_01">
                <div class='sc_wrap'>
                    <div class='title_wrap'>
                        <div class='top_wrap'>
                            <div class='description_wrap'>
                                <span>고객이 원하는</span>
                                <span>PPT Design</span>
                            </div>
                            <span>Value</span>
                        </div>
                        <h1>Cost</h1>
                        <h2>Result</h2>
                    </div>

                    <div class='content-divider-wrap'>
                        <div class='content-divider'></div>
                    </div>

                    <div class='content_01'>
                        <div class='swiper section01_listMobileSwiper'>
                            <div class='swiper-wrapper'>
                                <a href='/business?pptIndex=1' class='content proposal swiper-slide'>
                                    <span>Proposal<br />document</span>
                                </a>
                                <a href='/business?pptIndex=4' class='content lecture swiper-slide'>
                                    <span>Lecture <br />materials</span>
                                </a>
                                <a href='/business?pptIndex=2' class='content introduction swiper-slide'>
                                    <span>Introduction</span>
                                </a>
                                <a href='/business?pptIndex=4' class='content educational swiper-slide'>
                                    <span>Educational<br />materials</span>
                                </a>
                                <a href='/business?pptIndex=3' class='content business swiper-slide'>
                                    <span>Business report</span>
                                </a>
                                <a href='/business?pptIndex=1'  class='content proposal swiper-slide'>
                                    <span>Proposal<br />document</span>
                                </a>
                                <a href='/business?pptIndex=4' class='content lecture swiper-slide'>
                                    <span>Lecture <br />materials</span>
                                </a>
                                <a href='/business?pptIndex=2' class='content introduction swiper-slide'>
                                    <span>Introduction</span>
                                </a>
                                <a href='/business?pptIndex=4' class='content educational swiper-slide'>
                                    <span>Educational<br />materials</span>
                                </a>
                                <a href='/business?pptIndex=3' class='content business swiper-slide'>
                                    <span>Business report</span>
                                </a>
                            </div>
                        </div>

                        <div class='content-panel-wrap'>
                            <svg id="section_01_list_swiper_left" width="24" height="24" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 6l-6 6 6 6" />
                            </svg>
                            
                            <a href='/business?pptIndex=2' class='content-panel active'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/introduction-1.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>소개서</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Introduction</span>
                                </div>
                            </a>
                            
                            <a href='/business?pptIndex=1' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/proposal-report-1.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>제안서</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Proposal document</span>
                                </div>
                            </a>
                            
                            <a href='/business?pptIndex=3' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/business-report-1.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>보고서</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Business report</span>
                                </div>
                            </a>
                            
                            <a href='/business?pptIndex=4' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/education-1.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>교육자료</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Educational meterials</span>
                                </div>
                            </a>
                            
                            <a href='/business?pptIndex=4' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/education-2.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>강의자료</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Lecture meterials</span>
                                </div>
                            </a>
                            
                            <a href='/business?pptIndex=2' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/introduction-2.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>소개서</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Introduction</span>
                                </div>
                            </a>

                            <a href='/business?pptIndex=1' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/proposal-report-2.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>제안서</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Proposal document</span>
                                </div>
                            </a>

                            <a href='/business?pptIndex=3' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/business-report-2.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>보고서</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Business report</span>
                                </div>
                            </a>

                            <a href='/business?pptIndex=4' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/education-1.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>교육자료</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Educational meterials</span>
                                </div>
                            </a>

                            <a href='/business?pptIndex=4' class='content-panel'>
                                <div class='img-wrap'>
                                    <img src='resources/users/img/main/contentImage/education-2.png' />
                                </div>
                                <div class='bottom-wrap'>
                                    <div class='title_arrow_wrap'>
                                        <span>강의자료</span>
                                        <img src='resources/users/img/main/arrow_top.png' />
                                    </div>
                                    <span>Lecture meterials</span>
                                </div>
                            </a>

                            <svg id="section_01_list_swiper_right" width="24" height="24" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </div>
                    </div>
                </div>
            </section>
            <!-- e:section_01-->

            <!-- s:section_02-->
            <section class="section_02">
                <div class='consulting_box'>
                    <div class='left_wrap'>
                        <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                        <ul>
                            <li>
                                <img src="resources/users/img/main/step_1.png" alt="상담 문의">
                                <p>문의</p>
                            </li>
                            <li class="arrow_between">
                                <img src="resources/users/img/icon/between_arrows.png">
                            </li>
                            <li>
                                <img src="resources/users/img/main/step_2.png" alt="상담 진행">
                                <p>상담</p>
                            </li>
                            <li class="arrow_between">
                                <img src="resources/users/img/icon/between_arrows.png">
                            </li>
                            <li>
                                <img src="resources/users/img/main/step_3.png" alt="화상 대면 미팅">
                                <p>화상 · 대면<br />미팅</p>
                            </li>
                            <li class="arrow_between">
                                <img src="resources/users/img/icon/between_arrows.png">
                            </li>
                            <li>
                                <img src="resources/users/img/main/step_4.png" alt="작업 진행">
                                <p>진행</p>
                            </li>
                            <li class="arrow_between">
                                <img src="resources/users/img/icon/between_arrows.png">
                            </li>
                            <li>
                                <img src="resources/users/img/main/step_5.png" alt="작업 수정">
                                <p>수정</p>
                            </li>
                            <li class="arrow_between">
                                <img src="resources/users/img/icon/between_arrows.png">
                            </li>
                            <li>
                                <img src="resources/users/img/main/step_6.png" alt="작업 완료">
                                <p>완료</p>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <a href="consulting?consultingIndex=2" class='right_wrap'>
                            <span>견적문의
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </span>
                            <span>Start</span>
                        </a>
                    </div>
                </div>
                <div class='made_it_wrap'>
                    <div class='text_wrap'>
                        <div class='title_wrap'>
                            <h2>We made it</h2>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>
                        <a href='consulting#portfolioWrapMobile' class='view_all_wrap_link'>
                            <div class='view_all_wrap'>
                                <span>전체보기</span>
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </div>
                        </a>
                    </div>
                    <div class='made_it_list swiper weMadeItSwiper'>
                        <div class='swiper-wrapper'>
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
            </section>
            <!-- e:section_02-->

            <!-- s:section_03-->
            <section class="section_03">
                <div class='title_wrap'>
                    <span>ALL Service</span>
                    <img src='resources/users/img/main/text/title_arrow.png' />
                </div>


                <div class='service_list'>
                    <!-- 보고서 -->
                    <a href="/business/list/businessPlan" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_01.png' />
                        <div class='service_text'>
                            <span>사업계획서</span>
                        </div>
                    </a>
                    <a href="/business/list/workReport" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_02.png' />
                        <div class='service_text'>
                            <span>업무보고서</span>
                        </div>
                    </a>
                    <a href="/business/list/performanceReport" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_03.png' />
                        <div class='service_text'>
                            <span>성과보고서</span>
                        </div>
                    </a>
                    <a href="/business/list/irReport" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_04.png' />
                        <div class='service_text'>
                            <span>IR보고서</span>
                        </div>
                    </a>
                    <a href="/business/list/researchReport" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_05.png' />
                        <div class='service_text'>
                            <span>연구보고서</span>
                        </div>
                    </a>
                    <a href="/business/list/salesReport" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_06.png' />
                        <div class='service_text'>
                            <span>영업보고서</span>
                        </div>
                    </a>

                    <!-- 제안서 -->
                    <a href="/business/list/storeProposal" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_07.png' />
                        <div class='service_text'>
                            <span>입점제안서</span>
                        </div>
                    </a>
                    <a href="/business/list/businessProposal" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_08.png' />
                        <div class='service_text'>
                            <span>사업제안서</span>
                        </div>
                    </a>
                    <a href="/business/list/biddingProposal" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_09.png' />
                        <div class='service_text'>
                            <span>입찰제안서</span>
                        </div>
                    </a>
                    <a href="/business/list/investmentProposal" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_10.png' />
                        <div class='service_text'>
                            <span>투자제안서</span>
                        </div>
                    </a>
                    <a href="/business/list/marketingProposal" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_11.png' />
                        <div class='service_text'>
                            <span>마케팅제안서</span>
                        </div>
                    </a>
                    <a href="/business/list/partnershipProposal" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_12.png' />
                        <div class='service_text'>
                            <span>제휴제안서</span>
                        </div>
                    </a>

                    <!-- 소개서 및 자료 -->
                    <a href="/business/list/lectureMaterials" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_13.png' />
                        <div class='service_text'>
                            <span>강의자료</span>
                        </div>
                    </a>
                    <a href="/business/list/education" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_14.png' />
                        <div class='service_text'>
                            <span>교육자료</span>
                        </div>
                    </a>
                    <a href="/business/list/seminarMaterials" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_15.png' />
                        <div class='service_text'>
                            <span>세미나자료</span>
                        </div>
                    </a>
                    <a href="/business/list/company" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_16.png' />
                        <div class='service_text'>
                            <span>회사소개서</span>
                        </div>
                    </a>
                    <a href="/business/list/productIntroduction" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_17.png' />
                        <div class='service_text'>
                            <span>제품소개서</span>
                        </div>
                    </a>
                    <a href="/business/list/serviceIntroduction" class='service_wrap'>
                        <img src='resources/users/img/main/services/service_18.png' />
                        <div class='service_text'>
                            <span>서비스소개서</span>
                        </div>
                    </a>
                </div>

                <div class='review_container'>
                    <div class='text_wrap'>
                        <div class='title_wrap'>
                            <h2>Review</h2>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>
                        <a href='/consulting#reviewListMobile' class='view_all_wrap_link'>
                            <div class='view_all_wrap'>
                                <span>전체보기</span>
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </div>
                        </a>
                    </div>
                    <ul class='review_list'>

                            <?php
                            foreach ($review_list as $list) {
                            ?>
                            
                                <li class='review_box cursor_hand get_review_info' data-idx="<?= $list->idx ?>">
                                <span class='review_title'><?= $list->subject ?></span>
                            <?php } ?>
                    </ul>
                </div>

                <div class="partner_box marquee">
                    <ul class="partner_wrap marquee-content">
                        <?php
                            foreach ($partbanner_list as $list) {
                            ?>
                                <li class='marquee-item'>
                                    <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                                </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!-- e:section_03-->

            <!-- s:section_04-->
            <section class="section_04">
                <div class='content_04'>
                    <div class='title_wrap'>
                        <span>PPT</span>
                        <img src='resources/users/img/main/text/title_arrow.png' />
                    </div>

                    <div class='ppt_wrap'>
                        <div class='proposal_document'>
                            <div class='sub_title accordion-trigger'>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                                <span>Proposal document</span>
                            </div>
                            <div class='ppt_content accordion-panel'>
                                <div class='description_wrap'>
                                    <span>제안서</span>
                                    <span>
                                        차별성 높은 표현력과 설득력 있는 스토리 구성을 통해 우리만의 경쟁력을 극대화합니다.
                                    </span>
                                </div>
                                <div class='type_example_wrap'>
                                    <span><a href='business?pptIndex=1'>용역제안</a></span>
                                    <span><a href='business?pptIndex=1'>제휴제안</a></span>
                                    <span><a href='business?pptIndex=1'>입찰제안</a></span>
                                    <span><a href='business?pptIndex=1'>마케팅제안</a></span>
                                    <span><a href='business?pptIndex=1'>영업제안</a></span>
                                    <span><a href='business?pptIndex=1'>투자제안</a></span>
                                </div>
                                <div class='img_wrap'>
                                    <a href='business?pptIndex=1' class='view_all_wrap_link'>
                                        <div class='view_all_wrap'>
                                            <span>전체보기</span>
                                            <img src='resources/users/img/icon/main_i_right.png' />
                                        </div>
                                    </a>
                                    <img src='resources/users/img/main/mobile/proposal_img.png' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='ppt_wrap'>
                        <div class='introduction'>
                            <div class='sub_title accordion-trigger'>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                                <span>Introduction</span>
                            </div>
                            <div class='ppt_content accordion-panel'>
                                <div class='description_wrap'>
                                    <span>소개서</span>
                                    <span>
                                        임팩트 강한 키워드와 논리적 정보전달을 통해<br />
                                        신뢰성과 긍정적 이미지를 유도합니다
                                    </span>
                                </div>
                                <div class='type_example_wrap'>
                                    <span><a href='business?pptIndex=2'>회사소개</a></span>
                                    <span><a href='business?pptIndex=2'>사업소개</a></span>
                                    <span><a href='business?pptIndex=2'>제품소개</a></span>
                                </div>
                                <div class='img_wrap'>
                                    <a href='business?pptIndex=2' class='view_all_wrap_link'>
                                        <div class='view_all_wrap'>
                                            <span>상세보기</span>
                                            <img src='resources/users/img/icon/main_i_right.png' />
                                        </div>
                                    </a>
                                    <img src='resources/users/img/main/mobile/introduction_img.png' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='ppt_wrap'>
                        <div class='business_report'>
                            <div class='sub_title accordion-trigger'>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                                <span>Business report</span>
                            </div>
                            <div class='ppt_content accordion-panel'>
                                <div class='description_wrap'>
                                    <span>보고서</span>
                                    <span>
                                        가독성 높은 디자인과 데이터 시각화를 통해<br />
                                        원하는 성과목표 메시지를 명확하게 전달합니다
                                    </span>
                                </div>
                                <div class='type_example_wrap'>
                                    <span><a href='business?pptIndex=3'>업무보고</a></span>
                                    <span><a href='business?pptIndex=3'>성과보고</a></span>
                                    <span><a href="business?pptIndex=3">IR보고</a></span>
                                </div>
                                <div class='img_wrap'>
                                    <a href='business?pptIndex=3' class='view_all_wrap_link'>

                                        <div class='view_all_wrap'>
                                            <span>전체보기</span>
                                            <img src='resources/users/img/icon/main_i_right.png' />
                                        </div>
                                    </a>
                                    <img src='resources/users/img/main/mobile/business_report_img.png' />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='ppt_wrap'>
                        <div class='education'>
                            <div class='sub_title accordion-trigger'>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                                <span>Educational materials</span>
                            </div>
                            <div class='ppt_content accordion-panel'>
                                <div class='description_wrap'>
                                    <span>교육·강의</span>
                                    <span>
                                        이해도 높은 구성력과 간결한 메시지를 통해<br />
                                        참석자와의 원활한 소통과 공감대를 형성합니다
                                    </span>
                                </div>
                                <div class='type_example_wrap'>
                                    <span><a href='business?pptIndex=4'>강의교재</a></span>
                                    <span><a href='business?pptIndex=4'>교육책자</a></span>
                                    <span><a href='business?pptIndex=4'>세미나자료</a></span>
                                </div>
                                <div class='img_wrap'>
                                    <a href='business?pptIndex=4' class='view_all_wrap_link'>
                                        <div class='view_all_wrap'>
                                            <span>전체보기</span>
                                            <img src='resources/users/img/icon/main_i_right.png' />
                                        </div>
                                    </a>
                                    <img src='resources/users/img/main/mobile/educational_img.png' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- e:section_04-->

            <!-- s:section_05-->
            <section class="section_05">
                <div class='content_05'>
                    <div class='about_wrap'>
                        <div class='sub_title accordion-trigger'>
                            <div class='sub_title_wrap'>
                                <span>About</span>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                            </div>

                            <a href='/company' class='view_all_wrap_link'>
                                <div class='view_all_wrap'>
                                    <span>상세보기</span>
                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>

                        </div>
                        <div class='about_content accordion-panel'>
                            <span class='sub_description'>
                                PPT Design<br />
                                Outsourcing company
                            </span>
                            <span class='detail_description'>
                                MTMBPPT는 고객과의 소통을 최우선으로
                                최적의 디자인과 최고의 가치를 제공하여
                                고객이 원하는 목표를 달성할 수 있도록 디자인 서비스를 제공하는
                                고객 맞춤형 PPT 디자인 전문 기업입니다.
                            </span>
                        </div>
                    </div>

                    <div class='notice_wrap'>
                        <div class='sub_title accordion-trigger'>
                            <div class='sub_title_wrap'>
                                <span>Notice</span>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                            </div>
                            <a href='/customer' class='view_all_wrap_link'>

                                <div class='view_all_wrap'>
                                    <span>전체보기</span>
                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        </div>
                        <div class='notice_list_wrap accordion-panel'>
                            <ul class='notice_list'>
                                <?php
                                    foreach ($notice_list as $list) {
                                    ?>
                                        <li class='notice_box cursor_hand get_notice_info' data-idx="<?= $list->idx ?>">
                                            <?= $list->title ?>
                                        </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- e:section_05-->

            <!-- s:section_06-->
            <section class="section_06">
                <div class='content_06'>
                    <div class='about_wrap' id='infinite-scroll-section-mo'>
                        <div class='sub_title'>
                            <div class='sub_title_wrap'>
                                <span>Portfolio</span>
                                <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                            </div>
                        </div>

                        <ul class='portfolio_list'>
                               <?php
                            foreach ($portfolio_list as $list) {
                                $img = json_decode($list->img_name)[0];
                                $currIdx = htmlspecialchars($list->idx, ENT_QUOTES, 'UTF-8');
                                $imgSrc = htmlspecialchars($img, ENT_QUOTES, 'UTF-8');
                                $title = htmlspecialchars($list->title, ENT_QUOTES, 'UTF-8');
                                ?>
                                <li class="portfolio_wrap select_portfolio" data-curridx="<?= $currIdx ?>">
                                    <div class="portfolio_img_inner">
                                        <img src="<?= $imgSrc ?>" alt="<?= $title ?>">
                                    </div>
                                    <div class="hover_overlay">
                                        <div class="hover_top">
                                            <img src='resources/users/img/main/view_detail.png' />
                                            <span><?= $title ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div id="sentinelMO"></div>
                    </div>
                </div>
            </section>
            <!-- e:section_06-->

            <footer class="footer mo" id='footer'>
                <div class="ft_wrap">
                    <p><b>(주)엠티엠비코리아</b></p>
                    <p>
                        대표: 정세종<br />
                        서울특별시 강서구 양천로 424 데시앙플렉스 지식산업센터 1231호<br />
                        Tel : 02-3663-0332 &emsp; Fax : 02-374-0335<br />
                        E-mail : mtmb@mtmbkorea.com<br />
                        사업자번호 : 130-87-09598 &emsp; 개인정보보호책임자 : 진동호 <br />
                        통신판매업신고중 :제 2023-서울강서-3726호
                    </p>
                    <p>
                    </p>
                    <div class='copyright_wrap'>
                        <p>COPYRIGHT (c) 2021 MTMBKOREA Co., Ltd.<br /> ALL RIGHTS RESERVED.</p>
                        <button class='footer_btn'>
                            <a href='/main/manager'>관리자</a>
                        </button>
                    </div>
                </div>
            </footer>

        </div>
        <!-- e:mo -->

        <!-- s:top_fixed -->
        <div class="top" id="top_fixed">
            <button type="button" onclick="location.href='/#main'">
                <img src='resources/users/img/main/top.png' id='top-icon-img' />
            </button>
        </div>
        <!-- e:top_fixed -->

        <!-- s:right_fixed -->
        <div class="right-fixed mo">
            <button>
                <img src='resources/users/img/icon/i_kakao_button.png' />
            </button>
            <button onclick="location.href='/#pageTop'">
                <img src='resources/users/img/icon/i_home_button.png' />
            </button>
            <button onclick="window.history.back()">
                <img src='resources/users/img/icon/i_back_button.png' />
            </button>
            <button onclick="location.href='/#pageTop'">
                <img src='resources/users/img/icon/i_top_button.png' />
            </button>
        </div>
        <!-- e:right_fixed -->

            <footer class="footer footer_pc fp-auto-height" id='footer'>
                <div class="ft_wrap">
                    <div class="row">
                        <div class="col-2">
                            <p><b>(주)엠티엠비코리아</b></p>
                        </div>
                        <div class="col-4">
                            <p>대표 : 정세종</p>
                            <p>서울특별시 강서구 양천로 424 데시앙플렉스 지식산업센터 1231호<br>
                                Tel : 02-3663-0332 Fax : 02-374-0335 E-mail : mtmb@mtmbkorea.com</p>
                            <button>
                                <a href='/main/manager'>관리자</a>
                            </button>
                        </div>
                        <div class="col-4">
                            <p>사업자번호 : 130-87-09598 <span>통신판매업신고중 :제 2023-서울강서-3726호</span><br />
                                개인정보보호책임자 : 진동호</p>
                            <p class='copyright'>COPYRIGHT (c) 2021 MTMBKOREA Co., Ltd. ALL RIGHTS RESERVED.</p>
                        </div>
                    </div>
                </div>
            </footer>
    </div>

    <div class="modal fade write-modal view-modal" id="modal-review-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="reviewModalLabel">Review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal_review">
                        <h5 id="modal-review-subject"></h5>
                        <ul class="data">
                            <li id="modal-review-regdate"></li>
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

    <div class="modal fade write-modal view-modal" id="modal-portfolio-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="reviewModalLabel">Portfolio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_review">
                    <h5 id="modal-portfolio-view-title"></h5>
                </div>
                <div class="modal_review_text row" id="modal-portfolio-view-img"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.25/vendors/easings.min.js" integrity="sha512-SrKslwu6IjHEo/8mAOtkoUOT3MzHCEOFWktrC8BNtjPuBBYLYjg1y/Marat34uYfOfxDMLEwy8DLArWEVc2i+w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script type="text/javascript" src="/resources/users/lib/vendors/scrolloverflow.min.js"></script>
<script src="/resources/users/js/examples.js?<?= time() ?>"></script>
<script src="/resources/users/js/main.js?<?= time() ?>"></script>
<script src="/resources/users/js/common.js?<?= time() ?>"></script>
<script>
    var portfolio_list = <?= json_encode($portfolio_list) ?>;
    console.log('portfolio_list:', portfolio_list);

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

        $(document).on("click", ".review_box", function() {
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

        modal_portfolio_view = new bootstrap.Modal(document.getElementById("modal-portfolio-view"), {
            keyboard: false,
        });

        $(".select_portfolio").on("click", function() {
            curr_portfolio_idx = $(this).data('curridx');
            view_portfolio();
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
                $("#modal-notice-content")(replaceToBr(result.data.contents));
                modal_notice_view.show();
            }
        });
    }


    function view_portfolio() {
        $.post("/consulting/portfolioView", {
            idx: curr_portfolio_idx
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                modal_portfolio_view.show();
                var img_list = JSON.parse(result.data.img_name);
                console.log(img_list)

                $("#modal-portfolio-view-title").text(result.data.title);
                $("#modal-portfolio-view-img").empty();

                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-lg-6 col-sm-12 mb-2 text-center'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#modal-portfolio-view-img").append(div_tags);
                });
            }
        });
    }
</script>