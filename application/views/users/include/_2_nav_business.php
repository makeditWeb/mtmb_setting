<body>
    <div class="sub_wrap product">
        <!-- s:header -->
        <header class="header" id="header">
            <div class="header_wrap">


                <div class="product_name pc">
                    <ul class="header_i">
                        <li data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                            <a><span class="i i_menu_w"></span></a>
                        </li>
                        <li>
                            <a href="/"><span class="i i_home"></span></a>
                        </li>
                        <li>
                            <a href="/">
                                <img src="/resources/users/img/header_logo.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="/"><span class="i i_home_white"></span></a>
                        </li>
                    </ul>
                    <h1><?= $business_current['name'] ?>
                        <img src="/resources/users/img/business/white/<?= $business_current['segment'] ?>.png" alt="<?= $business_current['name'] ?>">
                    </h1>
                </div>
                <ul class="sub_menu pc">
                    <li>
                        <a href="/business" class="all_service">All Service </a>
                    </li>
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

                <div class="product_name mo">
                    <ul class="header_i">
                        <li data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                            <a><span class="i i_menu"></span></a>
                        </li>
                        <li>
                            <a href="/"><span class="i i_home"></span></a>
                        </li>
                        <li>
                            <a href="/">
                                <img src="/resources/users/img/header_logo.png" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="/business" class="all_service mo">All Service </a>
            </div>
            <div class="menu_wrap mo">
                <ul class="sub_menu">
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
        </header>
        <!-- e:header -->

        <?php $this->load->view('/users/include/_2_nav_offcanvas', $business_list); ?>

        <!-- e:pc -->
        <section class="sub_cont pb-5">
            <div class="sub_cont_top">
                <h1>
                    <?= $business_current['name'] ?>
                    <img src="/resources/users/img/business/white/<?= $business_current['segment'] ?>.png" alt="<?= $business_current['name'] ?>">
                </h1>
            </div>