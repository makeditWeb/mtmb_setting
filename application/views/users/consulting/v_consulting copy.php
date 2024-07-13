<section class="sub_cont consulting">
    <div class="sub_cont_top">

        <!-- s: (0)시작 -->
        <div class="container start consulting_step_start">
            <div class="step_header">
                <h1>견적요청</h1>
            </div>
            <div class="step_body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="step_title">디자인<br>견적요청</h2>
                        <button type="button" class="btn_start btn_consulting_start_step">
                            <img src="/resources/users/img/btn_start.png" alt="">
                        </button>
                        <div class="trg_group">
                            <div class="trg_1"></div>
                            <div class="trg_2"></div>
                            <div class="trg_3"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <ul class="step consulting_process_icons">
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
        <!-- s: (0)시작 -->



        <!-- s: (1)카테고리 -->
        <div class="container step_01 consulting_step d-none">
            <div class="step_header">
                <h1 class="mo">견적요청<span>의뢰하실 카테고리를 선택하세요.</span></h1>
                <h1 class="pc">Design<br>consulting</h1>
                <p class="pc">의뢰하실 카테고리를<br>선택하세요</p>
            </div>
            <div class="step_body">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="category_wrap">
                            <h6>다중 선택 가능합니다.</h6>
                            <h6 class="description">선택이 어려우실 경우 상담신청을 선택하시면 담당자가 확인후 연락드립니다.</h6>
                            <div class="check_wrap">
                                <?php
                                $i = 0;
                                foreach ($business_list as $blist) {
                                    $category_list[$blist['segment']] = false;
                                ?>
                                    <div class="check_group">
                                        <input type="checkbox" id="cate_<?= $i ?>" class="consulting_category" data-segment="<?= $blist['segment'] ?>" value="<?= $blist['name'] ?>">
                                        <label for="cate_<?= $i ?>"><?= $blist['name'] ?></label>
                                    </div>
                                <?php
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="step_pagination">
                            <ul>
                                <li></li>
                                <li class="prev move_step btn_consulting_move_step" data-step-move="0">
                                    <!-- <img src="/resources/users/img/icon/i_left.png" alt=""> -->
                                    <p>이전</p>
                                </li>
                                <li class="next move_step btn_consulting_move_step" data-step-move="1">
                                    <!-- <img src="/resources/users/img/icon/i_right.png" alt=""> -->
                                    <p>다음</p>
                                </li>
                                <li></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="result_wrap">
                            <div class="step_result">
                                <h6>선택 카테고리</h6>
                                <div id="print_result_step_1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- s: (1)카테고리 -->


        <!-- s: (2)세부사항 -->
        <div class="container step_02 consulting_step d-none">
            <div class="step_header">
                <h1 class="mo">견적요청<span>세부 사항을 선택하세요</span></h1>
                <h1 class="pc">Design<br>consulting</h1>
                <p class="pc">세부사항을<br>선택하세요</p>
            </div>
            <div class="step_body">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="category_wrap" id="business_questions"></div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="step_pagination">
                            <ul>
                                <li></li>
                                <li class="prev move_step btn_consulting_move_step" data-step-move="0">
                                    <!-- <img src="/resources/users/img/icon/i_left.png" alt=""> -->
                                    <p>이전</p>
                                </li>
                                <li class="next move_step btn_consulting_move_step" data-step-move="2">
                                    <!-- <img src="/resources/users/img/icon/i_right.png" alt=""> -->
                                    <p>다음</p>
                                </li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="result_wrap">
                            <div class="step_result">
                                <h6>선택 카테고리</h6>
                                <div id="print_result_step_2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- e: (2)세부사항 -->

        <!-- s: (3)의뢰인 정보 -->
        <div class="container step_03 consulting_step d-none">
            <div class="step_header">
                <h1 class="mo">견적요청<span>의뢰자 정보를 입력해주세요.</span></h1>
                <h1 class="pc">Design<br>consulting</h1>
                <p class="pc">의뢰자 정보를<br>입력해주세요.</p>
            </div>
            <div class="step_body">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="category_wrap">
                            <div class="input_wrap" id="consulting_customer_info1">
                                <div class="input_group_two">
                                    <label>업체명</label>
                                    <input type="text" class="form-valid fv_empty" name="company_name" value="" maxlength="20">
                                </div>
                                <div class="input_group_two">
                                    <label>담당자</label>
                                    <input type="text" class="form-valid fv_empty" name="company_user_name" value="" maxlength="20">
                                </div>
                                <div class="input_group_two">
                                    <label>대표번호</label>
                                    <div class="phone_number">
                                        <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel1" value="">
                                        <span>-</span>
                                        <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel2" value="">
                                        <span>-</span>
                                        <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_tel3" value="">
                                    </div>
                                </div>
                                <div class="input_group_two">
                                    <label>휴대전화</label>
                                    <div class="phone_number">
                                        <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_user_tel1" value="">
                                        <span>-</span>
                                        <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_user_tel2" value="">
                                        <span>-</span>
                                        <input type="number" class="form-valid fv_empty fv_numeric use_maxlength" data-maxlength="4" name="company_user_tel3" value="">
                                    </div>
                                </div>
                                <div class="input_group_two">
                                    <label>이메일</label>
                                    <input type="email" class="form-valid fv_empty fv_email" name="company_user_email" maxlength="50" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="step_pagination">
                            <ul>
                                <li></li>
                                <li class="prev move_step btn_consulting_move_step" data-step-move="1">
                                    <!-- <img src="/resources/users/img/icon/i_left.png" alt=""> -->
                                    <p>이전</p>
                                </li>
                                <li class="next move_step btn_consulting_move_step" data-step-move="3">
                                    <!-- <img src="/resources/users/img/icon/i_right.png" alt=""> -->
                                    <p>다음</p>
                                </li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="result_wrap">
                            <div class="step_result">
                                <h6>선택 카테고리</h6>
                                <div id="print_result_step_3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- e: (3)의뢰인 정보 -->

        <!-- s: (4)기타정보 -->
        <div class="container step_04 consulting_step d-none">
            <div class="step_header">
                <h1 class="mo">견적요청<span>추가 요청사항을 입력해주세요.</span></h1>
                <h1 class="pc">Design<br>consulting</h1>
                <p class="pc">추가 요청사항을<br>입력해주세요.</p>
            </div>
            <div class="step_body">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="category_wrap">
                            <div class="input_wrap" id="consulting_customer_info2">
                                <textarea name="request" class="form-valid fv_empty" name="request" cols="30" rows="5" placeholder="기타 세부사항에 대해 적어주시면 더욱 상세한 견적을 받으실 수 있습니다."></textarea>
                                <div class="input_group_two mt-3">
                                    <input type="file" name="consulting_file1" id="consulting_file1" placeholder="파일을 선택해주세요." />
                                </div>
                                <div class="input_group_two mt-3">
                                    <input type="file" name="consulting_file2" id="consulting_file2" placeholder="파일을 선택해주세요." />
                                </div>
                                <div class="input_group_two mt-3">
                                    <input type="file" name="consulting_file3" id="consulting_file3" placeholder="파일을 선택해주세요." />
                                </div>
                                <div class="input_group_two mt-3">
                                    <input type="password" class="form-valid fv_empty" name="consulting_pass" value="" placeholder="패스워드를 입력해주세요">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="step_pagination">
                            <ul>
                                <li></li>
                                <li class="prev move_step btn_consulting_move_step" data-step-move="2">
                                    <!-- <img src="/resources/users/img/icon/i_left.png" alt=""> -->
                                    <p>이전</p>
                                </li>
                                <li class="next move_step btn_consulting_move_step" data-step-move="4">
                                    <!-- <img src="/resources/users/img/icon/i_right.png" alt=""> -->
                                    <p>다음</p>
                                </li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="result_wrap">
                            <div class="step_result">
                                <h6>선택 카테고리</h6>
                                <div id="print_result_step_4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- e: (4)기타정보 -->

        <!-- s: (5)접수완료 -->
        <div class="container step_05 consulting_step d-none">
            <div class="step_header">
                <h1 class="mo">견적요청<span>견적의뢰가 접수되었습니다.</span></h1>
                <h1 class="pc">Design<br>consulting</h1>
                <p class="pc">견적의뢰가<br>접수되었습니다.</p>
            </div>
            <div class="step_body">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="category_wrap">
                            <p class="message">의뢰해 주셔서 감사합니다.<br><br>배정된 1:1 맞춤 컨설팅 담당자가<br>연락드릴 예정입니다.<br>(약
                                30분 이내)<br><br>빠른 답변을 원하시면<br>유선 연락바랍니다.<br>(02-3663-0332)</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="result_wrap">
                            <div class="step_result">
                                <h6>선택 카테고리</h6>
                                <div id="print_result_step_5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- e: (5)접수완료 -->
    </div>


    <div class="sub_cont_body">
        <div id="list"></div>
        <!-- s: (모바일)의뢰현황-->
        <section class="container mo">
            <div class="cont_header">
                <h1 class="cont_title">의뢰목록</h1>
            </div>
            <div class="cont_body">
                <div class="row">
                    <div class="col-4">
                        <!-- 키워드 고려 필요 -->
                        <div class="input_group type2">
                            <select name="">
                                <option value="">기업명 or 작성자</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="input_group type2">
                            <input type="text" class="consulting_keyword" placeholder="검색어를 입력해주세요">
                            <button type="button" class="btn_search btn_get_consulting_list"></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="request_table">
                            <colgroup>
                                <col width="12%" />
                                <col width="68%" />
                                <col width="20%" />
                            </colgroup>
                            <tbody id="table_consulting_list_mo"></tbody>
                        </table>
                        <div class="table_pagination">
                            <ul>
                                <li class="prev btn_consulting_prev_page"><span>◀</span>이전</li>
                                <li class="consulting_curr_page"></li>
                                <li>/</li>
                                <li class="consulting_total_page"></li>
                                <li class="next btn_consulting_next_page">다음<span>▶</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- e: (모바일)의뢰현황-->

        <!-- s: (PC)의뢰현황-->
        <section class="container pc mt-5">
            <div class="row">
                <div class="col-3">
                    <div class="cont_left">
                        <h1 class="cont_title">의뢰목록</h1>
                        <div class="cont_bot">
                            <div class="input_group type2">
                                <select name="">
                                    <option value="">기업명 or 작성자</option>
                                </select>
                            </div>
                            <div class="input_group type2 mt-2">
                                <input type="text" class="consulting_keyword" placeholder="검색어를 입력해주세요">
                                <button type="button" class="btn_search btn_get_consulting_list"></button>
                            </div>
                            <div class="table_pagination">
                                <ul>
                                    <li class="prev btn_consulting_prev_page"><span>◀</span>이전</li>
                                    <li class="next btn_consulting_next_page">다음<span>▶</span></li>
                                </ul>
                                <ul>
                                    <li class="consulting_curr_page"></li>
                                    <li>/</li>
                                    <li class="consulting_total_page"></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-9">
                    <div class="cont_right">
                        <table class="request_table">
                            <colgroup>
                                <col width="10%" />
                                <col width="50%" />
                                <col width="12%" />
                                <col width="14%" />
                                <col width="14%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>작성자</th>
                                    <th>작성일</th>
                                    <th>상태</th>
                                </tr>
                            </thead>
                            <tbody id="table_consulting_list_pc"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- e: (PC)의뢰현황-->

        <div id="review"></div>
        <!-- s: (모바일)만족도 -->
        <section class="container mt-5 mo">
            <div class="cont_header">
                <h1 class="cont_title">만족도</h1>
                <button type="button" class="btn_primary btn_review_add">글쓰기</button>
            </div>
            <div class="cont_body">
                <div class="row">
                    <div class="col-4">
                        <div class="input_group type2">
                            <select name="">
                                <option value="">제목 + 내용</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="input_group type2">
                            <input type="text" class="review_keyword" placeholder="검색어를 입력해주세요">
                            <button type="button" class="btn_search btn_get_review_list"></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="request_table">
                            <colgroup>
                                <col width="12%" />
                                <col width="68%" />
                                <col width="20%" />
                            </colgroup>
                            <tbody id="table_review_list_mo"></tbody>
                        </table>
                        <div class="table_pagination">
                            <ul>
                                <li class="prev btn_review_prev_page"><span>◀</span>이전</li>
                                <li class="review_curr_page"></li>
                                <li>/</li>
                                <li class="review_total_page"></li>
                                <li class="next btn_review_next_page">다음<span>▶</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- e: (모바일)만족도-->

        <!-- s: (PC)만족도-->
        <section class="container pc mt-5">
            <div class="row">
                <div class="col-3">
                    <div class="cont_left">
                        <h1 class="cont_title">만족도</h1>
                        <div class="cont_bot">
                            <button type="button" class="btn_primary btn_review_add">글쓰기</button>
                            <div class="input_group type2">
                                <select name="">
                                    <option value="">제목 + 내용</option>
                                </select>
                            </div>
                            <div class="input_group type2 mt-2">
                                <input type="text" class="review_keyword" placeholder="검색어를 입력해주세요">
                                <button type="button" class="btn_search btn_get_review_list"></button>
                            </div>
                            <div class="table_pagination">
                                <ul>
                                    <li class="prev btn_review_prev_page"><span>◀</span>이전</li>
                                    <li class="next btn_review_next_page">다음<span>▶</span></li>
                                </ul>
                                <ul>
                                    <li class="review_curr_page"></li>
                                    <li>/</li>
                                    <li class="review_total_page"></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="cont_right">
                        <table class="request_table type2">
                            <colgroup>
                                <col width="8%" />
                                <col width="12%" />
                                <col width="44%" />
                                <col width="12%" />
                                <col width="12%" />
                                <col width="12%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>만족도</th>
                                    <th>제목</th>
                                    <th>작성자</th>
                                    <th>작성일</th>
                                    <th>조회수</th>
                                </tr>
                            </thead>
                            <tbody id="table_review_list_pc">
                                <!-- scale 7 -->
                                <tr>
                                    <td>20</td>
                                    <td class="ta_center">
                                        <ul class="star">
                                            <li class="on">★</li>
                                            <li class="on">★</li>
                                            <li class="on">★</li>
                                            <li class="on">★</li>
                                            <li>☆</li>
                                        </ul>
                                    </td>
                                    <td>'(주)제스엔지니어링'님의 디자인 견적요청이 접수되었습니다.</td>
                                    <td class="ta_center">홍길동</td>
                                    <td class="ta_center">2023.04.04</td>
                                    <td class="ta_center">20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- e: (PC)만족도-->

        <div id="partner"></div>
        <!-- s: 파트너사 -->
        <section class="container partner">
            <h1>파트너사</h1>
            <?php
            $partbanner_list_mod = array_chunk($partbanner_list, ceil(count($partbanner_list) / 3));
            ?>
            <div class="swiper partnerSubSwiper">
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
            <div class="swiper partnerSubSwiper">
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
            <div class="swiper partnerSubSwiper">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($partbanner_list_mod[2] as $list) {
                    ?>
                        <div class="swiper-slide">
                            <img src="<?= $list->img_name ?>" alt="<?= $list->title ?>">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="partner swiper-button-next pc"></div>
            <div class="partner swiper-button-prev pc"></div>
        </section>
        <!-- e: 파트너사 -->

        <div id="portfolio"></div>
        <!-- s: 포트폴리오 -->
        <section class="container pf">
            <h1>포트폴리오</h1>
            <div class="row">
                <?php
                foreach ($portfolio_list as $list) {
                    $img = json_decode($list->img_name)[0];
                ?>
                    <div class="col-6 col-lg-3 select_portfolio" data-curridx="<?= $list->idx ?>">
                        <img src="<?= $img ?>" alt="<?= $list->title ?>">
                    </div>
                <?php } ?>
            </div>
        </section>
        <!-- e: 포트폴리오 -->

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
                label_tags = $("<label/>").text(category_name);
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
                    // 카테고리 명
                    $(par_idv).append($('<h5/>').text(val.text));

                    question_list = result.data.questions.filter(question => question.segment == val.segment);
                    var segment = val.segment;

                    $.each(question_list, function(key, val) {
                        var question_val = val.question;
                        var question_id = segment + '_' + val.idx;
                        var input_name = question_id;
                        question_count++;

                        var question_tags = $('<p/>', {
                            class: 'mt-3'
                        }).html(question_val);
                        // 질문
                        $(par_idv).append(question_tags);

                        answer_list = result.data.answers.filter(answer => answer.question_idx == val.idx);

                        var answer_tags = $('<div/>', {
                            class: 'check_wrap'
                        });
                        $.each(answer_list, function(key, val) {
                            answer_id = question_id + '_' + val.idx;
                            var group_tags = $('<div/>', {
                                class: 'check_group'
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
                            var label_tags = $('<label/>', {
                                for: answer_id
                            }).html(val.answer);
                            $(group_tags).append(radio_tags).append(label_tags);
                            $(answer_tags).append(group_tags);
                        });
                        // 답변목록
                        $(par_idv).append(answer_tags);
                    });
                    $(par_idv).append($("<hr/>"));
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