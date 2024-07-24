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
				$business_list = array_filter($business_list, function ($item) {
					return $item['use_partner'] === true;
				});
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

				<div class="col-4 input-group">
					<input class="form-control" type="search" id="sch_keyword" placeholder="업체명, 사업자 등록번호, 대표자명, 대표번호, 소재지로 검색" value="<?= $page_info['sch_keyword'] ?>" autocomplete="off">
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
					<col width="12%">
					<col width="12%">
					<col width="12%">
					<col width="12%">
					<col width="12%">
					<col width="20%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'regdate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="regdate">등록일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="name">업체명</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'brn') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="brn">사업자등록번호</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'ceo') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="ceo">대표자명</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'tel') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="tel">대표번호</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'addr') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="addr">소재지</th>
						<th>외주분야</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($dataList as $list) {
					?>
						<tr>
							<td class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td class="text-center"><a href="<?= $page_info['base_url'] ?>/view/<?= $list->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>"><?= $list->name ?></a></td>
							<td class="text-center"><?= $list->brn ?></td>
							<td class="text-center"><?= $list->ceo ?></td>
							<td class="text-center"><?= $list->tel ?></td>
							<td><?= $list->addr ?></td>
							<td>
								<?php
								$partners_category = json_decode($list->category);
								if (json_last_error() === JSON_ERROR_NONE && is_object($partners_category)) {
									foreach ($business_list as $blist) {
										if (isset($partners_category->{$blist['segment']}) && $partners_category->{$blist['segment']}) {
								?>
											<div class="btn btn-xs btn-secondary"><?= $blist['name'] ?></div>
								<?php
										}
									}
								} else {
									// JSON 디코딩 오류 또는 유효하지 않은 데이터 처리
									echo '<div class="btn btn-xs btn-danger">Invalid category data</div>';
								}
								?>
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
	
        // PHP 변수를 JavaScript 변수로 변환하여 콘솔에 출력
        var dataList = <?= json_encode($dataList) ?>;
        var pageInfo = <?= json_encode($page_info) ?>;
        var businessList = <?= json_encode($business_list) ?>;

        console.log("dataList:", dataList);
        console.log("pageInfo:", pageInfo);
        console.log("businessList:", businessList);
</script>
