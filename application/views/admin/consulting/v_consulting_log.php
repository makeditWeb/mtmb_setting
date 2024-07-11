<div class="card" id="card_consulting_log">
    <div class="card-header card-header-strong">
        <div class="card-title card-title-strong">저장 기록</div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" id="btn_consulting_log_collapse" title="Collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <div class="card-body" aria-expanded="false">
        <?php
        foreach ($sessions_log as $log) {
            $controller = $log->controller;
            $session_value = json_decode($log->session_data);
            $post_value = json_decode($log->param_post);

            if ($controller == "consulting") {
        ?>
                <table class="table table-bordered list_table mt-5" width="100%" cellspacing="0">
                    <colgroup>
                        <col width="12%" />
                        <col width="20%" />
                        <col width="22%" />
                        <col width="22%" />
                        <col width="12%" />
                        <col width="12%" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>입력정보</th>
                            <th>기업정보</th>
                            <th>문의 정보</th>
                            <th>요청 세부사항, 상담메모</th>
                            <th>관리자 정보</th>
                            <th>개별 진행내역</th>
                        </tr>
                        <tr>
                            <td class="text-center">
                                <?= replaceDatetime($log->regdate) ?><br />
                                <hr />
                                <?php if (isset($session_value->adm_idx)) { ?>
                                    <a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $session_value->adm_idx ?>">
                                        <?= $session_value->adm_name ?> (<?= $session_value->adm_id ?>)
                                    </a>
                                <?php } ?>
                            </td>

                            <td>
                                <?php if (isset($post_value->customer_idx) && $post_value->customer_idx) { ?>
                                    <a class="pop_view" data-path="/admin/customer/view/" data-idx="<?= $post_value->customer_idx ?>">
                                        <?= (isset($post_value->name)) ? $post_value->name : "-" ?>
                                    </a>
                                <?php } else { ?>
                                    <?= (isset($post_value->name)) ? $post_value->name : "-" ?>
                                <?php } ?>
                                <?= (isset($post_value->category)) ? "(" . replaceCustomerType($post_value->category) . ")" : "-" ?><br />
                                <?= (isset($post_value->business_type)) ? $post_value->business_type : "-" ?> / <?= (isset($post_value->business_item)) ? $post_value->business_item : "-" ?><br />
                                <?= (isset($post_value->brn)) ? $post_value->brn : "-" ?><br />
                                <?= (isset($post_value->ceo)) ? $post_value->ceo : "-" ?><br />
                                <?= (isset($post_value->tel)) ? $post_value->tel : "-" ?><br />
                                <?= (isset($post_value->email)) ? $post_value->email : "-" ?><br />
                                <?= (isset($post_value->addr)) ? $post_value->addr : "-" ?> <?= (isset($post_value->addr_more)) ? $post_value->addr_more : "" ?><br />
                                <?= (isset($post_value->employee_name)) ? $post_value->employee_name : "-" ?><br />
                                <?= (isset($post_value->employee_tel)) ? $post_value->employee_tel : "-" ?><br />
                                <?= (isset($post_value->employee_email)) ? $post_value->employee_email : "-" ?>
                            </td>

                            <td>
                                <?php
                                if (isset($post_value->del_category_list)) {
                                    foreach ($post_value->del_category_list as $list) {
                                ?>
                                        <div class="btn btn-xs btn-danger"><?= $business_list[$list]['name'] ?></div>
                                <?php
                                    }
                                }
                                ?>
                                <br />
                                <?php
                                if (isset($post_value->question_values)) {
                                    foreach ($post_value->question_values as $list) {
                                ?>
                                        <div>
                                            <span class="btn btn-xs btn-secondary"><?= $business_list[$list->segment]['name'] ?></span>
                                            <?= strip_tags(htmlspecialchars_decode($list->answer)) ?>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </td>

                            <td>
                                <?= (isset($post_value->request)) ? stripslashes(nl2br2($post_value->request)) : "" ?>
                                <hr />
                                <?= (isset($post_value->memo)) ? $post_value->memo : "" ?>
                            </td>

                            <td class="text-center">
                                <?php if (isset($post_value->manager_idx) && $post_value->manager_idx) { ?>
                                    <a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $post_value->manager_idx ?>">
                                        <?= $post_value->manager_name ?>(<?= $post_value->manager_id ?>)
                                    </a>
                                <?php } ?><br />
                                <hr />
                                <?= (isset($post_value->status)) ? $consulting_status[$post_value->status]['name'] : "-" ?>
                            </td>

                            <td>
                                <?php
                                if (isset($post_value->work_values)) {
                                    foreach ($post_value->work_values as $list) {
                                ?>
                                        <div class="btn btn-xs btn-secondary"><?= $business_list[$list->segment]['name'] ?></div>
                                        <div>담당자 :
                                            <?php if ($list->manager_idx) { ?>
                                                <a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $list->manager_idx ?>">
                                                    <?= $list->manager_name ?>(<?= $list->manager_id ?>)
                                                </a>
                                            <?php } ?>
                                        </div>
                                        <div>상태 : <?= replaceConsultingDetailStatus($list->status) ?> </div>
                                        <div>수정차수 : <?= replaceConsultingDetailModCount($list->mod_count) ?> </div>

                                        <div>외주업체 :
                                            <a class="pop_view" data-path="/admin/partner/view/" data-idx="<?= $list->partner_idx ?>">
                                                <?= $list->partner_name ?>
                                            </a>
                                        </div>
                                        <div>외주상태 : <?= replaceConsultingDetailPartnerStatus($list->partner_status) ?></div>
                                        <hr />
                                <?php
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>

            <?php if ($controller == "calculate") { ?>
                <table class="table table-bordered list_table" width="100%" cellspacing="0">
                    <colgroup>
                        <col width="12%" />
                        <col width="88%" />
                    </colgroup>
                    <tbody>
                        <tr>
                            <th>전체 정산 정보</th>
                            <th>개별 정산 정보</th>
                        </tr>
                        <tr>
                            <td>
                                청구금액 : <?= (isset($post_value->price) && is_numeric($post_value->price)) ? number_format($post_value->price) : "-" ?><br />
                                지출비용 : <?= (isset($post_value->out_cost) && is_numeric($post_value->out_cost)) ? number_format($post_value->out_cost) : "-" ?><br />
                                수익금액 : <?= (isset($post_value->revenue) && is_numeric($post_value->revenue)) ? number_format($post_value->revenue) : "-" ?><br />
                                수익률 : <?= (isset($post_value->revenue_rate) && is_numeric($post_value->revenue_rate)) ? $post_value->revenue_rate . '%' : "-" ?>
                            </td>

                            <td>
                                <div class="row">
                                    <?php
                                    if (isset($post_value->work_values)) {
                                        foreach ($post_value->work_values as $list) {
                                    ?>
                                            <div class="col-lg-2 col-sm-12">
                                                <?php if (isset($list->category)) { ?>
                                                    <div class="btn btn-xs btn-secondary"><?= $business_list[$list->category]['name'] ?></div><br />
                                                <?php } ?>
                                                견적금액 : <?= (isset($list->price) && is_numeric($list->price)) ? number_format($list->price) : "-" ?><br />
                                                지출비용 : <?= (isset($list->expenditure) && is_numeric($list->expenditure)) ? number_format($list->expenditure) : "-" ?><br />
                                                외주 지불금액 : <?= (isset($list->out_cost) && is_numeric($list->out_cost)) ? number_format($list->out_cost) : "-" ?><br />
                                                외주 지불형태 : <?= (isset($list->out_cost_type)) ? replaceOutCostType($list->out_cost_type) : "-" ?><br />
                                                외주 지불상태 : <?= (isset($list->out_cost_status)) ? replaceOutCostStatus($list->out_cost_status) : "-" ?><br />
                                                외주 계산서발행 : <?= (isset($list->tax_bill_status)) ? replaceOutCostBillStatus($list->tax_bill_status) : "-" ?>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>정산 메모</th>
                            <td><?= (isset($post_value->memo2)) ? $post_value->memo2 : "" ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<script>
    $(function() {
        // $("#card_consulting_log").attr("aria-expanded", "false");

        $('#btn_consulting_log_collapse').trigger("click");
    });
</script>