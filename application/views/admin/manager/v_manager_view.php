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
						<th>유형</th>
						<td><?= replaceManagerGrade($dataResult->grade) ?></td>
						<th>상태</th>
						<td><?= replaceActive($dataResult->is_active) ?></td>
					</tr>
					<tr>
						<th>아이디</th>
						<td><?= $dataResult->adm_id ?></td>
						<th>이메일</th>
						<td><?= $dataResult->email ?></td>
					</tr>
					<tr>
						<th>이름</th>
						<td><?= $dataResult->name ?></td>
						<th>부서</th>
						<td><?= $dataResult->dept ?></td>
					</tr>
					<tr>
						<th>관리 권한</th>
						<td colspan="3">
							<div class="row">
								<?php
								$admin_permission = json_decode($dataResult->permission, true);
								foreach ($menu_list as $menu) {
									if ($menu['visible']) {
								?>
										<div class="col-2 mb-5 text-center">
											<div type="button" class="btn btn-warning"><strong><?= $menu['name'] ?></strong></div>
											<?php if (isset($admin_permission[$menu['segment']])) { ?>
												<br />
												<?= ($admin_permission[$menu['segment']]['read']) ? '<div class="btn btn-xs btn-secondary">읽기</div>' : '' ?>
												<br />
												<?= ($admin_permission[$menu['segment']]['create']) ? '<div class="btn btn-xs bg-olive">등록</div>' : '' ?>
												<br />
												<?= ($admin_permission[$menu['segment']]['update']) ? '<div class="btn btn-xs bg-olive">수정</div>' : '' ?>
												<br />
												<?= ($admin_permission[$menu['segment']]['delete']) ? '<div class="btn btn-xs btn-danger">삭제</div>' : '' ?>
											<?php } ?>
										</div>
								<?php
									}
								}
								?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/mod/<?= $dataResult->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn bg-olive mr-2">수정</button>
				<button type="button" id="managerDelBtn" class="btn btn-danger mr-2">삭제</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
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
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="11%">
					<col width="11%">
					<col width="11%">
					<col width="11%">
					<col width="11%">
					<col width="11%">
					<col width="11%">
					<col width="12%">
					<col width="11%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>접수번호</th>
						<th>기업명</th>
						<th>대표번호</th>
						<th>담당자명</th>
						<th>담당자연락처</th>
						<th>담당자이메일</th>
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
									<a class="pop_view" data-path="/admin/customer/view/" data-idx="<?= $clist->customer_idx ?>">
										<?= $clist->name ?>
									</a>
								</td>
								<td class="text-center"><?= $clist->tel ?></td>
								<td class="text-center"><?= $clist->employee_name ?></td>
								<td class="text-center"><?= $clist->employee_tel ?></td>
								<td class="text-center"><?= $clist->employee_email ?></td>
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
							<td colspan="9" class="text-center">컨설팅 내역이 없습니다.</td>
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
										<?= $list->manager_name ?> (<?= $list->manager_id ?>)
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

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';

	$(function() {
		$("#managerDelBtn").on("click", function() {
			managerDelSubmit();
		});
	});

	function managerDelSubmit() {
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
</script>