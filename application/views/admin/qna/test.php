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
					<col width="80%">
				</colgroup>
				<tbody class="vertical">
					<tr>
						<th>작성자</th>
						<td>
							<input class="form-control form-control-md form-valid  fv_empty" name="name" type="text" placeholder="작성자이름을 입력하세요." aria-label="devault input example" title="작성자" />
						</td>
					</tr>
					<tr>
						<th>제목</th>
						<td>
							<input class="form-control form-control-md form-valid  fv_empty" name="title" type="text" placeholder="제목을 입력하세요." aria-label="devault input example" title="제목" />
						</td>
					</tr>
					<tr>
						<th>비밀번호</th>
						<td>
							<input class="form-control form-control-md form-valid  fv_empty" name="qna_pass" type="text" placeholder="비밀번호를 입력하세요." aria-label="devault input example" title="비밀번호" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<textarea class="snEditor" name="contents" title="내용"></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 noticeSubmit">저장</button>
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

	uploadPathInfo = {
		"method": "/admin/qna/editorUpload/",
		"upPath": "/uploads/editor/qna/"
	};

	$(function() {
		$(".noticeSubmit").on("click", function() {
			var mode = $(this).data("mode");
			noticeSubmit(mode);
		});
	});

	function noticeSubmit(mode) {
		var form_data = {
			"name": $("input[name=name]").val(),
			"subject": $("input[name=title]").val(),
			"qna_pass": $("input[name=qna_pass]").val(),
			"contents": $("textarea[name=contents]").val()
		};

		var ajax_url = page_info['base_url'] + "/testSave";
		$.ajax({
			method: "POST",
			url: ajax_url,
			beforeSend: function(xhr, opts) {
				if (!formValidate()) {
					xhr.abort();
				}
			},
			data: form_data,
			success: function(data) {
				var result = JSON.parse(data);
				if (result.flag) {
					$modal_alert(page_info['curr_title'], result.message, function() {
						location.href = page_info['base_url'] + '/view/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
					});
				} else {
					$modal_alert(page_info['curr_title'], result.message, function() {
						$modal_hide();
					});
				}
			}
		});
	}
</script>