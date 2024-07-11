<section class="content container-fluid">
	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">컨설팅 문의 수신 메일 설정</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="card-body">
			<!-- <div class="text-right">
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/add/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>' " class="btn bg-olive">신규 등록</button>
			</div> -->
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="10%">
					<col width="12.5%">
					<col width="12.5%">
					<col width="12.5%">
					<col width="12.5%">
					<col width="12.5%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>정렬번호</th>
						<th>분야명</th>
						<th>code</th>
						<th>협력업체 의뢰범위</th>
						<th>월간디자인 의뢰범위</th>
						<th>매출통계 대상</th>
						<th>매출통계 색상</th>
					</tr>
				</thead>
				<tbody class="connectedSortable">
					<?php
					foreach ($business_list as $list) {
					?>
						<tr>
							<td class="text-center tr-header" data-business_idx="<?= $list->idx ?>"><?= $list->sort ?></td>
							<td class="text-center"><?= $list->name ?></td>
							<td class="text-center"><a href="<?= $page_info['base_url'] ?>/mod/<?= $list->idx ?>"><?= $list->segment ?></a></td>
							<td class="text-center"><?= bool2Str($list->use_partner) ?></td>
							<td class="text-center"><?= bool2Str($list->use_subscribe) ?></td>
							<td class="text-center"><?= bool2Str($list->use_statistics) ?></td>
							<td class="text-center" style="background-color:<?= $list->color ?>"><?= $list->color ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>

<script src="/resources/admin/jquery-ui/jquery-ui.min.js"></script>
<script>
	let business_sort = [];

	page_info = JSON.parse('<?= json_encode($page_info) ?>');


	$(function() {
		// 질문 재정렬
		$('.connectedSortable').sortable({
			placeholder: 'sort-highlight',
			connectWith: '.connectedSortable',
			handle: '.tr-header',
			forcePlaceholderSize: true,
			zIndex: 999999,
			update: function(event, ui) {
				businessSortSubmit();
			}
		});
	});

	function businessSortSubmit() {
		business_sort = [];
		$(".connectedSortable .tr-header").each(function(index) {
			business_idx = $(this).data("business_idx");
			business_sort.push({
				"idx": business_idx,
				"sort": (index+1)
			});
		});

		console.log(business_sort);

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/sort/",
			data: {
				"business_sort": business_sort
			},
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