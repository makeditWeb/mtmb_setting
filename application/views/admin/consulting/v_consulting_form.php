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
						<td colspan="2" class="text-center">
							<?php
							if (is_null($consulting_info->customer_idx) || $consulting_info->customer_idx == 0) {
							?>
								<strong class="red">관리중인 고객사와 연결이 되어있지 않습니다.</strong>
								<button type="button" class="btn btn-sm btn-primary mr-2" id="btn-search-company-modal">고객사 검색</button>
							<?php
							}
							?>
						</td>
					</tr>
					<tr>
						<th>기업명</th>
						<td>
							<input name="customer_idx" type="hidden" value="<?= $consulting_info->customer_idx ?>" />
							<input class="form-control form-valid fv_empty" name="name" type="text" placeholder="기업명을 입력하세요." title="기업명" value="<?= htmlspecialchars($consulting_info->name) ?>" />
						</td>
						<th>사업자등록번호</th>
						<td>
							<input class="form-control" name="brn" type="text" placeholder="사업자등록번호를 입력하세요." title="사업자등록번호" value="<?= htmlspecialchars($consulting_info->brn) ?>" />
						</td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td>
							<input class="form-control" name="ceo" type="text" placeholder="대표자명을 입력하세요." title="대표자명" value="<?= htmlspecialchars($consulting_info->ceo) ?>" />
						</td>
						<th>소재지</th>
						<td>
							<div class="input-group">
								<input type="text" class="form-control" id="daumpostcode-addr" name="addr" type="text" placeholder="주소를 검색해주세요" title="주소" value="<?= htmlspecialchars($consulting_info->addr) ?>" readonly>
								<div class="input-group-append">
									<button type="button" class="btn btn-primary btn-find-address">주소검색</button>
								</div>
							</div>
							<input type="text" class="form-control mt-2" id="daumpostcode-addr-more" name="addr_more" type="text" placeholder="상세주소를 입력해주세요." title="상세주소" value="<?= htmlspecialchars($consulting_info->addr_more) ?>">
						</td>
					</tr>
					<tr>
						<th>대표번호</th>
						<td>
							<input class="form-control" name="tel" type="text" placeholder="기업대표번호를 입력하세요." title="기업 대표번호" value="<?= htmlspecialchars($consulting_info->tel) ?>" />
						</td>
						<th>이메일주소</th>
						<td>
							<input class="form-control" name="email" type="text" placeholder="기업 이메일주소를 입력하세요." title="기업 이메일주소" value="<?= htmlspecialchars($consulting_info->email) ?>" />
						</td>
					</tr>
					<tr>
						<th>업태</th>
						<td>
							<input class="form-control" name="business_type" type="text" placeholder="업태를 입력하세요." title="업태" value="<?= htmlspecialchars($consulting_info->business_type) ?>" />
						</td>
						<th>담당자명</th>
						<td>
							<input class="form-control" name="employee_name" type="text" placeholder="담당자 이름을 입력하세요." title="담당자 이름" value="<?= htmlspecialchars($consulting_info->employee_name) ?>" />
						</td>
					</tr>
					<tr>
						<th>종목</th>
						<td>
							<input class="form-control" name="business_item" type="text" placeholder="종목을 입력하세요." title="종목" value="<?= htmlspecialchars($consulting_info->business_item) ?>" />
						</td>
						<th>담당자 연락처</th>
						<td>
							<input class="form-control" name="employee_tel" type="text" placeholder="담당자 연락처를 입력하세요." title="담당자 연락처" value="<?= htmlspecialchars($consulting_info->employee_tel) ?>" />
						</td>
					</tr>
					<tr>
						<th>기업구분</th>
						<td>
							<div class="row">
								<?php
								for ($i = 0; $i < 4; $i++) {
								?>
									<div class="col-3 mt-1">
										<div class="custom-control custom-radio">
											<input class="custom-control-input company_type" type="radio" id="customRadio<?= $i ?>" name="category" value="<?= $i ?>" <?= ($consulting_info->category == $i) ? 'checked' : '' ?>>
											<label for="customRadio<?= $i ?>" class="custom-control-label"><?= replaceCustomerType($i) ?></label>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</td>
						<th>담당자 이메일</th>
						<td>
							<input class="form-control" name="employee_email" type="text" placeholder="담당자 이메일주소를 입력하세요." title="담당자 이메일주소" value="<?= htmlspecialchars($consulting_info->employee_email) ?>" />
						</td>
					</tr>

					<tr>
						<th>문의경로</th>
						<td>
							<div class="row">
								<?php
								for ($i = 0; $i < 3; $i++) {
								?>
									<div class="col-3 mt-1">
										<div class="custom-control custom-radio">
											<input class="custom-control-input" type="radio" id="reg_path_<?= $i ?>" name="reg_path" value="<?= $i ?>" <?= ($consulting_info->reg_path == $i) ? 'checked' : '' ?>>
											<label for="reg_path_<?= $i ?>" class="custom-control-label"><?= replaceConsultingRegPath($i) ?></label>
										</div>
									</div>
								<?php
								}
								?>
							</div>
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
						<td>
							<input class="form-control" name="paydate" type="text" placeholder="날짜를 선택해주세요." title="입금일" value="<?= ($consulting_info->paydate) ? replaceDatetime($consulting_info->paydate) : "" ?>" autocomplete="off" />
						</td>
						<th>종료날짜</th>
						<td>
							<input class="form-control" name="enddate" type="text" placeholder="날짜를 선택해주세요." title="종료일" value="<?= ($consulting_info->enddate) ? replaceDatetime($consulting_info->enddate) : "" ?>" autocomplete="off" />
						</td>
					</tr>
					<tr>
						<th>총괄 담당자</th>
						<td>
							<select class="form-control" name="manager_info" style="width: 100%;">
								<option>지정 없음</option>
								<?php
								foreach ($manager_list as $mlist) {
								?>
									<option data-idx="<?= $mlist->idx ?>" data-name="<?= $mlist->name ?>" data-adm_id="<?= $mlist->adm_id ?>" <?= ($mlist->idx == $consulting_info->manager_idx) ? 'selected' : '' ?>><?= $mlist->name ?> (<?= $mlist->adm_id ?>)</option>
								<?php
								}
								?>
							</select>
						</td>
						<th>전체 진행상태</th>
						<td>
							<div class="row">
								<?php
								$status_list = $consulting_status;
								array_multisort(array_column($status_list, 'sort'), SORT_ASC, $status_list);
								foreach ($status_list as $key => $val) {
								?>
									<div class="col-4 mt-1 mb-2">
										<div class="custom-control custom-radio">
											<input class="custom-control-input" type="radio" id="customRadio2<?= $val['code'] ?>" name="status" value="<?= $val['code'] ?>" <?= ($consulting_info->status == $val['code']) ? 'checked' : '' ?>>
											<label for="customRadio2<?= $val['code'] ?>" class="custom-control-label"><?= $val['name'] ?></label>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</td>
					</tr>
					<tr>
						<th>의뢰범위</th>
						<td colspan="3">
							<div class="row mb-5">
								<?php
								$arr_work_category = explode(',', str_replace(' ', '', $consulting_info->business));
								$i = 0;
								foreach ($business_list as $blist) {
								?>
									<div class="col-2 mt-1 mb-2">
										<div class="form-check">
											<input class="form-check-input consulting_category" data-segment="<?= $blist['segment'] ?>" type="checkbox" id="cate_<?= $i ?>" value="<?= $blist['name'] ?>" <?= in_array($blist['segment'], $arr_work_category) ? 'checked' : '' ?>>
											<label class="form-check-label" for="cate_<?= $i ?>"><strong><?= $blist['name'] ?></strong></label>
										</div>
										<?php $i++; ?>
									</div>
								<?php
								}
								?>
							</div>
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
						<th>상담 메모</th>
						<td colspan="3">
							<textarea class="snEditor" data-height="150" name="memo" title="메모"><?= htmlspecialchars($consulting_info->memo) ?></textarea>
						</td>
					</tr>
					<!-- <tr>
						<th>답변</th>
						<td colspan="3">
							<form method="post">
								<textarea class="snEditor" data-height="150" name="reply" title="메모"><?= $consulting_info->reply ?></textarea>
							</form>
						</td>
					</tr> -->
				</tbody>
			</table>

			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="14.2%">
					<col width="14.2%">
					<col width="14.2%">
					<col width="14.2%">
					<col width="14.2%">
					<col width="14.2%">
					<col width="14.2%">
				</colgroup>
				<thead>
					<tr>
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
							<td class="text-center consulting_work_list_name"><?= $business_list[$wlist->category]['name'] ?></td>
							<td class="text-center">
								<select class="form-control" name="sub_manager_info" style="width: 100%;">
									<option>지정 없음</option>
									<?php
									foreach ($manager_list as $mlist) {
									?>
										<option data-idx="<?= $mlist->idx ?>" data-name="<?= $mlist->name ?>" data-adm_id="<?= $mlist->adm_id ?>" <?= ($mlist->idx == $wlist->manager_idx) ? 'selected' : '' ?>><?= $mlist->name ?> (<?= $mlist->adm_id ?>)</option>
									<?php
									}
									?>
								</select>
							</td>
							<td class="text-center">
								<select class="form-control" name="work_range">
									<option value="0" <?= ($wlist->work_range == "0") ? 'selected' : '' ?>><?= replaceConsultingDetailWorkRange("0") ?></option>
									<option value="1" <?= ($wlist->work_range == "1") ? 'selected' : '' ?>><?= replaceConsultingDetailWorkRange("1") ?></option>
									<option value="2" <?= ($wlist->work_range == "2") ? 'selected' : '' ?>><?= replaceConsultingDetailWorkRange("2") ?></option>
								</select>
							</td>
							<td class="text-center">
								<select class="form-control" name="detail_status">
									<option value="0" <?= ($wlist->status == "0") ? 'selected' : '' ?>><?= replaceConsultingDetailStatus("0") ?></option>
									<option value="1" <?= ($wlist->status == "1") ? 'selected' : '' ?>><?= replaceConsultingDetailStatus("1") ?></option>
									<option value="2" <?= ($wlist->status == "2") ? 'selected' : '' ?>><?= replaceConsultingDetailStatus("2") ?></option>
									<option value="3" <?= ($wlist->status == "3") ? 'selected' : '' ?>><?= replaceConsultingDetailStatus("3") ?></option>
									<option value="4" <?= ($wlist->status == "4") ? 'selected' : '' ?>><?= replaceConsultingDetailStatus("4") ?></option>
								</select>
							</td>
							<td class="text-center">
								<select class="form-control" name="detail_mod_count">
									<option value="0" <?= ($wlist->mod_count == "0") ? 'selected' : '' ?>><?= replaceConsultingDetailModCount("0") ?></option>
									<option value="1" <?= ($wlist->mod_count == "1") ? 'selected' : '' ?>><?= replaceConsultingDetailModCount("1") ?></option>
									<option value="2" <?= ($wlist->mod_count == "2") ? 'selected' : '' ?>><?= replaceConsultingDetailModCount("2") ?></option>
									<option value="3" <?= ($wlist->mod_count == "3") ? 'selected' : '' ?>><?= replaceConsultingDetailModCount("3") ?></option>
									<option value="4" <?= ($wlist->mod_count == "4") ? 'selected' : '' ?>><?= replaceConsultingDetailModCount("4") ?></option>
									<option value="5" <?= ($wlist->mod_count == "5") ? 'selected' : '' ?>><?= replaceConsultingDetailModCount("5") ?></option>
								</select>
							</td>
							<td class="text-center">
								<select class="form-control partner_info" name="partner_info" style="width: 100%;">
									<option data-segment="<?= $wlist->category ?>">내부작업</option>
									<?php
									foreach ($partner_list as $plist) {
									?>
										<option data-segment="<?= $wlist->category ?>" data-idx="<?= $plist->idx ?>" data-name="<?= $plist->name ?>" <?= ($plist->idx == $wlist->partner_idx) ? 'selected' : '' ?>><?= $plist->name ?></option>
									<?php
									}
									?>
								</select>
							</td>
							<td class="text-center">
								<select class="form-control" name="partner_status">
									<option value="0" <?= ($wlist->partner_status == "0") ? 'selected' : '' ?>><?= replaceConsultingDetailPartnerStatus("0") ?></option>
									<option value="1" <?= ($wlist->partner_status == "1") ? 'selected' : '' ?>><?= replaceConsultingDetailPartnerStatus("1") ?></option>
									<option value="2" <?= ($wlist->partner_status == "2") ? 'selected' : '' ?>><?= replaceConsultingDetailPartnerStatus("2") ?></option>
									<option value="3" <?= ($wlist->partner_status == "3") ? 'selected' : '' ?>><?= replaceConsultingDetailPartnerStatus("3") ?></option>
									<option value="4" <?= ($wlist->partner_status == "4") ? 'selected' : '' ?>><?= replaceConsultingDetailPartnerStatus("4") ?></option>
									<option value="5" <?= ($wlist->partner_status == "5") ? 'selected' : '' ?>><?= replaceConsultingDetailPartnerStatus("5") ?></option>
								</select>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<?php if ($this->session->userdata("adm_grade") == "0") { ?>
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
								<td class="text-center">
									<input class="form-control price" name="price" type="number" placeholder="금액을 입력하세요." title="견적금액" value="<?= ($wlist->price) ?>" />
								</td>
								<td class="text-center">
									<input class="form-control expenditure" name="expenditure" type="number" placeholder="금액을 입력하세요." title="지출비용" value="<?= ($wlist->expenditure) ?>" />
								</td>
								<?php if ($wlist->partner_idx) { ?>
									<td class="partner_calculate">
										<a class="pop_view" data-path="/admin/partner/view/" data-idx="<?= $wlist->partner_idx ?>">
											<?= $wlist->partner_name ?>
										</a>
									</td>
									<td class="partner_calculate text-center">
										<input class="form-control out_cost" name="out_cost" type="number" placeholder="금액을 입력하세요." title="외주 지불금액" value="<?= ($wlist->out_cost) ?>" />
									</td>
									<td class="partner_calculate text-center">
										<select class="form-control w100per out_cost_type" name="out_cost_type">
											<option value="0">지정 없음</option>
											<option value="1" <?= ($wlist->out_cost_type == '1') ? 'selected' : '' ?>>무통장입금</option>
											<option value="2" <?= ($wlist->out_cost_type == '2') ? 'selected' : '' ?>>카드결제</option>
										</select>
									</td>
									<td class="partner_calculate text-center">
										<select class="form-control w100per out_cost_status" name="out_cost_status">
											<option value="0">지정 없음</option>
											<option value="1" <?= ($wlist->out_cost_status == '1') ? 'selected' : '' ?>>지불 전</option>
											<option value="2" <?= ($wlist->out_cost_status == '2') ? 'selected' : '' ?>>지불완료</option>
										</select>
									</td>
									<td class="partner_calculate text-center">
										<select class="form-control w100per tax_bill_status" name="tax_bill_status">
											<option value="0" <?= ($wlist->tax_bill_status == '0') ? 'selected' : '' ?>>발행전</option>
											<option value="1" <?= ($wlist->tax_bill_status == '1') ? 'selected' : '' ?>>발행완료</option>
										</select>
									</td>
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
							<td colspan="3">
								<textarea class="snEditor" data-height="150" name="memo2" title="메모"><?= htmlspecialchars($consulting_info->memo2) ?></textarea>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- 총괄 담당자 전용 -->

		<?php $this->load->view('/admin/consulting/v_consulting_log', ['sessions_log' => $sessions_log]); ?>
	<?php } ?>

	<div class="right pb-3">
		<button type="button" class="btn bg-olive mr-2" id="btn-consulting-save">저장</button>
		<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
	</div>
</section>

<div class="modal" id="modal-company" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modal-company-title">고객사 검색</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modal-company-content">
				<div class="input-group fright w90per ml-2">
					<input class="form-control" type="search" id="modal-company-schkeyword" placeholder="업체명, 사업자 등록번호, 대표자명, 대표번호, 소재지로 검색" value="<?= $page_info['sch_keyword'] ?>" autocomplete="off">
					<div class="input-group-append">
						<button type="button" class="btn btn-primary" id="btn-search-company">검색</button>
					</div>
				</div>
				<div class="fclear"></div>
				<div style="max-height:600px; overflow-y: auto;">
					<table class="table table-bordered list_table mt-2 table-hover" width="100%" cellspacing="0">
						<colgroup>
							<col width="10%">
							<col width="13%">
							<col width="13%">
							<col width="13%">
							<col width="13%">
							<col width="35%">
						</colgroup>
						<thead>
							<tr>
								<th>구분</th>
								<th>업체명</th>
								<th>사업자등록번호</th>
								<th>대표자명</th>
								<th>대표번호</th>
								<th>소재지</th>
							</tr>
						</thead>
						<tbody id="modal-company-list-table">
							<tr>
								<td class="center red" colspan="6">검색어를 입력해주세요.</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary closeModalBtn">닫기</button>
			</div>
		</div>
	</div>
</div>

<link href="/resources/admin/summernote-0.8.18-dist/summernote-bs4.css" rel="stylesheet" />
<script src="/resources/admin/summernote-0.8.18-dist/summernote-bs4.js"></script>
<script src="/resources/admin/summernote-0.8.18-dist/lang/summernote-ko-KR.js"></script>

<link href="/resources/admin/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script src="/resources/admin/daterangepicker/daterangepicker.js"></script>
<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $consulting_info->idx ?>';

	let modal_schkeyword;
	let par_tags, tr_tags, td_tags, a_tags, input_tags, select_tags, option_tags;
	let del_category_list = [];
	let question_values = [];
	let work_values = [];
	let new_tr_line;

	let price, expenditure, out_cost, revenue;
	let total_price = 0;
	let total_expenditure = 0;
	let customer_price = 0;
	let price_vat = 0;
	let total_out_cost = 0;
	let revenue_rate = 0.0;
	let tax_free = false;

	const uploadPathInfo = {
		"method": "/admin/consulting/editorUpload/",
		"upPath": "/uploads/editor/consulting/"
	};

	$(function() {
		$("#btn-search-company-modal").on('click', function() {
			initComplanyList();
			$("#modal-company").modal();
		});

		$("#modal-company-schkeyword").on("keypress", function(e) {
			if (e.keyCode == 13) schCompanyList();
		});

		$("#btn-search-company").on('click', function() {
			schCompanyList();
		});

		$(document).on('click', '.select-search-company', function() {
			companySelect($(this).data());
		});

		$(".consulting_category").on("click", function() {
			var segment = $(this).data('segment');
			choose_category_list = [];
			if ($(this).is(":checked")) {
				setBusinessQuestions(segment, $(this).val());
			} else {
				if ($(".consulting_category:checked").length > 0) {
					del_category_list.push(segment);
					$("#question_div_" + segment).remove();
					$("#work_list_tr_" + segment).remove();
					$("#calculate_list_tr_" + segment).remove();
					const set_arr = new Set(del_category_list);
					del_category_list = [...set_arr];
				} else {
					$modal_alert(page_info['curr_title'], '최소 1개이상의 의뢰범위가 있어야 합니다.', function() {
						$modal_hide();
					});
					return false;
				}
			}
		});

		$("#btn-consulting-save").on("click", function() {
			consultingSubmit();
		});

		$("input[name=paydate]").daterangepicker(daterangepicker_options_single, function(sDate, eDate) {			
			$("input[name=paydate]").val(sDate.format('YYYY-MM-DD HH:mm'));
		});

		$("input[name=enddate]").daterangepicker(daterangepicker_options_single, function(date) {
			$("input[name=enddate]").val(date.format('YYYY-MM-DD HH:mm'));
		});
	});

	function initComplanyList() {
		$("#modal-company-list-table").empty();
		var empty_tags = $('<tr/>').append($('<td/>', {
			class: 'center red',
			colspan: '6'
		}).text('검색어를 입력해주세요.'));
		$("#modal-company-list-table").append(empty_tags);
		$("#modal-company-schkeyword").val("");
	}

	function schCompanyList() {
		modal_schkeyword = $("#modal-company-schkeyword").val();
		if (modal_schkeyword.length > 0) {
			$.post('/admin/customer/customerList/', {
				'sch_keyword': modal_schkeyword
			}, function(data) {
				var result = JSON.parse(data);
				if (result.flag) {
					setSearchCompanyList(result.data);
				} else {
					$modal_alert(page_info['curr_title'], result.message, function() {
						$modal_hide();
					});
				}
			});
		}
	}

	function setSearchCompanyList(listData) {
		par_tags = $("#modal-company-list-table").empty();
		if (listData.length > 0) {
			par_tags = $("#modal-company-list-table");
			$(listData).each(function(index, data) {
				tr_tags = $("<tr/>", {
					class: 'cursor-pointer select-search-company',
					data: {
						'customer_idx': data.idx,
						'category': data.category,
						'name': data.name,
						'brn': data.brn,
						'ceo': data.ceo,
						'tel': data.tel,
						'email': data.email,
						'business_type': data.business_type,
						'business_item': data.business_item,
						'addr': data.addr,
						'addr_more': data.addr_more
					}
				});
				td_tags = $("<td/>").text(replaceCustomerType(data.category));
				tr_tags.append(td_tags);
				td_tags = $("<td/>").text(data.name);
				tr_tags.append(td_tags);
				td_tags = $("<td/>").text(data.brn);
				tr_tags.append(td_tags);
				td_tags = $("<td/>").text(data.ceo);
				tr_tags.append(td_tags);
				td_tags = $("<td/>").text(data.tel);
				tr_tags.append(td_tags);
				td_tags = $("<td/>").text(data.addr + ' ' + data.addr_more);
				tr_tags.append(td_tags);
				par_tags.append(tr_tags);
			});
		} else {
			$("#modal-company-list-table").empty();
			var empty_tags = $('<tr/>').append($('<td/>', {
				class: 'center red',
				colspan: '6'
			}).text('조회된 고객사가 없습니다.'));
			$("#modal-company-list-table").append(empty_tags);
		}
	}

	function companySelect(sch_data) {
		$("input[name=customer_idx]").val(sch_data.customer_idx);
		$("input[name=name]").val(sch_data.name);
		$("input[name=brn]").val(sch_data.brn);
		$("input[name=ceo]").val(sch_data.ceo);
		$("input[name=tel]").val(sch_data.tel);
		$("input[name=email]").val(sch_data.email);
		$("input[name=business_type]").val(sch_data.business_type);
		$("input[name=business_item]").val(sch_data.business_item);
		$("input[name=addr]").val(sch_data.addr);
		$("input[name=addr_more]").val(sch_data.addr_more);

		$("input[name=category]").each(function(index, val) {
			if (sch_data.category == val.value) $(this).attr('checked', true);
		});

		$modal_hide();
	}

	function setBusinessQuestions(segment, label) {
		let param_category = [segment];
		var par_idv = $("#business_questions");
		$.post('/admin/consulting/questionList', {
			'category': param_category
		}, function(data) {
			var result = JSON.parse(data);
			if (result.flag) {
				var category_tags = $('<div/>', {
					class: 'mb-5',
					id: 'question_div_' + segment
				}).append($('<h1/>').text(label));

				var question_list = result.data.questions.filter(question => question.segment == segment);

				$.each(question_list, function(key, val) {
					var question_val = val.question;
					var question_id = segment + '_' + val.idx;
					var input_name = question_id;

					var question_tags = $('<div/>', {
						class: 'mb-3 border-1px-radius question_list'
					}).html(question_val);
					var answer_list = result.data.answers.filter(answer => answer.question_idx == val.idx);

					$.each(answer_list, function(key, val) {
						answer_id = question_id + '_' + val.idx;
						var answer_tags = $('<div/>', {
							class: 'custom-control custom-radio'
						});
						var radio_tags = $('<input/>', {
							class: 'custom-control-input choose_question_answer',
							type: 'radio',
							data: {
								'segment': segment,
								'questionidx': val.question_idx,
								'question': question_val,
								'answeridx': val.idx,
								'answer': val.answer
							},
							name: input_name,
							id: answer_id
						});
						var label_tags = $('<label/>', {
							for: answer_id,
							class: 'custom-control-label'
						}).html(val.answer);
						$(answer_tags).append(radio_tags).append(label_tags);
						$(question_tags).append(answer_tags);
					});

					$(category_tags).append(question_tags);
				});
				$(par_idv).append(category_tags);

				new_tr_line = $(".consulting_work_list").last().clone();
				$(new_tr_line).attr("id", 'work_list_tr_' + segment);
				// $(new_tr_line).data("segment", segment);
				$(new_tr_line).attr("data-segment", segment);
				$(new_tr_line).find("select").each(function() {
					$(this).children("option").eq(0).attr("selected", true);
				});
				// $(new_tr_line).children(".partner_info option").data("segment", segment);				
				$(new_tr_line).find(".partner_info option").attr("data-segment", segment);
				$(new_tr_line).children(".consulting_work_list_name").html(label);
				$("#consulting_work_list_table").append(new_tr_line);

				if ($("#calculate_work_list_table").length > 0) {
					new_tr_line = $(".calculate_work_list").last().clone();
					$(new_tr_line).attr("id", 'calculate_list_tr_' + segment);
					// $(new_tr_line).data("segment", segment);
					$(new_tr_line).attr("data-segment", segment);
					$(new_tr_line).find("select").each(function() {
						$(this).children("option").eq(0).attr("selected", true);
					});
					$(new_tr_line).find("input[type=number]").each(function() {
						$(this).val("");
					});
					$(new_tr_line).children(".calculate_work_list_name").html(label);
					$("#calculate_work_list_table").append(new_tr_line);
				}
			} else {
				alert(result.message);
			}
		});
	}

	function consultingSubmit() {
		var manager_info = $("select[name=manager_info]").children("option:selected").data();
		var form_data = {
			"idx": curr_idx,
			"category": $("input[name=category]:checked").val(),
			"customer_idx": $("input[name=customer_idx]").val(),
			"name": $("input[name=name]").val(),
			"brn": $("input[name=brn]").val(),
			"ceo": $("input[name=ceo]").val(),
			"addr": $("input[name=addr]").val(),
			"addr_more": $("input[name=addr_more]").val(),
			"business_type": $("input[name=business_type]").val(),
			"business_item": $("input[name=business_item]").val(),
			"tel": $("input[name=tel]").val(),
			"email": $("input[name=email]").val(),
			"employee_name": $("input[name=employee_name]").val(),
			"employee_tel": $("input[name=employee_tel]").val(),
			"employee_email": $("input[name=employee_email]").val(),
			"memo": $("textarea[name=memo]").val(),
			"reply": $("textarea[name=reply]").val(),
			"status": $("input[name=status]:checked").val(),
			"manager_idx": (manager_info.idx) ? manager_info.idx : 0,
			"manager_id": (manager_info.adm_id) ? manager_info.adm_id : '',
			"manager_name": (manager_info.name) ? manager_info.name : '',
			"reg_path": $("input[name=reg_path]:checked").val(),
			"paydate": $("input[name=paydate]").val(),
			"enddate": $("input[name=enddate]").val(),
		};

		question_values = [];
		$(".choose_question_answer:checked").each(function() {
			var this_data = $(this).data();
			question_values.push({
				'segment': this_data.segment,
				'question_idx': this_data.questionidx,
				'question': this_data.question,
				'answer_idx': this_data.answeridx,
				'answer': this_data.answer
			});
		});

		work_values = [];
		$(".consulting_work_list").each(function() {
			var segment = $(this).data('segment');
			var sub_manager_info = $(this).find('select[name=sub_manager_info]').children("option:selected").data();
			var partner_info = $(this).find('.partner_info option:selected').data();

			work_values.push({
				'segment': segment,
				"manager_idx": (sub_manager_info.idx) ? sub_manager_info.idx : 0,
				"manager_id": (sub_manager_info.adm_id) ? sub_manager_info.adm_id : '',
				"manager_name": (sub_manager_info.name) ? sub_manager_info.name : '',
				"work_range": $(this).find('select[name=work_range]').val(),
				'status': $(this).find('select[name=detail_status]').val(),
				'mod_count': $(this).find('select[name=detail_mod_count]').val(),
				'partner_idx': (partner_info.idx) ? partner_info.idx : 0,
				'partner_name': (partner_info.name) ? partner_info.name : '',
				'partner_status': $(this).find('select[name=partner_status]').val()
			});
		});

		form_data['del_category_list'] = (del_category_list);
		form_data['question_values'] = (question_values);
		form_data['work_values'] = (work_values);

		$.ajax({
			method: "POST",
			url: page_info['base_url'] + "/save",
			beforeSend: function(xhr, opts) {
				if (!formValidate()) {
					xhr.abort();
					return false;
				}

				if (question_values.length != $(".question_list").length) {
					$modal_alert(page_info['curr_title'], '모든 질문에 답변을 체크해주셔야 합니다.', function() {
						$modal_hide();
					});
					return;
				}
			},
			data: form_data,
			success: function(data) {
				var result = JSON.parse(data);
				calculateSubmit(result);
			}
		});
	}

	let calculateSubmit = function(info_result) {
		if (info_result.flag) {
			$modal_alert(page_info['curr_title'], info_result.message, function() {
				location.reload();
			});
		} else {
			$modal_alert(page_info['curr_title'], info_result.message, function() {
				$modal_hide();
			});
		}
	};
</script>


<!-- 총괄 담당자 전용 -->
<?php if ($this->session->userdata("adm_grade") == "0") { ?>
	<script>
		$(function() {
			$(document).on("change", ".partner_info", function() {
				var choose_partner = $(this).children("option:selected");
				setPartnerCalculate(choose_partner);
			});

			$(document).on('keyup', ".price, .expenditure, .out_cost", function() {
				calculate_all();
				$("#consulting_customer_price").text(format_number(customer_price));
				$("#consulting_total_price").text(format_number(total_price));
				$("#consulting_price_vat").text(format_number(price_vat));
				$("#consulting_revenue").text(format_number(revenue));
				$("#consulting_revenue_rate").text(revenue_rate + '%');
				$("#consulting_total_out_cost").text(format_number(total_out_cost));
			});

			tax_free = ($(".company_type:checked").val() == 3) ? true : false;

			$(".company_type").on("change", function() {
				calculate_all();
				$("#consulting_customer_price").text(format_number(customer_price));
				$("#consulting_total_price").text(format_number(total_price));
				$("#consulting_price_vat").text(format_number(price_vat));
				$("#consulting_revenue").text(format_number(revenue));
				$("#consulting_revenue_rate").text(revenue_rate + '%');
				$("#consulting_total_out_cost").text(format_number(total_out_cost));
			});
		});

		function setPartnerCalculate(partnerInfo) {
			// console.log(
			// 	partnerInfo.index(),
			// 	partnerInfo.data("segment"),
			// 	partnerInfo.data("idx"),
			// 	partnerInfo.data("name")
			// );

			par_tags = $("#calculate_list_tr_" + partnerInfo.data("segment"));
			par_tags.children(".partner_calculate").remove();
			par_tags

			if (partnerInfo.index() == 0) {

				td_tags = $("<td/>", {
					class: "partner_calculate",
					colspan: 5
				}).text("외주업체가 지정되지 않았습니다.");
				par_tags.append(td_tags);
			} else {
				td_tags = $("<td/>", {
					class: "partner_calculate"
				});
				a_tags = $("<a/>", {
					class: "pop_view",
					data: {
						"path": "/admin/partner/view/",
						"idx": partnerInfo.data("idx")
					}
				}).text(partnerInfo.data("name"));
				td_tags.append(a_tags);
				par_tags.append(td_tags);

				td_tags = $("<td/>", {
					class: "partner_calculate text-center"
				});
				input_tags = $("<input/>", {
					class: "form-control out_cost",
					name: "out_cost",
					type: "number",
					placeholder: "금액을 입력하세요.",
					title: "외주 지불금액",
					value: "0",
				});
				td_tags.append(input_tags);
				par_tags.append(td_tags);

				td_tags = $("<td/>", {
					class: "partner_calculate text-center"
				});
				select_tags = $("<select/>", {
					class: "form-control w100per out_cost_type",
					name: "out_cost_type",
				})
				option_tags = $("<option/>", {
					value: "0"
				}).text("지정 없음");
				select_tags.append(option_tags);
				option_tags = $("<option/>", {
					value: "1"
				}).text("무통장입금");
				select_tags.append(option_tags);
				option_tags = $("<option/>", {
					value: "2"
				}).text("카드결제");
				select_tags.append(option_tags);
				td_tags.append(select_tags);
				par_tags.append(td_tags);

				td_tags = $("<td/>", {
					class: "partner_calculate text-center"
				});
				select_tags = $("<select/>", {
					class: "form-control w100per out_cost_status",
					name: "out_cost_status",
				})
				option_tags = $("<option/>", {
					value: "0"
				}).text("지정 없음");
				select_tags.append(option_tags);
				option_tags = $("<option/>", {
					value: "1"
				}).text("지불 전");
				select_tags.append(option_tags);
				option_tags = $("<option/>", {
					value: "2"
				}).text("지불완료");
				select_tags.append(option_tags);
				td_tags.append(select_tags);
				par_tags.append(td_tags);

				td_tags = $("<td/>", {
					class: "partner_calculate text-center"
				});
				select_tags = $("<select/>", {
					class: "form-control w100per tax_bill_status",
					name: "tax_bill_status",
				})
				option_tags = $("<option/>", {
					value: "0"
				}).text("발행전");
				select_tags.append(option_tags);
				option_tags = $("<option/>", {
					value: "1"
				}).text("발행완료");
				select_tags.append(option_tags);
				td_tags.append(select_tags);
				par_tags.append(td_tags);
			}
		}

		function calculate_all() {
			total_price = 0;
			total_expenditure = 0;
			total_out_cost = 0;
			customer_price = 0;

			$(".price").each(function() { // 개별 견적금액 합산
				price = ($(this).val()) ? $(this).val() : 0;
				total_price += parseInt(price);
			});

			$(".expenditure").each(function() { // 개별 지출금액 합산
				expenditure = ($(this).val()) ? $(this).val() : 0;
				total_expenditure += parseInt(expenditure);
			});

			$(".out_cost").each(function() { // 개별 외주비용 합산
				out_cost = ($(this).val()) ? $(this).val() : 0;
				total_out_cost += parseInt(out_cost);
			});

			tax_free = ($(".company_type:checked").val() == 3) ? true : false;

			price_vat = (tax_free) ? 0 : parseInt(total_price * 0.1); // 부가세액
			total_out_cost += total_expenditure; // 전체 지출비용
			customer_price = total_price + price_vat; // 청구 금액
			revenue = (total_price - total_out_cost) // 수익 금액
			revenue_rate = ((revenue / total_price) * 100).toFixed(2); // 수익률
		}

		calculateSubmit = function(info_result) {
			calculate_all();

			if (!info_result.flag) {
				$modal_alert(page_info['curr_title'], info_result.message, function() {
					$modal_hide();
				});
				return false;
			}

			var form_data = {
				"idx": curr_idx,
				"price": customer_price,
				"out_cost": total_out_cost,
				"revenue": revenue,
				"revenue_rate": revenue_rate,
				"memo2": $("textarea[name=memo2]").val()
			};

			work_values = [];
			$(".calculate_work_list").each(function() {
				// work_idx = $(this).data('idx');
				category = $(this).data("segment");
				price = $(this).find('.price').val();
				expenditure = $(this).find('.expenditure').val();
				out_cost = $(this).find('.out_cost').val();
				out_cost_type = $(this).find('.out_cost_type').val();
				out_cost_status = $(this).find('.out_cost_status').val();
				tax_bill_status = $(this).find('.tax_bill_status').val();

				work_values.push({
					// "work_idx": work_idx,				
					"category": category,
					"price": price,
					"expenditure": expenditure,
					"out_cost": out_cost,
					"out_cost_type": out_cost_type,
					"out_cost_status": out_cost_status,
					"tax_bill_status": tax_bill_status
				});
			});

			form_data['work_values'] = (work_values);

			$.ajax({
				method: "POST",
				url: "/admin/calculate/save",
				beforeSend: function(xhr, opts) {
					if (!formValidate()) xhr.abort();
				},
				data: form_data,
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
	</script>
<?php } ?>