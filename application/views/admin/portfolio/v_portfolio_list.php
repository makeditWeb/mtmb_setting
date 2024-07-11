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
			<div class="text-right">
				<button type="button" class="btn btn-sm bg-olive btn-portfolio-moddal" data-mode="add" data-curridx="0">포트폴리오 등록</button>
			</div>
			<div class="row connectedSortable">
				<?php
				foreach ($dataList as $list) {
					$img = json_decode($list->img_name)[0];
				?>
					<div class="col-2 mt-5 mb-5 portfolio_list text-center" data-idx="<?= $list->idx ?>">
						<p class="select_portfolio cursor-pointer" data-curridx="<?= $list->idx ?>"><img class="portfolio_list_img img-fluid" src="<?= $img ?>" class="" /></p>
						<strong class="portfolio_list_title"><?= $list->title ?></strong>
						<div class="fclear"></div>
						<button type="button" class="btn btn-sm bg-olive btn-portfolio-moddal" data-mode="mod" data-curridx="<?= $list->idx ?>">수정</button>
						<button type="button" class="btn btn-sm btn-danger btn-portfolio-del" data-idx="<?= $list->idx ?>">삭제</button>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>

<div class="modal" id="modal-portfolio-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">포트폴리오 저장</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="portfolio-title-input">제목</label>
					<input type="text" class="form-control form-valid fv_empty" name="title" id="portfolio-title-input" placeholder="제목을 입력해주세요." title="제목">
				</div>
				<div class="form-group mt-4">
					<label for="portfolio-img-input">이미지</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="portfolio_img[]" id="portfolio-img-input" placeholder="파일을 선택해주세요." title="이미지" multiple>
							<label class="custom-file-label" for="portfolio-img-input">파일을 선택해주세요.</label>
						</div>
					</div>
				</div>
				<div class="mt-2 row" id="portfolio_img_origin"></div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary closeModalBtn">취소</button>
				<button type="button" class="btn btn-blue" id="portfolioSubmit">저장</button>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="modal-portfolio-view" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-portfolio-view-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body row" id="modal-portfolio-view-img"></div>
		</div>
	</div>
</div>


<script src="/resources/admin/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/resources/admin/jquery-ui/jquery-ui.min.js"></script>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	let curr_idx = '';
	let portfolio_sort = [];

	let div_tags, img_tags;

	$(function() {
		bsCustomFileInput.init();

		$('.connectedSortable').sortable({
			placeholder: 'sort-highlight',
			connectWith: '.connectedSortable',
			handle: '.portfolio_list_title, .portfolio_list_img',
			forcePlaceholderSize: true,
			zIndex: 999999,
			update: function(event, ui) {
				portfolioSortSubmit();
			}
		});

		// 질문 작성창 modal
		$(".btn-portfolio-moddal").on("click", function() {
			$("#portfolio_img_origin").empty();
			$("#portfolio-title-input").val("");

			portfolio_mode = $(this).data('mode');
			curr_idx = $(this).data('curridx');
			$("#modal-portfolio-form").modal();

			if (portfolio_mode == "mod") {
				portfolioMod(curr_idx);
			}
		});

		$(".select_portfolio").on("click", function() {
			curr_idx = $(this).data('curridx');
			portfolioView(curr_idx);
		});

		// 질문 저장
		$("#portfolioSubmit").on("click", function() {
			portfolioSubmit(portfolio_mode);
		});

		// 질문 삭제
		$(".btn-portfolio-del").on("click", function() {
			curr_idx = $(this).data('idx');
			portfolioDelSubmit();
		});
	});

	function portfolioMod(idx) {
		$.post(page_info['base_url'] + "/view/", {
			idx: idx
		}, function(data) {
			var result = JSON.parse(data);

			if (result.flag) {
				$("#portfolio-title-input").val(result.data.dataResult.title);
				var img_list = JSON.parse(result.data.dataResult.img_name);
				$.each(img_list, function(key, value) {
					div_tags = $("<div/>", {
						class: 'col-2'
					});
					img_tags = $("<img/>", {
						class: 'w100per mb-2',
						src: value
					});
					div_tags.append(img_tags);
					$("#portfolio_img_origin").append(div_tags);
				});
			}
		});
	}

	function portfolioView(idx) {
		$.post(page_info['base_url'] + "/view/", {
			idx: idx
		}, function(data) {
			var result = JSON.parse(data);

			if (result.flag) {
				$("#modal-portfolio-view").modal();
				var img_list = JSON.parse(result.data.dataResult.img_name);
				$("#modal-portfolio-view-title").text(result.data.dataResult.title);
				$("#modal-portfolio-view-img").empty();

				$.each(img_list, function(key, value) {
					div_tags = $("<div/>", {
						class: 'col-3'
					});
					img_tags = $("<img/>", {
						class: 'w100per mb-2',
						src: value
					});
					div_tags.append(img_tags);
					$("#modal-portfolio-view-img").append(div_tags);
				});
			}
		});
	}

	function portfolioSubmit(mode) {
		var form_data = new FormData();
		form_data.append("idx", curr_idx);
		form_data.append("title", $("#portfolio-title-input").val());

		var fileList = $("#portfolio-img-input")[0].files;

		$.each(fileList, function(key, val) {
			form_data.append("portfolio_img[]", val);
		});

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/save/" + mode,
			beforeSend: function(xhr, opts) {
				if (!formValidate()) xhr.abort();
			},
			data: form_data,
			enctype: 'multipart/form-data',
			processData: false,
			cache: false,
			contentType: false,
			success: function(data) {
				var result = JSON.parse(data);
				$modal_alert(page_info['curr_title'], result.message, function() {
					if (result.flag) {
						location.reload();
					} else {
						$modal_hide();
					}
				});
			}
		});
	}

	function portfolioDelSubmit() {
		$modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/del/",
				data: {
					"idx": curr_idx
				},
				success: function(data) {
					var result = JSON.parse(data);
					$modal_alert(page_info['curr_title'], result.message, function() {
						if (result.flag) {
							location.reload();
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

	function portfolioSortSubmit() {
		portfolio_sort = [];
		$(".connectedSortable .portfolio_list").each(function(index) {
			curr_idx = $(this).data("idx");
			portfolio_sort.push({
				"idx": curr_idx,
				"sort": index
			});
		});

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/sort/",
			data: {
				"portfolio_sort": portfolio_sort
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