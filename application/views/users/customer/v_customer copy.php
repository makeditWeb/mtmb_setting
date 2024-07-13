<section class="sub_cont consulting sc">
    <div class="sub_cont_top" id="">
        <div class="container_wrap">
            <!-- s: (모바일) 공지사항 -->
            <div class="container mo">
                <h1>공지사항</h1>
                <div class="notice_wrap">
                    <ul class="table_notice_list"></ul>
                </div>
                <div class="notice_pagination">
                    <ul>
                        <li class="prev btn_notice_prev_page"><span>◀</span>이전</li>
                        <li class="notice_curr_page"></li>
                        <li>/</li>
                        <li class="notice_total_page"></li>
                        <li class="next btn_notice_next_page">다음<span>▶</span></li>
                    </ul>
                </div>
            </div>
            <!-- e: (모바일) 공지사항 -->

            <!-- s: (PC) 공지사항 -->
            <div class="container pc">
                <div class="row">
                    <div class="col-4">
                        <div class="cont_left">
                            <h1 class="cont_title">공지사항</h1>
                            <div class="cont_bot">
                                <div class="notice_pagination">
                                    <ul>
                                        <li class="prev btn_notice_prev_page"><span>◀</span>이전</li>
                                        <li class="notice_curr_page"></li>
                                        <li>/</li>
                                        <li class="notice_total_page"></li>
                                        <li class="next btn_notice_next_page">다음<span>▶</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="cont_right notice_wrap">
                            <ul class="table_notice_list"></ul>
                        </div>
                    </div>
                </div>
                <!-- e: (PC) 공지사항 -->
            </div>
        </div>
    </div>

    <div class="sub_cont_body pb-5" id="qna">
        <!-- s: (모바일)문의하기 -->
        <section class="container mo">
            <div class="cont_header">
                <h1 class="cont_title m-0">문의하기</h1>
                <button type="button" class="btn_primary btn_qna_add">글쓰기</button>
            </div>
            <div class="cont_body">
                <div class="row">
                    <div class="col-4">
                        <div class="input_group type2">
                            <select name="" id="">
                                <option value="">제목 + 내용</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="input_group type2">
                            <input type="text" class="qna_keyword" placeholder="검색어를 입력해주세요">
                            <button type="button" class="btn_search btn_get_qna_list"></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <table class="request_table">
                            <colgroup>
                                <col width="12%" />
                                <col width="60%" />
                                <col width="28%" />
                            </colgroup>
                            <tbody id="table_qna_list_mo"></tbody>
                        </table>
                        <div class="table_pagination">
                            <ul>
                                <li class="prev btn_qna_prev_page"><span>◀</span>이전</li>
                                <li class="qna_curr_page"></li>
                                <li>/</li>
                                <li class="qna_total_page"></li>
                                <li class="next btn_qna_next_page">다음<span>▶</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- e: (모바일)문의하기-->

        <!-- s: (PC)문의하기-->
        <section class="container pc mt-5 ">
            <div class="row">
                <div class="col-4">
                    <div class="cont_left">
                        <h1 class="cont_title type2">문의하기 <button type="button" class="btn_primary btn_qna_add">글쓰기</button></h1>
                        <div class="cont_bot">
                            <div class="sc input_wrap">
                                <div class="input_group type2">
                                    <select name="" id="">
                                        <option value="">제목 + 내용</option>
                                    </select>
                                </div>
                                <div class="input_group type2">
                                    <input type="text" class="qna_keyword" placeholder="검색어를 입력해주세요">
                                    <button type="button" class="btn_search btn_get_qna_list"></button>
                                </div>
                            </div>

                            <div class="notice_pagination">
                                <ul>
                                    <li class="prev btn_qna_prev_page"><span>◀</span>이전</li>
                                    <li class="qna_curr_page"></li>
                                    <li>/</li>
                                    <li class="qna_total_page"></li>
                                    <li class="next btn_qna_next_page">다음<span>▶</span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-8">
                    <div class="cont_right">
                        <table class="request_table">
                            <colgroup>
                                <col width="10%" />
                                <col width="60%" />
                                <col width="15%" />
                                <col width="15%" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>작성자</th>
                                    <th>작성일</th>
                                </tr>
                            </thead>
                            <tbody id="table_qna_list_pc"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!-- e: (PC)문의하기-->
    </div>
</section>

<!-- s:게시글 조회 모달 -->
<div class="modal fade write-modal view-modal" id="modal-notice-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="reviewModalLabel">공지사항</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_review">
                    <h5 id="modal-notice-subject"></h5>
                    <ul class="data">
                        <li id="modal-notice-regdate"></li>
                    </ul>
                </div>
                <div class="modal_review_text" id="modal-notice-content"></div>
            </div>
        </div>
    </div>
</div>

<!-- s:writingModalL(글쓰기) -->
<div class="modal fade write-modal" id="modal-qna-write" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="writingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="writingModalLabel">문의하기</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_body_area" id="qna_form">
                    <div class="input_area">
                        <div class="row">
                            <div class="col-6">
                                <div class="input_group">
                                    <label>작성자</label>
                                    <input type="text" class="form-valid fv_empty" name="qna_name" maxlength="20">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input_group">
                                    <label>패스워드</label>
                                    <input type="password" class="form-valid fv_empty" name="qna_pass" maxlength="20">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input_group">
                                    <label>연락처</label>
                                    <input type="text" class="form-valid fv_empty fv_telnum" name="qna_tel" maxlength="16">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input_group">
                                    <label>이메일주소</label>
                                    <input type="text" class="form-valid fv_empty fv_email" name="qna_email" maxlength="50">
                                </div>
                            </div>                            
                            <div class="col-12">
                                <div class="input_group">
                                    <label class="w_17">제목</label>
                                    <input type="text" class="form-valid fv_empty" name="qna_subject" placeholder="제목을 입력해주세요" maxlength="100">
                                </div>
                            </div>
                            <div class="col-12">
                                <textarea class="form-valid fv_empty" name="qna_content" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-skyblue" id="btn_qna_save">등록</button>
            </div>
        </div>
    </div>
</div>
<!-- e:writingModal -->

<!-- s:게시글 조회 모달 -->
<div class="modal fade write-modal view-modal" id="modal-qna-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="reviewModalLabel">만족도</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal_review">
                    <h5 id="modal-qna-subject"></h5>
                    <ul class="data">
                        <li id="modal-qna-regdate"></li>
                    </ul>
                </div>
                <div class="modal_review_text" id="modal-qna-content"></div>
                <hr/>
                <div class="modal_review_text" id="modal-qna-answer"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" id="btn_qna_del">삭제</button>
                <button type="button" class="btn btn-skyblue" id="btn_qna_mod">수정</button>
            </div>
        </div>
    </div>
</div>

<script src="/resources/users/lib/jquery.min.js"></script>
<script src="/resources/users/lib/bootstrap.bundle.min.js"></script>
<script src="/resources/users/lib/jquery.fullpage.min.js"></script>
<script src="/resources/users/lib/swiper-bundle.min.js"></script>
<script src="/resources/users/js/examples.js"></script>
<script src="/resources/users/js/common.js"></script>
<script>
    section = "<?= $page_info['section'] ?>";

    let notice_curr_page = 1;
    let notice_total_page = 1;
    let modal_notice_view;
    let curr_notice_idx;

    let qna_curr_page = 1;
    let qna_total_page = 1;
    let qna_keyword = "";
    let qna_write_mode = "add";
    let modal_qna_write;
    let modal_qna_view;
    let curr_qna_idx;

    $(function() {
        load_notice();

        $(".btn_get_notice_list").on("click", function() {
            notice_curr_page = 1;
            load_notice();
        });

        $(".btn_notice_prev_page").on("click", function() {
            notice_curr_page = (notice_curr_page > 1) ? (notice_curr_page - 1) : 1;
            load_notice();
        });

        $(".btn_notice_next_page").on("click", function() {
            notice_curr_page = (notice_curr_page < notice_total_page) ? (notice_curr_page + 1) : notice_total_page;
            load_notice();
        });

        modal_notice_view = new bootstrap.Modal(document.getElementById("modal-notice-view"), {
            keyboard: false,
        });

        $(document).on("click", ".get_notice_info", function() {
            curr_notice_idx = $(this).data("idx");
            view_notice();
        });

        load_qna();

        $(".qna_keyword").on("keyup", function(e) {
            $(".qna_keyword").val($(this).val());
            if (e.keyCode == 13) {
                qna_curr_page = 1;
                load_qna();
            }
        });

        $(".btn_get_qna_list").on("click", function() {
            qna_curr_page = 1;
            load_qna();
        });

        $(".btn_qna_prev_page").on("click", function() {
            qna_curr_page = (qna_curr_page > 1) ? (qna_curr_page - 1) : 1;
            load_qna();
        });

        $(".btn_qna_next_page").on("click", function() {
            qna_curr_page = (qna_curr_page < qna_total_page) ? (qna_curr_page + 1) : qna_total_page;
            load_qna();
        });

        modal_qna_write = new bootstrap.Modal(document.getElementById("modal-qna-write"), {
            keyboard: false,
        });

        modal_qna_view = new bootstrap.Modal(document.getElementById("modal-qna-view"), {
            keyboard: false,
        });

        $(".btn_qna_add").on("click", function() {
            $("input[name=qna_name]").val("");
            $("input[name=qna_subject]").val("");
            $("input[name=qna_pass]").val("");
            $("textarea[name=qna_content]").val("");
            qna_write_mode = "add";
            modal_qna_write.show();
        });

        $("#btn_qna_save").on("click", function() {
            save_qna();
        });

        $(document).on("click", ".get_qna_info", function() {
            curr_qna_idx = $(this).data("idx");
            $modal_pasword(function() {
                view_qna();
            });
        });

        $("#btn_qna_mod").on("click", function() {
            qna_write_mode = "mod";
            modal_qna_view.hide();
            $modal_pasword(function() {
                set_qna_modify();
            });
        });

        $("#btn_qna_del").on("click", function() {
            modal_qna_view.hide();
            $modal_pasword(function() {
                del_qna();
            });
        });
    });

    function load_notice() {
        notice_keyword = $(".notice_keyword").val();
        $.post("/customer/noticeList", {
            curr_page: notice_curr_page
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                notice_total_page = result.data.totalPage;
                $(".notice_curr_page").text(notice_curr_page);
                $(".notice_total_page").text(result.data.totalPage);
                $(".table_notice_list").empty().html(result.data.dataList);
            }
        });
    }

    function view_notice() {
        $.post("/customer/noticeView", {
            idx: curr_notice_idx
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                $("#modal-notice-subject").text(result.data.title);
                $("#modal-notice-regdate").text(dateToIsoString(result.data.regdate));
                $("#modal-notice-content").html(replaceToBr(result.data.contents));
                modal_notice_view.show();
            }
        });
    }

    function load_qna() {
        qna_keyword = $(".qna_keyword").val();
        $.post("/customer/qnaList", {
            curr_page: qna_curr_page,
            keyword: qna_keyword
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                qna_total_page = result.data.totalPage;
                $(".qna_curr_page").text(qna_curr_page);
                $(".qna_total_page").text(result.data.totalPage);
                $("#table_qna_list_mo").empty().html(result.data.dataList_mo);
                $("#table_qna_list_pc").empty().html(result.data.dataList_pc);
            }
        });
    }

    function view_qna() {
        $.ajax({
            method: "POST",
            url: "/customer/qnaConfirm",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#password_form")) xhr.abort();
            },
            data: {
                "idx": curr_qna_idx,
                "password": $("#modal-password-input").val()
            },
            success: function(data) {
                var result = JSON.parse(data);
                $modal_hide();
                if (result.flag) {
                    $modal_hide();
                    $.post("/customer/qnaView", {
                        idx: curr_qna_idx
                    }, function(data) {
                        var result = JSON.parse(data);
                        if (result.flag) {
                            $("#modal-qna-subject").text(result.data.subject);
                            $("#modal-qna-regdate").text(dateToIsoString(result.data.regdate));
                            $("#modal-qna-content").html(replaceToBr(result.data.contents));
                            $("#modal-qna-answer").html(result.data.answer);
                            modal_qna_view.show();
                        }
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                        $modal_pasword(function() {
                            view_qna();
                        });
                    });
                }
            }
        });
    }

    function save_qna() {
        var form_data = {
            "mode": qna_write_mode,
            "idx": curr_qna_idx,
            "name": $("input[name=qna_name]").val(),
            "subject": $("input[name=qna_subject]").val(),
            "qna_pass": $("input[name=qna_pass]").val(),
            "contents": $("textarea[name=qna_content]").val(),
            "tel": $("input[name=qna_tel]").val(),
            "email": $("input[name=qna_email]").val(),
            
        };

        $.ajax({
            method: "POST",
            url: "/customer/qnasave",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#qna_form")) xhr.abort();
            },
            data: form_data,
            success: function(data) {
                var result = JSON.parse(data);
                if (result.flag) {
                    modal_qna_write.hide();
                    qna_curr_page = 1;
                    qna_keyword = "";
                    load_qna();
                    $modal_alert("MTMbiz Design", result.message, function() {
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

    function del_qna() {
        $.ajax({
            method: "POST",
            url: "/customer/qnaDelete",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#password_form")) xhr.abort();
            },
            data: {
                "idx": curr_qna_idx,
                "password": $("#modal-password-input").val()
            },
            success: function(data) {
                var result = JSON.parse(data);
                $modal_hide();
                if (result.flag) {
                    load_qna();
                    $modal_alert("MTMbiz Design", result.message, function() {
                        load_qna();
                        $modal_hide();
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                        $modal_pasword(function() {
                            del_qna();
                        });
                    });
                }
            }
        });
    }

    function set_qna_modify() {
        $.ajax({
            method: "POST",
            url: "/customer/qnaConfirm",
            beforeSend: function(xhr, opts) {
                if (!formValidate("#password_form")) xhr.abort();
            },
            data: {
                "idx": curr_qna_idx,
                "password": $("#modal-password-input").val()
            },
            success: function(data) {
                var result = JSON.parse(data);
                $modal_hide();
                if (result.flag) {
                    $modal_hide();
                    $.post("/customer/qnaView", {
                        idx: curr_qna_idx
                    }, function(data) {
                        var result = JSON.parse(data);
                        if (result.flag) {
                            $("input[name=qna_name]").val(result.data.name);
                            $("input[name=qna_subject]").val(result.data.subject);
                            $("input[name=qna_pass]").val("");
                            $("textarea[name=qna_content]").val(result.data.contents.replace(/\\n/g, "\n"));
                            modal_qna_write.show();
                        }
                    });
                } else {
                    $modal_alert("MTMbiz Design", result.message, function() {
                        $modal_hide();
                        $modal_pasword(function() {
                            set_qna_modify();
                        });
                    });
                }
            }
        });
    }    
</script>