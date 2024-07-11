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
						<th>연락처</th>
						<td>
							<input class="form-control form-valid fv_empty" name="tel" type="text" placeholder="연락처를 입력하세요." title="연락처" value="<?= $dataResult->tel ?>" />
						</td>
						<th>FAX</th>
						<td>
							<input class="form-control form-valid fv_empty" name="fax" type="text" placeholder="FAX를 입력하세요." title="FAX" value="<?= $dataResult->fax ?>" />
						</td>
					</tr>
					<tr>
						<th>홈페이지</th>
						<td>
							<input class="form-control form-valid fv_empty" name="homepage" type="text" placeholder="홈페이지를 입력하세요." title="홈페이지" value="<?= $dataResult->homepage ?>" />
						</td>
						<th>계좌번호</th>
						<td>
							<input class="form-control form-valid fv_empty" name="account_bank" type="text" placeholder="은행명을 입력하세요." title="은행명" value="<?= $dataResult->account_bank ?>" />
							<input class="form-control form-valid fv_empty mt-1" name="account_name" type="text" placeholder="예금주를 입력하세요." title="예금주" value="<?= $dataResult->account_name ?>" />
							<input class="form-control form-valid fv_empty mt-1" name="account_num" type="text" placeholder="계좌번호를 입력하세요." title="계좌번호" value="<?= $dataResult->account_num ?>" />
						</td>
					</tr>
					<th>외주분야</th>
					<td colspan="3">
						<div class="row">
							<?php
							$partners_category = json_decode($dataResult->category);
							$category_list = [];
							$i = 0;

							$business_list = array_filter($business_list, function ($item) {
								return $item['use_partner'] === true;
							});

							foreach ($business_list as $blist) {
								$category_list[$blist['segment']] = false;
							?>
								<div class="col-2 mt-1 mb-2">
									<div class="form-check">
										<input class="form-check-input category" data-segment="<?= $blist['segment'] ?>" type="checkbox" id="cate_<?= $i ?>" value="1" <?= (isset($partners_category->{$blist['segment']}) && $partners_category->{$blist['segment']}) ? "checked" : '' ?>>
										<label class="form-check-label" for="cate_<?= $i ?>"><strong><?= $blist['name'] ?></strong></label>
									</div>
									<?php $i++; ?>
								</div>
							<?php
							}
							?>
						</div>
					</td>
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
				<button type="button" class="btn bg-olive mr-2 partnerSubmit" data-mode=<?= $mode ?>>저장</button>
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
		"method": "/admin/partner/editorUpload/",
		"upPath": "/uploads/editor/partner/"
	};
	let category_list = JSON.parse('<?= json_encode($category_list) ?>');

	$(function() {
		$(".partnerSubmit").on("click", function() {
			var mode = $(this).data("mode");
			partnerSubmit(mode);
		});
	});

	function partnerSubmit(mode) {
		var form_data = {
			"idx": curr_idx,
			"name": $("input[name=name]").val(),
			"brn": $("input[name=brn]").val(),
			"ceo": $("input[name=ceo]").val(),
			"addr": $("input[name=addr]").val(),
			"addr_more": $("input[name=addr_more]").val(),
			"tel": $("input[name=tel]").val(),
			"fax": $("input[name=fax]").val(),
			"homepage": $("input[name=homepage]").val(),
			"account_bank": $("input[name=account_bank]").val(),
			"account_num": $("input[name=account_num]").val(),
			"account_name": $("input[name=account_name]").val(),
			"memo": $("textarea[name=memo]").val()
		};

		$(".category").each(function() {
			if ($(this).is(":checked")) {
				category_list[$(this).data('segment')] = true;
			}
		});

		form_data['category'] = JSON.stringify(category_list);

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