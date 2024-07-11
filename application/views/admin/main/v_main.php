<section class="content container-fluid">
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-header card-header-strong">
					<div class="card-title card-title-strong"><?= $this->session->userdata('adm_name') ?>(<?= $this->session->userdata('adm_id') ?>)</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 col-sm-12">
							<h5><strong>컨설팅 의뢰 진행건 (<?= $consulting_request_count_my ?>건)</strong></h5>
							<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
								<colgroup>
									<col width="15%">
									<col width="15%">
									<col width="25%">
									<col width="25%">
									<col width="20%">
								</colgroup>
								<thead>
									<tr>
										<th>등록일</th>
										<th>접수번호</th>
										<th>기업(단체)명</th>
										<th>신청인</th>
										<th>의뢰분야</th>
									</tr>
								</thead>
								<tbody id="consulting_request_my">
									<?php
									$i = 0;
									foreach ($consulting_request_list_my as $list) {
									?>
										<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
											<td class="text-center"><?= replaceDate($list->regdate) ?></td>
											<td class="text-center"><?= $list->idx ?></td>
											<td class="text-center"><a href="/admin/consulting/view/<?= $list->idx ?>/"><?= $list->name ?></a></td>
											<td class="text-center"><?= $list->employee_name ?></td>
											<td class="text-center">
												<?php
												$consulting_business = explode(',', str_replace(' ', '', $list->business));
												foreach ($consulting_business as $business) {
												?>
													<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
										$i++;
									}
									?>
								</tbody>
							</table>
							<?php if ($i > 4) { ?>
								<div class="mt-1">
									<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#consulting_request_my">더보기</button>
								</div>
							<?php } ?>

						</div>

						<div class="col-lg-6 col-sm-12">
							<h5><strong>월간디자인 진행건 (<?= $subscribe_work_new_count_my ?>건)</strong></h5>
							<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
								<colgroup>
									<col width="15%">
									<col width="20%">
									<col width="20%">
									<col width="30%">
									<col width="15%">
								</colgroup>
								<thead>
									<tr>
										<th>등록일</th>
										<th>고객사</th>
										<th>의뢰분야</th>
										<th>건명</th>
										<th>종료일</th>
									</tr>
								</thead>
								<tbody id="subscribe_work_new_my">
									<?php
									$i = 0;
									foreach ($subscribe_work_new_list_my as $list) {
									?>
										<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
											<td class="text-center"><?= replaceDate($list->regdate) ?></td>
											<td class="text-center"><a href="/admin/subscribe/view/<?= $list->idx ?>/"><?= $list->customer_name ?></a></td>
											<td class="text-center"><?= $list->employee_name ?></td>
											<td class="text-center">
												<?php
												$subscribe_work_business = explode(',', str_replace(' ', '', $list->category));
												foreach ($subscribe_work_business as $business) {
												?>
													<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
												<?php
												}
												?>
											</td>
											<td class="text-center"><?= replaceDate($list->work_edate) ?></td>
										</tr>
									<?php
										$i++;
									}
									?>
								</tbody>
							</table>
							<?php if ($i > 4) { ?>
								<div class="mt-1">
									<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#subscribe_work_new_my">더보기</button>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-sm-12">
			<div class="card">
				<div class="card-header card-header-strong">
					<div class="card-title card-title-strong">전체 진행건</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
					</div>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-lg-6 col-sm-12">

							<h5><strong>컨설팅 의뢰 진행건 (<?= $consulting_request_count ?>건)</strong></h5>
							<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
								<colgroup>
									<col width="15%">
									<col width="10%">
									<col width="25%">
									<col width="15%">
									<col width="20%">
									<col width="15%">
								</colgroup>
								<thead>
									<tr>
										<th>등록일</th>
										<th>접수번호</th>
										<th>기업(단체)명</th>
										<th>신청인</th>
										<th>의뢰분야</th>
										<th>작업담당자</th>
									</tr>
								</thead>
								<tbody id="consulting_request">
									<?php
									$i = 0;
									foreach ($consulting_request_list as $list) {
									?>
										<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
											<td class="text-center"><?= replaceDate($list->regdate) ?></td>
											<td class="text-center"><?= $list->idx ?></td>
											<td class="text-center"><a href="/admin/consulting/view/<?= $list->idx ?>/"><?= $list->name ?></a></td>
											<td class="text-center"><?= $list->employee_name ?></td>
											<td class="text-center">
												<?php
												$consulting_business = explode(',', str_replace(' ', '', $list->business));
												foreach ($consulting_business as $business) {
												?>
													<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
												<?php
												}
												?>
											</td>
											<td class="text-center"><?= $list->manager_name ?></td>
										</tr>
									<?php
										$i++;
									}
									?>
								</tbody>
							</table>
							<?php if ($i > 4) { ?>
								<div class="mt-1">
									<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#consulting_request">더보기</button>
								</div>
							<?php } ?>

						</div>

						<div class="col-lg-6 col-sm-12">
							<h5><strong>월간디자인 진행건 (<?= $subscribe_work_new_count ?>건)</strong></h5>
							<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
								<colgroup>
									<col width="15%">
									<col width="20%">
									<col width="20%">
									<col width="30%">
									<col width="15%">
								</colgroup>
								<thead>
									<tr>
										<th>등록일</th>
										<th>고객사</th>
										<th>의뢰분야</th>
										<th>건명</th>
										<th>작업담당자</th>
									</tr>
								</thead>
								<tbody id="subscribe_work_new">
									<?php
									$i = 0;
									foreach ($subscribe_work_new_list as $list) {
									?>
										<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
											<td class="text-center"><?= replaceDate($list->regdate) ?></td>
											<td class="text-center"><a href="/admin/subscribe/view/<?= $list->idx ?>/"><?= $list->customer_name ?></a></td>											
											<td class="text-center">
												<?php
												$subscribe_work_business = explode(',', str_replace(' ', '', $list->category));
												foreach ($subscribe_work_business as $business) {
												?>
													<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
												<?php
												}
												?>
											</td>
											<td class="text-center"><?= $list->subject ?></td>
											<td class="text-center"><?= $list->manager_name ?></td>
										</tr>
									<?php
										$i++;
									}
									?>
								</tbody>
							</table>
							<?php if ($i > 4) { ?>
								<div class="mt-1">
									<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#subscribe_work_new">더보기</button>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-strong w50per">
					<div class="card-title card-title-strong">컨설팅 - 신규문의 (<?= $consulting_new_count ?>건)</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
						<colgroup>
							<col width="15%">
							<col width="15%">
							<col width="25%">
							<col width="25%">
							<col width="20%">


						</colgroup>
						<thead>
							<tr>
								<th>등록일</th>
								<th>접수번호</th>
								<th>기업(단체)명</th>
								<th>신청인</th>
								<th>의뢰분야</th>
							</tr>
						</thead>
						<tbody id="consulting_new">
							<?php
							$i = 0;
							foreach ($consulting_new_list as $list) {
							?>
								<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
									<td class="text-center"><?= replaceDate($list->regdate) ?></td>
									<td class="text-center"><?= $list->idx ?></td>
									<td class="text-center"><a href="/admin/consulting/view/<?= $list->idx ?>/"><?= $list->name ?></a></td>
									<td class="text-center"><?= $list->employee_name ?></td>
									<td class="text-center">
										<?php
										$consulting_business = explode(',', str_replace(' ', '', $list->business));
										foreach ($consulting_business as $business) {
										?>
											<div class="btn btn-xs btn-secondary"><?= $business_list[$business]['name'] ?></div>
										<?php
										}
										?>
									</td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
					<?php if ($i > 4) { ?>
						<div class="mt-1">
							<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#consulting_new">더보기</button>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-strong w50per">
					<div class="card-title card-title-strong">월간디자인 - 구독만료예정 (<?= $subscribe_expire_count ?>건)</div>
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
							<col width="12%">
						</colgroup>
						<thead>
							<tr>
								<th>만료일</th>
								<th>구분</th>
								<th>업체명</th>
								<th>대표자</th>
							</tr>
						</thead>
						<tbody id="subscribe_expire">
							<?php
							$i = 0;
							foreach ($subscribe_expire_list as $list) {
							?>
								<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
									<td class="text-center"><?= replaceDate($list->subscribe_edate) ?></td>
									<td class="text-center"><?= replaceCustomerType($list->category) ?></td>
									<td class="text-center"><a href="/admin/customer/view/<?= $list->idx ?>/"><?= $list->name ?></a></td>
									<td class="text-center"><?= $list->ceo ?></td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
					<?php if ($i > 4) { ?>
						<div class="mt-1">
							<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#subscribe_expire">더보기</button>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-strong w50per">
					<div class="card-title card-title-strong">만족도 - 미답변 (<?= $review_count ?>건)</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
					</div>
				</div>

				<div class="card-body">
					<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
						<colgroup>
							<col width="15%">
							<col width="50%">
							<col width="20%">
							<col width="15%">
						</colgroup>
						<thead>
							<tr>
								<th>등록일</th>
								<th>제목</th>
								<th>작성자</th>
								<th>별점</th>
							</tr>
						</thead>
						<tbody id="review_new">
							<?php
							$i = 0;
							foreach ($review_list as $list) {
							?>
								<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
									<td class="text-center"><?= replaceDate($list->regdate) ?></td>
									<td><a href="/admin/review/view/<?= $list->idx ?>/"><?= $list->subject ?></a></td>
									<td class="text-center"><?= $list->name ?></td>
									<td class="text-center"><?= $list->score ?></td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
					<?php if ($i > 4) { ?>
						<div class="mt-1">
							<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#review_new">더보기</button>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-12">
			<div class="card">
				<div class="card-header card-header-strong w50per">
					<div class="card-title card-title-strong">QnA - 미답변 (<?= $qna_count ?>건)</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
					</div>
				</div>

				<div class="card-body">
					<table class="table table-bordered list_table mt-2" width="100%" cellspacing="0">
						<colgroup>
							<col width="20%">
							<col width="60%">
							<col width="20%">
						</colgroup>
						<thead>
							<tr>
								<th>등록일</th>
								<th>제목</th>
								<th>작성자</th>
							</tr>
						</thead>
						<tbody id="qna_new">
							<?php
							$i = 0;
							foreach ($qna_list as $list) {
							?>
								<tr class="<?= ($i > 4) ? 'displaynone' : '' ?>">
									<td class="text-center"><?= replaceDate($list->regdate) ?></td>
									<td><a href="/admin/qna/view/<?= $list->idx ?>/"><?= $list->subject ?></a></td>
									<td class="text-center"><?= $list->name ?></td>
								</tr>
							<?php
								$i++;
							}
							?>
						</tbody>
					</table>
					<?php if ($i > 4) { ?>
						<div class="mt-1">
							<button class="btn btn-sm btn-primary w100per show_more_list" data-tableid="#qna_new">더보기</button>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>


<script>
	page_info = JSON.parse('<?= json_encode($page_info) ?>');

	$(function() {
		$(".show_more_list").on("click", function() {
			var tableid = $(this).data("tableid");
			$(tableid).children(".displaynone").slice(0, 5).removeClass("displaynone");
			if ($(tableid).children(".displaynone").length < 1) {
				$(this).addClass("displaynone");
			}
		});
	});
</script>