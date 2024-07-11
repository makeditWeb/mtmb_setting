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
            <table class="table table-bordered" width="100%" cellspacing="0">
                <colgroup>
                    <col width="15%">
                    <col width="35%">
                    <col width="15%">
                    <col width="35%">
                </colgroup>
                <tbody class="vertical">
                    <tr>
                        <th>기업명</th>
                        <td>
                            <input name="customer_idx" type="hidden" value="<?= (isset($customer_info->idx)) ? ($customer_info->idx) : "" ?>" />
                            <input class="form-control form-valid fv_empty" name="name" type="text" placeholder="기업명을 입력하세요." title="기업명" value="<?= (isset($customer_info->name)) ? $customer_info->name : "" ?>" />
                        </td>
                        <th>사업자등록번호</th>
                        <td>
                            <input class="form-control" name="brn" type="text" placeholder="사업자등록번호를 입력하세요." title="사업자등록번호" value="<?= (isset($customer_info->brn)) ? $customer_info->brn : "" ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>대표자명</th>
                        <td>
                            <input class="form-control" name="ceo" type="text" placeholder="대표자명을 입력하세요." title="대표자명" value="<?= (isset($customer_info->ceo)) ? $customer_info->ceo : "" ?>" />
                        </td>
                        <th>소재지</th>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" id="daumpostcode-addr" name="addr" type="text" placeholder="주소를 검색해주세요" title="주소" value="<?= (isset($customer_info->addr)) ? $customer_info->addr : "" ?>" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary btn-find-address">주소검색</button>
                                </div>
                            </div>
                            <input type="text" class="form-control mt-2" id="daumpostcode-addr-more" name="addr_more" type="text" placeholder="상세주소를 입력해주세요." title="상세주소" value="<?= (isset($customer_info->addr_more)) ? $customer_info->addr_more : "" ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>대표번호</th>
                        <td>
                            <input class="form-control" name="tel" type="text" placeholder="기업대표번호를 입력하세요." title="기업 대표번호" value="<?= (isset($customer_info->tel)) ? $customer_info->tel : "" ?>" />
                        </td>
                        <th>이메일주소</th>
                        <td>
                            <input class="form-control" name="email" type="text" placeholder="기업 이메일주소를 입력하세요." title="기업 이메일주소" value="<?= (isset($customer_info->email)) ? $customer_info->email : "" ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>업태</th>
                        <td>
                            <input class="form-control" name="business_type" type="text" placeholder="업태를 입력하세요." title="업태" value="<?= (isset($customer_info->business_type)) ? $customer_info->business_type : "" ?>" />
                        </td>
                        <th>담당자명</th>
                        <td>
                            <input class="form-control" name="employee_name" type="text" placeholder="담당자 이름을 입력하세요." title="담당자 이름" value="" />
                        </td>
                    </tr>
                    <tr>
                        <th>종목</th>
                        <td>
                            <input class="form-control" name="business_item" type="text" placeholder="종목을 입력하세요." title="종목" value="<?= (isset($customer_info->business_item)) ? $customer_info->business_item : "" ?>" />
                        </td>
                        <th>담당자 연락처</th>
                        <td>
                            <input class="form-control" name="employee_tel" type="text" placeholder="담당자 연락처를 입력하세요." title="담당자 연락처" value="" />
                        </td>
                    </tr>
                    <tr>
                        <th>기업구분</th>
                        <td>
                            <div class="row">
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                ?>
                                    <div class="col-3 mt-1">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="category_<?= $i ?>" name="category" value="<?= $i ?>" <?=($i==0) ? 'checked' : ''?>>
                                            <label for="category_<?= $i ?>" class="custom-control-label"><?= replaceCustomerType($i) ?></label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </td>
                        <th>담당자 이메일</th>
                        <td>
                            <input class="form-control" name="employee_email" type="text" placeholder="담당자 이메일주소를 입력하세요." title="담당자 이메일주소" value="" />
                        </td>
                    </tr>

                    <tr>
                        <th>문의경로</th>
                        <td>
                            <div class="row">
                                <?php                                
                                for ($i = 1; $i < 3; $i++) {
                                ?>
                                    <div class="col-3 mt-1">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="reg_path_<?= $i ?>" name="reg_path" value="<?= $i ?>" <?=($i==1) ? 'checked' : ''?>>
                                            <label for="reg_path_<?= $i ?>" class="custom-control-label"><?= replaceConsultingRegPath($i) ?></label>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th>의뢰범위</th>
                        <td colspan="3">
                            <div class="row">
                                <?php
                                $i = 0;
                                foreach ($business_list as $blist) {
                                    $category_list[$blist['segment']] = false;
                                ?>
                                    <div class="col-2 mt-1 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input consulting_category" data-segment="<?= $blist['segment'] ?>" type="checkbox" id="cate_<?= $i ?>" value="<?= $blist['name'] ?>">
                                            <label class="form-check-label" for="cate_<?= $i ?>"><strong><?= $blist['name'] ?></strong></label>
                                        </div>
                                        <?php $i++; ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="mt-5" id="business_questions"></div>
                        </td>
                    </tr>
                    <tr>
                        <th>세부사항</th>
                        <td colspan="3">
                            <textarea class="form-control" rows="5" name="request" placeholder="세부사항에 대해 말씀해 주시면 더욱 수월해집니다."></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="right mt-2">
                <button type="button" class="btn bg-olive mr-2 consultingSubmit">저장</button>
            </div>
        </div>
    </div>
</section>


<script>
    page_info = JSON.parse('<?= json_encode($page_info) ?>');
    let param_category = [];
    let choose_category_list = [];
    let question_values = [];
    let question_count = 0;
    let answer_count = 0;

    $(function() {
        $(".consultingSubmit").on("click", function() {
            var mode = $(this).data("mode");
            consultingSubmit(mode);
        });

        $(".btnLayerPostcode").on("click", function() {
            layerDaumPostcode();
        });

        $(".consulting_category").on("click", function() {
            var segment = $(this).data('segment');
            choose_category_list = [];
            if ($(this).is(":checked")) {
                setBusinessQuestions(segment, $(this).val());
            } else {
                if ($(".consulting_category:checked").length > 0) {
                    $("#question_div_" + segment).remove();
                    $("#work_list_tr_" + segment).remove();
                    $("#calculate_list_tr_" + segment).remove();
                } else {
                    $modal_alert(page_info['curr_title'], '최소 1개이상의 의뢰범위가 있어야 합니다.', function() {
                        $modal_hide();
                    });
                    return false;
                }
            }
        });
    });

    function setBusinessQuestions(segment, label) {
        let param_category = [segment];
        var par_idv = $("#business_questions");
        $.post('/admin/consulting/questionList', {
            'category': param_category
        }, function(data) {
            var result = JSON.parse(data);
            if (result.flag) {
                var category_tags = $('<div/>', {
                    class: 'mb-5',
                    id: 'question_div_' + segment
                }).append($('<h1/>').text(label));

                var question_list = result.data.questions.filter(question => question.segment == segment);

                $.each(question_list, function(key, val) {
                    var question_val = val.question;
                    var question_id = segment + '_' + val.idx;
                    var input_name = question_id;

                    var question_tags = $('<div/>', {
                        class: 'mb-3 border-1px-radius question_list'
                    }).html(question_val);
                    var answer_list = result.data.answers.filter(answer => answer.question_idx == val.idx);

                    $.each(answer_list, function(key, val) {
                        answer_id = question_id + '_' + val.idx;
                        var answer_tags = $('<div/>', {
                            class: 'custom-control custom-radio'
                        });
                        var radio_tags = $('<input/>', {
                            class: 'custom-control-input choose_question_answer',
                            type: 'radio',
                            data: {
                                'segment': segment,
                                'questionidx': val.question_idx,
                                'question': question_val,
                                'answeridx': val.idx,
                                'answer': val.answer
                            },
                            name: input_name,
                            id: answer_id
                        });
                        var label_tags = $('<label/>', {
                            for: answer_id,
                            class: 'custom-control-label'
                        }).html(val.answer);
                        $(answer_tags).append(radio_tags).append(label_tags);
                        $(question_tags).append(answer_tags);
                    });

                    $(category_tags).append(question_tags);
                });
                $(par_idv).append(category_tags);

                new_tr_line = $(".consulting_work_list").last().clone();
                $(new_tr_line).attr("id", 'work_list_tr_' + segment);
                // $(new_tr_line).data("segment", segment);
                $(new_tr_line).attr("data-segment", segment);
                $(new_tr_line).find("select").each(function() {
                    $(this).children("option").eq(0).attr("selected", true);
                });
                // $(new_tr_line).children(".partner_info option").data("segment", segment);				
                $(new_tr_line).find(".partner_info option").attr("data-segment", segment);
                $(new_tr_line).children(".consulting_work_list_name").html(label);
                $("#consulting_work_list_table").append(new_tr_line);

                if ($("#calculate_work_list_table").length > 0) {
                    new_tr_line = $(".calculate_work_list").last().clone();
                    $(new_tr_line).attr("id", 'calculate_list_tr_' + segment);
                    // $(new_tr_line).data("segment", segment);
                    $(new_tr_line).attr("data-segment", segment);
                    $(new_tr_line).find("select").each(function() {
                        $(this).children("option").eq(0).attr("selected", true);
                    });
                    $(new_tr_line).find("input[type=number]").each(function() {
                        $(this).val("");
                    });
                    $(new_tr_line).children(".calculate_work_list_name").html(label);
                    $("#calculate_work_list_table").append(new_tr_line);
                }
            } else {
                alert(result.message);
            }
        });
    }

    function consultingSubmit() {
        question_values = [];
        $(".choose_question_answer:checked").each(function() {
            var this_data = $(this).data();
            question_values.push({
                'segment': this_data.segment,
                'question_idx': this_data.questionidx,
                'question': this_data.question,
                'answer_idx': this_data.answeridx,
                'answer': this_data.answer
            });
        });

        question_values = JSON.stringify(question_values);

        var form_data = new FormData();
        form_data.append("customer_idx", $("input[name=customer_idx]").val());
        form_data.append("name", $("input[name=name]").val());
        form_data.append("category", $("input[name=category]:checked").val());
        form_data.append("brn", $("input[name=brn]").val());
        form_data.append("ceo", $("input[name=ceo]").val());
        form_data.append("addr", $("input[name=addr]").val());
        form_data.append("addr_more", $("input[name=addr_more]").val());
        form_data.append("tel", $("input[name=tel]").val());
        form_data.append("email", $("input[name=email]").val());
        form_data.append("business_type", $("input[name=business_type]").val());
        form_data.append("business_item", $("input[name=business_item]").val());
        form_data.append("employee_name", $("input[name=employee_name]").val());
        form_data.append("employee_tel", $("input[name=employee_tel]").val());
        form_data.append("employee_email", $("input[name=employee_email]").val());
        form_data.append("request", $("textarea[name=request]").val());
        form_data.append("reg_path", $("input[name=reg_path]:checked").val());
        form_data.append('question_values', question_values);

        $.ajax({
            method: "POST",
            url: page_info['base_url'] + "/addsave/",
            beforeSend: function(xhr, opts) {
                if (!formValidate()) {
                    xhr.abort();
                    return false;
                }

                if ($(".choose_question_answer:checked").length < 1) {
                    $modal_alert(page_info['curr_title'], '최소 1개이상의 의뢰범위가 있어야 합니다.', function() {
                        $modal_hide();
                    });
                    return false;
                }

                if ($(".choose_question_answer:checked").length != $(".question_list").length) {
                    $modal_alert(page_info['curr_title'], '모든 질문에 답변을 체크해주셔야 합니다.', function() {
                        $modal_hide();
                    });
                    return false;
                }
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
                        //location.reload();
                        location.href = page_info['base_url'] + '/reply/' + result.idx + '/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
                    } else {
                        $modal_hide();
                    }
                });
            }
        });
    }
</script>