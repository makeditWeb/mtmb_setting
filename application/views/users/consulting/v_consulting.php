
    <!-- pc -->
    <section class="consulting_container pc">
        <div class='content_wrap'>
            <!-- step 00 -->
            <div class='consulting_box step_0 start consulting_step_start'>
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

                <div class='right_wrap btn_consulting_start_step'>
                    <p>견적문의 <img src="resources/users/img/icon/main_i_right.png"> </p>
                    <span>Start</span>
                </div>
            </div>

            <!-- step 01 -->
            <div class='consulting_box step_box step_01 consulting_step d-none'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <span class='survey_title'>서비스 분야</span>

                        <div class="survey_scroller">
                            <div class='check_container'>
                                     <?php
                                $i = 0;
                                foreach ($business_list as $blist) {
                                    $category_list[$blist['segment']] = false;
                                ?>
                                    <div class="check_wrap check_group">
                                        <input type='checkbox' id="cate_<?= $i ?>" class="consulting_category" data-segment="<?= $blist['segment'] ?>" value="<?= $blist['name'] ?>" />
                                        <label for="cate_<?= $i ?>"><?= $blist['name'] ?></label>
                                    </div>
                                <?php
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>

                        <span class='description'>
                            다중 선택 가능합니다.<br />
                            <span><strong>상담 신청</strong>을 선택하시면 담당자 배정 후 연락드립니다.</span>
                        </span>

                        <div class='step_control_container'>
                            <div class='prev move_step btn_consulting_move_step' data-step-move="0">
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>1</b> / 5</span>

                            <div class='next next move_step btn_consulting_move_step' data-step-move="1">
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap' id='print_result_step_1'>
                                <span class='title'>상담신청</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 02 -->
            <div class='consulting_box step_box step_02 consulting_step d-none'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <span class='survey_title'>세부 사항</span>

                        <div class="survey_scroller category_wrap" id="business_questions"></div>

                        <!-- <div class="survey_scroller">
                            <div class='form_container'>
                                <span class='form_title'>상담 신청</span>
                                <div class='form_wrap'>
                                    <span class='form_sub_title'>상담유형</span>

                                    <div class='form_checkbox_container'>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='phone_consult_check' /><label></label>
                                            <label for='phone_consult_check'>전화상담</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='email_consult_check' /><label></label>
                                            <label for='email_consult_check'>이메일 상담</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='form_container'>
                                <span class='form_title'>사업계획서</span>

                                <div class='form_wrap'>
                                    <span class='form_sub_title'>전체페이지</span>

                                    <div class='form_checkbox_container'>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='page_check_01' />
                                            <label for='page_check_01'>10~20P</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='page_check_02' />
                                            <label for='page_check_02'>~30P</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='page_check_03' />
                                            <label for='page_check_03'>~40P</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='page_check_04' />
                                            <label for='page_check_04'>40P 이상</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='form_wrap'>
                                    <span class='form_sub_title'>작업일정</span>

                                    <div class='form_checkbox_container'>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='schedule_check_01' />
                                            <label for='schedule_check_01'>3~4일</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='schedule_check_02' />
                                            <label for='schedule_check_02'>~4~5일</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='schedule_check_03' />
                                            <label for='schedule_check_03'>1주일 이상</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='schedule_check_04' />
                                            <label for='schedule_check_04'>긴급(2일이내)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class='step_control_container'>
                            <div class='prev move_step btn_consulting_move_step' data-step-move="0">
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>2</b> / 5</span>

                            <div class='next move_step btn_consulting_move_step' data-step-move="2">
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap' id='print_result_step_1'>
                                <span class='title'>상담신청</span>
                            </div>

                            </div>
                            <div class='survey_wrap' id='print_result_step_2'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 03 -->
            <div class='consulting_box step_box step_03 consulting_step d-none'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <span class='survey_title'>고객 정보</span>

                        <div class="survey_scroller">
                            <div class='input_wrap first_input_wrap'>
                                <label for='company_name'>업체명</label>
                                <input type="text" class="form-valid fv_empty" name="company_name" value="" maxlength="20" />
                            </div>
                            <div class='input_wrap'>
                                <label for='company_user_name'>담당자</label>
                                <input type="text" class="form-valid fv_empty" name="company_user_name" value="" maxlength="20" />
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>대표번호</label>
                                <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel1" value="">
                                <span>-</span>
                                <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel2" value="">
                                <span>-</span>
                                <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel3" value="">
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>휴대전화</label>
                                <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel1" value="">
                                <span>-</span>
                                <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel2" value="">
                                <span>-</span>
                                <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel3" value="">
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>이메일</label>
                                <input type="email" class="form-valid fv_empty fv_email" name="company_user_email" maxlength="50" value="">
                            </div>
                        </div>
                        <div class='step_control_container'>
                            <div class='prev move_step btn_consulting_move_step' data-step-move="1">
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>3</b> / 5</span>

                            <div class='next move_step btn_consulting_move_step' data-step-move="3">
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>

                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>고객정보</span>
                                <span class='content'>
                                    엠티엠비코리<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                    010-1234-1234<br />
                                    abc@gmail.com<br />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 04 -->
            <div class='consulting_box step_box step_04 consulting_step d-none'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <span class='survey_title'>추가 정보</span>

                        <div class="survey_scroller">
                            <div class='detail_input_wrap'>
                                <span>세부 내용을 작성하시면 더욱 상세한 견적을 받으실 수 있습니다</span>
                                <textarea cols="30" rows="5"></textarea>
                            </div>

                            <div class='password_input_wrap'>
                                <input type='password' placeholder='패스워드를 입력해 주세요' />
                            </div>

                            <div class='file_input_container'>
                                <div class='file_input_wrap'>
                                    <input type="file" name="consulting_file1" id="consulting_file1" placeholder="파일을 선택해주세요." />
                                </div>
                                <div class='file_input_wrap'>
                                    <input type="file" name="consulting_file2" id="consulting_file2" placeholder="파일을 선택해주세요." />
                                </div>
                                <div class='file_input_wrap'>
                                    <input type="password" class="form-valid fv_empty" name="consulting_pass" value="" placeholder="패스워드를 입력해주세요">
                                </div>
                            </div>
                        </div>

                        <div class='step_control_container'>
                            <div class='prev move_step btn_consulting_move_step' data-step-move="2">
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>4</b> / 5</span>

                            <div class='next move_step btn_consulting_move_step' data-step-move="4">
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>고객정보</span>
                                <span class='content'>
                                    엠티엠비코리<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                    010-1234-1234<br />
                                    abc@gmail.com<br />
                                </span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>추가정보</span>
                                <span class='content'>
                                    엠티엠비코리아<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- step 05 -->
            <div class='consulting_box step_box step_05 consulting_step d-none'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>

                        <div class='complete_wrap'>
                            <span>감사합니다</span>

                            <span>
                                1:1맞춤 컨설팅을 위해<br />
                                담당자 배정 후 연락드리겠습니다<br />
                                <span>(약 30분 이내)</span>
                            </span>

                            <hr />

                            <span>
                                대표전화(02-3663-0332)로 연락 주시면<br />
                                보다 신속하게 상담받으실 수 있습니다
                            </span>
                        </div>


                        <div class='step_control_container'>
                            <span><b>5</b> / 5</span>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>고객정보</span>
                                <span class='content'>
                                    엠티엠비코리<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                    010-1234-1234<br />
                                    abc@gmail.com<br />
                                </span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>추가정보</span>
                                <span class='content'>
                                    엠티엠비코리아<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Q & A -->
            <div class='consulting_qa_container' id='consultingList'>
                <div class='left_wrap'>
                    <div class='top_wrap'>
                        <div class='title_wrap'>
                            <span>Consulting List</span>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>

                        <div class='search_wrap'>
                            <select name="search" class="select">
                                <option disabled selected>제목+내용</option>
                                <option value="apple">제목</option>
                                <option value="orange">내용</option>
                                <option value="grape">제목+내용</option>
                            </select>

                            <!-- TODO: 검색 버튼 -->
                            <input type='text' class='search' class="consulting_keyword" />
                        </div>
                    </div>


                    
                    <div class="notice_pagination">
                        <ul class="pagination_arrow">
                            <li class="prev btn_consulting_prev_page">
                                <img src="resources/users/img/icon/arrow_left.png">
                            </li>
                            <li class="next btn_consulting_next_page"><img src="resources/users/img/icon/arrow_right.png"></li>
                        </ul>
                        <ul class="pagination_number">
                            <li class="now_page consulting_curr_page">2</li>
                            <li>/</li>
                            <li class="total_page consulting_total_page">80</li>
                        </ul>
                    </div>
                </div>

                <div class="request_table_wrapper">
                    <table class="request_table">
                        <tbody id='table_consulting_list_pc'>
                        </tbody>
                    </table>
                </div>

                

            </div>

            <!-- Review List -->
            <div class='review_container' id='reviewList'>
                <div class='left_wrap'>
                    <div class='top_wrap'>
                        <div class='title_wrap'>
                            <span>Review</span>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                        </div>

                        <div class='search_wrap'>
                            <select name="search" class="select">
                                <option disabled selected>제목+내용</option>
                                <option value="apple">제목</option>
                                <option value="orange">내용</option>
                                <option value="grape">제목+내용</option>
                            </select>

                            <input type='text' class='search' />
                        </div>
                    </div>

                    <div class="cont_bot">

                        <div class="input_write_button">
                            <button class="qna-btn write-btn btn_review_add">
                                <p>글쓰기</p>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </button>
                        </div>
                        <div class="notice_pagination">
                            <ul class="pagination_arrow">
                                <li class="prev btn_review_prev_page">
                                    <img src="resources/users/img/icon/arrow_left.png">
                                </li>
                                <li class="next btn_review_next_page"><img src="resources/users/img/icon/arrow_right.png"></li>
                            </ul>
                            <ul class="pagination_number">
                                <li class="now_page review_curr_page">2</li>
                                <li>/</li>
                                <li class="total_page review_total_page">80</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="request_table_wrapper">
                    <table class="review_table" id='table_review_list_pc'>
                    </table>
                </div>
            </div>

            
            <!-- 파트너사 롤링배너 -->
            <div class="partner_container" id='partnerCompany'>
                <div class='partner_wrap marquee'>
                    <ul class="marquee-content">
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_01.png' /></i></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_02.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_03.png' /></i></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_04.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_05.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_06.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_07.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_08.png' /></li>
                    </ul>
                </div>
            </div>

            <!-- 포트폴리오 영역 -->
            <div class='portfolio_container' id='portfolioWrap'>
                <div class='portfolio_content'>
                    <div class='title'>
                        <span>Portfolio</span>
                        <img src='resources/users/img/main/text/title_arrow.png' />
                    </div>

                    <ul class='portfolio_list'>
                        <?php
                        foreach ($portfolio_list as $list) {
                            $img = json_decode($list->img_name)[0];
                        ?>
                            <li class='portfolio_wrap select_portfolio' data-curridx="<?= $list->idx ?>">
                                <div class="portfolio_img_inner">
                                    <img src="<?= $img ?>" alt="<?= $list->title ?>">
                                </div>
                                <div class="hover_overlay">
                                    <div class="hover_top">
                                        <img src='resources/users/img/main/view_detail.png' />
                                        <span><?= $list->title ?></span>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                    <div id="sentinel"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- mobile -->
    <section class="consulting_container mo">
        <div class='content_wrap'>
            <!-- step 00 -->
            <div class='consulting_box step_0 active'>
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

                <div class='right_wrap'>
                    <p>견적문의  <img src="resources/users/img/icon/main_i_right.png"> </p>
                    <span>Start</span>
                </div>
            </div>

            <!-- step 01 -->
            <div class='consulting_box step_box step_01'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <div class="survey_top">
                            <div class="survey_eng">
                                <img src="resources/users/img/main/text/consulting_sub.png">
                            </div>
                            <span class='survey_title'>서비스 분야</span>
                        </div>
                        
                        <div class="mo_consult_scroll">
                            <div class='check_container'>
                                <div class='check_wrap'>
                                    <input type='checkbox' id='mo_check_01' />
                                    <label for='mo_check_01'>상담신청</label>
                                </div>
                                <div class='check_wrap'>
                                    <input type='checkbox' id='mo_check_02' />
                                    <label for='mo_check_02'>사업계획서</label>
                                </div>
                                <div class='check_wrap'>
                                    <input type='checkbox' id='mo_check_03' />
                                    <label for='mo_check_03'>업무보고서</label>
                                </div>
                                <div class='check_wrap'>
                                    <input type='checkbox' id='mo_check_04' />
                                    <label for='mo_check_04'>성과보고서</label>
                                </div>
                                <div class='check_wrap'>
                                    <input type='checkbox' id='mo_check_05' />
                                    <label for='mo_check_05'>IR보고서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_06' />
                                    <label for='mo_check_06'>연구보고서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_07' />
                                    <label for='mo_check_07'>영업보고서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_08' />
                                    <label for='mo_check_08'>입점제안서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_09' />
                                    <label for='mo_check_09'>사업제안서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_10' />
                                    <label for='mo_check_10'>입찰제안서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_11' />
                                    <label for='mo_check_11'>투자제안서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_12' />
                                    <label for='mo_check_12'>마케팅제안서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_13' />
                                    <label for='mo_check_13'>제휴제안서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_14' />
                                    <label for='mo_check_14'>강의자료</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_15' />
                                    <label for='mo_check_15'>교육자료</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_16' />
                                    <label for='mo_check_16'>세미나자료</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_17' />
                                    <label for='mo_check_17'>회사소개서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_18' />
                                    <label for='mo_check_18'>제품소개서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_19' />
                                    <label for='mo_check_19'>서비스소개서</label>
                                </div>
                                <div class='check_wrap'>

                                    <input type='checkbox' id='mo_check_20' />
                                    <label for='mo_check_20'>기타</label>
                                </div>
                            </div>
                        </div>
                        
                        <span class='description'>
                            다중 선택 가능합니다.<br />
                            <span><strong>상담 신청</strong>을 선택하시면 담당자 배정 후 연락드립니다.</span>
                        </span>

                        <div class='step_control_container'>
                            <div class='prev'>
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>1</b> / 5</span>

                            <div class='next'>
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 02 -->
            <div class='consulting_box step_box step_02'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <div class="survey_top">
                            <div class="survey_eng">
                                <img src="resources/users/img/main/text/consulting_sub.png">
                            </div>
                            <span class='survey_title'>세부 사항</span>
                        </div>

                        <div class="mo_consult_scroll">
                            <div class='form_container'>
                                <span class='form_title'>상담 신청</span>
                                <div class='form_wrap'>
                                    <span class='form_sub_title'>상담유형</span>

                                    <div class='form_checkbox_container'>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_phone_consult_check' />
                                            <label for='mo_phone_consult_check'>전화상담</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_email_consult_check' />
                                            <label for='mo_email_consult_check'>이메일 상담</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='form_container'>
                                <span class='form_title'>사업계획서</span>

                                <div class='form_wrap'>
                                    <span class='form_sub_title'>전체페이지</span>

                                    <div class='form_checkbox_container'>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_page_check_01' />
                                            <label for='mo_page_check_01'>10~20P</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_page_check_02' />
                                            <label for='mo_page_check_02'>~30P</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_page_check_03' />
                                            <label for='mo_page_check_03'>~40P</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_page_check_04' />
                                            <label for='mo_page_check_04'>40P 이상</label>
                                        </div>
                                    </div>
                                </div>

                                <div class='form_wrap'>
                                    <span class='form_sub_title'>작업일정</span>

                                    <div class='form_checkbox_container'>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_schedule_check_01' />
                                            <label for='mo_schedule_check_01'>3~4일</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_schedule_check_02' />
                                            <label for='mo_schedule_check_02'>~4~5일</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_schedule_check_03' />
                                            <label for='mo_schedule_check_03'>1주일 이상</label>
                                        </div>
                                        <div class='check_wrap'>
                                            <input type='checkbox' id='mo_schedule_check_04' />
                                            <label for='mo_schedule_check_04'>긴급(2일이내)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                        <div class='step_control_container'>
                            <div class='prev'>
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>2</b> / 5</span>

                            <div class='next'>
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    
                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 03 -->
            <div class='consulting_box step_box step_03'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    
                    <div class='survey_form_container'>
                        <div class="survey_top">
                            <div class="survey_eng">
                                <img src="resources/users/img/main/text/consulting_sub.png">
                            </div>
                            <span class='survey_title'>서비스분야</span>
                        </div>

                        <div class="mo_consult_scroll">
                            <div class='input_wrap'>
                                <label for='company_name'>업체명</label>
                                <input type='text' name='company_name' id='company_name' />
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>담당자</label>
                                <input type='text' name='name' id='name' />
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>대표번호</label>
                                <input type='text' name='company_phone' id='company_phone' />
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>휴대전화</label>
                                <input type='text' name='phone' id='phone' />
                            </div>
                            <div class='input_wrap'>
                                <label for='company_name'>이메일</label>
                                <input type='email' name='email' id='email' />
                            </div>
                            </div>
                        <div class='step_control_container'>
                            <div class='prev'>
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>3</b> / 5</span>

                            <div class='next'>
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>고객정보</span>
                                <span class='content'>
                                    엠티엠비코리<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                    010-1234-1234<br />
                                    abc@gmail.com<br />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 04 -->
            <div class='consulting_box step_box step_04'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>
                        <div class="survey_top">
                            <div class="survey_eng">
                                <img src="resources/users/img/main/text/consulting_sub.png">
                            </div>
                            <span class='survey_title'>추가정보</span>
                        </div>

                        <div class="mo_consult_scroll">
                            <div class="scroll_inner_left">
                                <div class='detail_input_wrap'>
                                    <span>세부 내용을 작성하시면 더욱 상세한 견적을 받으실 수 있습니다</span>
                                    <textarea cols="30" rows="5"></textarea>
                                </div>



                                <div class='password_input_wrap'>
                                    <input type='password' placeholder='패스워드를 입력해 주세요' />
                                </div>

                                <div class='file_input_container'>
                                    <div class='file_input_wrap'>
                                        <input type='file' />
                                    </div>
                                    <div class='file_input_wrap'>
                                        <input type='file' />
                                    </div>
                                    <div class='file_input_wrap'>
                                        <input type='file' />
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class='step_control_container'>
                            <div class='prev'>
                                <img src="resources/users/img/icon/arrow_left.png">
                                <span>이전</span>
                            </div>

                            <span><b>4</b> / 5</span>

                            <div class='next'>
                                <span>다음</span>
                                <img src="resources/users/img/icon/arrow_right.png">
                            </div>
                        </div>
                    </div>

                    <div class="survey_container_wrapper">
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>고객정보</span>
                                <span class='content'>
                                    엠티엠비코리<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                    010-1234-1234<br />
                                    abc@gmail.com<br />
                                </span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>추가정보</span>
                                <span class='content'>
                                    엠티엠비코리아<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- step 05 -->
            <div class='consulting_box step_box step_05'>
                <div class='left_wrap'>
                    <img class='section_text' src='resources/users/img/main/text/consulting.png' alt='consulting' />
                </div>

                <div class='right_wrap'>
                    <div class='survey_form_container'>

                        <div class='complete_wrap'>
                            <span>감사합니다</span>

                            <span>
                                1:1맞춤 컨설팅을 위해<br />
                                담당자 배정 후 연락드리겠습니다<br />
                                <span>(약 30분 이내)</span>
                            </span>

                            <hr />

                            <span>
                                대표전화(02-3663-0332)로 연락 주시면<br />
                                보다 신속하게 상담받으실 수 있습니다
                            </span>
                        </div>


                        <div class='step_control_container'>
                            <span><b>5</b> / 5</span>
                        </div>
                    </div>

                    <div class='survey_container_wrapper'>
                        <div class='survey_container'>
                            <span class='survey_content_title'>문의 내용</span>
                            <div class='survey_wrap'>
                                <span class='title'>상담신청</span>
                                <span class='content'>이메일 상담</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>사업계획서</span>
                                <span class='content'>~30P<br />긴급(2일이내)</span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>고객정보</span>
                                <span class='content'>
                                    엠티엠비코리<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                    010-1234-1234<br />
                                    abc@gmail.com<br />
                                </span>
                            </div>
                            <div class='survey_wrap'>
                                <span class='title'>추가정보</span>
                                <span class='content'>
                                    엠티엠비코리아<br />
                                    홍길동<br />
                                    010-1234-1234<br />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Consulting List -->
            <div class='consulting_qa_container'>
                <div class='left_wrap'>
                    <div class='top_wrap'>
                        <div class='title_wrap'>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                            <span>Consulting List</span>
                        </div>

                        <div class='search_wrap'>
                            <select name="search" class="select">
                                <option disabled selected>제목+내용</option>
                                <option value="apple">제목</option>
                                <option value="orange">내용</option>
                                <option value="grape">제목+내용</option>
                            </select>

                            <input type='text' class='search' />
                        </div>
                    </div>
                </div>

                <div class='consulting_content_container'>
                    <table>
                        <tbody id='table_consulting_list_mo'>

                        </tbody>
                    </table>

                    <div class='pagination_wrap'>
                        <div class='arrow_wrap'>
                            <span class='btn_consulting_prev_page'><img src="resources/users/img/icon/arrow_left.png"></span>
                            <span class='btn_consulting_next_page'><img src="resources/users/img/icon/arrow_right.png"></span>
                        </div>

                        <span>
                            <b class='consulting_curr_page'>2</b>/<span class='consulting_total_page'></span>
                        </span>
                    </div>

                </div>
            </div>

            <!-- 파트너사 롤링배너 -->
                <div class="partner_container" id='partnerCompanyMobile'>
                <div class='partner_wrap marquee'>
                    <ul class="marquee-content">
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_01.png' /></i></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_02.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_03.png' /></i></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_04.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_05.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_06.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_07.png' /></li>
                        <li class='marquee-item'><img src='resources/users/img/partner/partner_08.png' /></li>
                    </ul>
                </div>
            </div>

            <!-- Review List -->
            <div class='review_container' id='reviewListMobile'>
                <div class='left_wrap'>
                    <div class='top_wrap'>
                        <div class='title_wrap'>
                            <img src='resources/users/img/main/text/title_arrow.png' />
                            <span>Review</span>
                        </div>

                        <div class='search_container'>
                            <div class='search_wrap'>
                                <select name="search" class="select">
                                    <option disabled selected>제목+내용</option>
                                    <option value="apple">제목</option>
                                    <option value="orange">내용</option>
                                    <option value="grape">제목+내용</option>
                                </select>

                                <input type='text' class='search' />
                            </div>
                            <button type='button' class='review-button btn_review_add'>
                                <span>글쓰기</span>
                                <img src='resources/users/img/icon/main_i_right.png' />
                            </button>
                        </div>
                    </div>


                </div>
                <div class='consulting_content_container'>
                    <table>
                        <tbody id='table_review_list_mo'>

                        </tbody>
                    </table>

                    <div class='pagination_wrap'>
                        <div class='arrow_wrap'>
                            <span class='btn_review_prev_page'><img src="resources/users/img/icon/arrow_left.png"></span>
                            <span class='btn_review_next_page'><img src="resources/users/img/icon/arrow_right.png"></span>
                        </div>

                        <span>
                            <b class='review_curr_page'></b>/<span class='review_total_page'></span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- 포트폴리오 영역 -->
            <div class='portfolio_container' id='portfolioWrapMobile'>
                <div class='title'>
                    <span>Portfolio</span>
                    <img src='resources/users/img/main/text/title_arrow.png' />
                </div>

                <ul class='portfolio_list'>
                    <?php
                    foreach ($portfolio_list as $list) {
                        $img = json_decode($list->img_name)[0];
                    ?>
                        <li class='portfolio_wrap select_portfolio' data-curridx="<?= $list->idx ?>">
                            <img src="<?= $img ?>" alt="<?= $list->title ?>">
                        </li>
                    <?php } ?>

                </ul>
                <div id="sentinel"></div>
            </div>
        </div>
    </section>

<div class="modal fade write-modal view-modal" id="modal-consulting-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="consultingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="consultingModalLabel">견적요청 내용</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_review left" id="modal-consulting-category"></div>
                <div class="modal_review">
                    <h5>의뢰자 정보</h5>
                    <div id="modal-consulting-name"></div>
                    <div id="modal-consulting-employeeName"></div>
                    <div id="modal-consulting-tel"></div>
                    <div id="modal-consulting-employeeTel"></div>
                    <div id="modal-consulting-employeeEmail"></div>
                </div>
                <div class="modal_review">
                    <h5>추가 요청사항</h5>
                    <div id="modal-consulting-request"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- s:writingModalL(글쓰기) -->
<div class="modal fade write-modal" id="modal-review-write" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="writingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="writingModalLabel">만족도</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_body_area" id="review_form">
                    <div class="write-modal-title">디자인은 만족하셨나요?</div>
                    <h6>다른 회원들을 위해 소중한 별점을 남겨주세요.</h6>
                    <ul class="star">
                        <li class="on">
                            <input type="radio" class="score_radio" id="star_radio_1" name="review_score" value="1">
                            <label class="score_radio_label" for="star_radio_1">★</label>
                        </li>
                        <li class="on">
                            <input type="radio" class="score_radio" id="star_radio_2" name="review_score" value="2">
                            <label class="score_radio_label" for="star_radio_2">★</label>
                        </li>
                        <li class="on">
                            <input type="radio" class="score_radio" id="star_radio_3" name="review_score" value="3">
                            <label class="score_radio_label" for="star_radio_3">★</label>
                        </li>
                        <li class="on">
                            <input type="radio" class="score_radio" id="star_radio_4" name="review_score" value="4">
                            <label class="score_radio_label" for="star_radio_4">★</label>
                        </li>
                        <li class="on">
                            <input type="radio" class="score_radio" id="star_radio_5" name="review_score" value="5" checked>
                            <label class="score_radio_label" for="star_radio_5">★</label>
                        </li>
                    </ul>
                    <div class="input_area">
                        <div class="row">
                            <div class="col-6">
                                <div class="input_group">
                                    <label>작성자</label>
                                    <input type="text" class="form-valid fv_empty" name="review_name" maxlength="20">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input_group">
                                    <label>패스워드</label>
                                    <input type="password" class="form-valid fv_empty" name="review_pass" maxlength="20">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input_group">
                                    <label class="w_17">제목</label>
                                    <input type="text" class="form-valid fv_empty" name="review_subject" placeholder="제목을 입력해주세요" maxlength="100">
                                </div>
                            </div>
                            <div class="col-12">
                                <textarea class="form-valid fv_empty" name="review_content" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-skyblue" id="btn_review_save">등록</button>
            </div>
        </div>
    </div>
</div>
<!-- e:writingModal -->

<!-- s:게시글 조회 모달 -->
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
                <hr />
                <div class="modal_review_text" id="modal-review-reply"></div>
            </div>
            <!-- <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" id="btn_review_del">삭제</button>
                <button type="button" class="btn btn-skyblue" id="btn_review_mod">수정</button>
            </div> -->
        </div>
    </div>
</div>

<!-- s:게시글 조회 모달 -->
<div class="modal fade write-modal view-modal" id="modal-portfolio-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="reviewModalLabel">포트폴리오</h1>
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

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js?<?= time() ?>"></script>
<script src="/resources/users/js/common.js?<?= time() ?>"></script>
<script src="/resources/users/js/consulting.js?<?= time() ?>"></script>
<script>
    section = "<?= $page_info['section'] ?>";

    let step_move;
    let step_curr = 0;
    let param_category = [];
    let choose_category_list = [];
    let question_values = [];
    let question_count = 0;
    let answer_count = 0;
    let div_tags, label_tags, h5_tags, h6_tags, par_idv, p_tags;
    let chk_flag, category_segment, category_name, this_data, append_html;
    let consulting_list, question_list, answer_list, prev_result, answer_value;
    let question_div;

    let consulting_curr_page = 1;
    let consulting_total_page = 1;
    let consulting_keyword = "";
    let modal_consulting_view;
    let question_value;
    let curr_consulting_idx = "0";

    let review_curr_page = 1;
    let review_total_page = 1;
    let review_keyword = "";
    let review_write_mode = "add";
    let modal_review_write;
    let modal_review_view;
    let curr_review_idx = "0";

    let modal_portfolio_view;
    let curr_portfolio_idx = "0";

    const domParser = new DOMParser();
    let decodedData;

    let fn_step_move_arr;
    let progress_xhr = false;

    $(function() {
        if (getCookie("show_consulting_first_step") == "1") {
            deleteCookie("show_consulting_first_step");
            $(".consulting_step").eq(0).removeClass("d-none");
            $(".consulting_step_start").addClass("d-none");
        }

        $(".btn_consulting_start_step").on("click", function() {
            $(".consulting_step").eq(0).removeClass("d-none");
            $(".consulting_step_start").addClass("d-none");
        });

        let fn_step_move_arr = [
            consulting_step_0,
            consulting_step_1,
            consulting_step_2,
            consulting_step_3,
            consulting_step_4
        ];

        $(".btn_consulting_move_step").on("click", function() {
            if (progress_xhr) {
                $modal_alert("MTMbiz Design", "잠시만 기다려 주십시오.", function() {
                    $modal_hide();
                });
                progress_xhr = false;
                return false;
            }

            step_move = $(this).data("step-move");
            $.when(fn_step_move_arr[step_move](step_move))
                .done(function(result) {
                    progress_xhr = false;
                    if (result) {
                        $(".consulting_step").eq(step_curr).addClass("d-none");
                        $(".consulting_step").eq(step_move).removeClass("d-none");
                        step_curr = step_move;
                    }
                });
        });

        $(".consulting_category").on("click", function() {
            chk_flag = $(this).is(":checked");
            category_segment = $(this).data("segment");
            category_name = $(this).val();

            if (chk_flag) {
                label_tags = $("<span/>", {
                    class: 'content'
                }).text(category_name);
                div_tags = $("<div/>", {
                    class: "input_group " + category_segment
                }).append(label_tags);
                $("#print_result_step_1").append(div_tags);
            } else {
                $("#print_result_step_1").children("." + category_segment).remove();
            }
        });

        $(document).on("change", ".choose_question_answer", function() {
            this_data = $(this).data();
            p_tags_class = "choose_" + this_data["segment"] + "_" + this_data["questionidx"];
            answer_value = this_data["answer"];
            question_div = $("#print_result_step_2").children("." + this_data["segment"]);

            $("#print_result_step_2").find("." + p_tags_class).remove();
            p_tags = $("<p/>", {
                class: p_tags_class
            }).html(answer_value);
            question_div.append(p_tags);
        });

        load_consulting();

        $(".consulting_keyword").on("keyup", function(e) {
            $(".consulting_keyword").val($(this).val());
            if (e.keyCode == 13) {
                consulting_curr_page = 1;
                load_consulting();
            }
        });

        $(".btn_get_consulting_list").on("click", function() {
            consulting_curr_page = 1;
            load_consulting();
        });

        $(".btn_consulting_prev_page").on("click", function() {
            consulting_curr_page = (consulting_curr_page > 1) ? (consulting_curr_page - 1) : 1;
            load_consulting();
        });

        $(".btn_consulting_next_page").on("click", function() {
            consulting_curr_page = (consulting_curr_page < consulting_total_page) ? (consulting_curr_page + 1) : consulting_total_page;
            load_consulting();
        });

        modal_consulting_view = new bootstrap.Modal(document.getElementById("modal-consulting-view"), {
            keyboard: false,
        });

        $(document).on("click", ".get_consulting_info", function() {
            curr_consulting_idx = $(this).data("idx");
            $modal_pasword(function() {
                view_consulting();
            });
        });

        load_review();

        $(".review_keyword").on("keyup", function(e) {
            $(".review_keyword").val($(this).val());
            if (e.keyCode == 13) {
                review_curr_page = 1;
                load_review();
            }
        });

        $(".btn_get_review_list").on("click", function() {
            review_curr_page = 1;
            load_review();
        });

        $(".btn_review_prev_page").on("click", function() {
            review_curr_page = (review_curr_page > 1) ? (review_curr_page - 1) : 1;
            load_review();
        });

        $(".btn_review_next_page").on("click", function() {
            review_curr_page = (review_curr_page < review_total_page) ? (review_curr_page + 1) : review_total_page;
            load_review();
        });

        modal_review_write = new bootstrap.Modal(document.getElementById("modal-review-write"), {
            keyboard: false,
        });

        modal_review_view = new bootstrap.Modal(document.getElementById("modal-review-view"), {
            keyboard: false,
        });

        $(".btn_review_add").on("click", function() {
            $("input[name=review_name]").val("");
            $("input[name=review_subject]").val("");
            $("input[name=review_pass]").val("");
            $("textarea[name=review_content]").val("");
            $(".score_radio").eq(4).trigger("click");
            review_write_mode = "add";
            modal_review_write.show();
        });

        $("#btn_review_mod").on("click", function() {
            review_write_mode = "mod";
            modal_review_view.hide();
            $modal_pasword(function() {
                set_review_modify();
            });
        });

        $(".score_radio").on("click", function() {
            $(".score_radio:lt(" + $(this).val() + ")").parent().addClass("on");
            $(".score_radio:gt(" + ($(this).val() - 1) + ")").parent().removeClass("on");
            $(".score_radio_label:lt(" + $(this).val() + ")").text("★");
            $(".score_radio_label:gt(" + ($(this).val() - 1) + ")").text("☆");
        });

        $("#btn_review_save").on("click", function() {
            save_review();
        });

        $(document).on("click", ".get_review_info", function() {
            curr_review_idx = $(this).data("idx");
            view_review();
        });

        $("#btn_review_del").on("click", function() {
            modal_review_view.hide();
            $modal_pasword(function() {
                del_review();
            });
        });

        modal_portfolio_view = new bootstrap.Modal(document.getElementById("modal-portfolio-view"), {
            keyboard: false,
        });

        $(".select_portfolio").on("click", function() {
            curr_portfolio_idx = $(this).data('curridx');
            view_portfolio();
        });
    });

    const consulting_step_0 = function() {
        return true;
    }

    const consulting_step_1 = function() {
        if ($(".consulting_category:checked").length < 1) {
            $modal_alert("MTMbiz Design", "최소 하나이상의 카테고리를 선택하여 주십시오.", function() {
                $modal_hide();
            });
            return false;
        }
        param_category = [];
        choose_category_list = [];
        $(".consulting_category:checked").each(function() {
            choose_category_list.push({
                'segment': $(this).data('segment'),
                'text': $(this).val()
            });
            param_category.push($(this).data('segment'));
        });

        par_idv = $("#business_questions").empty();

        $.post('/consulting/questionList', {
            'category': param_category
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                question_count = 0;
               $.each(choose_category_list, function(key, val) {
                    // 각 카테고리 컨테이너 생성
                    var formContainer = $('<div/>', {
                        class: 'form_container'
                    });

                    // 카테고리 제목
                    $(formContainer).append($('<span/>', {
                        class: 'form_title'
                    }).text(val.text));

                    // 질문 리스트 필터링
                    var question_list = result.data.questions.filter(question => question.segment == val.segment);
                    var segment = val.segment;

                    $.each(question_list, function(key, val) {
                        var question_val = val.question;
                        var question_id = segment + '_' + val.idx;
                        var input_name = question_id;
                        question_count++;

                        // 질문 컨테이너 생성
                        var formWrap = $('<div/>', {
                            class: 'form_wrap'
                        });

                        // 질문 제목
                        $(formWrap).append($('<span/>', {
                            class: 'form_sub_title'
                        }).html(question_val));

                        // 답변 리스트 필터링
                        var answer_list = result.data.answers.filter(answer => answer.question_idx == val.idx);

                        // 답변 컨테이너 생성
                        var formCheckboxContainer = $('<div/>', {
                            class: 'form_checkbox_container'
                        });

                        $.each(answer_list, function(key, val) {
                            var answer_id = question_id + '_' + val.idx;

                            // 체크박스 그룹 생성
                            var checkWrap = $('<div/>', {
                                class: 'check_wrap'
                            });

                            var radio_tags = $('<input/>', {
                                class: 'choose_question_answer',
                                type: 'radio',
                                data: {
                                    'segment': segment,
                                    'questionidx': val.question_idx,
                                    'question': question_val,
                                    'answeridx': val.idx,
                                    'answer': val.answer
                                },
                                name: input_name,
                                id: answer_id
                            });

                            var frag_label_tags = $('<label/>');

                            var label_tags = $('<label/>', {
                                for: answer_id
                            }).html(val.answer);

                            // 체크박스 그룹에 라디오 버튼과 라벨 추가
                            $(checkWrap).append(radio_tags).append(frag_label_tags).append(label_tags);
                            // 답변 컨테이너에 체크박스 그룹 추가
                            $(formCheckboxContainer).append(checkWrap);
                        });

                        // 질문 컨테이너에 답변 컨테이너 추가
                        $(formWrap).append(formCheckboxContainer);
                        // 카테고리 컨테이너에 질문 컨테이너 추가
                        $(formContainer).append(formWrap);
                    });

                    // 부모 요소에 카테고리 컨테이너 추가
                    $(par_idv).append(formContainer);
                });

            } else {
                $modal_alert("MTMbiz Design", "카테고리별 질문목록을 불러오지 못했습니다. 문의 바랍니다.", function() {
                    $modal_hide();
                });
            }
        });
        prev_result = $("#print_result_step_1").html();
        $("#print_result_step_2").empty().html(prev_result);
        return true;
    }

    const consulting_step_2 = function() {
        answer_count = $(".choose_question_answer:checked").length;
        if (question_count != answer_count) {
            $modal_alert("MTMbiz Design", "모든 질문에 답변을 선택하여 주십시오.", function() {
                $modal_hide();
            });
            return false;
        }
        prev_result = $("#print_result_step_2").html();
        $("#print_result_step_3").empty().html(prev_result);
        return true;
    }

    const consulting_step_3 = function() {
        if (!formValidate("#consulting_customer_info1")) return false;
        prev_result = $("#print_result_step_3").html();
        $("#print_result_step_4").empty().html(prev_result);

        append_html = $("input[name=company_name]").val() + " / ";
        append_html += $("input[name=company_user_name]").val() + " / ";
        append_html += $("input[name=company_user_tel1]").val() + "-" + $("input[name=company_user_tel2]").val() + "-" + $("input[name=company_user_tel3]").val() + " / ";
        append_html += $("input[name=company_tel1]").val() + "-" + $("input[name=company_tel2]").val() + "-" + $("input[name=company_tel3]").val() + " / ";
        append_html += $("input[name=company_user_email]").val();

        div_tags = $("<div/>", {
            class: "info_group"
        });
        h6_tags = $("<h6/>").text("의뢰자 정보");
        p_tags = $("<p/>").html(append_html);
        div_tags.append(h6_tags).append(p_tags);
        $("#print_result_step_4").append(div_tags);

        return true;
    }

    const consulting_step_4 = function() {
        if (!formValidate("#consulting_customer_info2")) return false;

        prev_result = $("#print_result_step_4").html();
        $("#print_result_step_5").empty().html(prev_result);

        append_html = $("textarea[name=request]").val();

        div_tags = $("<div/>", {
            class: "info_group"
        });
        h6_tags = $("<h6/>").text("추가 요청사항");
        p_tags = $("<p/>").html(append_html);
        div_tags.append(h6_tags).append(p_tags);
        $("#print_result_step_5").append(div_tags);

        question_values = [];
        $(".choose_question_answer:checked").each(function() {
            var this_data = $(this).data();
            question_values.push({
                'segment': this_data.segment,
                'question_idx': this_data.questionidx,
                'question': this_data.question,
                'answer_idx': this_data.answeridx,
                'answer': this_data.answer
            });
        });

        question_values = JSON.stringify(question_values);
        // question_values = question_values.slice(1, -1);

        var form_data = new FormData();
        form_data.append("consulting_pass", $("input[name=consulting_pass]").val());
        form_data.append("name", $("input[name=company_name]").val());
        form_data.append("tel1", $("input[name=company_tel1]").val());
        form_data.append("tel2", $("input[name=company_tel2]").val());
        form_data.append("tel3", $("input[name=company_tel3]").val());
        form_data.append("employee_name", $("input[name=company_user_name]").val());
        form_data.append("employee_tel1", $("input[name=company_user_tel1]").val());
        form_data.append("employee_tel2", $("input[name=company_user_tel2]").val());
        form_data.append("employee_tel3", $("input[name=company_user_tel3]").val());
        form_data.append("employee_email", $("input[name=company_user_email]").val());
        form_data.append("request", $("textarea[name=request]").val());
        form_data.append("consulting_file1", $("#consulting_file1")[0].files[0]);
        form_data.append("consulting_file2", $("#consulting_file2")[0].files[0]);
        form_data.append("consulting_file3", $("#consulting_file3")[0].files[0]);
        form_data.append("question_values", question_values);

        $.ajax({
            method: "POST",
            url: "/consulting/save/",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#consulting_customer_info1") || !formValidate("#consulting_customer_info2") || question_count != answer_count) {
                    $modal_alert("MTMbiz Design", "정상적인 입력을 해주십시오.", function() {
                        $modal_hide();
                    });
                    xhr.abort();
                }
            },
            data: form_data,
            enctype: 'multipart/form-data',
            processData: false,
            cache: false,
            contentType: false,
            success: function(data) {
                var result = JSON.parse(data);
                if (result.flag) {
                    consulting_curr_page = 1;
                    consulting_keyword = "";
                    load_consulting();
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                    });
                }
            }
        });

        return true;
    }

    function load_consulting() {
        consulting_keyword = $(".consulting_keyword").val();
        $.post("/consulting/consultingList", {
            curr_page: consulting_curr_page,
            keyword: consulting_keyword
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                consulting_total_page = result.data.totalPage;
                $(".consulting_curr_page").text(consulting_curr_page);
                $(".consulting_total_page").text(consulting_total_page);
                $("#table_consulting_list_mo").empty().html(result.data.dataList_mo);
                $("#table_consulting_list_pc").empty().html(result.data.dataList_pc);
            }
        });
    }

    function view_consulting() {
        $.ajax({
            method: "POST",
            url: "/consulting/consultingConfirm",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#password_form")) xhr.abort();
            },
            data: {
                "idx": curr_consulting_idx,
                "password": $("#modal-password-input").val()
            },
            success: function(data) {
                var result = JSON.parse(data);
                $modal_hide();
                if (result.flag) {
                    $modal_hide();
                    $.post("/consulting/consultingView", {
                        idx: curr_consulting_idx
                    }, function(data) {
                        var result = JSON.parse(data);
                        if (result.flag) {
                            $("#modal-consulting-category").html("");
                            $.each(result.data.consulting_work_list, function(idx, val) {
                                h5_tags = $("<h5/>", {
                                    class: "mt-3"
                                }).text(result.data.business_list[val.category]['name']);
                                $("#modal-consulting-category").append(h5_tags);

                                $.each(JSON.parse(val.question_value), function(idx2, val2) {
                                    decodedData = domParser.parseFromString(val2.answer, "text/html").body.textContent;
                                    div_tags = $("<div/>").html(decodedData);
                                    $("#modal-consulting-category").append(div_tags);
                                });
                            });

                            $("#modal-consulting-name").text(result.data.consulting_info.name);
                            $("#modal-consulting-employeeName").text(result.data.consulting_info.employee_name);
                            $("#modal-consulting-tel").text(result.data.consulting_info.tel);
                            $("#modal-consulting-employeeTel").text(result.data.consulting_info.employee_tel);
                            $("#modal-consulting-employeeEmail").text(result.data.consulting_info.employee_email);
                            $("#modal-consulting-request").html(replaceToBr(result.data.consulting_info.request));
                            modal_consulting_view.show();
                        }
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                        $modal_pasword(function() {
                            view_consulting();
                        });
                    });
                }
            }
        });
    }

    function load_review() {
        review_keyword = $(".review_keyword").val();
        $.post("/consulting/reviewList", {
            curr_page: review_curr_page,
            keyword: review_keyword
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                review_total_page = result.data.totalPage;
                $(".review_curr_page").text(review_curr_page);
                $(".review_total_page").text(review_total_page);
                $("#table_review_list_mo").empty().html(result.data.dataList_mo);
                $("#table_review_list_pc").empty().html(result.data.dataList_pc);
            }
        });
    }

    function save_review() {
        var form_data = {
            "mode": review_write_mode,
            "idx": curr_review_idx,
            "name": $("input[name=review_name]").val(),
            "subject": $("input[name=review_subject]").val(),
            "score": $("input[name=review_score]:checked").val(),
            "review_pass": $("input[name=review_pass]").val(),
            "contents": $("textarea[name=review_content]").val()
        };

        $.ajax({
            method: "POST",
            url: "/consulting/reviewsave",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#review_form")) xhr.abort();
            },
            data: form_data,
            success: function(data) {
                var result = JSON.parse(data);
                if (result.flag) {
                    modal_review_write.hide();
                    review_curr_page = 1;
                    review_keyword = "";
                    load_review();
                    $modal_alert("MTMbiz Design", result.message, function() {
                        load_review();
                        $modal_hide();
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                    });
                }
            }
        });
    }

    function set_review_modify() {
        $.ajax({
            method: "POST",
            url: "/consulting/reviewConfirm",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#password_form")) xhr.abort();
            },
            data: {
                "idx": curr_review_idx,
                "password": $("#modal-password-input").val()
            },
            success: function(data) {
                var result = JSON.parse(data);
                $modal_hide();
                if (result.flag) {
                    $modal_hide();
                    $.post("/consulting/reviewView", {
                        idx: curr_review_idx
                    }, function(data) {
                        var result = JSON.parse(data);
                        if (result.flag) {
                            $("input[name=review_name]").val(result.data.name);
                            $("input[name=review_subject]").val(result.data.subject);
                            $("input[name=review_pass]").val("");
                            $("textarea[name=review_content]").val(result.data.contents.replace(/\\n/g, "\n"));
                            (result.data.score > 1) ? $(".score_radio").eq(1).trigger("click"): false;
                            (result.data.score > 2) ? $(".score_radio").eq(2).trigger("click"): false;
                            (result.data.score > 3) ? $(".score_radio").eq(3).trigger("click"): false;
                            (result.data.score > 4) ? $(".score_radio").eq(4).trigger("click"): false;
                            modal_review_write.show();
                        }
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                        $modal_pasword(function() {
                            set_review_modify();
                        });
                    });
                }
            }
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
                $("#modal-review-reply").html(result.data.reply);
                (result.data.score > 1) ? $("#modal-review-score li").eq(1).addClass("on").text("★"): $("#modal-review-score li").eq(1).removeClass("on").text("☆");
                (result.data.score > 2) ? $("#modal-review-score li").eq(2).addClass("on").text("★"): $("#modal-review-score li").eq(2).removeClass("on").text("☆");
                (result.data.score > 3) ? $("#modal-review-score li").eq(3).addClass("on").text("★"): $("#modal-review-score li").eq(3).removeClass("on").text("☆");
                (result.data.score > 4) ? $("#modal-review-score li").eq(4).addClass("on").text("★"): $("#modal-review-score li").eq(4).removeClass("on").text("☆");
                modal_review_view.show();
            }
        });
    }

    function del_review() {
        $.ajax({
            method: "POST",
            url: "/consulting/reviewDelete",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#password_form")) xhr.abort();
            },
            data: {
                "idx": curr_review_idx,
                "password": $("#modal-password-input").val()
            },
            success: function(data) {
                var result = JSON.parse(data);
                $modal_hide();
                if (result.flag) {
                    load_review();
                    $modal_alert("MTMbiz Design", result.message, function() {
                        load_review();
                        $modal_hide();
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                        $modal_pasword(function() {
                            del_review();
                        });
                    });
                }
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
                $("#modal-portfolio-view-title").text(result.data.title);
                $("#modal-portfolio-view-img").empty();

                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-lg-6 col-sm-12 mb-2 text-center'
                    });
                    img_tags = $("<resources/users/img/>", {
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