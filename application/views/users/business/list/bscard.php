<div class="sub_cont_body product_wrap">
    <section class="container">
        <div class="row">
            <div class="col-12">
                <p>업종별 선호디자인에 따라 다양한 시안을 바탕으로 다채로운 상품을 제공해드립니다.</p>
                <ul>
                    <li>고급 재질의 용지와 후 가공을 통한 고품격 명함 디자인 제공</li>
                    <li>디자인 트랜드를 고려한 다양한 컨셉</li>
                    <li>고객의 요구 사항을 분석하여 유기적인 레이아웃 반영</li>
                </ul>
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