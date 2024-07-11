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
					<input class="form-control" type="search" id="sch_keyword" placeholder="아이디, 이름, 이메일주소, 부서로 검색" value="<?= $page_info['sch_keyword'] ?>" autocomplete="off">
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
					<col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="20%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'regdate') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="regdate">등록일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'adm_id') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="adm_id">아이디</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'name') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="name">이름</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'email') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="email">이메일</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'dept') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="dept">부서</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'is_active') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="is_active">상태</th>
						<th class="selectSort <?php if ($page_info['sort_key'] == 'grade') echo ($page_info['sort_direction'] == 'desc') ? 'desc' : 'asc'; ?>" data-sort_key="grade">유형</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($data_list as $list) {
					?>
						<tr>
							<td  class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td  class="text-center"><a href="<?= $page_info['base_url'] ?>/view/<?= $list->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>"><?= $list->adm_id ?></a></td>
							<td  class="text-center"><?= $list->name ?></td>
							<td  class="text-center"><?= $list->email ?></td>
							<td  class="text-center"><?= $list->dept ?></td>
							<td  class="text-center"><?= replaceActive($list->is_active) ?></td>
							<td  class="text-center"><?= replaceManagerGrade($list->grade) ?></td>
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