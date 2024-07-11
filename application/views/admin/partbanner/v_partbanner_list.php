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
				<button type="button" class="btn btn-sm bg-olive btn-partbanner-moddal" data-mode="add" data-curridx="0">파트너사 등록</button>
			</div>
			<div class="row connectedSortable">
				<?php
				foreach ($dataList as $list) {
				?>
					<div class="col-2 mt-5 mb-5 partbanner_list text-center" data-idx="<?= $list->idx ?>">						
						<p><img class="partbanner_list_img img-fluid" src="<?= $list->img_name ?>" class="" /></p>
						<strong class="partbanner_list_title"><?= $list->title ?></strong>
						<div class="fclear"></div>
						<button type="button" class="btn btn-sm bg-olive btn-partbanner-moddal" data-mode="mod" data-curridx="<?= $list->idx ?>">수정</button>
						<button type="button" class="btn btn-sm btn-danger btn-partbanner-del" data-idx="<?= $list->idx ?>">삭제</button>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>


<div class="modal" id="modal-partbanner-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">파트너사 저장</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="partbanner-title-input">제목</label>
					<input type="text" class="form-control form-valid fv_empty" name="title" id="partbanner-title-input" placeholder="제목을 입력해주세요." title="제목">
				</div>
				<div class="form-group mt-4">
					<label for="partbanner-img-input">이미지</label>
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="partbanner_img" id="partbanner-img-input" placeholder="파일을 선택해주세요." title="이미지">
							<label class="custom-file-label" for="partbanner-img-input">파일을 선택해주세요.</label>
						</div>
					</div>
				</div>
				<div class="mt-2" id="partbanner_img_origin"></div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary closeModalBtn">취소</button>
				<button type="button" class="btn btn-blue" id="partbannerSubmit">저장</button>
			</div>
		</div>
	</div>
</div>

<script src="/resources/admin/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/resources/admin/jquery-ui/jquery-ui.min.js"></script>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	let curr_idx = '';
	let partbanner_sort = [];

	$(function() {
		bsCustomFileInput.init();

		$('.connectedSortable').sortable({
			placeholder: 'sort-highlight',
			connectWith: '.connectedSortable',
			handle: '.partbanner_list_title, .partbanner_list_img',
			forcePlaceholderSize: true,
			zIndex: 999999,
			update: function(event, ui) {
				partbannerSortSubmit();
			}
		});

		$(".btn-partbanner-moddal").on("click", function() {
			$("#partbanner_img_origin").empty();
			$("#partbanner-title-input").val("");

			partbanner_mode = $(this).data('mode');
			curr_idx = $(this).data('curridx');
			$("#modal-partbanner-form").modal();

			if (partbanner_mode == "mod") {
				partbanner_title = $(this).parent().find('.partbanner_list_title').text();
				partbanner_img = $(this).parent().find('img').clone();
				$("#partbanner_img_origin").html(partbanner_img);
				$("#partbanner-title-input").val(partbanner_title);
			}
		});

		$("#partbannerSubmit").on("click", function() {
			partbannerSubmit(partbanner_mode);
		});

		$(".btn-partbanner-del").on("click", function() {
			curr_idx = $(this).data('idx');
			partbannerDelSubmit();
		});
	});

	function partbannerSubmit(mode) {
		var form_data = new FormData();
		form_data.append("idx", curr_idx);
		form_data.append("title", $("#partbanner-title-input").val());
		form_data.append("partbanner_img", $("#partbanner-img-input")[0].files[0]);

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

	function partbannerDelSubmit() {
		$modal_confirm(page_info['curr_title'], "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/del/",
				data: {"idx": curr_idx},
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

	function partbannerSortSubmit() {
		partbanner_sort = [];
		$(".connectedSortable .partbanner_list").each(function(index) {
			curr_idx = $(this).data("idx");
			partbanner_sort.push({
				"idx": curr_idx,
				"sort": index
			});
		});

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/sort/",
			data: {"partbanner_sort": partbanner_sort},
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