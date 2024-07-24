
    <!-- body -->
    <section class="detail_container pc">
        <div class="detail_page-content">
            <div class="left_arrows">
                <img src="/resources/users/img/main/text/title_arrow.png" alt="텍스트 우측 하단 화살표 이미지">
            </div>
            <div class="detail_content-wrapper">
                <div class="detail_header">
                    <h3>사업계획서</h3>
                    <img src="/resources/users/img/main/services/service_01.png">
                </div>
                <div class="detail_content_descript">
                    <h5>차별화된 사업의 성격과 예측된 결과의 타당성을 전달할 수 있는 메시지의 표현이 중요합니다</h5>
                    <p>사업성격을 표현할 수 있는 컬러를 설정하고 텍스트의 도식화로 정보의 이해도를 높여 추진사업의 긍정적 판단을 유도합니다
                    </p>
                    <div class="detail_img_wrapper">
                        <div class="detail_img_left">
                            <img src="/resources/users/img/detailPage/businessPlan/detail01.png">
                        </div>
                        <div class="detail_img_right">
                            <img src="/resources/users/img/detailPage/businessPlan/detail02.png">
                            <img src="/resources/users/img/detailPage/businessPlan/detail03.png">
                        </div>
                        <div class="detail_img_absoulte">
                            <img src="/resources/users/img/detailPage/businessPlan/detail04.png">
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
                            <h3>사업계획서</h3>
                            <img src="/resources/users/img/main/services/service_01.png">
                        </div>

                    </div>
                    <div class="detail_content_descript">
                        <h5> 차별화된 사업의 성격과 예측된 결과의 타당성을 전달할 수 있는 메시지의 표현이 중요합니다</h5>
                        <p>사업성격을 표현할 수 있는 컬러를 설정하고 텍스트의 도식화로 정보의 이해도를 높여 추진사업의 긍정적 판단을 유도합니다</p>
                        <div class="detail_img_wrapper">
                            <div class="detail_img_left">
                                <img src="/resources/users/img/detailPage/businessPlan/detail01.png">
                            </div>
                            <div class="detail_img_right">
                                <img src="/resources/users/img/detailPage/businessPlan/detail02.png">
                                <img src="/resources/users/img/detailPage/businessPlan/detail03.png">
                            </div>
                            <div class="detail_img_absoulte">
                                <img src="/resources/users/img/detailPage/businessPlan/detail04.png">
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
        <button onclick="location.href='index.html'">
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

<!-- s:게시글 조회 모달 -->
<div class="modal fade write-modal view-modal" id="modal-reference-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="reviewModalLabel">레퍼런스</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_review">
                    <h5 id="modal-reference-view-title"></h5>
                </div>
                <div class="modal_review_text row" id="modal-reference-view-img"></div>
            </div>
        </div>
    </div>
</div>

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>

<script>
    var referenceList = <?= json_encode($reference_list) ?>;
    console.log('Reference List:', referenceList);
</script>

<script>
    let curr_reference_idx;
    let modal_reference_view;

    $(function() {
        $(".select_reference").on("click", function() {
            curr_reference_idx = $(this).data('curridx');
            view_reference();
        });

        modal_reference_view = new bootstrap.Modal(document.getElementById("modal-reference-view"), {
            keyboard: false,
        });
    });


    function view_reference() {
        $.post("/business/referenceView", {
            idx: curr_reference_idx
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                modal_reference_view.show();
                var img_list = JSON.parse(result.data.img_name);
                $("#modal-reference-view-title").text(result.data.title);
                $("#modal-reference-view-img").empty();

                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-lg-6 col-sm-12 mb-2 text-center'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#modal-reference-view-img").append(div_tags);
                });
            }
        });
    }

</script>