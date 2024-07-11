<section class="sub_cont service">
    <div class="sub_cont_body">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h1>All Service</h1>
                    <p class="title_desc">엠티엠비즈 디자인은 고객을 위한<br>분야별 <b>전문 디자인서비스</b>를 제공합니다.</p>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="row box_color mb-2">
                        <div class="col-12 col-lg-6">
                            <a href="/business/list/proposal">
                                <div class="box op">
                                    <img src="/resources/users/img/business/symbol/proposal.png" alt="<?= $business_list['proposal']['name'] ?>">
                                    <div class="box_text">
                                        <h2><?= $business_list['proposal']['name'] ?></h2>
                                        <p class="ta_l">보고서 / 제안서<br />회사소개서 / 교육자료</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="/business/list/webdesign">
                                <div class="box">
                                    <img src="/resources/users/img/business/symbol/webdesign.png" alt="<?= $business_list['webdesign']['name'] ?>">
                                    <p><?= $business_list['webdesign']['name'] ?></p>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-lg-3">
                            <a href="/business/list/package">
                                <div class="box">
                                    <img src="/resources/users/img/business/symbol/package.png" alt="<?= $business_list['package']['name'] ?>">
                                    <p><?= $business_list['package']['name'] ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                $business_list_bottom = array_filter($business_list, function ($item) {
                    return ($item['use_menu'] && !$item['use_top']);
                });
                ?>

                <div class="col-12">
                    <div class="row box_wrap">
                        <?php
                        foreach ($business_list_bottom as $list) {
                        ?>
                            <div class="col-4">
                                <a href="/business/list/<?= $list['segment'] ?>/">
                                    <div class="box">
                                        <img src="/resources/users/img/business/symbol/<?= $list['segment'] ?>.png" alt="<?= $list['name'] ?>">
                                        <p><?= $list['name'] ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="work"></div>

        <div class="tab_container">
            <ul class="nav nav-tabs" id="workTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= ($active_tab == '0') ? 'active' : '' ?>" id="work-one-tab" data-bs-toggle="tab" data-bs-target="#work-one-tab-pane" type="button" role="tab" aria-controls="work-one-tab-pane" aria-selected="true">WORKS #1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= ($active_tab == '1') ? 'active' : '' ?>" id="work-two-tab" data-bs-toggle="tab" data-bs-target="#work-two-tab-pane" type="button" role="tab" aria-controls="work-two-tab-pane" aria-selected="false">WORKS #2</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= ($active_tab == '2') ? 'active' : '' ?>" id="work-three-tab" data-bs-toggle="tab" data-bs-target="#work-three-tab-pane" type="button" role="tab" aria-controls="work-three-tab-pane" aria-selected="false">WORKS #3</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= ($active_tab == '3') ? 'active' : '' ?>" id="work-four-tab" data-bs-toggle="tab" data-bs-target="#work-four-tab-pane" type="button" role="tab" aria-controls="work-four-tab-pane" aria-selected="false">WORKS #4</button>
                </li>
            </ul>
            <div class="tab-content" id="workTabContent">


                <div class="tab-pane fade <?= ($active_tab == '0') ? 'show active' : '' ?>" id="work-one-tab-pane" role="tabpanel" aria-labelledby="work-two-tab" tabindex="0">
                    <div class="tab-content-wrap">
                        <div class="row">
                            <div class="col-12 col-lg-6 tab_text">
                                <h1>PPT디자인</h1>
                                <p>고객니즈를 바탕으로한 정보의 재구성으로 전략적 핵심에 집중되는
                                    디자인을 제공해 제안서의 설득력을 높이고 임팩트 있는 프리젠테이션을
                                    가능하게 합니다.<br>
                                    공공기관, 대학 등, 전문화된 대상을 위한 작업일정과 프로세스의 대응으로
                                    특화된 PPT제작물을 제공합니다.</p>
                                <ul>
                                    <li class="pc_flex">사업계획서</li>
                                    <li class="pc_flex">IR자료</li>
                                    <li class="pc_flex">연구보고서</li>
                                    <li class="pc_flex">입찰제안서</li>
                                    <li class="pc_flex">투자제안서</li>
                                    <li class="pc_flex">강의자료</li>
                                    <li class="pc_flex">세미나자료</li>
                                    <li class="pc_flex">회사소개서</li>

                                    <li class="mo_flex">사업계획서</li>
                                    <li class="mo_flex">IR자료</li>
                                    <li class="mo_flex">연구보고서</li>
                                    <li class="mo_flex">입찰제안서</li>
                                    <li class="mo_flex">투자제안서</li>
                                    <li class="mo_flex">강의자료</li>
                                    <li class="mo_flex">세미나자료</li>
                                    <li class="mo_flex">회사소개서</li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-6 process_img pc">
                                <img src="/resources/users/img/work/work_16_231017.png" alt="">
                            </div></a>
                        </div>
                    </div>

                    <div class="process_wrap mo">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />의도파악</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>
                            </ul>
                            <ul>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_5.png"><br />디자인 수정</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />작업물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_wrap pc">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />의도파악</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_5.png"><br />디자인 수정</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />작업물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_img mo">
                        <img src="/resources/users/img/work/work_16_231017.png" alt="">
                    </div>
                </div>


                <div class="tab-pane fade <?= ($active_tab == '1') ? 'show active' : '' ?>" id="work-two-tab-pane" role="tabpanel" aria-labelledby="work-four-tab" tabindex="0">
                    <div class="tab-content-wrap">
                        <div class="row">
                            <div class="col-12 col-lg-6 tab_text">
                                <h1>공공기관</h1>
                                <p>공공기관 특화전략으로 고객의 전략적 방향 수립과 성공적인 피드백을 위해
                                    분야별 엄선된 파트너의 인프라 구축과 업무수행으로 고객이 원하는 최적의
                                    결과물을 제공합니다.<br>
                                    고객의 일정을 최고의 목표로 두고 전략적 파트너와의 유기적인 소통과
                                    프로세스 대응으로 최소일정을 실현합니다.</p>
                                <ul>
                                    <li class="pc_flex">규정 가이드북</li>
                                    <li class="pc_flex">시설안내 리플렛</li>
                                    <li class="pc_flex">행사포스터</li>
                                    <li class="pc_flex">행사보고 소책자</li>
                                    <li class="pc_flex">정기간행 소식지</li>
                                    <li class="pc_flex">정책안내 브로셔</li>
                                    <li class="pc_flex">엑스배너</li>
                                    <li class="pc_flex">현수막</li>

                                    <li class="mo_flex">규정<br />가이드북</li>
                                    <li class="mo_flex">시설안내<br />리플렛</li>
                                    <li class="mo_flex">행사<br />포스터</li>
                                    <li class="mo_flex">행사보고<br />소책자</li>
                                    <li class="mo_flex">정기간행<br />소식지</li>
                                    <li class="mo_flex">정책안내<br />브로셔</li>
                                    <li class="mo_flex">엑스배너</li>
                                    <li class="mo_flex">현수막</li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-6 process_img pc">
                                <img src="/resources/users/img/work/m_work_05.jpg" alt="">
                            </div></a>
                        </div>
                    </div>

                    <div class="process_wrap mo">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />제작방향 설정</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>

                            </ul>
                            <ul>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_00.png"><br />상품제작</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />제작물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_wrap pc">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />제작방향 설정</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_00.png"><br />상품제작</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />제작물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_img mo">
                        <img src="/resources/users/img/work/m_work_05.jpg" alt="">
                    </div>
                </div>

                <div class="tab-pane fade <?= ($active_tab == '2') ? 'show active' : '' ?>" id="work-three-tab-pane" role="tabpanel" aria-labelledby="work-three-tab" tabindex="0">
                    <div class="tab-content-wrap">
                        <div class="row">
                            <div class="col-12 col-lg-6 tab_text">
                                <h1>중소기업</h1>
                                <p>
                                    고객 가치 중심 업무 프로세스는 더 높은 만족도와 분야별 기대효과에 부합한
                                    성공적인 디자인 제작물을 제공합니다.<br>
                                    기업에 필요한 프로젝트의 기획, 디자인, 제작 등 A~Z 까지 전략적 플래닝과
                                    기능적인 운영을 통해 보다 높은 고객 가치를 실현합니다.
                                </p>
                                <ul>
                                    <li class="pc_flex">명함</li>
                                    <li class="pc_flex">사원증</li>
                                    <li class="pc_flex">제품 카달록</li>
                                    <li class="pc_flex">회사소개서</li>
                                    <li class="pc_flex">프로젝트 기획서</li>
                                    <li class="pc_flex">홍보전단</li>
                                    <li class="pc_flex">카드뉴스</li>
                                    <li class="pc_flex">웹사이트 리뉴얼</li>

                                    <li class="mo_flex">명함</li>
                                    <li class="mo_flex">사원증</li>
                                    <li class="mo_flex">제품<br />카달록</li>
                                    <li class="mo_flex">회사소개서</li>
                                    <li class="mo_flex">프로젝트<br />기획서</li>
                                    <li class="mo_flex">홍보전단</li>
                                    <li class="mo_flex">카드뉴스</li>
                                    <li class="mo_flex">웹사이트<br />리뉴얼</li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-6 process_img pc">
                                <img src="/resources/users/img/work/work_10.jpg" alt="">
                            </div></a>
                        </div>
                    </div>

                    <div class="process_wrap mo">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />제작방향 설정</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>

                            </ul>
                            <ul>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_00.png"><br />상품제작</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />제작물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_wrap pc">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />제작방향 설정</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_00.png"><br />상품제작</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />제작물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_img mo">
                        <img src="/resources/users/img/work/work_10.jpg" alt="">
                    </div>
                </div>


                <div class="tab-pane fade <?= ($active_tab == '3') ? 'show active' : '' ?>" id="work-four-tab-pane" role="tabpanel" aria-labelledby="work-one-tab" tabindex="0">
                    <div class="tab-content-wrap">
                        <div class="row">
                            <div class="col-12 col-lg-6 tab_text">
                                <h1>월간디자인</h1>
                                <p>설정한 기간 동안 다양한 분야별 발생되는 디자인 작업에 대해
                                    전문 서비스를 통합 제공하여 추가 비용 없이 다양한 디자인 옵션과
                                    고객의 요구와 목표에 부합하는 최적의 솔루션을 제공합니다.<br class="pc">
                                    담당자의 상담으로 합리적인 비용을 제안하고 고객이 원하는
                                    전문적인 디자인 서비스의 제공을 위한 최적의 프로세스를
                                    지원합니다.</p>
                                <ul>
                                    <li class="pc_flex">카드뉴스</li>
                                    <li class="pc_flex">웹 배너</li>
                                    <li class="pc_flex">상세페이지</li>
                                    <li class="pc_flex">팝업 광고</li>
                                    <li class="pc_flex">이미지보정</li>
                                    <li class="pc_flex">제품 랜더링</li>
                                    <li class="pc_flex">엑스배너</li>
                                    <li class="pc_flex">명함</li>

                                    <li class="mo_flex">카드뉴스</li>
                                    <li class="mo_flex">웹 배너</li>
                                    <li class="mo_flex">상세페이지</li>
                                    <li class="mo_flex">팝업 광고</li>
                                    <li class="mo_flex">이미지보정</li>
                                    <li class="mo_flex">제품 랜더링</li>
                                    <li class="mo_flex">엑스배너</li>
                                    <li class="mo_flex">명함</li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-6 process_img pc">
                                <img src="/resources/users/img/work/work_01.jpg" alt="">
                            </div></a>
                        </div>
                    </div>

                    <div class="process_wrap mo">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />제작방향 설정</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>
                            </ul>
                            <ul>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_5.png"><br />디자인 수정</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />제작물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_wrap pc">
                        <div class="process type2">
                            <ul>
                                <li><img src="/resources/users/img/work/ico_1.png"><br />상담</li>
                                <li><img src="/resources/users/img/work/ico_2.png"><br />제작방향 설정</li>
                                <li><img src="/resources/users/img/work/ico_3.png"><br />디자이너 배정</li>
                                <li><img src="/resources/users/img/work/ico_4.png"><br />시안작업</li>
                                <li><img src="/resources/users/img/work/ico_5.png"><br />디자인 수정</li>
                                <li><img src="/resources/users/img/work/ico_6.png"><br />제작물 제공</li>
                            </ul>
                        </div>
                    </div>

                    <div class="process_img mo">
                        <img src="/resources/users/img/work/work_01.jpg" alt="">
                    </div>

                </div>





            </div>
        </div>
    </div>
</section>

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>
<script src="/resources/users/js/common.js"></script>
<script>
    section = "<?= $page_info['section'] ?>";
</script>