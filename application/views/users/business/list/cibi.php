<div class="sub_cont_body product_wrap">
    <section class="container">
        <div class="row">
            <div class="col-12">
                <p>기업의 이념과 성격이 담긴 CI/BI는 소비자가 느끼는 무형의 가치와 니즈를 접목하여 독창적인 시각화 작업을 진행합니다.</p>
                <h6>MTM Biz Design은 각각의 프로세스 마다 긴밀한 상담으로 완성도 높은 결과물을 만들어 냅니다.</h6>
            </div>
            <div class="col-12">
                <div class="product_box">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="swiper product_top product_01_02">
                                <div class="swiper-wrapper">
                                    <?php
                                    foreach ($contents_list as $list) {
                                        $img = json_decode($list->img_name)[0];
                                    ?>
                                        <div class="swiper-slide">
                                            <img src="<?= $img ?>" />
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="swiper_area">
                                <div thumbsSlider="" class="swiper product_bot product_01_01">
                                    <div class="swiper-wrapper">
                                        <?php
                                        foreach ($contents_list as $list) {
                                            $img = json_decode($list->img_name)[0];
                                        ?>
                                            <div class="swiper-slide">
                                                <img src="<?= $img ?>" />
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>