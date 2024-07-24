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

			<div class="btn-group">
				<?php
				foreach ($business_list as $blist) {
				?>
					<button type="button" class="sch_category btn btn-sm <?= (in_array($blist['segment'], $page_info['sch_category'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="<?= $blist['segment'] ?>"><?= $blist['name'] ?></button>
				<?php } ?>
			</div>

			<div class="row mt-2">
				<div class="col-2 input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">목록 개수</span>
					</div>

					<select class="custom-select form-control" id="table_rows">
						<option value="10" <?php if ($page_info['page_scale'] == 10) echo 'selected'; ?>>10</option>
						<option value="20" <?php if ($page_info['page_scale'] == 20) echo 'selected'; ?>>20</option>
						<option value="50" <?php if ($page_info['page_scale'] == 50) echo 'selected'; ?>>50</option>
						<option value="100" <?php if ($page_info['page_scale'] == 100) echo 'selected'; ?>>100</option>
					</select>
				</div>

				<div class="8 btn-group">
					<?php
					$status_list = $consulting_status;
					array_multisort(array_column($status_list, 'sort'), SORT_ASC, $status_list);
					foreach ($status_list as $key => $val) {
					?>
						<button type="button" class="sch_status btn <?= (in_array($val['code'], $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="<?= $val['code'] ?>"><?= $val['name'] ?></button>
					<?php
					}
					?>
				</div>

				<div class="col-4 input-group">
					<input class="form-control" type="search" id="sch_keyword" placeholder="업체명, 사업자 등록번호, 대표자명, 대표번호, 소재지로 검색" value="<?= $page_info['sch_keyword'] ?>" autocomplete="off">
					<div class="input-group-append">
						<button type="button" class="btn btn-primary" id="schButton">검색</button>
					</div>
				</div>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/add/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>' " class="btn bg-olive">신규 등록</button>
			</div>


			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="8%">
					<col width="8%">
					<col width="8%">
					<col width="13%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="13%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>No.</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'regdate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="regdate">등록일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'idx') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="idx">접수번호</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="name">기업명</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'tel') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="tel">대표번호</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'employee_name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="employee_name">담당자명</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'company_user_rank') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="company_user_rank">직급</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'employee_tel') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="employee_tel">담당자연락처</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'employee_email') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="employee_email">담당자이메일</th>
						<th>의뢰분야</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'status') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="status">상태</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($dataList as $list) {
					?>
						<tr>
							<td class="text-center"><?= $list->row_num ?></td>
							<td class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td class="text-center"><?= $list->idx ?></td>
							<td class="text-center"><a href="<?= $page_info['base_url'] ?>/view/<?= $list->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>"><?= $list->name ?></a></td>
							<td class="text-center"><?= $list->tel ?></td>
							<td class="text-center"><?= $list->employee_name ?></td>
							<td class="text-center"><?= $list->company_user_rank ?></td>
							<td class="text-center"><?= $list->employee_tel ?></td>
							<td class="text-center"><?= $list->employee_email ?></td>
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
							<td class="text-center">
								<select class="custom-select form-control update-on-list" data-column="status" data-idx="<?= $list->idx ?>" style="color:#ffffff;background-color:<?= $consulting_status[$list->status]['color'] ?>;">
									<?php
									foreach ($status_list as $key => $val) {
									?>
										<option value="<?= $val['code'] ?>" <?= ($list->status == $val['code']) ? 'selected' : '' ?>>
											<?= $val['name'] ?>
										</option>
									<?php
									}
									?>
								</select>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<div class="text-center mt-2">
				<?= $paging ?>
			</div>
		</div>
	</div>
</section>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	let form_data = [];

	$(function() {
		$(".update-on-list").on("change", function() {
			var column = $(this).data("column");
			var idx = $(this).data("idx");
			var value = $(this).val();

			form_data = {
				"column": column,
				"idx": idx,
				"value": value
			};

			updateOnList();
		});
	});

	function updateOnList() {
		$.ajax({
			method: "POST",
			url: "/admin/consulting/updateOnList",
			data: form_data,
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