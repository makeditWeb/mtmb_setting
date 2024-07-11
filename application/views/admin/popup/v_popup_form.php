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
					<col width="35%">
					<col width="15%">
					<col width="35%">
				</colgroup>
				<tbody class="vertical">
					<tr>
						<th>활성화</th>
						<td colspan="3">
							<div class="form-check radio pr-3">
								<input class="form-check-input" type="radio" name="is_active" id="adminactive1" value="Y" checked />
								<label class="form-check-label" for="adminactive1">활성</label>
							</div>
							<div class="form-check radio pr-3">
								<input class="form-check-input" type="radio" name="is_active" id="adminactive2" value="N" <?php if ($dataResult->is_active == 'N') echo "checked"; ?> />
								<label class="form-check-label" for="adminactive2">비활성</label>
							</div>
						</td>
					</tr>
					<tr>
					<th>팝업 게시기간</th>
						<td colspan="3">
							<div class="row">
								<div class="col-4">
									<input class="form-control form-valid daterangepicker-input" name="ex_sdate" type="text" placeholder="시작일을 입력하세요." title="시작일" value="<?= $dataResult->ex_sdate ?>" autocomplete="off" />
								</div>
								<div class="col-4">
									<input class="form-control form-valid daterangepicker-input" name="ex_edate" type="text" placeholder="종료일을 입력하세요." title="종료일" value="<?= $dataResult->ex_edate ?>" autocomplete="off" />
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>크기(가로)</th>
						<td>
							<div class="input-group">
								<input type="text" class="form-control form-valid w20per fv_empty" name="size_width" type="number" placeholder="가로 크기를 입력하세요." title="크기(가로)" value="<?= $dataResult->size_width ?>">
								<div class="input-group-append">
									<span class="input-group-text">px</span>
								</div>
							</div>
						</td>
						<th>크기(세로)</th>
						<td>
							<div class="input-group">
								<input type="text" class="form-control form-valid w20per fv_empty" name="size_height" type="number" placeholder="세로 크기를 입력하세요." title="크기(세로)" value="<?= $dataResult->size_height ?>">
								<div class="input-group-append">
									<span class="input-group-text">px</span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>위치(가로)</th>
						<td>
							<div class="input-group">
								<input type="text" class="form-control form-valid w20per fv_empty" name="location_left" type="number" placeholder="가로 위치를 입력하세요." title="위치(가로)" value="<?= $dataResult->location_left ?>">
								<div class="input-group-append">
									<span class="input-group-text">px</span>
								</div>
							</div>
						</td>
						<th>위치(세로)</th>
						<td>
							<div class="input-group">
								<input type="text" class="form-control form-valid w20per fv_empty" name="location_top" type="number" placeholder="세로 위치를 입력하세요." title="위치(세로)" value="<?= $dataResult->location_top ?>">
								<div class="input-group-append">
									<span class="input-group-text">px</span>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<th>제목</th>
						<td colspan="3">
							<input class="form-control form-valid fv_empty" name="title" type="text" placeholder="제목을 입력하세요." title="제목" value="<?= $dataResult->title ?>" />
						</td>
					</tr>
					<tr>
						<th>내용</th>
						<td colspan="3">
							<textarea class="snEditor" name="contents" title="내용"><?= $dataResult->contents ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 popupSubmit" data-mode=<?= $mode ?>>저장</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<link href="/resources/admin/summernote-0.8.18-dist/summernote-bs4.css" rel="stylesheet" />
<script src="/resources/admin/summernote-0.8.18-dist/summernote-bs4.js"></script>
<script src="/resources/admin/summernote-0.8.18-dist/lang/summernote-ko-KR.js"></script>
<link href="/resources/admin/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script src="/resources/admin/daterangepicker/daterangepicker.js"></script>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';
	const uploadPathInfo = {
		"method": "/admin/popup/editorUpload/",
		"upPath": "/uploads/editor/popup/"
	};

	$(function() {
		$(".popupSubmit").on("click", function() {
			var mode = $(this).data("mode");
			popupSubmit(mode);
		});

		$(".daterangepicker-input").daterangepicker(daterangepicker_options, function(sdate, edate) {
			$("input[name=ex_sdate]").val(sdate.format('YYYY-MM-DD HH:mm'));
			$("input[name=ex_edate]").val(edate.format('YYYY-MM-DD HH:mm'));
		});
	});

	function popupSubmit(mode) {
		var form_data = {
			"idx": curr_idx,
			"is_active": $("input[name=is_active]:checked").val(),
			"title": $("input[name=title]").val(),
			"contents": $("textarea[name=contents]").val(),
			"ex_sdate": $("input[name=ex_sdate]").val(),
			"ex_edate": $("input[name=ex_edate]").val(),
			"size_width": $("input[name=size_width]").val(),
			"size_height": $("input[name=size_height]").val(),
			"location_left": $("input[name=location_left]").val(),
			"location_top": $("input[name=location_top]").val(),
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