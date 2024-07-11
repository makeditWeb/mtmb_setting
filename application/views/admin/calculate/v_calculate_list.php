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
			<div class="btn-group mb-2">
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
					<button type="button" class="sch_status btn <?= (in_array('2', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="2">입금확인</button>
					<button type="button" class="sch_status btn <?= (in_array('3', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="3">작업진행</button>
					<button type="button" class="sch_status btn <?= (in_array('5', $page_info['sch_status'])) ? 'btn-info' : 'btn-secondary' ?> mr-1" data-val="5">완료</button>
				</div>

				<div class="col-4 input-group">
					<input class="form-control" type="search" id="sch_keyword" placeholder="업체명, 사업자 등록번호, 대표자명, 대표번호, 소재지로 검색" value="<?= $page_info['sch_keyword'] ?>" autocomplete="off">
					<div class="input-group-append">
						<button type="button" class="btn btn-primary" id="schButton">검색</button>
					</div>
				</div>
			</div>

			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="12%">
					<col width="12%">
					<col width="20%">
					<col width="20%">
					<col width="12%">
					<col width="12%">
					<col width="12%">
				</colgroup>
				<thead>
					<tr>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'regdate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="regdate">등록일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'idx') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="idx">접수번호</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="name">기업명</th>
						<th>의뢰분야</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'status') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="status">상태</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'enddate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="enddate">완료일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'price') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="price">청구금액</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($dataList as $list) {

					?>
						<tr>
							<td class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td class="text-center"><?= $list->idx ?></td>
							<td><a href="<?= $page_info['base_url'] ?>/mod/<?= $list->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>"><?= $list->name ?></a></td>
							<td>
								<?php
								$consulting_business = explode(',', str_replace(' ', '', $list->business));
								foreach ($consulting_business as $business) {
								?>
									<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
								<?php
								}
								?>
							</td>
							<td class="text-center"><?= $consulting_status[$list->status]['name'] ?></td>
							<td class="text-center"><?= replaceDate($list->enddate) ?></td>
							<td class="text-center"><?= ($list->price) ?></td>
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