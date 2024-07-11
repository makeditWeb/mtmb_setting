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
						<th>관리자 유형</th>
						<td>
							<div class="form-check radio pr-3">
								<input class="form-check-input" type="radio" name="grade" id="admingrade2" value="0" checked />
								<label class="form-check-label" for="admingrade2">총괄책임자</label>
							</div>
							<div class="form-check radio pr-3">
								<input class="form-check-input" type="radio" name="grade" id="admingrade1" value="1" <?php if ($dataResult->grade != '0') echo "checked"; ?> />
								<label class="form-check-label" for="admingrade1">담당자</label>
							</div>
						</td>
					</tr>
					<tr>
						<th>활성화</th>
						<td>
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
						<th>아이디</th>
						<td>
							<input class="form-control form-valid fv_empty w40per" <?php if ($mode == 'mod') echo 'readonly'; ?> name="adm_id" type="text" placeholder="아이디를 입력하세요." title="아이디" value="<?= $dataResult->adm_id ?>" />
						</td>
					</tr>
					<tr>
						<th>비밀번호</th>
						<td>
							<input class="form-control <?php if ($mode == 'add') echo 'form-valid fv_empty'; ?> w40per" name="adm_pass" type="password" placeholder="비밀번호를 입력하세요." title="비밀번호" autocomplete="new-password" />
						</td>
					</tr>
					<tr>
						<th>비밀번호 확인</th>
						<td>
							<input class="form-control <?php if ($mode == 'add') echo 'form-valid fv_empty'; ?> w40per" name="adm_pass_conf" type="password" placeholder="비밀번호 확인을 입력하세요." title="비밀번호 확인" autocomplete="new-password" />
						</td>
					</tr>
					<tr>
						<th>이름</th>
						<td>
							<input class="form-control form-valid fv_empty w40per" name="adm_name" type="text" placeholder="이름을 입력하세요." title="이름" value="<?= $dataResult->name ?>" />
						</td>
					</tr>
					<tr>
						<th>이메일</th>
						<td>
							<input class="form-control form-valid fv_empty fv_email w40per" name="email" type="text" placeholder="이메일을 입력하세요." title="이메일" value="<?= $dataResult->email ?>" />
						</td>
					</tr>
					<tr>
						<th>부서</th>
						<td>
							<input class="form-control w40per" name="dept" type="text" placeholder="부서를 입력하세요." title="부서" value="<?= $dataResult->dept ?>" />
						</td>
					</tr>
					<tr>
						<th>관리 권한</th>
						<td>
							<div class="row">
								<?php
								$admin_permission = json_decode($dataResult->permission, true);
								$permission_list = new stdClass();
								$i = 0;
								foreach ($menu_list as $menu) {
									$permission_list->{$menu['segment']} = [
										'read' => false,
										'create' => false,
										'update' => false,
										'delete' => false,
									];
									if ($menu['visible']) {
								?>
										<div class="col-2 mb-5 text-center">
											<div type="button" class="btn btn-warning"><strong><?= $menu['name'] ?></strong></div>											
											<?php if ($menu['is_used']['read']) { ?>
												<div class="form-check">
													<input class="form-check-input adm_permission" data-per-name="<?= $menu['segment'] ?>" data-per-type="read" type="checkbox" id="per_<?= $i ?>" value="1" <?= (isset($admin_permission[$menu['segment']]) && $admin_permission[$menu['segment']]['read']) ? "checked" : '' ?>>
													<label class="form-check-label" for="per_<?= $i ?>">읽기</label>
												</div>
												<?php $i++; ?>
											<?php } ?>

											<?php if ($menu['is_used']['create']) { ?>
												<div class="form-check">
													<input class="form-check-input adm_permission" data-per-name="<?= $menu['segment'] ?>" data-per-type="create" type="checkbox" id="per_<?= $i ?>" value="1" <?= (isset($admin_permission[$menu['segment']]) && $admin_permission[$menu['segment']]['create']) ? "checked" : '' ?>>
													<label class="form-check-label" for="per_<?= $i ?>">등록</label>
												</div>
												<?php $i++; ?>
											<?php } ?>

											<?php if ($menu['is_used']['update']) { ?>
												<div class="form-check">
													<input class="form-check-input adm_permission" data-per-name="<?= $menu['segment'] ?>" data-per-type="update" type="checkbox" id="per_<?= $i ?>" value="1" <?= (isset($admin_permission[$menu['segment']]) && $admin_permission[$menu['segment']]['update']) ? "checked" : '' ?>>
													<label class="form-check-label" for="per_<?= $i ?>">수정</label>
												</div>
												<?php $i++; ?>
											<?php } ?>

											<?php if ($menu['is_used']['delete']) { ?>
												<div class="form-check">
													<input class="form-check-input adm_permission" data-per-name="<?= $menu['segment'] ?>" data-per-type="delete" type="checkbox" id="per_<?= $i ?>" value="1" <?= (isset($admin_permission[$menu['segment']]) && $admin_permission[$menu['segment']]['delete']) ? "checked" : '' ?>>
													<label class="form-check-label" for="per_<?= $i ?>">삭제</label>
												</div>
												<?php $i++; ?>
											<?php } ?>
										</div>
								<?php
									}
								}
								?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2 managerSubmit" data-mode=<?= $mode ?>>저장</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $dataResult->idx ?>';
	let permission_list = JSON.parse('<?= json_encode($permission_list) ?>');

	$(function() {
		$(".managerSubmit").on("click", function() {
			var mode = $(this).data("mode");
			managerSubmit(mode);
		});
	});

	function managerSubmit(mode) {
		var form_data = {
			"idx": curr_idx,
			"grade": $("input[name=grade]:checked").val(),
			"is_active": $("input[name=is_active]:checked").val(),
			"adm_id": $("input[name=adm_id]").val(),
			"adm_pass": $("input[name=adm_pass]").val(),
			"adm_pass_conf": $("input[name=adm_pass_conf]").val(),
			"name": $("input[name=adm_name]").val(),
			"email": $("input[name=email]").val(),
			"dept": $("input[name=dept]").val(),
		};

		$(".adm_permission").each(function() {
			if ($(this).is(":checked")) permission_list[$(this).data('per-name')][$(this).data('per-type')] = true;
		});

		form_data['permission'] = JSON.stringify(permission_list);

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