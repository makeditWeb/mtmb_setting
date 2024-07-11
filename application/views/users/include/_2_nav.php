<body>
    <div class="sub_wrap">
        <!-- s:header -->
        <header class="header" id="header">
            <div class="header_wrap">
                <ul class="header_i">
                    <li data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                        <span class="i i_menu"></span>
                    </li>
                    <li>
                        <a href="/"><span class="i i_home"></span></a>
                    </li>
                    <li>
                        <a href="/"><span class="i i_home_sub"></span></a>
                        <!-- <a href="/">
                            <img src="/resources/users/img/header_logo.png" alt="">
                        </a> -->
                    </li>
                </ul>
                <ul class="sub_menu pc">
                    <li class="<?= ($page_info['curr_segment'] == "company") ? "active" : "" ?>">
                        <a href="/company">회사소개</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "business") ? "active" : "" ?>">
                        <a href="/business">비즈니스</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "consulting") ? "active" : "" ?>">
                        <a href="/consulting">견적요청</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "customer") ? "active" : "" ?>">
                        <a href="/customer">고객센터</a>
                    </li>
                </ul>
            </div>
            <div class="menu_wrap mo">
                <ul class="sub_menu">
                    <li class="<?= ($page_info['curr_segment'] == "company") ? "active" : "" ?>">
                        <a href="/company">회사소개</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "business") ? "active" : "" ?>">
                        <a href="/business">비즈니스</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "consulting") ? "active" : "" ?>">
                        <a href="/consulting">견적요청</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "customer") ? "active" : "" ?>">
                        <a href="/customer">고객센터</a>
                    </li>
                </ul>
            </div>
        </header>
        <!-- e:header -->

        <?php $this->load->view('/users/include/_2_nav_offcanvas', $business_list); ?>