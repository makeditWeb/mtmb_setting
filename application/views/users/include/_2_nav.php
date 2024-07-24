<body id='pageTop'>
    <div class="sub_wrap">
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
                    <li class="<?= ($page_info['curr_segment'] == "company") ? "active" : "" ?>">
                        <a href='/'><span class='logo_text'>MTMBPPT</span></a>
                    </li>
                </ul>
                <ul class="header_login">
                    <li >
                        <a href="#">로그인</a>
                    </li>
                    <li >
                        <a href="#">회원가입</a>
                    </li>
                </ul>
                <ul class="sub_menu pc">
                    <li class="<?= ($page_info['curr_segment'] == "company") ? "active" : "" ?>">
                        <a href="/company">회사소개</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "business") ? "active" : "" ?>">
                        <a href="/business">비지니스</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "consulting") ? "active" : "" ?>">
                        <a href="/consulting">견적문의</a>
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
                        <a href="/business">비지니스</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "consulting") ? "active" : "" ?>">
                        <a href="/consulting">견적문의</a>
                    </li>
                    <li class="<?= ($page_info['curr_segment'] == "customer") ? "active" : "" ?>">
                        <a href="/customer">고객센터</a>
                    </li>
                </ul>
            </div>
        </header>

        <?php $this->load->view('/users/include/_2_nav_offcanvas', $business_list); ?>