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
						<td><?= replaceDatetime($customer_info->regdate) ?></td>
						<th>수정일시</th>
						<td><?= replaceDatetime($customer_info->moddate) ?></td>
					</tr>
					<tr>
						<th>외주분야</th>
						<td colspan="3"><?= replaceCustomerType($customer_info->category) ?></td>
					</tr>
					<tr>
						<th>기업명</th>
						<td><?= $customer_info->name ?></td>
						<th>사업자등록번호</th>
						<td><?= $customer_info->brn ?></td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td><?= $customer_info->ceo ?></td>
						<th>소재지</th>
						<td><?= $customer_info->addr ?> <?= $customer_info->addr_more ?></td>
					</tr>
					<tr>
						<th>업태</th>
						<td><?= $customer_info->business_type ?></td>
						<th>종목</th>
						<td><?= $customer_info->business_item ?></td>
					</tr>
					<tr>
						<th>대표번호</th>
						<td><?= $customer_info->tel ?></td>
						<th>이메일</th>
						<td><?= $customer_info->email ?></td>
					</tr>
					<tr>
						<th>메모</th>
						<td colspan="3"><?= $customer_info->memo ?></td>
					</tr>
				</tbody>
			</table>
			</table>
			<div class="right mt-2">
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/mod/<?= $customer_info->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn bg-olive mr-2">수정</button>
				<button type="button" id="customerDelBtn" class="btn btn-danger mr-2">삭제</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">고객사 담당자</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<div class="right">
				<button type="button" class="btn bg-olive btn-employee-modal" data-mode="add" data-emp-idx="0" data-name="" data-tel="" data-email="">담당자등록</button>
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
					if (count($customer_employee) > 0) {
						foreach ($customer_employee as $list) {
					?>
							<tr>
								<td class="text-center"><?= replaceDate($list->regdate) ?></td>
								<td class="text-center"><?= replaceDate($list->moddate) ?></td>
								<td class="text-center"><?= $list->name ?></td>
								<td class="text-center"><?= $list->tel ?></td>
								<td class="text-center"><?= $list->email ?></td>
								<td class="text-center">
									<button type="button" class="btn btn-sm bg-olive btn-employee-modal" data-mode="mod" data-emp-idx="<?= $list->idx ?>" data-name="<?= $list->name ?>" data-tel="<?= $list->tel ?>" data-email="<?= $list->email ?>">수정</button>
									<button type="button" class="btn btn-sm btn-danger btn-employee-del" data-emp-idx="<?= $list->idx ?>">삭제</button>
								</td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td class="text-center" colspan="6">등록된 담당자가 없습니다.</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">컨설팅 의뢰 내역</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="card-body">
			<div class="text-right">
				<button type="button" class="btn bg-olive" id="btn_consulting_add">컨설팅등록</button>
			</div>
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>접수번호</th>
						<th>의뢰분야</th>
						<th>상태</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($consulting_list) > 0) {
						foreach ($consulting_list as $clist) {
					?>
							<tr>
								<td class="text-center"><?= replaceDate($clist->regdate) ?></td>
								<td class="text-center">
									<a class="pop_view" data-path="/admin/consulting/view/" data-idx="<?= $clist->idx ?>">
										<?= $clist->idx ?>
									</a>
								</td>
								<td>
									<?php
									$consulting_business = explode(',', str_replace(' ', '', $clist->business));
									foreach ($consulting_business as $business) {
									?>
										<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
									<?php
									}
									?>
								</td>
								<td class="text-center"><?= $consulting_status[$clist->status]['name'] ?></td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td class="text-center" colspan="4">컨설팅 내역이 없습니다.</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">월간디자인 관리</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<div class="right">
				<button type="button" class="btn bg-olive btn-subscribe-modal" data-mode="add" data-idx="0">구독 등록</button>
			</div>
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="10%">
					<col width="*">
					<col width="12%">
					<col width="12%">
					<col width="12%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>의뢰범위</th>
						<th>총괄담당자</th>
						<th>시작일</th>
						<th>종료일</th>
						<th>관리</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($customer_subscribe) > 0) {
						foreach ($customer_subscribe as $list) {
					?>
							<tr>
								<td class="text-center"><?= replaceDate($list->regdate) ?></td>
								<td>
									<?php
									$partners_category = json_decode($list->category);
									foreach ($business_list as $blist) {
										if (isset($partners_category->{$blist['segment']}) && $partners_category->{$blist['segment']}) {
									?>
											<div class="btn btn-xs btn-secondary"><?= $blist['name'] ?></div>
									<?php
										}
									}
									?>
								</td>
								<td class="text-center">
									<?php if ($list->manager_idx && $list->manager_idx <> '0') { ?>
										<?= $list->manager_name ?> (<?= $list->manager_id ?>)
									<?php } ?>
								</td>
								<td class="text-center"><?= replaceDateTime($list->expire_sdate) ?></td>
								<td class="text-center"><?= replaceDateTime($list->expire_edate) ?></td>
								<td class="text-center">
									<button type="button" class="btn btn-sm bg-olive btn-subscribe-modal" data-mode="mod" data-idx="<?= $list->idx ?>">수정</button>
									<button type="button" class="btn btn-sm btn-danger btn-subscribe-del" data-idx="<?= $list->idx ?>">삭제</button>
								</td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td class="text-center" colspan="6">구독 기록이 없습니다.</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">월간디자인 의뢰 내역</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="9%">
					<col width="9%">
					<col width="9%">
					<col width="10%">
					<col width="22%">
					<col width="9%">
					<col width="9%">
					<col width="9%">
					<col width="14%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>고객사</th>
						<th>담당자</th>
						<th>구분</th>
						<th>건명</th>
						<th>상태</th>
						<th>시작일</th>
						<th>종료일</th>
						<th>담당자</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if (count($subscribe_work_list) > 0) {
						foreach ($subscribe_work_list as $list) {
					?>
							<tr>
								<td class="text-center"><?= replaceDate($list->regdate) ?></td>
								<td class="text-center"><?= $list->customer_name ?></td>
								<td class="text-center"><?= $list->employee_name ?></td>
								<td class="text-center"><?= $business_list[$list->category]['name'] ?></td>
								<td>
									<a class="pop_view" data-path="/admin/subscribe/view/" data-idx="<?= $list->idx ?>">
										<?= $list->subject ?>
									</a>
								</td>
								<td class="text-center"><?= replaceSubscribeWorkStatus($list->status) ?></td>
								<td class="text-center"><?= replaceDate($list->work_sdate) ?></td>
								<td class="text-center"><?= replaceDate($list->work_edate) ?></td>
								<td class="text-center">
									<?php if ($list->manager_idx && $list->manager_idx != '0') { ?>
										<a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $list->manager_idx ?>">
											<?= $list->manager_name ?> (<?= $list->manager_id ?>)
										</a>
									<?php } ?>
								</td>
							</tr>
						<?php
						}
					} else {
						?>
						<tr>
							<td class="text-center" colspan="9">구독 의뢰 내역이 없습니다.</td>
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
				<table class="table table-bordered emp_form" width="100%" cellspacing="0">
					<tbody class="vertical">
						<tr>
							<td>
								<input class="form-control form-valid fv_empty" name="name" type="text" placeholder="이름을 입력하세요." title="이름" />
							</td>
						</tr>
						<tr>
							<td>
								<input class="form-control form-valid fv_empty fv_telnum" name="tel" type="text" placeholder="연락처를 입력하세요." title="연락처" />
							</td>
						</tr>
						<tr>
							<td>
								<input class="form-control form-valid fv_empty fv_email" name="email" type="text" placeholder="이메일 입력하세요." title="이메일" />
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

<div class="modal" id="modal-subscribe-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">구독 정보 저장</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered sub_form" width="100%" cellspacing="0">
					<colgroup>
						<col width="20%" />
						<col width="80%" />
					</colgroup>
					<tbody class="vertical">
						<tr>
							<th colspan="2">계약 범위</th>
						</tr>
						<tr>
							<td colspan="2">
								<div class="row">
									<?php
									$category_list = [];
									$i = 0;
									foreach ($business_list as $blist) {
										$category_list[$blist['segment']] = false;
										if ($blist['use_subscribe']) {
									?>
											<div class="col-2 mt-1 mb-2">
												<div class="form-check">
													<input class="form-check-input sub_category" data-segment="<?= $blist['segment'] ?>" type="checkbox" id="cate_<?= $i ?>">
													<label class="form-check-label" for="cate_<?= $i ?>"><strong><?= $blist['name'] ?></strong></label>
												</div>
												<?php $i++; ?>
											</div>
									<?php
										}
									}
									?>
								</div>
							</td>
						</tr>
						<tr>
							<th>구독 기간</th>
							<td>
								<div class="row">
									<div class="col-4">
										<input class="form-control form-valid daterangepicker-input" name="expire_sdate" type="text" placeholder="시작일을 입력하세요." title="작업 시작일" autocomplete="off" />
									</div>
									<div class="col-4">
										<input class="form-control form-valid daterangepicker-input" name="expire_edate" type="text" placeholder="종료일을 입력하세요." title="작업 종료일" autocomplete="off" />
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th>총괄 담당자</th>
							<td>
								<select class="form-control" name="manager_info" style="width: 100%;">
									<option>지정 없음</option>
									<?php
									foreach ($manager_list as $mlist) {
									?>
										<option data-idx="<?= $mlist->idx ?>" data-name="<?= $mlist->name ?>" data-adm_id="<?= $mlist->adm_id ?>"><?= $mlist->name ?> (<?= $mlist->adm_id ?>)</option>
									<?php
									}
									?>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary closeModalBtn">취소</button>
				<button type="button" class="btn btn-blue" id="btn-subscribe-save">저장</button>
			</div>
		</div>
	</div>
</div>

<link href="/resources/admin/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script src="/resources/admin/daterangepicker/daterangepicker.js"></script>
<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $customer_info->idx ?>';
	let emp_mode, emp_idx, emp_name, emp_tel, emp_email;
	let sub_mode, sub_idx, sub_sdate, sub_edate, sub_mng_idx;
	let category_list = JSON.parse('<?= json_encode($category_list) ?>'); // 저장용
	let mod_category = [];

	$(function() {
		$("#customerDelBtn").on("click", function() {
			customerDelSubmit();
		});

		$(".btn-employee-modal").on("click", function() {
			emp_mode = $(this).data("mode");
			emp_idx = $(this).data("emp-idx");
			emp_name = $(this).data("name");
			emp_tel = $(this).data("tel");
			emp_email = $(this).data("email");
			$("input[name=name]").val(emp_name);
			$("input[name=tel]").val(emp_tel);
			$("input[name=email]").val(emp_email);
			$("#modal-employee-form").modal();
		});

		$(".btn-employee-del").on("click", function() {
			emp_idx = $(this).data("emp-idx");
			employeeDelSubmit();
		});

		$("#btn-employee-save").on("click", function() {
			employeeSubmit(emp_mode);
		});

		$(".btn-subscribe-modal").on("click", function() {
			mod_category = [];
			sub_mode = $(this).data("mode");
			sub_idx = $(this).data("idx");
			sub_sdate = '';
			sub_edate = '';
			sub_mng_idx = '0';
			$(".sub_category").prop("checked", false);
			$("select[name=manager_info] option").eq(0).prop("selected", true);

			$.post('/admin/customer/subscribeInfo/', {
				"idx": sub_idx
			}, function(data) {
				var subscribe_info = JSON.parse(data);
				if (subscribe_info.flag) {
					mod_category = subscribe_info.data['category'];
					mod_category = JSON.parse(mod_category);
					sub_sdate = subscribe_info.data['expire_sdate'];
					sub_edate = subscribe_info.data['expire_edate'];
					sub_mng_idx = subscribe_info.data['manager_idx'];
				}

				$(".sub_category").each(function() {
					if (mod_category[$(this).data('segment')]) $(this).prop("checked", true);
				});

				$("select[name=manager_info] option").each(function() {
					if ($(this).data('idx') == sub_mng_idx) $(this).prop('selected', true);
				});

				$("input[name=expire_sdate]").val(sub_sdate);
				$("input[name=expire_edate]").val(sub_edate);
			});

			$("#modal-subscribe-form").modal();
		});

		$(".btn-subscribe-del").on("click", function() {
			sub_idx = $(this).data("idx");
			subscribeDelSubmit();
		});

		$("#btn-subscribe-save").on("click", function() {
			subscribeSubmit(sub_mode);
		});

		$(".daterangepicker-input").daterangepicker(daterangepicker_options, function(sdate, edate) {
			$("input[name=expire_sdate]").val(sdate.format('YYYY-MM-DD HH:mm'));
			$("input[name=expire_edate]").val(edate.format('YYYY-MM-DD HH:mm'));
		});

		$("#btn_consulting_add").on("click", function() {
			location.href = "/admin/consulting/add/"+curr_idx;
		});
	});

	function customerDelSubmit() {
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

	function employeeSubmit(mode) {
		var form_data = {
			"idx": emp_idx,
			"customer_idx": curr_idx,
			"name": $("input[name=name]").val(),
			"tel": $("input[name=tel]").val(),
			"email": $("input[name=email]").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/empSave/" + mode,
			beforeSend: function(xhr, opts) {
				if (!formValidate($(".emp_form"))) xhr.abort();
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

	function subscribeSubmit(mode) {
		var manager_info = $("select[name=manager_info] option:selected").data();
		var form_data = {
			"idx": sub_idx,
			"customer_idx": curr_idx,
			"expire_sdate": $("input[name=expire_sdate]").val(),
			"expire_edate": $("input[name=expire_edate]").val(),
			"manager_idx": (manager_info.idx) ? manager_info.idx : '0',
			"manager_id": (manager_info.adm_id) ? manager_info.adm_id : '',
			"manager_name": (manager_info.name) ? manager_info.name : ''
		};

		$(".sub_category").each(function() {
			if ($(this).is(":checked")) category_list[$(this).data('segment')] = true;
		});

		form_data['category'] = JSON.stringify(category_list);

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/subSave/" + mode,
			beforeSend: function(xhr, opts) {
				if (!formValidate($(".sub_form"))) xhr.abort();
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

	function subscribeDelSubmit() {
		$modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/subDel/",
				data: {
					"idx": sub_idx
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