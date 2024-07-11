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
						<th>등록일시</th>
						<td><?= replaceDatetime($consulting_info->regdate) ?></td>
						<th>수정일시</th>
						<td><?= replaceDatetime($consulting_info->moddate) ?></td>
					</tr>
					<tr>
						<th>접수번호</th>
						<td><?= $consulting_info->idx ?></td>
						<th>등록경로</th>
						<td><?= replaceConsultingRegPath($consulting_info->reg_path) ?></td>
					</tr>
					<tr>
						<th>기업명</th>
						<td>
							<?php
							if ($consulting_info->customer_idx) {
							?>
								<a class="pop_view" data-path="/admin/customer/view/" data-idx="<?= $consulting_info->customer_idx ?>">
									<?= $consulting_info->name ?>
								</a>
							<?php } else { ?>
								<?= $consulting_info->name ?>
							<?php } ?>
						</td>
						<th>사업자등록번호</th>
						<td><?= htmlspecialchars($consulting_info->brn) ?></td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td><?= htmlspecialchars($consulting_info->ceo) ?></td>
						<th>소재지</th>
						<td><?= htmlspecialchars($consulting_info->addr) ?> <?= htmlspecialchars($consulting_info->addr_more) ?></td>
					</tr>
					<tr>
						<th>대표번호</th>
						<td><?= htmlspecialchars($consulting_info->tel) ?></td>
						<th>이메일주소</th>
						<td><?= htmlspecialchars($consulting_info->email) ?></td>
					</tr>
					<tr>
						<th>업태</th>
						<td><?= htmlspecialchars($consulting_info->business_type) ?></td>
						<th>담당자명</th>
						<td><?= htmlspecialchars($consulting_info->employee_name) ?></td>
					</tr>
					<tr>
						<th>종목</th>
						<td><?= htmlspecialchars($consulting_info->business_item) ?></td>
						<th>담당자 연락처</th>
						<td><?= htmlspecialchars($consulting_info->employee_tel) ?></td>
					</tr>
					<tr>
						<th>기업구분</th>
						<td><?= replaceCustomerType($consulting_info->category) ?></td>
						<th>담당자 이메일</th>
						<td><?= htmlspecialchars($consulting_info->employee_email) ?></td>
					</tr>
					<tr>
						<th>첨부파일</th>
						<td colspan="3">
							<?php
							$file_info = json_decode($consulting_info->file_info);
							if (!is_null($file_info)) {
								foreach ($file_info as $list) {
							?>
									<?= $list->file_name ?>(<?= formatBytes($list->file_size) ?>)
									<button class="btn btn-primary btn-xs btn_download_file" data-filepath="<?= $list->file_path ?>" data-filename="<?= $list->file_name ?>">Download</button>
									<br />
							<?php
								}
							}
							?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-header card-header-strong">
			<div class="card-title card-title-strong">상세내역</div>
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
						<th>매출기준일</th>
						<td><?= replaceDatetime($consulting_info->paydate) ?></td>
						<th>종료날짜</th>
						<td><?= replaceDatetime($consulting_info->enddate) ?></td>
					</tr>
					<tr>
						<th>총괄 담당자</th>
						<td>
							<?php if ($consulting_info->manager_idx) { ?>
								<a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $consulting_info->manager_idx ?>">
									<?= $consulting_info->manager_name ?> (<?= $consulting_info->manager_id ?>)
								</a>
							<?php } ?>
						</td>
						<th>전체 진행상태</th>
						<td><?= $consulting_status[$consulting_info->status]['name'] ?></td>
					</tr>
					<tr>
						<th>의뢰범위</th>
						<td colspan="3">
							<?php
							$consulting_business = explode(',', str_replace(' ', '', $consulting_info->business));
							foreach ($consulting_business as $business) {
							?>
								<div class="btn btn-secondary"><?= $business_list[$business]['name'] ?></div>
							<?php
							}
							?>
							<div class="mt-5"></div>

							<?php
							foreach ($consulting_work_list as $list) {
							?>
								<div class="mb-5" id="question_div_<?= $list->category ?>">
									<h4><strong><?= $business_list[$list->category]['name'] ?></strong></h4>
									<div class="row">
										<?php
										$question_value = json_decode($list->question_value);
										foreach ($question_value as $qlist) {
										?>
											<div class="mb-3 col-2">
												<div class="border-1px-radius"><?= htmlspecialchars_decode($qlist->answer) ?></div>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
							<div class="mt-5" id="business_questions"></div>
						</td>
					</tr>
					<tr>
						<th>세부사항</th>
						<td colspan="3"><?= nl2br2($consulting_info->request) ?></td>
					</tr>
					<tr>
						<th>상담메모</th>
						<td colspan="3"><?= ($consulting_info->memo) ?></td>
					</tr>
					<!-- <tr>
						<th>답변</th>
						<td colspan="3"><?= ($consulting_info->reply) ?></td>
					</tr> -->
				</tbody>
			</table>

			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
					<col width="11.1%">
				</colgroup>
				<thead>
					<tr>
						<th>등록일</th>
						<th>수정일</th>
						<th>의뢰분야</th>
						<th>담당자</th>
						<th>작업범위</th>
						<th>작업상태</th>
						<th>수정차수</th>
						<th>외주업체</th>
						<th>외주상태</th>
					</tr>
				</thead>
				<tbody id="consulting_work_list_table">
					<?php
					foreach ($consulting_work_list as $wlist) {
					?>
						<tr class="consulting_work_list" id="work_list_tr_<?= $wlist->category ?>" data-segment="<?= $wlist->category ?>">
							<td class="text-center consulting_work_list_regdate"><?= replaceDatetime($wlist->regdate) ?></td>
							<td class="text-center consulting_work_list_moddate"><?= replaceDatetime($wlist->moddate) ?></td>
							<td class="text-center consulting_work_list_name"><?= $business_list[$wlist->category]['name'] ?></td>
							<td class="text-center">
								<?php if ($wlist->manager_idx) { ?>
									<a class="pop_view" data-path="/admin/manager/view/" data-idx="<?= $wlist->manager_idx ?>">
										<?= $wlist->manager_name ?> (<?= $wlist->manager_id ?>)
									</a>
								<?php } ?>
							</td>
							<td class="text-center"><?= replaceConsultingDetailWorkRange($wlist->work_range) ?></td>
							<td class="text-center"><?= replaceConsultingDetailStatus($wlist->status) ?></td>
							<td class="text-center"><?= replaceConsultingDetailModCount($wlist->mod_count) ?></td>
							<td class="text-center">
								<a class="pop_view" data-path="/admin/partner/view/" data-idx="<?= $wlist->partner_idx ?>">
									<?= $wlist->partner_name ?>
								</a>
							</td>
							<td class="text-center"><?= replaceConsultingDetailPartnerStatus($wlist->partner_status) ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>




	<?php
	if ($this->session->userdata("adm_grade") == "0") {
	?>
		<!-- 총괄 담당자 전용 -->
		<div class="card">
			<div class="card-header card-header-strong">
				<div class="card-title card-title-strong">정산</div>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
					<colgroup>
						<col width="12.5%">
						<col width="12.5%">
						<col width="12.5%">
						<col width="12.5%">
						<col width="12.5%">
						<col width="12.5%">
						<col width="12.5%">
						<col width="12.5%">
					</colgroup>
					<thead>
						<tr>
							<th rowspan="2">의뢰분야</th>
							<th rowspan="2">견적금액</th>
							<th rowspan="2">제반비용</th>
							<th colspan="5">외주업체</th>
						</tr>
						<tr>
							<th>업체명</th>
							<th>지불금액</th>
							<th>지불형태</th>
							<th>지불상태</th>
							<th>계산서발행</th>
						</tr>
					</thead>
					<tbody id="calculate_work_list_table">
						<?php
						foreach ($consulting_work_list as $wlist) {
						?>
							<tr class="calculate_work_list" id="calculate_list_tr_<?= $wlist->category ?>" data-segment="<?= $wlist->category ?>">
								<td class="text-center calculate_work_list_name"><?= $business_list[$wlist->category]['name'] ?></td>
								<td class="text-center"><?= number_format($wlist->price) ?></td>
								<td class="text-center"><?= number_format($wlist->expenditure) ?></td>
								<?php if ($wlist->partner_idx) { ?>
									<td>
										<a class="pop_view" data-path="/admin/partner/view/" data-idx="<?= $wlist->partner_idx ?>">
											<?= $wlist->partner_name ?>
										</a>
									</td>
									<td class="text-center"><?= number_format($wlist->out_cost) ?></td>
									<td class="text-center"><?= replaceOutCostType($wlist->out_cost_type) ?></td>
									<td class="text-center"><?= replaceOutCostStatus($wlist->out_cost_status) ?></td>
									<td class="text-center"><?= replaceOutCostBillStatus($wlist->tax_bill_status) ?></td>
								<?php } else { ?>
									<td class="partner_calculate" colspan="5">외주업체가 지정되지 않았습니다.</td>
								<?php } ?>
							</tr>
						<?php } ?>
					</tbody>
				</table>

				<table class="table table-bordered mt-5" width="100%" cellspacing="0">
					<colgroup>
						<col width="15%">
						<col width="35%">
						<col width="15%">
						<col width="35%">
					</colgroup>
					<tbody class="vertical">
						<?php
						$tax_free = ($consulting_info->category == 3) ? true : false;
						$customer_price = $consulting_info->price;
						$customer_price_vat = ($tax_free) ? 0 : $customer_price * 10 / 110;
						$consulting_price = $customer_price - $customer_price_vat;
						?>
						<tr>
							<th>공급가액</th>
							<td id="consulting_total_price"><?= number_format($consulting_price) ?></td>
							<th>총 지출비용</th>
							<td id="consulting_total_out_cost"><?= number_format($consulting_info->out_cost) ?></td>
						</tr>
						<tr>
							<th>수익금액</th>
							<td id="consulting_revenue"><?= number_format($consulting_info->revenue) ?></td>
							<th>수익률</th>
							<td id="consulting_revenue_rate"><?= number_format($consulting_info->revenue_rate, 2) ?>%</td>
						</tr>
						<tr class="bg_blue">
							<th>청구금액</th>
							<td id="consulting_customer_price"><?= number_format($customer_price) ?></td>
							<th>부가세액</th>
							<td id="consulting_price_vat"><?= number_format($customer_price_vat) ?></td>
						</tr>
						<tr>
							<th>정산메모</th>
							<td colspan="3"><?= ($consulting_info->memo2) ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- 총괄 담당자 전용 -->
		<?php $this->load->view('/admin/consulting/v_consulting_log', ['sessions_log' => $sessions_log]); ?>
	<?php
	}
	?>
	<div class="right pb-3">
		<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/reply/<?= $consulting_info->idx ?>/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn bg-olive mr-2">수정</button>
		<button type="button" id="consultingDelBtn" class="btn btn-danger mr-2">삭제</button>
		<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
	</div>
</section>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	let file_path, file_name;
	const curr_idx = '<?= $consulting_info->idx ?>';

	$(function() {
		$("#consultingDelBtn").on("click", function() {
			consultingDelSubmit();
		});
	});

	function consultingDelSubmit() {
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
							location.href = page_info['base_url'] + '/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>';
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