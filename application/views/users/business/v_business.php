
            
        <!-- pc -->
        <section class="business_container pc">
            <div class='content_wrap'>
                <div class='all_service_container' id='allService'>
                    <div class='title_container'>
                        <div class='title_wrap'>
                            <h2>ALL Service</h2>
                            <img src='resources/users/img/main/text/title_arrow.png' alt='텍스트 우측 하단 화살표 이미지' />
                        </div>
                        <span class='description'>
                            MTMBPPT는 고객을 위한 <br />
                            분야별 <span>전문 PPT 디자인 서비스</span>를 제공 합니다
                        </span>
                    </div>

                        <?php
                            $business_list_bottom = array_filter($business_list, function ($item) {
                                return ($item['use_menu'] && !$item['use_top']);
                            });
                        ?>

                    <div class='service_list'>
                        <?php
                        $index = 1; // 인덱스 초기값 설정
                        foreach ($business_list_bottom as $list) {
                            // 두 자리 숫자로 포맷팅
                            $formattedIndex = sprintf("%02d", $index);
                        ?>

                            <a href="/business/list/<?= $list['segment'] ?>/" class='service_wrap'>
                                <img src='resources/users/img/main/services/service_<?= $formattedIndex ?>.png' />
                                <div class='service_text'>
                                    <span><?= $list['name'] ?></span>

                                    <img src='resources/users/img/icon/main_i_right.png' />
                                </div>
                            </a>
                        <?php  $index++; } ?>
                    </div>
                </div>

                <div class='ppt_container' id='pptWrap'>
                    <div class='title_wrap'>
                        <h2>PPT</h2>
                        <img src='resources/users/img/main/text/title_arrow.png' alt='텍스트 우측 하단 화살표 이미지' />
                    </div>

                    <div class='ppt_content_container'>
                        <div class='ppt_index_container'>
                            <div class='ppt_index_wrap'>
                                <p>Proposal document</p>
                                <img src='resources/users/img/business/right_arrow_blue.png' />
                            </div>
                            <div class='ppt_index_wrap'>
                                <p>Introduction</p>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                            <div class='ppt_index_wrap'>
                                <p>Business report</p>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                            <div class='ppt_index_wrap'>
                                <p>Educational materials</p>
                                <img src='resources/users/img/main/text/title_arrow.png' />
                            </div>
                        </div>

                        <div class='ppt_content_wrap'>
                            <!-- 제안서 -->
                            <div class='ppt_content active'>
                                <div class='left_wrap'>
                                    <span class='title_wrap'>
                                        제안서
                                    </span>

                                    <ul class='strength_wrap'>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>임팩트 강한 디자인</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>대상의 경쟁력</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>간결한 구성력</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>메세지 전달력</span>
                                        </li>
                                    </ul>

                                    <span class='description'>
                                        차별성 높은 표현력과 설득력 있는 스토리 구성을 통해 우리만의 경쟁력을 극대화합니다
                                    </span>
                                </div>

                                <img src='resources/users/img/business/ppt_img/proposal_document.png' />
                            </div>

                            <!-- 소개서 -->
                            <div class='ppt_content'>
                                <div class='left_wrap'>
                                    <span class='title_wrap'>
                                        소개서
                                    </span>

                                    <ul class='strength_wrap'>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>차별성 높은 디자인</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>표현의 전문성</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>정보의 객관성</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>대상의 필요성</span>
                                        </li>
                                    </ul>

                                    <span class='description'>
                                        임팩트 강한 키워드와 논리적 정보전달을 통해 신뢰성과 긍정적 이미지를 유도합니다
                                    </span>
                                </div>
                                <img src='resources/users/img/business/ppt_img/Introduction.png' />
                            </div>

                            <!-- 보고서 -->
                            <div class='ppt_content'>
                                <div class='left_wrap'>
                                    <span class='title_wrap'>
                                        보고서
                                    </span>

                                    <ul class='strength_wrap'>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>가독성 높은 디자인</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>데이터 시각화</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>논리적 구성력</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>정보의 전달력</span>
                                        </li>
                                    </ul>

                                    <span class='description'>
                                        가독성 높은 디자인을 바탕으로 논리적 구성력과 데이터 시각화를 통해 전달하고자 하는 정보를 명확하게 전달합니다
                                    </span>
                                </div>
                                <img src='resources/users/img/business/ppt_img/business_report.png' />
                            </div>

                            <!-- 교육 강의 자료 -->
                            <div class='ppt_content'>
                                <div class='left_wrap'>
                                    <span class='title_wrap'>
                                        교육•강의
                                    </span>

                                    <ul class='strength_wrap'>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>전문성 높은 디자인</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>체계적 구성력</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>스토리 설득력</span>
                                        </li>
                                        <li>
                                            <img src='resources/users/img/check_box.png' />
                                            <span>정확한 전달력</span>
                                        </li>
                                    </ul>

                                    <span class='description'>
                                        이해도 높은 구성력과 간결한 메시지를 통해 참석자와의 원활한 소통과 공감대를 형성합니다
                                    </span>
                                </div>
                                <img src='resources/users/img/business/ppt_img/educational_materials.png' />
                            </div>

                            <ul class='service_step_container'>
                                <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_01.png" alt="상담 문의">
                                    <p>상담</p>
                                </li>
                                <li>
                                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                                </li>
                              <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_02.png" alt="기획검토">
                                    <p>기획검토</p>
                                </li>
                                <li>
                                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                                </li>
                               <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_03.png" alt="화상 대면 미팅">
                                    <p>화상 · 대면 미팅</p>
                                </li>
                                <li>
                                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                                </li>
                              <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_04.png" alt="담당 배정">
                                    <p>담당배정</p>
                                </li>
                                <li>
                                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                                </li>
                              <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_05.png" alt="디자인">
                                    <p>디자인</p>
                                </li>
                                <li>
                                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                                </li>
                               <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_06.png" alt="작업 완료">
                                    <p>수정</p>
                                </li>
                                <li>
                                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                                </li>
                               <li class='step_wrap'>
                                    <img src="resources/users/img/business/service_step/step_07.png" alt="작업 완료">
                                    <p>완료</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!-- mobile -->
<section class="business_container mo">
    <div class='content_wrap'>
        <div class='all_service_container' id='allService'>
            <div class='title_container'>
                <div class='title_wrap'>
                    <h2>ALL Service</h2>
                    <img src='resources/users/img/main/text/title_arrow.png' alt='텍스트 우측 하단 화살표 이미지' />
                </div>
                <span class='description'>
                    MTMBPPT는 고객을 위한 <br />
                    분야별 전문 <b>PPT디자인 서비스</b>를 제공 합니다
                </span>
            </div>

            <div class='service_list'>

                        <?php
                        $index = 1; // 인덱스 초기값 설정
                        foreach ($business_list_bottom as $list) {
                            // 두 자리 숫자로 포맷팅
                            $formattedIndex = sprintf("%02d", $index);
                        ?>
                        <a href="/business/list/<?= $list['segment'] ?>/" class='service_wrap'>
                                        <img src='resources/users/img/main/services/service_<?= $formattedIndex ?>.png' />
                            <div class='service_text'>
                                <span><?= $list['name'] ?></span>
                                <img src="img/icon/main_i_right.png" style="animation-delay: 0s;">
                            </div>
                        </a>
                    <?php  $index++; } ?>
            </div>

        </div>

        <div class='ppt_container' id='pptWrap'>
            <div class='title_wrap'>
                <h2>PPT</h2>
                <img src='resources/users/img/main/text/title_arrow.png' alt='텍스트 우측 하단 화살표 이미지' />
            </div>

            <div class='ppt_wrap'>
                <div class='proposal_document'>
                    <div class='sub_title accordion-trigger'>
                        <div class="arrow_tab_img">
                            <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                        </div>
                        <span>Proposal document</span>
                    </div>
                    <div class='ppt_content accordion-panel'>
                        <div class='left_wrap'>
                            <span class='title_wrap'>
                                제안서
                            </span>

                            <ul class='strength_wrap'>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>임팩트 강한 디자인</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>대상의 경쟁력</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>간결한 구성력</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>메세지 전달력</span>
                                </li>
                            </ul>

                            <span class='description'>
                                차별성 높은 표현력과 설득력 있는 스토리 구성을 통해 우리만의 경쟁력을 극대화합니다
                            </span>
                        </div>

                        <img src='resources/users/img/business/ppt_img/proposal_document.png' />
                    </div>
                </div>
            </div>

            <div class='ppt_wrap'>
                <div class='proposal_document'>
                    <div class='sub_title accordion-trigger'>
                        <div class="arrow_tab_img">
                            <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                        </div>
                        <span>Introduction</span>
                    </div>
                    <div class='ppt_content accordion-panel'>
                        <div class='left_wrap'>
                            <span class='title_wrap'>
                                소개서
                            </span>

                            <ul class='strength_wrap'>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>차별성 높은 디자인</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>표현의 전문성</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>정보의 객관성</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>대상의 필요성</span>
                                </li>
                            </ul>

                            <span class='description'>
                                임팩트 강한 키워드와 논리적 정보전달을 통해 신뢰성과 긍정적 이미지를 유도합니다
                            </span>
                        </div>

                        <img src='resources/users/img/business/ppt_img/Introduction.png' />
                    </div>
                </div>
            </div>

            <div class='ppt_wrap'>
                <div class='proposal_document'>
                    <div class='sub_title accordion-trigger'>
                        <div class="arrow_tab_img">
                            <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                        </div>
                        <span>Business report</span>
                    </div>
                    <div class='ppt_content accordion-panel'>
                        <div class='left_wrap'>
                            <span class='title_wrap'>
                                보고서
                            </span>

                            <ul class='strength_wrap'>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>가독성 높은 디자인</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>데이터 시각화</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>논리적 구성력</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>정보의 전달력</span>
                                </li>
                            </ul>

                            <span class='description'>
                                가독성 높은 디자인을 바탕으로 논리적 구성력과 데이터 시각화를 통해 전달하고자 하는 정보를 명확하게 전달합니다
                            </span>
                        </div>

                        <img src='resources/users/img/business/ppt_img/business_report.png' />
                    </div>
                </div>
            </div>

            <div class='ppt_wrap'>
                <div class='proposal_document'>
                    <div class='sub_title accordion-trigger'>
                        <div class="arrow_tab_img">
                            <img src='resources/users/img/main/text/title_arrow.png' class='accordion-trigger-arrow-img' />
                        </div>
                        <span>Educational materials</span>
                    </div>
                    <div class='ppt_content accordion-panel'>
                        <div class='left_wrap'>
                            <span class='title_wrap'>
                                교육•강의
                            </span>

                            <ul class='strength_wrap'>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>전문성 높은 디자인</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>체계적 구성력</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>스토리 설득력</span>
                                </li>
                                <li>
                                    <img src='resources/users/img/check_box.png' />
                                    <span>정확한 전달력</span>
                                </li>
                            </ul>

                            <span class='description'>
                                이해도 높은 구성력과 간결한 메시지를 통해 참석자와의 원활한 소통과 공감대를 형성합니다
                            </span>
                        </div>

                        <img src='resources/users/img/business/ppt_img/educational_materials.png' />
                    </div>
                </div>
            </div>
        </div>

        <div class='service_step_container_mo'>
            <ul class='service_step_container'>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_01.png" alt="상담 문의">
                    <p>상담</p>
                </li>
                <li >
                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                </li>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_02.png" alt="기획검토">
                    <p>기획검토</p>
                </li>
                <li >
                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                </li>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_03.png" alt="화상 대면 미팅">
                    <p>화상 · 대면 미팅</p>
                </li>
            </ul>

            <ul class='service_step_container'>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_04.png" alt="담당 배정">
                    <p>담당배정</p>
                </li>
                <li >
                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                </li>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_05.png" alt="디자인">
                    <p>디자인</p>
                </li>
                <li >
                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                </li>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_06.png" alt="작업 완료">
                    <p>수정</p>
                </li>
                <li >
                    <img src='resources/users/img/business/service_step/right_arrow.png' alt='오른쪽 화살표' />
                </li>
                <li class='step_wrap'>
                    <img src="resources/users/img/business/service_step/step_07.png" alt="작업 완료">
                    <p>완료</p>
                </li>
            </ul>
        </div>
    </div>
</section>

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>
<script src="/resources/users/js/common.js"></script>
<script src="/resources/users/js/business.js"></script>
<script>
    section = "<?= $page_info['section'] ?>";
</script>