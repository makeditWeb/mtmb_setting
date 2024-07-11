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
						<th>컨설팅 접수번호</th>
						<td>
							<a class="pop_view" data-path="/admin/consulting/view/" data-idx="<?= $consulting_info->idx ?>">
								<?= $consulting_info->idx ?>
							</a>
						</td>
						<th>기업명</th>
						<td>
							<a class="pop_view" data-path="/admin/customer/view/" data-idx="<?= $consulting_info->customer_idx ?>">
								<?= htmlspecialchars($consulting_info->name) ?>
							</a>
						</td>
					</tr>
					<tr>
						<th>총괄 담당자</th>
						<td>
							<?= $consulting_info->manager_name ?>
							(<?= $consulting_info->manager_id ?>)
						</td>
						<th>전체 진행상태</th>
						<td><?= $consulting_status[$consulting_info->status]['name'] ?></td>
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
			<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
				<colgroup>
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th rowspan="2">등록일</th>
						<th rowspan="2">수정일</th>
						<th rowspan="2">의뢰분야</th>
						<th rowspan="2">견적금액</th>
						<th rowspan="2">지출비용</th>
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
				<tbody id="consulting_work_list_table">
					<?php
					foreach ($consulting_work_list as $wlist) {
					?>
						<tr class="consulting_work_list" data-idx="<?= $wlist->idx ?>">
							<td class="text-center consulting_work_list_regdate"><?= replaceDatetime($wlist->regdate) ?></td>
							<td class="text-center consulting_work_list_moddate"><?= replaceDatetime($wlist->moddate) ?></td>
							<td class="text-center consulting_work_list_name"><?= $business_list[$wlist->category]['name'] ?></td>
							<td class="text-center">
								<input class="form-control price" name="price" type="number" placeholder="금액을 입력하세요." title="견적금액" value="<?= ($wlist->price) ?>" />
							</td>
							<td class="text-center">
								<input class="form-control expenditure" name="expenditure" type="number" placeholder="금액을 입력하세요." title="견적금액" value="<?= ($wlist->expenditure) ?>" />
							</td>
							<?php if ($wlist->partner_idx) { ?>
								<td>
									<a class="pop_view" data-path="/admin/partner/view/" data-idx="<?= $wlist->partner_idx ?>">
										<?= $wlist->partner_name ?>
									</a>
								</td>
								<td class="text-center">
									<input class="form-control out_cost" name="out_cost" type="number" placeholder="금액을 입력하세요." title="외주 지불금액" value="<?= ($wlist->out_cost) ?>" />
								</td>
								<td class="text-center">
									<select class="form-control out_cost_type" name="out_cost_type" style="width: 100%;">
										<option value="0">지정 없음</option>
										<option value="1" <?= ($wlist->out_cost_type == '1') ? 'selected' : '' ?>>무통장입금</option>
										<option value="2" <?= ($wlist->out_cost_type == '2') ? 'selected' : '' ?>>카드결제</option>
									</select>
								</td>
								<td class="text-center">
									<select class="form-control out_cost_status" name="out_cost_status" style="width: 100%;">
										<option value="0">지정 없음</option>
										<option value="1" <?= ($wlist->out_cost_status == '1') ? 'selected' : '' ?>>지불 전</option>
										<option value="2" <?= ($wlist->out_cost_status == '2') ? 'selected' : '' ?>>지불완료</option>
									</select>
								</td>
								<td class="text-center">
									<select class="form-control tax_bill_status" name="tax_bill_status" style="width: 100%;">
										<option value="0" <?= ($wlist->tax_bill_status == '0') ? 'selected' : '' ?>>발행전</option>
										<option value="1" <?= ($wlist->tax_bill_status == '1') ? 'selected' : '' ?>>발행완료</option>
									</select>
								</td>
							<?php } else { ?>
								<td colspan="5">외주업체가 지정되지 않았습니다.</td>
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
					$customer_price = $consulting_info->price;
					$customer_price_vat = $customer_price * 10 / 110;
					$consulting_price = $customer_price - $customer_price_vat;
					?>
					<tr>
						<th>총 견적금액</th>
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
					<tr>
						<th>청구금액 (VAT 포함)</th>
						<td id="consulting_customer_price"><?= number_format($customer_price) ?></td>
						<th>부가세액</th>
						<td id="consulting_price_vat"><?= number_format($customer_price_vat) ?></td>
					</tr>
				</tbody>
			</table>
			<div class="right mt-2">
				<button type="button" class="btn bg-olive mr-2" id="btn-consulting-save">저장</button>
				<button type="button" onclick="location.href='<?= $page_info['base_url'] ?>/list/<?= $page_info['url_param'] ?>&curr_page=<?= $page_info['curr_page'] ?>'" class="btn btn-secondary">목록</button>
			</div>
		</div>
	</div>
</section>

<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');
	const curr_idx = '<?= $consulting_info->idx ?>';
	let price, expenditure, out_cost, out_cost_type, out_cost_status, tax_bill_status, revenue, work_idx;
	let total_price = 0;
	let total_expenditure = 0;
	let customer_price = 0;
	let price_vat = 0;
	let total_out_cost = 0;
	let revenue_rate = 0.0;

	$(function() {
		$("#btn-consulting-save").on("click", function() {
			calculateSubmit();
		});

		$(".price, .expenditure, .out_cost").on('keyup', function() {
			calculate_all();
			$("#consulting_customer_price").text(format_number(customer_price));
			$("#consulting_total_price").text(format_number(total_price));
			$("#consulting_price_vat").text(format_number(price_vat));
			$("#consulting_revenue").text(format_number(revenue));
			$("#consulting_revenue_rate").text(revenue_rate + '%');
			$("#consulting_total_out_cost").text(format_number(total_out_cost));
		});
	});

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

		price_vat = parseInt(total_price * 0.1); // 부가세액
		total_out_cost += total_expenditure; // 전체 지출비용
		customer_price = parseInt(total_price * 1.1); // 청구 금액
		revenue = (total_price - total_out_cost) // 수익 금액
		revenue_rate = ((revenue / total_price) * 100).toFixed(2); // 수익률
	}


	function calculateSubmit() {
		calculate_all();

		var form_data = {
			"idx": curr_idx,
			"price": customer_price,
			"out_cost": total_out_cost,
			"revenue": revenue,
			"revenue_rate": revenue_rate
		};

		work_values = [];
		$(".consulting_work_list").each(function() {
			work_idx = $(this).data('idx');
			price = $(this).find('.price').val();
			expenditure = $(this).find('.expenditure').val();
			out_cost = $(this).find('.out_cost').val();
			out_cost_type = $(this).find('.out_cost_type').val();
			out_cost_status = $(this).find('.out_cost_status').val();
			tax_bill_status = $(this).find('.tax_bill_status').val();

			work_values.push({
				"work_idx": work_idx,
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
			url: page_info['base_url'] + "/save",
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