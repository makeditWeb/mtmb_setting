<section class="content container-fluid">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-3 calendar">
          <div class="input-group date">
            <input type="text" class="form-control daterangepicker-input" autocomplete="off" id="sDate" readonly value="<?= $page_info['sch_sdate'] ?>">
            <h4 class="ml-2 mr-2">~</h4>
            <input type="text" class="form-control daterangepicker-input" autocomplete="off" id="eDate" readonly value="<?= $page_info['sch_edate'] ?>">
          </div>
        </div>
        <div class="col-9">
          <button type="button" class="button btn-red mr-2 btn_search" data-range="1">조회</button>
          <!-- <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="1">당일</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="3">7일</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="4">30일</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="5">3개월</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="6">6개월</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="7">1년</button> -->
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="1">금주</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="2">금월</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="3">전월</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="4">3개월</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="5">6개월</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="6">1년</button>
          <button type="button" class="button btn-secondary mr-2 btn_set_range" data-range="7">2년</button>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">매출통계</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <div>
            <canvas id="chart_line_count" style="max-width: 100%;height:350px;"></canvas>
          </div>
        </div>
        <div class="col-6">
          <div>
            <canvas id="chart_line_sales" style="max-width: 100%;height:350px;"></canvas>
          </div>
        </div>
      </div>

      <table class="table table-bordered list_table mt-5" width="100%" cellspacing="0">
        <colgroup>
          <col width="16.66%">
          <col width="16.66%">
          <col width="16.66%">
          <col width="16.66%">
          <col width="16.66%">
          <col width="16.66%">
        </colgroup>
        <thead>
          <tr>
            <th>총 문의 건수</th>
            <th>총 확정 건수</th>
            <th>총 매출액</th>
            <th>총 지출액</th>
            <th>총 순이익</th>
            <th>월간디자인</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center"><?= number_format($statis_result->count_all) ?></td>
            <td class="text-center"><?= number_format($statis_result->count_request) ?></td>
            <td class="text-center"><?= number_format($statis_result->sales) ?></td>
            <td class="text-center"><?= number_format($statis_result->outcost) ?></td>
            <td class="text-center"><?= number_format($statis_result->revenue) ?></td>
            <td class="text-center"><?= number_format($statis_result->count_subscribe) ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">상품별 통계</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-bordered list_table mt-5" width="100%" cellspacing="0">
        <colgroup>
          <col width="15%">
          <col width="20%">
          <col width="45%">
          <col width="20%">
        </colgroup>
        <thead>
          <tr>
            <th>상품</th>
            <th>건수</th>
            <th>점유율</th>
            <th>순위</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($statis_result_category as $list) {
            $count_request_per = ($list['count_total'] > 0) ? ($list['count_request'] / $list['count_total']) * 100 : 0;
            $ratio_count_request = ($statis_result_category_total['count'] > 0) ? ($list['count_request'] / $statis_result_category_total['count']) * 100 : 0;
            $ratio_sales = ($statis_result_category_total['sales'] > 0) ? ($list['sales'] / $statis_result_category_total['sales']) * 100 : 0;
            $ratio_revenue = ($statis_result_category_total['revenue'] > 0) ? ($list['revenue'] / $statis_result_category_total['revenue']) * 100 : 0;
          ?>
            <tr>
              <td class="text-center"><?= $list['name'] ?></td>
              <td class="text-center">
                <div>문의 <?= number_format($list['count_total']) ?>건 중 확정 <?= number_format($list['count_request']) ?>건</div>
                <div>(확정률 <?= number_format($count_request_per, 2) ?>%)</div>
              </td>
              <td>
                <div class="row">
                  <div class="col-2 text-center">확정점유</div>
                  <div class="col-8">
                    <span style="display:block;height:15px;margin:3px 0px;background-color:<?= $business_list[$list['segment']]['color'] ?>;width:<?= $ratio_count_request ?>%;"></span>
                  </div>
                  <div class="col-2"><?= number_format($ratio_count_request, 2) ?>%</div>
                </div>
                <div class="row">
                  <div class="col-2 text-center">매출점유</div>
                  <div class="col-8">
                    <span style="display:block;height:15px;margin:3px 0px;background-color:<?= $business_list[$list['segment']]['color'] ?>;width:<?= $ratio_sales ?>%;"></span>
                  </div>
                  <div class="col-2"><?= number_format($ratio_sales, 2) ?>%</div>
                </div>
                <div class="row">
                  <div class="col-2 text-center">순익점유</div>
                  <div class="col-8">
                    <span style="display:block;height:15px;margin:3px 0px;background-color:<?= $business_list[$list['segment']]['color'] ?>;width:<?= $ratio_revenue ?>%;"></span>
                  </div>
                  <div class="col-2"><?= number_format($ratio_revenue, 2) ?>%</div>
                </div>
              </td>
              <td class="text-center">
                <div>확정 <?= $list['rank_count'] ?></div>
                <div>매출 <?= $list['rank_sales'] ?></div>
                <div>순익 <?= $list['rank_revenue'] ?></div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">상품별 통계</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <div>
            <canvas id="chart_bar_count" style="max-width: 100%;height:350px;"></canvas>
          </div>
        </div>
        <div class="col-6">
          <div>
            <canvas id="chart_bar_sales" style="max-width: 100%;height:350px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<link href="/resources/admin/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script src="/resources/admin/daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.3/dist/chart.umd.min.js"></script>
<script>
  const chart_config_line = {
    responsive: true,
    interaction: {
      intersect: false,
    },
    scales: {
      y: {
        min: 0,
      },
    },
  };

  const chart_config_bar = {
    responsive: true,
    interaction: {
      intersect: false,
    },
    scales: {
      y: {
        min: 0,
      },
    },
  };

  page_info = JSON.parse('<?= json_encode($page_info) ?>');

  const chart_range_label = JSON.parse('<?= json_encode($chart_range_label) ?>');
  const data_count_inquiry = JSON.parse('<?= json_encode($count_inquiry) ?>');
  const data_count_request = JSON.parse('<?= json_encode($count_request) ?>');
  const chart_data_count_inquiry = JSON.parse('<?= json_encode($chart_data_default) ?>');
  const chart_data_count_request = JSON.parse('<?= json_encode($chart_data_default) ?>');

  $.each(data_count_inquiry, function(key, val) {
    chart_data_count_inquiry[val.cur_date] = val.val;
  });

  $.each(data_count_request, function(key, val) {
    chart_data_count_request[val.cur_date] = val.val;
  });

  const chart_data_count = {
    labels: chart_range_label,
    datasets: [{
        label: '문의 건수',
        data: chart_data_count_inquiry,
        borderColor: chart_colors[22]
      },
      {
        label: '확정 건수',
        data: chart_data_count_request,
        borderColor: chart_colors[23]
      }
    ]
  };

  const business_label_list = JSON.parse('<?= json_encode($business_label_list) ?>');
  const data_count_inquiry_category = JSON.parse('<?= json_encode($count_inquiry_category) ?>');
  const data_count_request_category = JSON.parse('<?= json_encode($count_request_category) ?>');
  const chart_data_count_inquiry_category = JSON.parse('<?= json_encode($business_data_default) ?>');
  const chart_data_count_request_category = JSON.parse('<?= json_encode($business_data_default) ?>');

  $.each(data_count_inquiry_category, function(key, value) {
    // console.log(key, value, value.val);
    chart_data_count_inquiry_category[value.category].val = value.val;
  });

  const chart_data_count_inquiry_category_result = new Object();
  $.each(chart_data_count_inquiry_category, function(key, val) {
    chart_data_count_inquiry_category_result[val.name] = val.val;
  });

  $.each(data_count_request_category, function(key, val) {
    chart_data_count_request_category[val.category].val = val.val;
  });

  const chart_data_count_request_category_result = new Object();
  $.each(chart_data_count_request_category, function(key, val) {
    chart_data_count_request_category_result[val.name] = val.val;
  });

  const chart_data_count_category = {
    labels: business_label_list,
    datasets: [{
        label: '문의 건수',
        data: chart_data_count_inquiry_category_result,
        backgroundColor: chart_colors,
        borderColor: chart_colors,
        borderWidth: 2
      },
      {
        label: '확정 건수',
        data: chart_data_count_request_category_result,
        backgroundColor: chart_colors,
        borderColor: chart_colors,
        borderWidth: 2
      }
    ]
  };

  const data_sales_sum = JSON.parse('<?= json_encode($sales_sum) ?>');
  const chart_data_sales_sum = JSON.parse('<?= json_encode($chart_data_default) ?>');
  const chart_data_outcost_sum = JSON.parse('<?= json_encode($chart_data_default) ?>');
  const chart_data_revenue_sum = JSON.parse('<?= json_encode($chart_data_default) ?>');

  $.each(data_sales_sum, function(key, val) {
    chart_data_sales_sum[val.cur_date] = val.sales;
    chart_data_outcost_sum[val.cur_date] = val.outcost;
    chart_data_revenue_sum[val.cur_date] = val.revenue;
  });

  const chart_data_sales = {
    labels: chart_range_label,
    datasets: [{
        label: '매출액',
        data: chart_data_sales_sum,
        borderColor: chart_colors[5]
      },
      {
        label: '지출액',
        data: chart_data_outcost_sum,
        borderColor: chart_colors[3]
      },
      {
        label: '순이익',
        data: chart_data_revenue_sum,
        borderColor: chart_colors[17]
      }
    ]
  };

  const data_sales_sum_category = JSON.parse('<?= json_encode($sales_sum_category) ?>');
  const chart_data_sales_sum_category = JSON.parse('<?= json_encode($business_data_default) ?>');

  $.each(data_sales_sum_category, function(key, val) {
    chart_data_sales_sum_category[val.category].val = val.val;
  });

  const chart_data_sales_sum_category_result = new Object();
  $.each(chart_data_sales_sum_category, function(key, val) {
    chart_data_sales_sum_category_result[val.name] = val.val;
  });


  const chart_data_sales_category = {
    labels: business_label_list,
    datasets: [{
      label: '매출액',
      data: chart_data_sales_sum_category_result,
      backgroundColor: chart_colors,
      borderColor: chart_colors,
      borderWidth: 2
    }]
  };

  $(function() {
    $(".daterangepicker-input").daterangepicker(daterangepicker_options_none_time, function(sdate, edate) {
      $("#sDate").val(sdate.format('YYYY-MM-DD HH:mm:ss'));
      $("#eDate").val(edate.format('YYYY-MM-DD HH:mm:ss'));
    });


    // $(".btn_set_range").on("click", function() {
    //   var to_date = $("#eDate").val();
    //   var date_range = $(this).data("range");
    //   $("#sDate").val(get_from_date(date_range, to_date));
    // });

    $(".btn_set_range").on("click", function() {
      var date_range = $(this).data("range");
      var result_date = set_date_range(date_range);
      $("#sDate").val(result_date.sDate);
      $("#eDate").val(result_date.eDate);
      search_statics();
    });

    $(".btn_search").on("click", function() {
      search_statics();
    });

    new Chart(
      document.getElementById('chart_line_count').getContext("2d"), {
        type: 'line',
        options: chart_config_line,
        data: chart_data_count
      }
    );

    new Chart(
      document.getElementById('chart_bar_count').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar,
        data: chart_data_count_category
      }
    );

    new Chart(
      document.getElementById('chart_line_sales').getContext("2d"), {
        type: 'line',
        options: chart_config_line,
        data: chart_data_sales
      }
    );

    new Chart(
      document.getElementById('chart_bar_sales').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar,
        data: chart_data_sales_category
      }
    );
  });

  function search_statics() {
    const sch_sdate = $("#sDate").val();
    const sch_edate = $("#eDate").val();
    location.href = "/admin/statistics/?sch_sdate=" + sch_sdate + "&sch_edate=" + sch_edate;
  }
</script>