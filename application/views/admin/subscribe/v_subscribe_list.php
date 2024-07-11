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

				<div class="col-3 btn-group">
					<button type="button" class="sch_status btn <?= (in_array('0', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="0">작업대기</button>
					<button type="button" class="sch_status btn <?= (in_array('1', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="1">진행중</button>
					<button type="button" class="sch_status btn <?= (in_array('2', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="2">작업완료</button>
					<button type="button" class="sch_status btn <?= (in_array('3', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="3">취소</button>
				</div>

				<div class="col-2 text-center">
					<button type="button" class="sch_monthly btn <?= ($page_info['sch_monthly']=="prev") ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="prev">이번달</button>
					<button type="button" class="sch_monthly btn <?= ($page_info['sch_monthly']=="curr") ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="curr">지난달</button>
				</div>

				<div class="col-4 input-group">
					<input class="form-control" type="search" id="sch_keyword" placeholder="고객사명, 담당자명, 담당자명, 건명 검색" value="<?= $page_info['sch_keyword'] ?>" autocomplete="off">
					<div class="input-group-append">
						<button type="button" class="btn btn-primary" id="schButton">검색</button>
					</div>
				</div>

				<div class="col-1">
					<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/add/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>' " class="btn bg-olive">신규 등록</button>
				</div>
			</div>

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
						<th class="selectSort <?php if ($page_info['sort_key'] == 'regdate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="regdate">등록일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'customer_name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="customer_name">고객사</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'employee_name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="employee_name">담당자</th>
						<th>구분</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'subject') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="subject">건명</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'status') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="status">상태</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'work_sdate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="work_sdate">시작일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'work_edate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="work_edate">종료일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'manager_name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="manager_name">담당자</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($dataList as $list) {
					?>
						<tr>
							<td class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td class="text-center"><?= $list->customer_name ?></td>
							<td class="text-center"><?= $list->employee_name ?></td>
							<td class="text-center"><?= $business_list[$list->category]['name'] ?></td>
							<td><a href="<?= $page_info['base_url'] ?>/view/<?= $list->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>"><?= $list->subject ?></a></td>
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
</script>