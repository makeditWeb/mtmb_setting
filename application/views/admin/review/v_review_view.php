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
					<col width="20%">
					<col width="30%">
					<col width="20%">
					<col width="30%">
				</colgroup>
				<tbody class="vertical">
					<tr>
						<th>등록일시</th>
						<td><?= replaceDatetime($dataResult->regdate) ?></td>
					</tr>
					<tr>
						<th>작성자</th>
						<td colspan="3"><?= $dataResult->name ?></td>
					</tr>
					<tr>
						<th>별점</th>
						<td colspan="3"><?= $dataResult->score ?></td>
					</tr>
					<tr>
						<th>제목</th>
						<td colspan="3"><?= $dataResult->subject ?></td>
					</tr>
					<tr>
						<th>내용</th>
						<td colspan="3"><?= nl2br2($dataResult->contents) ?></td>
					</tr>
					<tr>
						<th>답변</th>
						<td colspan="3"><?= $dataResult->reply ?></td>
					</tr>					
				</tbody>
			</table>
			</table>
			<div class="right mt-2">
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/mod/<?= $dataResult->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn bg-olive mr-2">수정</button>
				<button type="button" id="noticeDelBtn" class="btn btn-danger mr-2">삭제</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';

	$(function() {
		$("#noticeDelBtn").on("click", function() {
			noticeDelSubmit();
		});
	});

	function noticeDelSubmit() {
		$modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/del/",
				data: {"idx": curr_idx},
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