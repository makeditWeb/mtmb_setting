<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1920, initial-scale=0.1">
    <title>MTMbiz Manager</title>

    <link rel="icon" href="/resources/admin/favicon/favicon.ico">

    <link rel="stylesheet" href="/resources/admin/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/resources/admin/css/adminlte.css?<?= time() ?>">
    <link rel="stylesheet" href="/resources/admin/css/style.css">

    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="/resources/admin/jquery/jquery.min.js"></script>
    <script src="/resources/admin/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/resources/admin/js/adminlte.min.js"></script>
    <script src="/resources/admin/js/moment.min.js"></script>
    <script src="/resources/admin/js/common.js?<?= time() ?>"></script>
</head>

<body class="wrapper">
    <div class="row">
        <div class="col-6">
            <div class="text-center" style="margin:140px auto;height:100px;">
                <a href="https://mtmbds.com/admin/">
                    <img src="/resources/users/img/main_logo.png" style="max-width:35%;" />
                </a>
            </div>

            <div class="card">
                <div class="card-header card-header-strong">
                    <div class="card-title card-title-strong">컨설팅 - 신규문의 (<?= $consulting_new_count_mtmb ?>건)</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body" style="min-height:410px;">
                    <table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
                        <colgroup>
                            <col width="15%">
                            <col width="30%">
                            <col width="25%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>등록일</th>
                                <th>기업(단체)명</th>
                                <th>신청인</th>
                                <th>의뢰분야</th>
                            </tr>
                        </thead>
                        <tbody id="consulting_new_mtmb">
                            <?php
                            $i = 0;
                            foreach ($consulting_new_list_mtmb as $list) {
                            ?>
                                <tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
                                    <td class="text-center"><?= replaceDate($list->regdate) ?></td>
                                    <td class="text-center"><?= masking_name($list->name) ?></td>
                                    <td class="text-center"><?= masking_name($list->employee_name) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $consulting_business = explode(',', str_replace(' ', '', $list->business));
                                        foreach ($consulting_business as $business) {
                                        ?>
                                            <div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-center mt-1" style="height:50px;">
                        <?php if (($i - 1) > 4) { ?>
                            <button class="btn btn-sm btn-primary w30per mt-3 show_more_list" data-tableid="#consulting_new_mtmb">더보기</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header card-header-strong">
                    <div class="card-title card-title-strong">QnA (<?= $qna_count_mtmb ?>건)</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body" style="min-height:300px;">
                    <table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
                        <colgroup>
                            <col width="15%">
                            <col width="60%">
                            <col width="25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>등록일</th>
                                <th>제목</th>
                                <th>작성자</th>
                            </tr>
                        </thead>
                        <tbody id="qna_new_mtmb">
                            <?php
                            $i = 0;
                            foreach ($qna_list_mtmb as $list) {
                            ?>
                                <tr class="<?= ($i > 2) ? 'displaynone' : '' ?>">
                                    <td class="text-center"><?= replaceDate($list->regdate) ?></td>
                                    <td><?= $list->subject ?></td>
                                    <td class="text-center"><?= masking_name($list->name) ?></td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-center mt-1" style="height:50px;">
                        <?php if (($i - 1) > 2) { ?>
                            <button class="btn btn-sm btn-primary w30per mt-3 show_more_list" data-tableid="#qna_new_mtmb">더보기</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-6">
            <div class="text-center" style="margin:140px auto;height:100px;">
                <a href="https://nestjejuds.com/admin/">
                    <img src="/resources/users/img/main_logo_nest.png" style="max-width:35%;" />
                </a>
            </div>

            <div class="card">
                <div class="card-header card-header-strong">
                    <div class="card-title card-title-strong">컨설팅 - 신규문의 (<?= $consulting_new_count_nest ?>건)</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body" style="min-height:410px;">
                    <table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
                        <colgroup>
                            <col width="15%">
                            <col width="30%">
                            <col width="25%">
                            <col width="30%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>등록일</th>
                                <th>기업(단체)명</th>
                                <th>신청인</th>
                                <th>의뢰분야</th>
                            </tr>
                        </thead>
                        <tbody id="consulting_new_nest">
                            <?php
                            $i = 0;
                            foreach ($consulting_new_list_nest as $list) {
                            ?>
                                <tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
                                    <td class="text-center"><?= replaceDate($list->regdate) ?></td>
                                    <td class="text-center"><?= masking_name($list->name) ?></td>
                                    <td class="text-center"><?= masking_name($list->employee_name) ?></td>
                                    <td class="text-center">
                                        <?php
                                        $consulting_business = explode(',', str_replace(' ', '', $list->business));
                                        foreach ($consulting_business as $business) {
                                        ?>
                                            <div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-center mt-1" style="height:50px;">
                        <?php if (($i - 1) > 4) { ?>
                            <button class="btn btn-sm btn-primary w30per mt-3 show_more_list" data-tableid="#consulting_new_nest">더보기</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header card-header-strong">
                    <div class="card-title card-title-strong">QnA (<?= $qna_count_nest ?>건)</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>

                <div class="card-body" style="min-height:300px;">
                    <table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
                        <colgroup>
                            <col width="15%">
                            <col width="60%">
                            <col width="25%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>등록일</th>
                                <th>제목</th>
                                <th>작성자</th>
                            </tr>
                        </thead>
                        <tbody id="qna_new_nest">
                            <?php
                            $i = 0;
                            foreach ($qna_list_nest as $list) {
                            ?>
                                <tr class="<?= ($i > 2) ? 'displaynone' : '' ?>">
                                    <td class="text-center"><?= replaceDate($list->regdate) ?></td>
                                    <td><?= $list->subject ?></td>
                                    <td class="text-center"><?= masking_name($list->name) ?></td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="text-center mt-1" style="height:50px;">
                        <?php if (($i - 1) > 2) { ?>
                            <button class="btn btn-sm btn-primary w30per mt-3 show_more_list" data-tableid="#qna_new_nest">더보기</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>



    </div>
</body>

<style>
    body {
        min-height: 100dvh;
    }

    /* .wrapper {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    } */
    .wrapper {
        padding: 20px;
    }

    .location-btn {
        padding: 1rem 3rem;
        margin: 10px;
        font-size: 4rem;
        color: #ffffff;
    }

    .location-btn.seoul {
        background-color: #4167df;
    }

    .location-btn.jeju {
        background-color: #00b0f0;
    }
</style>


<script>
    $(function() {
        $(".show_more_list").on("click", function() {
            var tableid = $(this).data("tableid");
            $(tableid).children(".displaynone").slice(0, 5).removeClass("displaynone");
            if ($(tableid).children(".displaynone").length < 1) {
                $(this).addClass("displaynone");
            }
        });
    });
</script>


</html>