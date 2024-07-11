<section class="content container-fluid">
	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">컨설팅 문의 수신 메일 설정</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="card-body">
			<div class="input-group w50per">
				<input class="form-control" type="text" id="email_user_name" placeholder="사용자를 입력해주세요." autocomplete="off">
				<input class="form-control" type="text" id="email_user_email" placeholder="이메일 주소를 입력해주세요." autocomplete="off">
				<div class="input-group-append">
					<button type="button" class="btn btn-primary" id="btn_email_add">이메일주소 등록</button>
				</div>
			</div>

			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>사용자</th>
						<th>이메일주소</th>
						<th>삭제</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($email_list as $list) {
					?>
						<tr>
							<td class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td class="text-center"><?= $list->name ?></td>
							<td><?= $list->email ?></td>
							<td class="text-center">
								<button type="button" class="btn btn-danger btn_email_delete" data-idx="<?= $list->idx ?>">삭제</button>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">컨설팅 문의 수신 SMS 설정</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="card-body">
			<div class="input-group w50per">
				<input class="form-control" type="text" id="smshp_user_name" placeholder="사용자를 입력해주세요." autocomplete="off">
				<input class="form-control" type="text" id="smshp_user_smshp" placeholder="휴대폰 번호를 입력해주세요." autocomplete="off">
				<div class="input-group-append">
					<button type="button" class="btn btn-primary" id="btn_smshp_add">휴대폰번호 등록</button>
				</div>
			</div>

			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>사용자</th>
						<th>휴대폰번호</th>
						<th>삭제</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($smshp_list as $list) {
					?>
						<tr>
							<td class="text-center"><?= replaceDate($list->regdate) ?></td>
							<td class="text-center"><?= $list->name ?></td>
							<td><?= $list->smshp ?></td>
							<td class="text-center">
								<button type="button" class="btn btn-danger btn_smshp_delete" data-idx="<?= $list->idx ?>">삭제</button>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">컨설팅 질문 답변 설정</div>
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="card-body connectedSortable">
			<div class="rows">
				<?php
				foreach ($category as $cate) {
				?>
					<div class="col-1 mb-2 btn btn-sm mr-1 btn-select-category <?= ($cate['segment'] == $page_info['category']) ? 'btn-success' : 'btn-secondary' ?>" data-category="<?= $cate['segment'] ?>"><?= $cate['name'] ?></div>
				<?php
				}
				?>
			</div>
			<div class="w100per right mb-4">
				<button type="button" class="btn btn-sm btn-info btn-card-toggle-all" data-card-toggle="collapse">모두 접기</button>
				<button type="button" class="btn btn-sm btn-info btn-card-toggle-all" data-card-toggle="expand">모두 펼치기</button>
				<button type="button" class="btn btn-sm bg-olive btn-question-moddal" data-mode="add" data-qidx="0">질문 등록</button>
			</div>

			<?php
			$ii = 0;
			$jj = 0;
			foreach ($question_list as $list) {
				$question_idx = $list->idx;
			?>
				<div class="card" data-qidx="<?= $question_idx ?>">
					<div class="card-header">
						<h3 class="card-title" id="question_origin_<?= $ii ?>"><?= $list->question ?></h3>
						<div class="card-tools">
							<button type="button" class="btn btn-sm btn-info trigger-collapse-card" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
							<button type="button" class="btn btn-sm bg-olive btn-question-moddal" data-mode="mod" data-qidx="<?= $question_idx ?>" data-questionid="#question_origin_<?= $ii ?>">수정</button>
							<button type="button" class="btn btn-sm btn-danger questionDelBtn" data-qidx="<?= $question_idx ?>">삭제</button>
							<button type="button" class="btn btn-sm btn-primary btn-answer-moddal" data-mode="add" data-qidx="<?= $question_idx ?>" data-aidx="0"><i class="fas fa-plus"></i> 답변 추가</button>
						</div>
					</div>
					<?php
					$answer_filtering_list = [];
					$answer_filtering_list = array_values(array_filter($answer_list, function ($data) use ($question_idx) {
						return ($data['question_idx'] == $question_idx);
					}));
					if (count($answer_filtering_list) > 0) {
					?>
						<div class="card-body">
							<ul class="todo-list" data-widget="todo-list" id="answer_list_<?= $ii ?>">
								<?php
								array_multisort(array_column($answer_filtering_list, 'sort'), $answer_filtering_list);
								foreach ($answer_filtering_list as $answers) {
								?>
									<li data-aidx="<?= $answers['idx'] ?>" data-anslistid="#answer_list_<?= $ii ?>">
										<span class="handle">
											<i class="fas fa-ellipsis-v"></i>
											<i class="fas fa-ellipsis-v"></i>
										</span>
										<span class="text" id="answer_origin_<?= $jj ?>"><?= $answers['answer'] ?></span>
										<div class="tools">
											<button type="button" class="btn btn-sm bg-olive btn-answer-moddal" data-mode="mod" data-qidx="<?= $question_idx ?>" data-aidx="<?= $answers['idx'] ?>" data-answerid="#answer_origin_<?= $jj ?>">수정</button>
											<button type="button" class="btn btn-sm btn-danger answerDelBtn" data-aidx="<?= $answers['idx'] ?>">삭제</button>
										</div>
									</li>
								<?php
									$jj++;
								}
								?>
							</ul>
						</div>
					<?php
					}
					?>
				</div>
			<?php
				$ii++;
			}
			?>
		</div>
	</div>
</section>


<div class="modal" id="modal-question-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">질문 저장</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea class="snEditor" name="question" title="내용"></textarea>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary closeModalBtn">취소</button>
				<button type="button" class="btn btn-blue" id="questionSubmit">저장</button>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modal-answer-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">답변 저장</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<textarea class="snEditor" name="answer" title="내용">asdf</textarea>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary closeModalBtn">취소</button>
				<button type="button" class="btn btn-blue" id="answerSubmit">저장</button>
			</div>
		</div>
	</div>
</div>

<link href="/resources/admin/summernote-0.8.18-dist/summernote-bs4.css" rel="stylesheet" />
<script src="/resources/admin/summernote-0.8.18-dist/summernote-bs4.js"></script>
<script src="/resources/admin/summernote-0.8.18-dist/lang/summernote-ko-KR.js"></script>
<script src="/resources/admin/jquery-ui/jquery-ui.min.js"></script>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const category = page_info['category'];
	const seg_sort = page_info['seg_sort'];
	let q_idx, a_idx, question_mode, rnum, answer_mode;
	let email_user_name, email_user_email, email_idx;
	let smshp_user_name, smshp_user_smshp, smshp_idx;
	let question_sort = [];
	let answer_sort = [];

	uploadPathInfo = {
		"method": "/admin/questions/editorUpload/",
		"upPath": "/uploads/editor/questions/"
	};

	$(function() {
		$(".btn-select-category").on("click", function() {
			move_category = $(this).data('category');
			location.href = page_info['base_url'] + "/list/" + move_category;
		});

		// 질문 재정렬
		$('.connectedSortable').sortable({
			placeholder: 'sort-highlight',
			connectWith: '.connectedSortable',
			handle: '.card-header, .nav-tabs',
			forcePlaceholderSize: true,
			zIndex: 999999,
			update: function(event, ui) {
				questionSortSubmit();
			}
		});

		// 질문내의 답변 재정렬
		$('.todo-list').sortable({
			placeholder: 'sort-highlight',
			handle: '.handle',
			forcePlaceholderSize: true,
			zIndex: 999999,
			update: function(event, ui) {
				answerSortSubmit(ui.item[0].dataset["anslistid"]);
			}
		});

		// 답변 모두 펼치기 닫기
		$(".btn-card-toggle-all").on("click", function() {
			var toggle_mode = $(this).data("card-toggle");
			$(".connectedSortable .card").CardWidget(toggle_mode);
		});

		// 질문 작성창 modal
		$(".btn-question-moddal").on("click", function() {
			$("textarea[name=question]").summernote('reset');
			question_mode = $(this).data('mode');
			q_idx = $(this).data('qidx');
			$("#modal-question-form").modal();
			if (question_mode == "mod") {
				var mod_question_id = $(this).data('questionid');
				var get_question_content = $(mod_question_id).html();
				$("textarea[name=question]").summernote('pasteHTML', get_question_content);
			}
		});

		// 질문 저장
		$("#questionSubmit").on("click", function() {
			questionSubmit(question_mode);
		});

		// 질문 삭제
		$(".questionDelBtn").on("click", function() {
			q_idx = $(this).data('qidx');
			questionDelSubmit();
		});

		// 답변 작성창 modal
		$(".btn-answer-moddal").on("click", function() {
			$("textarea[name=answer]").summernote('reset');
			answer_mode = $(this).data('mode');
			a_idx = $(this).data('aidx');
			q_idx = $(this).data('qidx');
			$("#modal-answer-form").modal();
			if (answer_mode == "mod") {
				var mod_answer_id = $(this).data('answerid');
				var get_answer_content = $(mod_answer_id).html();
				console.log(get_answer_content);
				$("textarea[name=answer]").summernote('pasteHTML', get_answer_content);
			}
		});

		// 답변 저장
		$("#answerSubmit").on("click", function() {
			answerSubmit(answer_mode);
		});

		// 답변 삭제
		$(".answerDelBtn").on("click", function() {
			a_idx = $(this).data('aidx');
			answerDelSubmit();
		});

		$("#btn_email_add").on("click", function() {
			emailSaveSubmit();
		});

		$(".btn_email_delete").on("click", function() {
			email_idx = $(this).data("idx");
			emailDeleteSubmit(email_idx);
		});

		$("#btn_smshp_add").on("click", function() {
			smshpSaveSubmit();
		});

		$(".btn_smshp_delete").on("click", function() {
			smshp_idx = $(this).data("idx");
			smshpDeleteSubmit(smshp_idx);
		});
	});

	function questionSubmit(mode) {
		var form_data = {
			"segment": category,
			"seg_sort": seg_sort,
			"idx": q_idx,
			"question": $("textarea[name=question]").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/save/" + mode,
			data: form_data,
			success: function(data) {
				var result = JSON.parse(data);
				$modal_alert(page_info['curr_title'] + '-질문', result.message, function() {
					if (result.flag) {
						location.reload();
					} else {
						$modal_hide();
					}
				});
			}
		});
	}

	function questionDelSubmit() {
		$modal_confirm(page_info['curr_title'] + '-질문', "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/del/",
				data: {
					"idx": q_idx
				},
				success: function(data) {
					var result = JSON.parse(data);
					$modal_alert(page_info['curr_title'] + '-질문', result.message, function() {
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

	function questionSortSubmit() {
		question_sort = [];
		$(".connectedSortable .card").each(function(index) {
			q_idx = $(this).data("qidx");
			question_sort.push({
				"idx": q_idx,
				"sort": index
			});
		});

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/sort/",
			data: {
				"question_sort": question_sort
			},
			success: function(data) {
				var result = JSON.parse(data);
				if (!result.flag) {
					$modal_alert(page_info['curr_title'] + '-질문', result.message, function() {
						$modal_hide();
					});
				}
			}
		});
	}

	function answerSubmit(mode) {
		var form_data = {
			"segment": category,
			"question_idx": q_idx,
			"idx": a_idx,
			"answer": $("textarea[name=answer]").val()
		};

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/ansSave/" + mode,
			data: form_data,
			success: function(data) {
				var result = JSON.parse(data);
				$modal_alert(page_info['curr_title'] + '-답변', result.message, function() {
					if (result.flag) {
						location.reload();
					} else {
						$modal_hide();
					}
				});
			}
		});
	}

	function answerDelSubmit() {
		$modal_confirm(page_info['curr_title'] + '-답변', "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/ansDel/",
				data: {
					"idx": a_idx
				},
				success: function(data) {
					var result = JSON.parse(data);
					$modal_alert(page_info['curr_title'] + '-답변', result.message, function() {
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

	function answerSortSubmit(obj) {
		answer_sort = [];
		$(obj + " li").each(function(index) {
			a_idx = $(this).data("aidx");
			answer_sort.push({
				"idx": a_idx,
				"sort": index
			});
		});

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/ansSort/",
			data: {
				"answer_sort": answer_sort
			},
			success: function(data) {
				var result = JSON.parse(data);
				if (!result.flag) {
					$modal_alert(page_info['curr_title'] + '-답변', result.message, function() {
						$modal_hide();
					});
				}
			}
		});
	}

	function emailSaveSubmit() {
		email_user_name = $("#email_user_name").val();
		email_user_email = $("#email_user_email").val();
		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/emailAdd/",
			data: {
				"name": email_user_name,
				"email": email_user_email,
			},
			success: function(data) {
				var result = JSON.parse(data);
				if (result.flag) {
					$modal_alert(page_info['curr_title'] + '-이메일 등록', result.message, function() {
						location.reload();
					});
				} else {
					$modal_alert(page_info['curr_title'] + '-이메일 등록', result.message, function() {
						$modal_hide();
					});
				}
			}
		});
	}

	function emailDeleteSubmit() {
		$modal_confirm(page_info['curr_title'] + '-이메일', "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/emailDel/",
				data: {
					"idx": email_idx
				},
				success: function(data) {
					var result = JSON.parse(data);
					$modal_alert(page_info['curr_title'] + '-이메일', result.message, function() {
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

	function smshpSaveSubmit() {
		smshp_user_name = $("#smshp_user_name").val();
		smshp_user_smshp = $("#smshp_user_smshp").val();
		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/smshpAdd/",
			data: {
				"name": smshp_user_name,
				"smshp": smshp_user_smshp,
			},
			success: function(data) {
				var result = JSON.parse(data);
				if (result.flag) {
					$modal_alert(page_info['curr_title'] + '-휴대폰번호 등록', result.message, function() {
						location.reload();
					});
				} else {
					$modal_alert(page_info['curr_title'] + '-휴대폰번호 등록', result.message, function() {
						$modal_hide();
					});
				}
			}
		});
	}

	function smshpDeleteSubmit() {
		$modal_confirm(page_info['curr_title'] + '-휴대폰번호', "삭제하시겠습니까?", function() {
			$.ajax({
				method: "POST",
				url: page_info['base_url'] + "/smshpDel/",
				data: {
					"idx": smshp_idx
				},
				success: function(data) {
					var result = JSON.parse(data);
					$modal_alert(page_info['curr_title'] + '-휴대폰번호', result.message, function() {
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
</script>