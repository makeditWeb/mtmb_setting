<section class="content container-fluid">
    <div class="card">
        <div class="card-header card-header-strong">
            <div class="card-title card-title-strong"><?= $current_menu_info['name'] ?></div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="business-form" width="100%" cellspacing="0">
                <colgroup>
                    <col width="15%">
                    <col width="35%">
                    <col width="15%">
                    <col width="35%">
                </colgroup>
                <tbody class="vertical">
                    <tr>
                        <th>분야명</th>
                        <td>
                            <input type="text" class="form-control form-valid fv_empty" name="name" type="text" placeholder="분야명을 입력해주세요." title="분야명" value="<?= $dataResult->name ?>">
                        </td>
                        <th>코드명</th>
                        <td>
                            <input type="text" class="form-control form-valid fv_empty" name="segment" type="text" placeholder="코드명을 입력해주세요." title="코드명" value="<?= $dataResult->segment ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>협력업체 의뢰범위</th>
                        <td>
                            <div class="form-check radio pr-3">
                                <input class="form-check-input" type="radio" name="use_partner" id="use_partner1" value="1" checked />
                                <label class="form-check-label" for="use_partner1">활성</label>
                            </div>
                            <div class="form-check radio pr-3">
                                <input class="form-check-input" type="radio" name="use_partner" id="use_partner2" value="0" <?php if (!$dataResult->use_partner) echo "checked"; ?> />
                                <label class="form-check-label" for="use_partner2">비활성</label>
                            </div>
                        </td>
                        <th>월간디자인 의뢰범위</th>
                        <td>
                            <div class="form-check radio pr-3">
                                <input class="form-check-input" type="radio" name="use_subscribe" id="use_subscribe1" value="1" checked />
                                <label class="form-check-label" for="use_subscribe1">활성</label>
                            </div>
                            <div class="form-check radio pr-3">
                                <input class="form-check-input" type="radio" name="use_subscribe" id="use_subscribe2" value="0" <?php if (!$dataResult->use_subscribe) echo "checked"; ?> />
                                <label class="form-check-label" for="use_subscribe2">비활성</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>매출통계 대상</th>
                        <td>
                            <div class="form-check radio pr-3">
                                <input class="form-check-input" type="radio" name="use_statistics" id="use_statistics1" value="1" checked />
                                <label class="form-check-label" for="use_statistics1">활성</label>
                            </div>
                            <div class="form-check radio pr-3">
                                <input class="form-check-input" type="radio" name="use_statistics" id="use_statistics2" value="0" <?php if (!$dataResult->use_statistics) echo "checked"; ?> />
                                <label class="form-check-label" for="use_statistics2">비활성</label>
                            </div>
                        </td>
                        <th>매출통계 색상</th>
                        <td>
                            <div class="input-group my-colorpicker2">
                                <div class="input-group-prepend w20per">
                                    <div class="w100per input-group-text" id="statics-color-preview" style="background-color:<?= $dataResult->color ?>"></div>
                                </div>
                                <input class="form-control form-valid fv_empty" id="statics-color-value" name="color" type="text" placeholder="색상을 지정해주세요." title="매출통계 색상" value="<?= $dataResult->color ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="right mt-2">
                <button type="button" class="btn bg-olive mr-2 businessSubmit" data-mode=<?= $mode ?>>저장</button>
                <button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
            </div>
        </div>
    </div>


    <?php
    if ($dataResult->use_contents) {
    ?>
    <div class="card">
        <div class="card-header card-header-strong">
            <div class="card-title card-title-strong">컨텐츠 관리</div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-right">
                <button type="button" class="btn btn-sm bg-olive btn-contents-moddal" data-mode="add" data-curridx="0">컨텐츠 등록</button>
            </div>
            <div class="row connectedSortable2">
                <?php
                foreach ($contents_list as $list) {
                    $img = json_decode($list->img_name)[0];
                ?>
                    <div class="col-2 mt-5 mb-5 contents_list text-center" data-idx="<?= $list->idx ?>">
                        <p class="select_contents cursor-pointer" data-curridx="<?= $list->idx ?>"><img class="contents_list_img img-fluid" src="<?= $img ?>" class="" /></p>
                        <strong class="contents_list_title"><?= $list->title ?></strong>
                        <div class="fclear"></div>
                        <button type="button" class="btn btn-sm bg-olive btn-contents-moddal" data-mode="mod" data-curridx="<?= $list->idx ?>">수정</button>
                        <button type="button" class="btn btn-sm btn-danger btn-contents-del" data-idx="<?= $list->idx ?>">삭제</button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php } ?>



    <div class="card">
        <div class="card-header card-header-strong">
            <div class="card-title card-title-strong">레퍼런스 관리</div>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="text-right">
                <button type="button" class="btn btn-sm bg-olive btn-reference-moddal" data-mode="add" data-curridx="0">레퍼런스 등록</button>
            </div>
            <div class="row connectedSortable">
                <?php
                foreach ($reference_list as $list) {
                    $img = json_decode($list->img_name)[0];
                ?>
                    <div class="col-2 mt-5 mb-5 reference_list text-center" data-idx="<?= $list->idx ?>">
                        <p class="select_reference cursor-pointer" data-curridx="<?= $list->idx ?>"><img class="reference_list_img img-fluid" src="<?= $img ?>" class="" /></p>
                        <strong class="reference_list_title"><?= $list->title ?></strong>
                        <div class="fclear"></div>
                        <button type="button" class="btn btn-sm bg-olive btn-reference-moddal" data-mode="mod" data-curridx="<?= $list->idx ?>">수정</button>
                        <button type="button" class="btn btn-sm btn-danger btn-reference-del" data-idx="<?= $list->idx ?>">삭제</button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


</section>

<div class="modal" id="modal-reference-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">레퍼런스 저장</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="reference-form">
                <div class="form-group">
                    <label for="reference-title-input">제목</label>
                    <input type="text" class="form-control form-valid" name="title" id="reference-title-input" placeholder="제목을 입력해주세요." title="제목">
                </div>
                <div class="form-group mt-4">
                    <label for="reference-img-input">이미지</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="reference_img[]" id="reference-img-input" placeholder="파일을 선택해주세요." title="이미지" multiple>
                            <label class="custom-file-label" for="reference-img-input">파일을 선택해주세요.</label>
                        </div>
                    </div>
                </div>
                <div class="mt-2 row" id="reference_img_origin"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary closeModalBtn">취소</button>
                <button type="button" class="btn btn-blue" id="referenceSubmit">저장</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modal-reference-view" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-reference-view-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row" id="modal-reference-view-img"></div>
        </div>
    </div>
</div>


<div class="modal" id="modal-contents-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">컨텐츠 저장</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="contents-form">
                <div class="form-group">
                    <label for="contents-title-input">제목</label>
                    <input type="text" class="form-control form-valid" name="title" id="contents-title-input" placeholder="제목을 입력해주세요." title="제목">
                </div>
                <div class="form-group mt-4">
                    <label for="contents-img-input">이미지</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="contents_img[]" id="contents-img-input" placeholder="파일을 선택해주세요." title="이미지">
                            <label class="custom-file-label" for="contents-img-input">파일을 선택해주세요.</label>
                        </div>
                    </div>
                </div>
                <div class="mt-2 row" id="contents_img_origin"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary closeModalBtn">취소</button>
                <button type="button" class="btn btn-blue" id="contentsSubmit">저장</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modal-contents-view" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-contents-view-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row" id="modal-contents-view-img"></div>
        </div>
    </div>
</div>

<script src="/resources/admin/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/resources/admin/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/resources/admin/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
<script src="/resources/admin/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script>
    page_info = JSON.parse('<?= json_encode($page_info) ?>');
    const curr_idx = '<?= $dataResult->idx ?>';
    const curr_segment = '<?= $dataResult->segment ?>';
    let curr_ref_idx = '';
    let curr_con_idx = '';

    $(function() {
        bsCustomFileInput.init();

        $('.connectedSortable').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.reference_list_title, .reference_list_img',
            forcePlaceholderSize: true,
            zIndex: 999999,
            update: function(event, ui) {
                referenceSortSubmit();
            }
        });

        $(".businessSubmit").on("click", function() {
            var mode = $(this).data("mode");
            businessSubmit(mode);
        });

        $('.my-colorpicker2').colorpicker({
            format: 'rgb',
            useAlpha: true
        });

        $("#statics-color-value").on("change", function() {
            var color = $(this).val();
            $("#statics-color-preview").css("background-color", color);
        });

        $(".btn-reference-moddal").on("click", function() {
            $("#reference_img_origin").empty();
            $("#reference-title-input").val("");

            reference_mode = $(this).data('mode');
            curr_ref_idx = $(this).data('curridx');
            $("#modal-reference-form").modal();

            if (reference_mode == "mod") {
                referenceMod(curr_ref_idx);
            }
        });

        $(".select_reference").on("click", function() {
            curr_ref_idx = $(this).data('curridx');
            referenceView(curr_ref_idx);
        });

        $("#referenceSubmit").on("click", function() {
            referenceSubmit(reference_mode);
        });

        $(".btn-reference-del").on("click", function() {
            curr_ref_idx = $(this).data('idx');
            referenceDelSubmit();
        });



        $('.connectedSortable2').sortable({
            placeholder: 'sort-highlight',
            connectWith: '.connectedSortable',
            handle: '.contents_list_title, .contents_list_img',
            forcePlaceholderSize: true,
            zIndex: 999999,
            update: function(event, ui) {
                contentsSortSubmit();
            }
        })

        $(".btn-contents-moddal").on("click", function() {
            $("#contents_img_origin").empty();
            $("#contents-title-input").val("");

            contents_mode = $(this).data('mode');
            curr_con_idx = $(this).data('curridx');
            $("#modal-contents-form").modal();

            if (contents_mode == "mod") {
                contentsMod(curr_con_idx);
            }
        });

        $(".select_contents").on("click", function() {
            curr_con_idx = $(this).data('curridx');
            contentsView(curr_con_idx);
        });

        $("#contentsSubmit").on("click", function() {
            contentsSubmit(contents_mode);
        });

        $(".btn-contents-del").on("click", function() {
            curr_con_idx = $(this).data('idx');
            contentsDelSubmit();
        });
    });

    function businessSubmit(mode) {
        var form_data = {
            "idx": curr_idx,
            "name": $("input[name=name]").val(),
            "use_partner": $("input[name=use_partner]:checked").val(),
            "use_subscribe": $("input[name=use_subscribe]:checked").val(),
            "use_statistics": $("input[name=use_statistics]:checked").val(),
            "color": $("input[name=color]").val()
        };

        $.ajax({
            method: "POST",
            url: page_info['base_url'] + "/save/" + mode,
            beforeSend: function(xhr, opts) {
                if (!formValidate("#business-form")) xhr.abort();
            },
            data: form_data,
            success: function(data) {
                var result = JSON.parse(data);
                $modal_alert(page_info['curr_title'], result.message, function() {
                    if (result.flag) {
                        location.href = page_info['base_url'] + '/mod/' + result.idx + '/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
                    } else {
                        $modal_hide();
                    }
                });
            }
        });
    }

    function referenceMod(idx) {
        $.post(page_info['base_url'] + "/refView/", {
            idx: idx
        }, function(data) {
            var result = JSON.parse(data);

            if (result.flag) {
                $("#reference-title-input").val(result.data.dataResult.title);
                var img_list = JSON.parse(result.data.dataResult.img_name);
                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-2'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per mb-2',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#reference_img_origin").append(div_tags);
                });
            }
        });
    }

    function referenceView(idx) {
        $.post(page_info['base_url'] + "/refView/", {
            idx: idx
        }, function(data) {
            var result = JSON.parse(data);

            if (result.flag) {
                $("#modal-reference-view").modal();
                var img_list = JSON.parse(result.data.dataResult.img_name);
                $("#modal-reference-view-title").text(result.data.dataResult.title);
                $("#modal-reference-view-img").empty();

                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-3'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per mb-2',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#modal-reference-view-img").append(div_tags);
                });
            }
        });
    }

    function referenceSubmit(mode) {
        var form_data = new FormData();
        form_data.append("idx", curr_ref_idx);
        form_data.append("segment", curr_segment);
        form_data.append("title", $("#reference-title-input").val());

        var fileList = $("#reference-img-input")[0].files;

        $.each(fileList, function(key, val) {
            form_data.append("reference_img[]", val);
        });

        $.ajax({
            method: "POST",
            url: page_info['base_url'] + "/refSave/" + mode,
            beforeSend: function(xhr, opts) {
                if (!formValidate("#reference-form")) xhr.abort();
            },
            data: form_data,
            enctype: 'multipart/form-data',
            processData: false,
            cache: false,
            contentType: false,
            success: function(data) {
                var result = JSON.parse(data);
                $modal_alert(page_info['curr_title'], result.message, function() {
                    if (result.flag) {
                        location.reload();
                    } else {
                        $modal_hide();
                    }
                });
            }
        });
    }

    function referenceDelSubmit() {
        $modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
            $.ajax({
                method: "POST",
                url: page_info['base_url'] + "/refDel/",
                data: {
                    "idx": curr_ref_idx
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    $modal_alert(page_info['curr_title'], result.message, function() {
                        if (result.flag) {
                            location.reload();
                        } else {
                            $modal_hide();
                        }
                    });
                }
            });
        }, function() {
            $modal_hide();
        });
    }

    function referenceSortSubmit() {
        reference_sort = [];
        $(".connectedSortable .reference_list").each(function(index) {
            curr_ref_idx = $(this).data("idx");
            reference_sort.push({
                "idx": curr_ref_idx,
                "sort": index
            });
        });

        $.ajax({
            method: "POST",
            url: page_info['base_url'] + "/refSort/",
            data: {
                "reference_sort": reference_sort
            },
            success: function(data) {
                var result = JSON.parse(data);
                if (!result.flag) {
                    $modal_alert(page_info['curr_title'], result.message, function() {
                        $modal_hide();
                    });
                }
            }
        });
    }












    function contentsMod(idx) {
        $.post(page_info['base_url'] + "/conView/", {
            idx: idx
        }, function(data) {
            var result = JSON.parse(data);

            if (result.flag) {
                $("#contents-title-input").val(result.data.dataResult.title);
                var img_list = JSON.parse(result.data.dataResult.img_name);
                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-2'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per mb-2',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#contents_img_origin").append(div_tags);
                });
            }
        });
    }

    function contentsView(idx) {
        $.post(page_info['base_url'] + "/refView/", {
            idx: idx
        }, function(data) {
            var result = JSON.parse(data);

            if (result.flag) {
                $("#modal-contents-view").modal();
                var img_list = JSON.parse(result.data.dataResult.img_name);
                $("#modal-contents-view-title").text(result.data.dataResult.title);
                $("#modal-contents-view-img").empty();

                $.each(img_list, function(key, value) {
                    div_tags = $("<div/>", {
                        class: 'col-3'
                    });
                    img_tags = $("<img/>", {
                        class: 'w100per mb-2',
                        src: value
                    });
                    div_tags.append(img_tags);
                    $("#modal-contents-view-img").append(div_tags);
                });
            }
        });
    }

    function contentsSubmit(mode) {
        var form_data = new FormData();
        form_data.append("idx", curr_con_idx);
        form_data.append("segment", curr_segment);
        form_data.append("title", $("#contents-title-input").val());

        var fileList = $("#contents-img-input")[0].files;

        $.each(fileList, function(key, val) {
            form_data.append("contents_img[]", val);
        });

        $.ajax({
            method: "POST",
            url: page_info['base_url'] + "/conSave/" + mode,
            beforeSend: function(xhr, opts) {
                if (!formValidate("#contents-form")) xhr.abort();
            },
            data: form_data,
            enctype: 'multipart/form-data',
            processData: false,
            cache: false,
            contentType: false,
            success: function(data) {
                var result = JSON.parse(data);
                $modal_alert(page_info['curr_title'], result.message, function() {
                    if (result.flag) {
                        location.reload();
                    } else {
                        $modal_hide();
                    }
                });
            }
        });
    }

    function contentsDelSubmit() {
        $modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
            $.ajax({
                method: "POST",
                url: page_info['base_url'] + "/conDel/",
                data: {
                    "idx": curr_con_idx
                },
                success: function(data) {
                    var result = JSON.parse(data);
                    $modal_alert(page_info['curr_title'], result.message, function() {
                        if (result.flag) {
                            location.reload();
                        } else {
                            $modal_hide();
                        }
                    });
                }
            });
        }, function() {
            $modal_hide();
        });
    }

    function contentsSortSubmit() {
        contents_sort = [];
        $(".connectedSortable2 .contents_list").each(function(index) {
            curr_con_idx = $(this).data("idx");
            contents_sort.push({
                "idx": curr_con_idx,
                "sort": index
            });
        });

        $.ajax({
            method: "POST",
            url: page_info['base_url'] + "/conSort/",
            data: {
                "contents_sort": contents_sort
            },
            success: function(data) {
                var result = JSON.parse(data);
                if (!result.flag) {
                    $modal_alert(page_info['curr_title'], result.message, function() {
                        $modal_hide();
                    });
                }
            }
        });
    }
</script>