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
						<th>작성자</th>
						<td>
							<input class="form-control form-valid  fv_empty" name="name" type="text" placeholder="작성자를 입력하세요." title="작성자" value="<?= $dataResult->name ?>" />
						</td>
					</tr>
					<tr>
						<th>별점</th>
						<td>
							<select class="form-control form-valid fv_empty" id="score" title="고객사" name="score" style="width: 50%;">
								<option value="">선택해 주세요.</option>
								<?php
								for ($i=1 ; $i < 6 ; $i++) {
								?>
									<option <?= ($i == $dataResult->score) ? 'selected' : '' ?>><?=$i?></option>
								<?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th>제목</th>
						<td>
							<input class="form-control form-valid  fv_empty" name="subject" type="text" placeholder="제목을 입력하세요." title="제목" value="<?= $dataResult->subject ?>" />
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td>
							<textarea class="snEditor" name="contents" title="내용"><?= nl2br2($dataResult->contents) ?></textarea>
						</td>
					</tr>
					<tr>
						<th>답변</th>
						<td>
							<textarea class="snEditor" name="reply" title="내용"><?= $dataResult->reply ?></textarea>
						</td>
					</tr>					
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 reviewSubmit" data-mode="<?= $mode ?>">저장</button>
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
		"method": "/admin/review/editorUpload/",
		"upPath": "/uploads/editor/review/"
	};

	$(function() {
		$(".reviewSubmit").on("click", function() {
			var mode = $(this).data("mode");
			reviewSubmit(mode);
		});
	});

	function reviewSubmit(mode) {
		var form_data = {
			"idx": curr_idx,
			"name": $("input[name=name]").val(),
			"score": $("select[name=score]").val(),
			"subject": $("input[name=subject]").val(),
			"contents": $("textarea[name=contents]").val(),
			"reply": $("textarea[name=reply]").val(),
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