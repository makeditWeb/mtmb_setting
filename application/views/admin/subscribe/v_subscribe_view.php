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
						<td><?= replaceDatetime($subscribe_info->regdate) ?></td>
						<th>수정일시</th>
						<td><?= replaceDatetime($subscribe_info->moddate) ?></td>
					</tr>

				<tbody class="vertical">
					<tr>
						<th>고객사</th>
						<td>
							<a class="pop_view" data-path="/admin/customer/view/" data-idx="<?= $subscribe_info->customer_idx ?>">
								<?= ($subscribe_info->customer_name) ?>
							</a>
						</td>
						<th>고객사 담당자</th>
						<td><?= ($subscribe_info->employee_name) ?></td>
					</tr>
					<tr>
						<th>의뢰 구분</th>
						<td colspan="3"><?= $business_list[$subscribe_info->category]['name'] ?></td>
					</tr>
					<tr>
						<th>건명</th>
						<td colspan="3"><?= ($subscribe_info->subject) ?></td>
					</tr>
					<tr>
						<th>담당자</th>
						<td colspan="3">
							<?php if ($subscribe_info->manager_idx && $subscribe_info->manager_idx != '0') { ?>
								<a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $subscribe_info->manager_idx ?>">
									<?= $subscribe_info->manager_name ?> (<?= $subscribe_info->manager_id ?>)
								</a>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<th>작업난이도</th>
						<td><?= replaceDifficulty($subscribe_info->difficulty) ?></td>
						<th>진행상태</th>
						<td><?= replaceSubscribeWorkStatus($subscribe_info->status) ?></td>
					</tr>
					<tr>
						<th>작업 시작일</th>
						<td><?= replaceDatetime($subscribe_info->work_sdate) ?></td>
						<th>작업 종료일</th>
						<td><?= replaceDatetime($subscribe_info->work_edate) ?></td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/mod/<?= $subscribe_info->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn bg-olive mr-2">수정</button>
				<button type="button" id="subscribeDelBtn" class="btn btn-danger mr-2">삭제</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $subscribe_info->idx ?>';

	$(function() {
		$("#subscribeDelBtn").on("click", function() {
			subscribeDelSubmit();
		});
	});

	function subscribeDelSubmit() {
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