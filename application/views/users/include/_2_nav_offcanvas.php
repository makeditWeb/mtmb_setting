<!-- s: (모바일) offcanvas -->
<div class="offcanvas offcanvas-top" data-bs-scroll="true" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-6 col-lg-12">
                <dl>
                    <dt>
                        <a href="/company">회사소개</a>
                    </dt>
                    <dd>
                        <a href="/company?section=about">- 인사말</a>
                    </dd>
                    <dd>
                        <a href="/company?section=location">- 위치</a>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <a href="/business">비지니스</a>
                    </dt>
                    <dd>
                        <a href="/business">- 전체서비스</a>
                    </dd>
                    <dd>
                        <a href="/business?section=work&tab=0">- PPT디자인</a>
                    </dd>
                    <dd>
                        <a href="/business?section=work&tab=1">- 공공기관</a>
                    </dd>
                    <dd>
                        <a href="/business?section=work&tab=2">- 중소기업</a>
                    </dd>
                    <dd>
                        <a href="/business?section=work&tab=3">- 월간디자인</a>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <a href="/consulting">컨설팅</a>
                    </dt>
                    <dd>
                        <a href="/consulting?section=list">- 의뢰목록</a>
                    </dd>
                    <dd>
                        <a href="/consulting?section=review">- 만족도</a>
                    </dd>
                    <dd>
                        <a href="/consulting?section=partner">- 파트너사</a>
                    </dd>
                    <dd>
                        <a href="/consulting?section=portfolio">- 포트폴리오</a>
                    </dd>
                </dl>
                <dl>
                    <dt>
                        <a href="/customer">고객센터</a>
                    </dt>
                    <dd>
                        <a href="/customer?section=notice">- 공지사항</a>
                    </dd>
                    <dd>
                        <a href="/customer?section=qna">- 문의하기</a>
                    </dd>
                </dl>
            </div>

            <?php
            $business_top = array_filter($business_list, function ($item) {
                return ($item['use_top'] == true && $item['use_menu'] == true);
            });

            $business_bottom = array_filter($business_list, function ($item) {
                return ($item['use_top'] == false && $item['use_menu'] == true);
            });
            ?>

            <div class="col-6 mo">
                <dl>
                    <dt>전체서비스</dt>

                    <?php
                    foreach ($business_top as $list) {
                    ?>
                        <dd>
                            <a href="/business/list/<?= $list['segment'] ?>"><b><?= $list['name'] ?></b></a>
                        </dd>
                    <?php } ?>
                </dl>
                <dl>
                    <?php
                    foreach ($business_bottom as $list) {
                    ?>
                        <dd>
                            <a href="/business/list/<?= $list['segment'] ?>"><?= $list['name'] ?></a>
                        </dd>
                    <?php } ?>
                </dl>
            </div>
        </div>
    </div>
</div>
<!-- e: (모바일) offcanvas -->