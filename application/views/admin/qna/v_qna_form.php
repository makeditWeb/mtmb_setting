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
						<th>답변일시</th>
						<td><?= replaceDatetime($dataResult->ansdate) ?></td>
					</tr>
					<tr>
						<th>작성자</th>
						<td colspan="3"><?= $dataResult->name ?></td>
					</tr>
					<tr>
						<th>연락처</th>
						<td><?= $dataResult->tel ?></td>
						<th>이메일주소</th>
						<td><?= $dataResult->email ?></td>
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
						<td colspan="3"><textarea class="snEditor" name="answer" title="답변"><?= $dataResult->answer ?></textarea></td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 qnaSubmit">저장</button>
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

	uploadPathInfo = {
		"method": "/admin/qna/editorUpload/",
		"upPath": "/uploads/editor/qna/"
	};

	$(function() {
		$(".qnaSubmit").on("click", function() {
			qnaSubmit();
		});
	});

	function qnaSubmit() {
		var form_data = {
			"idx": curr_idx,
			"answer": $("textarea[name=answer]").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/save/",
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