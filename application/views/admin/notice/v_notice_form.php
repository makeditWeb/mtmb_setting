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
					<col width="85%">
				</colgroup>
				<tbody class="vertical">
					<tr>
						<th>제목</th>
						<td>
							<input class="form-control form-valid  fv_empty" name="title" type="text" placeholder="제목을 입력하세요." title="제목" value="<?= $dataResult->title ?>" />
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td>
							<textarea class="snEditor" name="contents" title="내용"><?= $dataResult->contents ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 noticeSubmit" data-mode="<?= $mode ?>">저장</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<link href="/resources/admin/summernote-0.8.18-dist/summernote-bs4.css" rel="stylesheet" />
<script src="/resources/admin/summernote-0.8.18-dist/summernote-bs4.js"></script>
<script src="/resources/admin/summernote-0.8.18-dist/lang/summernote-ko-KR.js"></script>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';
	const uploadPathInfo = {
		"method": "/admin/notice/editorUpload/",
		"upPath": "/uploads/editor/notice/"
	};

	$(function() {
		$(".noticeSubmit").on("click", function() {
			var mode = $(this).data("mode");
			noticeSubmit(mode);
		});
	});

	function noticeSubmit(mode) {
		var form_data = {
			"idx": curr_idx,
			"title": $("input[name=title]").val(),
			"contents": $("textarea[name=contents]").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/save/" + mode,
			beforeSend: function(xhr, opts) {
				if (!formValidate()) xhr.abort();
			},
			data: form_data,
			success: function(data) {
				var result = JSON.parse(data);
				$modal_alert(page_info['curr_title'], result.message, function() {
					if (result.flag) {
						location.href = page_info['base_url'] + '/view/' + result.idx + '/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
					} else {
						$modal_hide();
					}
				});
			}
		});
	}
</script>