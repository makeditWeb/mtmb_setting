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
						<th>등록일시</th>
						<td><?= replaceDatetime($dataResult->regdate) ?></td>
						<th>수정일시</th>
						<td><?= replaceDatetime($dataResult->moddate) ?></td>
					</tr>
					<tr>
						<th>기업명</th>
						<td><?= $dataResult->name ?></td>
						<th>사업자등록번호</th>
						<td><?= $dataResult->brn ?></td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td><?= $dataResult->ceo ?></td>
						<th>소재지</th>
						<td><?= $dataResult->addr ?> <?= $dataResult->addr_more ?></td>
					</tr>
					<tr>
						<th>연락처</th>
						<td><?= $dataResult->tel ?></td>
						<th>FAX</th>
						<td><?= $dataResult->fax ?></td>
					</tr>
					<tr>
						<th>홈페이지</th>
						<td><?= $dataResult->homepage ?></td>
						<th>계좌번호</th>
						<td><?= $dataResult->account_bank ?> <?= $dataResult->account_name ?> <?= $dataResult->account_num ?></td>
					</tr>
					<th>외주분야</th>
					<td colspan="3">
						<?php
						$business_list = array_filter($business_list, function ($item) {
							return $item['use_partner'] === true;
						});

						$partners_category = json_decode($dataResult->category);
						foreach ($business_list as $blist) {
							if ($partners_category->{$blist['segment']}) {
						?>
								<div class="mt-1 mb-2 btn btn-xs btn-secondary mr-1"><?= $blist['name'] ?></div>
						<?php
							}
						}
						?>
					</td>
					<tr>
						<th>메모</th>
						<td colspan="3"><?= $dataResult->memo ?></td>
					</tr>
				</tbody>
			</table>
			</table>
			<div class="right mt-2">
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/mod/<?= $dataResult->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn bg-olive mr-2">수정</button>
				<button type="button" id="partnerDelBtn" class="btn btn-danger mr-2">삭제</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">협력업체 담당자</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<div class="right">
				<button type="button" class="btn bg-olive btn-employee-modal" data-mode="add" data-emp-idx="0" data-name="" data-tel="" data-email="">담당자 등록</button>
			</div>
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="14%">
					<col width="14%">
					<col width="14%">
					<col width="22%">
					<col width="22%">
					<col width="14%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>수정일</th>
						<th>담당자명</th>
						<th>연락처</th>
						<th>이메일</th>
						<th>관리</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($employee_list) > 0) {
						foreach ($employee_list as $elist) {
					?>
							<tr>
								<td class="text-center"><?= replaceDate($elist->regdate) ?></td>
								<td class="text-center"><?= replaceDate($elist->moddate) ?></td>
								<td class="text-center"><?= $elist->name ?></td>
								<td class="text-center"><?= $elist->tel ?></td>
								<td class="text-center"><?= $elist->email ?></td>
								<td class="text-center">
									<button type="button" class="btn btn-sm bg-olive btn-employee-modal" data-mode="mod" data-emp-idx="<?= $elist->idx ?>" data-name="<?= $elist->name ?>" data-tel="<?= $elist->tel ?>" data-email="<?= $elist->email ?>">수정</button>
									<button type="button" class="btn btn-sm btn-danger btn-employee-del" data-emp-idx="<?= $elist->idx ?>">삭제</button>
								</td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td class="text-center" colspan="8">등록된 담당자가 없습니다.</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">컨설팅 발주 내역</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="13%">
					<col width="13%">
					<col width="13%">
					<col width="12%">
					<col width="13%">
					<col width="12%">
					<col width="12%">
					<col width="12%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>발주일</th>
						<th>완료일</th>
						<th>접수번호</th>
						<th>작업카테고리</th>
						<th>외주비용</th>
						<th>지불형태</th>
						<th>지불상태</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($work_list) > 0) {
						foreach ($work_list as $wlist) {
					?>
							<tr>
								<td class="text-center"><?= replaceDate($wlist->regdate) ?></td>
								<td class="text-center"><?= replaceDate($wlist->out_sdate) ?></td>
								<td class="text-center"><?= replaceDate($wlist->out_edate) ?></td>
								<td class="text-center">
									<a class="pop_view" data-path="/admin/consulting/view/" data-idx="<?= $wlist->consulting_idx ?>">
										<?= $wlist->consulting_idx ?>
									</a>
								</td>
								<td class="text-center"><?= $business_list[$wlist->category]['name'] ?></td>
								<td class="text-center"><?= number_format($wlist->out_cost) ?></td>
								<td class="text-center"><?= replaceOutCostType($wlist->out_cost_type) ?></td>
								<td class="text-center"><?= replaceOutCostStatus($wlist->out_cost_status) ?></td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td class="text-center" colspan="8">발주 내역이 없습니다.</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<div class="modal" id="modal-employee-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">담당자 저장</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<tbody class="vertical">
						<tr>
							<td>
								<input class="form-control form-valid fv_empty" name="name" type="text" placeholder="이름을 입력하세요." title="이름" />
							</td>
						</tr>
						<tr>
							<td>
								<input class="form-control form-valid fv_empty" name="tel" type="text" placeholder="연락처를 입력하세요." title="연락처" />
							</td>
						</tr>
						<tr>
							<td>
								<input class="form-control form-valid fv_empty" name="email" type="text" placeholder="이메일 입력하세요." title="이메일" />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary closeModalBtn">취소</button>
				<button type="button" class="btn btn-blue" id="btn-employee-save">저장</button>
			</div>
		</div>
	</div>
</div>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';
	let emp_mode, emp_idx, emp_name, emp_tel, emp_email;

	$(function() {
		$("#partnerDelBtn").on("click", function() {
			partnerDelSubmit();
		});

		$(".btn-employee-modal").on("click", function() {
			emp_mode = $(this).data("mode");
			emp_idx = $(this).data("emp-idx");
			emp_name = $(this).data("name");
			emp_tel = $(this).data("tel");
			emp_email = $(this).data("email");
			employeeFormInit();
			$("#modal-employee-form").modal();
		});

		$(".btn-employee-del").on("click", function() {
			emp_idx = $(this).data("emp-idx");
			employeeDelSubmit();
		});

		$("#btn-employee-save").on("click", function() {
			employeeSubmit(emp_mode);
		});
	});

	function partnerDelSubmit() {
		$modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/del/",
				data: {
					"idx": curr_idx
				},
				success: function(data) {
					var result = JSON.parse(data);
					$modal_alert(page_info['curr_title'], result.message, function() {
						if (result.flag) {
							location.href = page_info['base_url'] + '/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
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

	function employeeFormInit() {
		$("input[name=name]").val(emp_name);
		$("input[name=tel]").val(emp_tel);
		$("input[name=email]").val(emp_email);
	}

	function employeeSubmit(mode) {
		var form_data = {
			"idx": emp_idx,
			"partner_idx": curr_idx,
			"name": $("input[name=name]").val(),
			"tel": $("input[name=tel]").val(),
			"email": $("input[name=email]").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/empSave/" + mode,
			beforeSend: function(xhr, opts) {
				if (!formValidate()) xhr.abort();
			},
			data: form_data,
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

	function employeeDelSubmit() {
		$modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/empDel/",
				data: {
					"idx": emp_idx
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
</script>