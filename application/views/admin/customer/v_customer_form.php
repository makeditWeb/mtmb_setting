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
					<th>기업구분</th>
					<td colspan="3">
						<div class="row w50per">
							<?php
							for ($i = 0; $i < 3; $i++) {
							?>
								<div class="col-4 mt-1 mb-2">
									<div class="custom-control custom-radio">
										<input class="custom-control-input" type="radio" id="customRadio<?= $i ?>" name="category" value="<?= $i ?>" <?= ($dataResult->category == $i) ? 'checked' : '' ?>>
										<label for="customRadio<?= $i ?>" class="custom-control-label"><?= replaceCustomerType($i) ?></label>
									</div>
								</div>
							<?php
							}
							?>
						</div>
					</td>
					<tr>
						<th>기업명</th>
						<td>
							<input class="form-control form-valid fv_empty" name="name" type="text" placeholder="기업명을 입력하세요." title="기업명" value="<?= $dataResult->name ?>" />
						</td>
						<th>사업자등록번호</th>
						<td>
							<input class="form-control form-valid fv_empty" name="brn" type="text" placeholder="사업자등록번호를 입력하세요." title="사업자등록번호" value="<?= $dataResult->brn ?>" />
						</td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td>
							<input class="form-control form-valid fv_empty" name="ceo" type="text" placeholder="대표자명을 입력하세요." title="대표자명" value="<?= $dataResult->ceo ?>" />
						</td>
						<th>소재지</th>
						<td>
							<div class="input-group">
								<input type="text" class="form-control form-valid fv_empty" id="daumpostcode-addr" name="addr" type="text" placeholder="주소를 검색해주세요" title="주소" value="<?= $dataResult->addr ?>" readonly>
								<div class="input-group-append">
									<button type="button" class="btn btn-primary btn-find-address">주소검색</button>
								</div>
							</div>
							<input type="text" class="form-control form-valid fv_empty mt-2" id="daumpostcode-addr-more" name="addr_more" type="text" placeholder="상세주소를 입력해주세요." title="상세주소" value="<?= $dataResult->addr_more ?>">
						</td>
					</tr>
					<tr>
						<th>업태</th>
						<td>
							<input class="form-control form-valid fv_empty" name="business_type" type="text" placeholder="업태를 입력하세요." title="업태" value="<?= $dataResult->business_type ?>" />
						</td>
						<th>종목</th>
						<td>
							<input class="form-control form-valid fv_empty" name="business_item" type="text" placeholder="종목을 입력하세요." title="종목" value="<?= $dataResult->business_item ?>" />
						</td>
					</tr>
					<tr>
						<th>대표번호</th>
						<td>
							<input class="form-control form-valid fv_empty fv_telnum" name="tel" type="text" placeholder="대표번호를 입력하세요." title="대표번호" value="<?= $dataResult->tel ?>" />
						</td>
						<th>이메일</th>
						<td>
							<input class="form-control form-valid fv_empty fv_email" name="email" type="email" placeholder="이메일을 입력하세요." title="이메일" value="<?= $dataResult->email ?>" />
						</td>
					</tr>
					<tr>
						<th>메모</th>
						<td colspan="3">
							<form method="post">
								<textarea class="snEditor" name="memo" title="메모"><?= $dataResult->memo ?></textarea>
							</form>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 customerSubmit" data-mode=<?= $mode ?>>저장</button>
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
		"method": "/admin/customer/editorUpload/",
		"upPath": "/uploads/editor/customer/"
	};

	$(function() {
		$(".customerSubmit").on("click", function() {
			var mode = $(this).data("mode");
			customerSubmit(mode);
		});
	});

	function customerSubmit(mode) {
		var form_data = {
			"idx": curr_idx,
			"category": $("input[name=category]:checked").val(),
			"name": $("input[name=name]").val(),
			"brn": $("input[name=brn]").val(),
			"ceo": $("input[name=ceo]").val(),
			"addr": $("input[name=addr]").val(),
			"addr_more": $("input[name=addr_more]").val(),
			"business_type": $("input[name=business_type]").val(),
			"business_item": $("input[name=business_item]").val(),
			"tel": $("input[name=tel]").val(),
			"email": $("input[name=email]").val(),
			"memo": $("textarea[name=memo]").val()
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