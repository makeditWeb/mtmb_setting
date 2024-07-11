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
						<th>고객사</th>
						<td>
							<select class="form-control form-valid fv_empty" id="customer_info" title="고객사" name="customer_info" style="width: 100%;">
								<option value="">선택해 주세요.</option>
								<?php
								foreach ($customer_list as $clist) {
								?>
									<option data-idx="<?= $clist->idx ?>" data-name="<?= $clist->name ?>" <?= ($clist->idx == $dataResult->customer_idx) ? 'selected' : '' ?>><?= $clist->name ?> (소재지 : <?= $clist->addr ?>)</option>
								<?php
								}
								?>
							</select>
						</td>
						<th>고객사 담당자</th>
						<td>
							<select class="form-control" id="employee_info" name="employee_info" style="width: 100%;">
								<option data-idx="0" data-name="">지정 없음</option>
								<?php
								foreach ($employee_list as $elist) {
								?>
									<option data-idx="<?= $elist->idx ?>" data-name="<?= $elist->name ?>" <?= ($elist->idx == $dataResult->employee_idx) ? 'selected' : '' ?>><?= $elist->name ?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>의뢰 구분</th>
						<td colspan="3">
							<div class="row">
								<?php
								$i = 0;
								$business_list = array_filter($business_list, function ($item) {
									return $item['use_subscribe'] === true;
								});
								foreach ($business_list as $blist) {
									$category_list[$blist['segment']] = false;

								?>
									<div class="col-2 mt-1 mb-2">
										<div class="custom-control custom-radio">
											<input class="custom-control-input category" name="category" value="<?= $blist['segment'] ?>" type="radio" id="cate_<?= $i ?>" <?= ($blist['segment'] == $dataResult->category) ? 'checked' : '' ?>>
											<label class="custom-control-label" for="cate_<?= $i ?>"><strong><?= $blist['name'] ?></strong></label>
										</div>
										<?php $i++; ?>
									</div>
								<?php
								}
								?>
							</div>
						</td>
					</tr>
					<tr>
						<th>건명</th>
						<td colspan="3">
							<input class="form-control form-valid fv_empty" name="subject" type="text" placeholder="건명을 입력하세요." title="건명" value="<?= $dataResult->subject ?>" />
						</td>
					</tr>
					<tr>
						<th>담당자</th>
						<td colspan="3">
							<select class="form-control" name="manager_info" style="width: 100%;">
								<option>지정 없음</option>
								<?php
								foreach ($manager_list as $mlist) {
								?>
									<option data-idx="<?= $mlist->idx ?>" data-name="<?= $mlist->name ?>" data-adm_id="<?= $mlist->adm_id ?>" <?= ($mlist->idx == $dataResult->manager_idx) ? 'selected' : '' ?>><?= $mlist->name ?> (<?= $mlist->adm_id ?>)</option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>작업난이도</th>
						<td>
							<select class="form-control" name="difficulty" style="width: 100%;">
								<option value="0">선택해 주세요.</option>
								<?php for ($i = 1; $i < 6; $i++) { ?>
									<option value="<?= $i ?>" <?= ($i == $dataResult->difficulty) ? 'selected' : '' ?>><?= replaceDifficulty($i) ?></option>
								<?php } ?>
							</select>
						</td>
						<th>진행상태</th>
						<td>
							<div class="row">
								<?php
								for ($i = 0; $i < 4; $i++) {
								?>
									<div class="col-3 mt-1 mb-2">
										<div class="custom-control custom-radio">
											<input class="custom-control-input status" type="radio" id="customRadio2<?= $i ?>" name="status" value="<?= $i ?>" <?= ($i == $dataResult->status) ? 'checked' : '' ?>>
											<label for="customRadio2<?= $i ?>" class="custom-control-label"><?= replaceSubscribeWorkStatus($i) ?></label>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</td>
					</tr>
					<tr>
						<th>작업 일정</th>
						<td colspan="3">
							<div class="row">
								<div class="col-4">
									<input class="form-control daterangepicker-input" name="work_sdate" type="text" placeholder="작업 시작일을 입력하세요." title="작업 시작일" value="<?= $dataResult->work_sdate ?>" autocomplete="off" />
								</div>
								<div class="col-4">
									<input class="form-control daterangepicker-input" name="work_edate" type="text" placeholder="작업 종료일을 입력하세요." title="작업 종료일" value="<?= $dataResult->work_edate ?>" autocomplete="off" />
								</div>
							</div>
						</td>
						<!-- <th>작업 종료일</th>
						<td>
							
						</td> -->
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 subscribeSubmit" data-mode=<?= $mode ?>>저장</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<link href="/resources/admin/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script src="/resources/admin/daterangepicker/daterangepicker.js"></script>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';
	let option_tags, customer_info, employee_info, manager_info;

	$(function() {
		$(".subscribeSubmit").on("click", function() {
			var mode = $(this).data("mode");
			subscribeSubmit(mode);
		});

		$("#customer_info").on("change", function() {
			var customer_idx = $(this).children('option:selected').data('idx');
			$.post('/admin/subscribe/empList/' + customer_idx, function(data) {
				var result = JSON.parse(data);
				$("#employee_info").empty();
				option_tags = $("<option/>", {
					"data": {
						"idx": "0",
						"name": ""
					}
				}).text("지정 없음");
				$("#employee_info").append(option_tags);
				if (result.flag && result.data.length > 0) {
					$.each(result.data, function(key, val) {
						option_tags = $("<option/>", {
							"data": {
								"idx": val.idx,
								"name": val.name
							}
						}).text(val.name);
						$("#employee_info").append(option_tags);
					});
				}
			});
		});

		$(".daterangepicker-input").daterangepicker(daterangepicker_options, function(sdate, edate) {
			$("input[name=work_sdate]").val(sdate.format('YYYY-MM-DD HH:mm'));
			$("input[name=work_edate]").val(edate.format('YYYY-MM-DD HH:mm'));
		});
	});

	function subscribeSubmit(mode) {
		customer_info = $("#customer_info option:selected").data();
		employee_info = $("#employee_info option:selected").data();
		manager_info = $("select[name=manager_info] option:selected").data();

		var form_data = {
			"idx": curr_idx,
			"customer_idx": (customer_info.idx) ? customer_info.idx : '0',
			"customer_name": (customer_info.name) ? customer_info.name : '',
			"employee_idx": (employee_info.idx) ? employee_info.idx : '0',
			"employee_name": (employee_info.name) ? employee_info.name : '',
			"manager_idx": (manager_info.idx) ? manager_info.idx : '0',
			"manager_id": (manager_info.adm_id) ? manager_info.adm_id : '',
			"manager_name": (manager_info.name) ? manager_info.name : '',
			"category": $(".category:checked").val(),
			"subject": $("input[name=subject]").val(),
			"difficulty": $("select[name=difficulty]").val(),
			"work_sdate": $("input[name=work_sdate]").val(),
			"work_edate": $("input[name=work_edate]").val(),
			"status": $(".status:checked").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/save/" + mode,
			beforeSend: function(xhr, opts) {
				if (!formValidate()) xhr.abort();
			},
			data: form_data,
			success: function(data) {
				var result = JSON.parse(data);
				$modal_alert(page_info['curr_title'], result.message, function() {
					if (result.flag) {
						location.href = page_info['base_url'] + '/view/' + result.idx + '/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
					} else {
						$modal_hide();
					}
				});
			}
		});
	}
</script>