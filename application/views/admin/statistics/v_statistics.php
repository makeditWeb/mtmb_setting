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
      <table class="table table-bordered list_table" width="100%" cellspacing="0">
        <colgroup>
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
          <col width="20%">
        </colgroup>
        <thead>
          <tr>
            <th>총 매출액</th>
            <th>총 지출액</th>
            <th>총 순이익</th>
            <th>총 문의 건수</th>
            <th>총 확정 건수</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center"><?= number_format($result_stat_sum['sales']) ?> 원</td>
            <td class="text-center"><?= number_format($result_stat_sum['outcost']) ?> 원</td>
            <td class="text-center"><?= number_format($result_stat_sum['revenue']) ?> 원</td>
            <td class="text-center"><?= number_format($result_stat_sum['count_inquiry']) ?> 건</td>
            <td class="text-center"><?= number_format($result_stat_sum['count_request']) ?> 건</td>
          </tr>
        </tbody>
      </table>

      <div class="mt-4 mb-4">
        <button type="button" class="btn btn-primary mr-2 show_stat" data-targetid="#statis_yearly">년도별 보기</button>
        <button type="button" class="btn btn-secondary mr-2 show_stat" data-targetid="#statis_monthly">월별 보기</button>
        <button type="button" class="btn btn-secondary mr-2 show_stat" data-targetid="#statis_weekly">주간별 보기</button>
        <button type="button" class="btn btn-secondary mr-2 show_stat" data-targetid="#statis_daily">일별 보기</button>
      </div>

      <div class="statis_chart statis_chart_list" id="statis_yearly">
        <div class="row statis_row">
          <div class="col-12 statis_cols">
            <div class="statis_title">매출</div>
            <canvas class="statis_content" id="chart_bar_stat_yearly_sales"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">지출</div>
            <canvas class="statis_content" id="chart_bar_stat_yearly_outcost"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">순이익</div>
            <canvas class="statis_content" id="chart_bar_stat_yearly_revenue"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">문의</div>
            <canvas class="statis_content" id="chart_bar_stat_yearly_count_inquiry"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">확정</div>
            <canvas class="statis_content" id="chart_bar_stat_yearly_count_request"></canvas>
          </div>
        </div>

        <table class="table table-bordered list_table" width="100%" cellspacing="0">
          <colgroup>
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
          </colgroup>
          <thead>
            <tr>
              <th>기간</th>
              <th>매출</th>
              <th>지출액</th>
              <th>순이익</th>
              <th>문의 건수</th>
              <th>확정 건수</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($result_stat['yearly'] as $list) {
            ?>
              <tr>
                <td class="text-center"><?= ($list['label']) ?></td>
                <td class="text-center"><?= ($list['sales'] == 0) ? '-' : number_format($list['sales']) ?></td>
                <td class="text-center"><?= ($list['outcost'] == 0) ? '-' : number_format($list['outcost']) ?></td>
                <td class="text-center"><?= ($list['revenue'] == 0) ? '-' : number_format($list['revenue']) ?></td>
                <td class="text-center"><?= ($list['count_inquiry'] == 0) ? '-' : number_format($list['count_inquiry']) ?></td>
                <td class="text-center"><?= ($list['count_request'] == 0) ? '-' : number_format($list['count_request']) ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="statis_chart statis_chart_list displaynone" id="statis_monthly">
        <div class="row statis_row">
          <div class="col-12 statis_cols">
            <div class="statis_title">매출</div>
            <canvas class="statis_content" id="chart_bar_stat_monthly_sales"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">지출</div>
            <canvas class="statis_content" id="chart_bar_stat_monthly_outcost"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">순이익</div>
            <canvas class="statis_content" id="chart_bar_stat_monthly_revenue"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">문의</div>
            <canvas class="statis_content" id="chart_bar_stat_monthly_count_inquiry"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">확정</div>
            <canvas class="statis_content" id="chart_bar_stat_monthly_count_request"></canvas>
          </div>
        </div>

        <table class="table table-bordered list_table" width="100%" cellspacing="0">
          <colgroup>
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
          </colgroup>
          <thead>
            <tr>
              <th>기간</th>
              <th>매출</th>
              <th>지출액</th>
              <th>순이익</th>
              <th>문의 건수</th>
              <th>확정 건수</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($result_stat['monthly'] as $list) {
            ?>
              <tr>
                <td class="text-center"><?= ($list['label']) ?></td>
                <td class="text-center"><?= ($list['sales'] == 0) ? '-' : number_format($list['sales']) ?></td>
                <td class="text-center"><?= ($list['outcost'] == 0) ? '-' : number_format($list['outcost']) ?></td>
                <td class="text-center"><?= ($list['revenue'] == 0) ? '-' : number_format($list['revenue']) ?></td>
                <td class="text-center"><?= ($list['count_inquiry'] == 0) ? '-' : number_format($list['count_inquiry']) ?></td>
                <td class="text-center"><?= ($list['count_request'] == 0) ? '-' : number_format($list['count_request']) ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="statis_chart statis_chart_list displaynone" id="statis_weekly">
        <div class="row statis_row">
          <div class="col-12 statis_cols">
            <div class="statis_title">매출</div>
            <canvas class="statis_content" id="chart_bar_stat_weekly_sales"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">지출</div>
            <canvas class="statis_content" id="chart_bar_stat_weekly_outcost"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">순이익</div>
            <canvas class="statis_content" id="chart_bar_stat_weekly_revenue"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">문의</div>
            <canvas class="statis_content" id="chart_bar_stat_weekly_count_inquiry"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">확정</div>
            <canvas class="statis_content" id="chart_bar_stat_weekly_count_request"></canvas>
          </div>
        </div>

        <table class="table table-bordered list_table" width="100%" cellspacing="0">
          <colgroup>
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
          </colgroup>
          <thead>
            <tr>
              <th>기간</th>
              <th>매출</th>
              <th>지출액</th>
              <th>순이익</th>
              <th>문의 건수</th>
              <th>확정 건수</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($result_stat['weekly'] as $list) {
            ?>
              <tr>
                <td class="text-center"><?= ($list['label']) ?></td>
                <td class="text-center"><?= ($list['sales'] == 0) ? '-' : number_format($list['sales']) ?></td>
                <td class="text-center"><?= ($list['outcost'] == 0) ? '-' : number_format($list['outcost']) ?></td>
                <td class="text-center"><?= ($list['revenue'] == 0) ? '-' : number_format($list['revenue']) ?></td>
                <td class="text-center"><?= ($list['count_inquiry'] == 0) ? '-' : number_format($list['count_inquiry']) ?></td>
                <td class="text-center"><?= ($list['count_request'] == 0) ? '-' : number_format($list['count_request']) ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="statis_chart statis_chart_list displaynone" id="statis_daily">
        <div class="row statis_row">
          <div class="col-12 statis_cols">
            <div class="statis_title">매출</div>
            <canvas class="statis_content" id="chart_bar_stat_daily_sales"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">지출</div>
            <canvas class="statis_content" id="chart_bar_stat_daily_outcost"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">순이익</div>
            <canvas class="statis_content" id="chart_bar_stat_daily_revenue"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">문의</div>
            <canvas class="statis_content" id="chart_bar_stat_daily_count_inquiry"></canvas>
          </div>
          <div class="col-12 statis_cols">
            <div class="statis_title">확정</div>
            <canvas class="statis_content" id="chart_bar_stat_daily_count_request"></canvas>
          </div>
        </div>

        <table class="table table-bordered list_table" width="100%" cellspacing="0">
          <colgroup>
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
            <col width="16.6%">
          </colgroup>
          <thead>
            <tr>
              <th>기간</th>
              <th>매출</th>
              <th>지출액</th>
              <th>순이익</th>
              <th>문의 건수</th>
              <th>확정 건수</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($result_stat['daily'] as $list) {
            ?>
              <tr>
                <td class="text-center"><?= ($list['label']) ?></td>
                <td class="text-center"><?= ($list['sales'] == 0) ? '-' : number_format($list['sales']) ?></td>
                <td class="text-center"><?= ($list['outcost'] == 0) ? '-' : number_format($list['outcost']) ?></td>
                <td class="text-center"><?= ($list['revenue'] == 0) ? '-' : number_format($list['revenue']) ?></td>
                <td class="text-center"><?= ($list['count_inquiry'] == 0) ? '-' : number_format($list['count_inquiry']) ?></td>
                <td class="text-center"><?= ($list['count_request'] == 0) ? '-' : number_format($list['count_request']) ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">확정 상품통계</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-bordered list_table" width="100%" cellspacing="0">
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
            <th>순위</th>
            <th>상품</th>
            <th>매출</th>
            <th>지출액</th>
            <th>순이익</th>
            <th>문의 건수</th>
            <th>확정 건수</th>
            <th>상세보기</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($result_statis_category as $list) {
          ?>
            <tr>
              <td class="text-center"><?= ($list->rank_sales == 99) ? '-' : $list->rank_sales ?></td>
              <td class="text-center"><?= $business_list[$list->category]['name'] ?></td>
              <td class="text-center"><?= ($list->sales > 0) ? number_format($list->sales * 1.1) : '-' ?></td>
              <td class="text-center"><?= ($list->cost > 0) ? number_format($list->cost) : '-' ?></td>
              <td class="text-center"><?= ($list->revenue > 0) ? number_format($list->revenue) : '-' ?></td>
              <td class="text-center"><?= ($list->count_total > 0) ? number_format($list->count_total) : '-' ?></td>
              <td class="text-center"><?= ($list->count_request > 0) ? number_format($list->count_request) : '-' ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-default pop_view" data-path="/admin/consulting/?sch_category=<?= $list->category ?>&sch_status=<?= str_replace("'", "", $status_calculate_str) ?>&sch_sdate=<?= $page_info['sch_sdate'] ?>&sch_edate=<?= $page_info['sch_edate'] ?>" data-idx="">상세보기</button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header card-header-strong">
          <div class="card-title card-title-strong">문의&확정 통계</div>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
          </div>
        </div>

        <div class="card-body">
          <table class="table table-bordered list_table" width="100%" cellspacing="0">
            <colgroup>
              <col width="33.3%">
              <col width="33.3%">
              <col width="33.3%">
            </colgroup>
            <thead>
              <tr>
                <th>총 문의</th>
                <th>총 확정</th>
                <th>총 확정률</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?= number_format($result_stat_sum['count_inquiry']) ?> 건</td>
                <td class="text-center"><?= number_format($result_stat_sum['count_request']) ?> 건</td>
                <td class="text-center"><?= ($result_stat_sum['count_inquiry'] > 0) ? number_format(($result_stat_sum['count_request'] / $result_stat_sum['count_inquiry']) * 100, 2) : 0 ?>%</td>
              </tr>
            </tbody>
          </table>

          <div class="statis_chart">
            <div class="row statis_row">
              <div class="col-12 statis_cols">
                <canvas class="statis_content" id="chart_bar_count_category"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-6">
      <div class="card">
        <div class="card-header card-header-strong">
          <div class="card-title card-title-strong">문의경로 통계</div>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
          </div>
        </div>

        <div class="card-body">
          <table class="table table-bordered list_table" width="100%" cellspacing="0">
            <colgroup>
              <col width="33.3%">
              <col width="33.3%">
              <col width="33.3%">
            </colgroup>
            <thead>
              <tr>
                <th>홈페이지</th>
                <th>전화</th>
                <th>이메일</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center" id="count_total_regpath_homepage"></td>
                <td class="text-center" id="count_total_regpath_tel"></td>
                <td class="text-center" id="count_total_regpath_email"></td>
              </tr>
            </tbody>
          </table>

          <div class="statis_chart">
            <div class="row statis_row">
              <div class="col-12 statis_cols">
                <canvas class="statis_content" id="chart_bar_count_category_regpath"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">디자인&제작 통계</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-bordered list_table" width="100%" cellspacing="0">
        <colgroup>
          <col width="33.3%">
          <col width="33.3%">
          <col width="33.3%">
        </colgroup>
        <thead>
          <tr>
            <th>디자인</th>
            <th>디자인+제작</th>
            <th>제작</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center" id="count_total_workRange_work1"></td>
            <td class="text-center" id="count_total_workRange_work2"></td>
            <td class="text-center" id="count_total_workRange_work3"></td>
          </tr>
        </tbody>
      </table>

      <div class="statis_chart">
        <div class="row statis_row">
          <div class="col-12 statis_cols">
            <canvas class="statis_content" id="chart_bar_count_category_workRange"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">고객사 통계</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      <div class="statis_chart">
        <div class="row statis_row">
          <div class="col-3 statis_table">
            <table class="table table-bordered list_table" width="100%" cellspacing="0">
              <colgroup>
                <col width="40%">
                <col width="60%">
              </colgroup>
              <tbody>
                <tr>
                  <th colspan="2">확정 문의고객</th>
                </tr>
                <?php
                foreach ($count_request_company as $list) {
                ?>
                  <tr>
                    <th class="text-center"><?= replaceCustomerType($list['category']) ?></th>
                    <td class="text-center"><?= $list['val'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="col-3 statis_cols">
            <canvas class="statis_content" id="chart_pie_count_request_company"></canvas>
          </div>
          <div class="col-3 statis_table">
            <table class="table table-bordered list_table" width="100%" cellspacing="0">
              <colgroup>
                <col width="40%">
                <col width="60%">
              </colgroup>
              <tbody>
                <tr>
                  <th colspan="2">전체 문의고객</th>
                </tr>
                <?php
                foreach ($count_inquiry_company as $list) {
                ?>
                  <tr>
                    <th class="text-center"><?= replaceCustomerType($list['category']) ?></th>
                    <td class="text-center"><?= $list['val'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="col-3 statis_cols">
            <canvas class="statis_content" id="chart_pie_count_inquiry_company"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header card-header-strong">
      <div class="card-title card-title-strong">고객사 매출순위</div>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove"><i class="fas fa-times"></i></button>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-bordered list_table" width="100%" cellspacing="0">
        <colgroup>
          <col width="14.3%">
          <col width="14.3%">
          <col width="14.3%">
          <col width="14.3%">
          <col width="14.3%">
          <col width="14.3%">
          <col width="14.3%">
        </colgroup>
        <thead>
          <tr>
            <th>순위</th>
            <th>고객사명</th>
            <th>의뢰분야</th>
            <th>매출</th>
            <th>지출액</th>
            <th>순이익</th>
            <th>상세보기</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($company_rank_sales as $list) {
          ?>
            <tr>
              <td class="text-center"><?= $list->rank_sales ?></td>
              <td class="text-center"><?= $list->name ?></td>
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
              <td class="text-center"><?= ($list->sales > 0) ? number_format($list->sales) : '-' ?></td>
              <td class="text-center"><?= ($list->cost > 0) ? number_format($list->cost) : '-' ?></td>
              <td class="text-center"><?= ($list->revenue > 0) ? number_format($list->revenue) : '-' ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-sm btn-default pop_view" data-path="/admin/consulting/?sch_customer=<?= $list->customer_idx ?>&sch_status=<?= str_replace("'", "", $status_calculate_str) ?>&sch_sdate=<?= $page_info['sch_sdate'] ?>&sch_edate=<?= $page_info['sch_edate'] ?>" data-idx="">상세보기</button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<link href="/resources/admin/daterangepicker/daterangepicker.css" rel="stylesheet" />
<script src="/resources/admin/daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.3/dist/chart.umd.min.js"></script>
<script>
  function search_statics() {
    const sch_sdate = $("#sDate").val();
    const sch_edate = $("#eDate").val();
    location.href = "/admin/statistics/?sch_sdate=" + sch_sdate + "&sch_edate=" + sch_edate;
  }

  page_info = JSON.parse('<?= json_encode($page_info) ?>');

  const chart_config_bar_1 = {
    responsive: true,
    plugins: {
      legend: {
        display: false,
      },
      tooltip: {
        mode: 'nearest',
        intersect: false,
      }
    },
  };

  const chart_config_bar_2 = {
    responsive: true,
    plugins: {
      legend: {
        display: true,
      },
      tooltip: {
        mode: 'nearest',
        intersect: false,
      }
    },
  };

  const chart_config_pie = {
    responsive: true,
    plugins: {
      legend: {
        display: false,
      },
      tooltip: {
        mode: 'nearest',
        intersect: false,
      }
    },
  };

  $(function() {
    $(".daterangepicker-input").daterangepicker(daterangepicker_options_none_time, function(sdate, edate) {
      $("#sDate").val(sdate.format('YYYY-MM-DD HH:mm:ss'));
      $("#eDate").val(edate.format('YYYY-MM-DD HH:mm:ss'));
    });

    $(".show_stat").on("click", function() {
      $(".show_stat").removeClass('btn-primary').addClass('btn-secondary');
      $(this).removeClass('btn-secondary').addClass('btn-primary');
      $(".statis_chart_list").hide();
      $($(this).data("targetid")).show();
      $(".statis_content").height("350px");
    });

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
  });

  // 년도별, 월별, 주간별, 일별 매출통계
  const chart_data_statis = JSON.parse('<?= json_encode($result_stat) ?>');
  const data_stat_yearly_sales = {};
  const data_stat_yearly_outcost = {};
  const data_stat_yearly_revenue = {};
  const data_stat_yearly_count_inquiry = {};
  const data_stat_yearly_count_request = {};
  const data_stat_monthly_sales = {};
  const data_stat_monthly_outcost = {};
  const data_stat_monthly_revenue = {};
  const data_stat_monthly_count_inquiry = {};
  const data_stat_monthly_count_request = {};
  const data_stat_weekly_sales = {};
  const data_stat_weekly_outcost = {};
  const data_stat_weekly_revenue = {};
  const data_stat_weekly_count_inquiry = {};
  const data_stat_weekly_count_request = {};
  const data_stat_daily_sales = {};
  const data_stat_daily_outcost = {};
  const data_stat_daily_revenue = {};
  const data_stat_daily_count_inquiry = {};
  const data_stat_daily_count_request = {};

  $.each(chart_data_statis.yearly, function(key, data) {
    data_stat_yearly_sales[data.label] = data.sales;
    data_stat_yearly_outcost[data.label] = data.outcost;
    data_stat_yearly_revenue[data.label] = data.revenue;
    data_stat_yearly_count_inquiry[data.label] = data.count_inquiry;
    data_stat_yearly_count_request[data.label] = data.count_request;
  });

  $.each(chart_data_statis.monthly, function(key, data) {
    data_stat_monthly_sales[data.label] = data.sales;
    data_stat_monthly_outcost[data.label] = data.outcost;
    data_stat_monthly_revenue[data.label] = data.revenue;
    data_stat_monthly_count_inquiry[data.label] = data.count_inquiry;
    data_stat_monthly_count_request[data.label] = data.count_request;
  });

  $.each(chart_data_statis.weekly, function(key, data) {
    data_stat_weekly_sales[data.label] = data.sales;
    data_stat_weekly_outcost[data.label] = data.outcost;
    data_stat_weekly_revenue[data.label] = data.revenue;
    data_stat_weekly_count_inquiry[data.label] = data.count_inquiry;
    data_stat_weekly_count_request[data.label] = data.count_request;
  });

  $.each(chart_data_statis.daily, function(key, data) {
    data_stat_daily_sales[data.label] = data.sales;
    data_stat_daily_outcost[data.label] = data.outcost;
    data_stat_daily_revenue[data.label] = data.revenue;
    data_stat_daily_count_inquiry[data.label] = data.count_inquiry;
    data_stat_daily_count_request[data.label] = data.count_request;
  });

  const chart_datasets_stat_yearly_sales = {
    datasets: [{
      data: data_stat_yearly_sales,
      backgroundColor: chart_colors[0]
    }]
  };
  const chart_datasets_stat_yearly_outcost = {
    datasets: [{
      data: data_stat_yearly_outcost,
      backgroundColor: chart_colors[0]
    }]
  };
  const chart_datasets_stat_yearly_revenue = {
    datasets: [{
      data: data_stat_yearly_revenue,
      backgroundColor: chart_colors[0]
    }]
  };
  const chart_datasets_stat_yearly_count_inquiry = {
    datasets: [{
      data: data_stat_yearly_count_inquiry,
      backgroundColor: chart_colors[0]
    }]
  };
  const chart_datasets_stat_yearly_count_request = {
    datasets: [{
      data: data_stat_yearly_count_request,
      backgroundColor: chart_colors[0]
    }]
  };

  const chart_datasets_stat_monthly_sales = {
    datasets: [{
      data: data_stat_monthly_sales,
      backgroundColor: chart_colors[4]
    }]
  };
  const chart_datasets_stat_monthly_outcost = {
    datasets: [{
      data: data_stat_monthly_outcost,
      backgroundColor: chart_colors[4]
    }]
  };
  const chart_datasets_stat_monthly_revenue = {
    datasets: [{
      data: data_stat_monthly_revenue,
      backgroundColor: chart_colors[4]
    }]
  };
  const chart_datasets_stat_monthly_count_inquiry = {
    datasets: [{
      data: data_stat_monthly_count_inquiry,
      backgroundColor: chart_colors[4]
    }]
  };
  const chart_datasets_stat_monthly_count_request = {
    datasets: [{
      data: data_stat_monthly_count_request,
      backgroundColor: chart_colors[4]
    }]
  };

  const chart_datasets_stat_weekly_sales = {
    datasets: [{
      data: data_stat_weekly_sales,
      backgroundColor: chart_colors[5]
    }]
  };
  const chart_datasets_stat_weekly_outcost = {
    datasets: [{
      data: data_stat_weekly_outcost,
      backgroundColor: chart_colors[5]
    }]
  };
  const chart_datasets_stat_weekly_revenue = {
    datasets: [{
      data: data_stat_weekly_revenue,
      backgroundColor: chart_colors[5]
    }]
  };
  const chart_datasets_stat_weekly_count_inquiry = {
    datasets: [{
      data: data_stat_weekly_count_inquiry,
      backgroundColor: chart_colors[5]
    }]
  };
  const chart_datasets_stat_weekly_count_request = {
    datasets: [{
      data: data_stat_weekly_count_request,
      backgroundColor: chart_colors[5]
    }]
  };

  const chart_datasets_stat_daily_sales = {
    datasets: [{
      data: data_stat_daily_sales,
      backgroundColor: chart_colors[7]
    }]
  };
  const chart_datasets_stat_daily_outcost = {
    datasets: [{
      data: data_stat_daily_outcost,
      backgroundColor: chart_colors[7]
    }]
  };
  const chart_datasets_stat_daily_revenue = {
    datasets: [{
      data: data_stat_daily_revenue,
      backgroundColor: chart_colors[7]
    }]
  };
  const chart_datasets_stat_daily_count_inquiry = {
    datasets: [{
      data: data_stat_daily_count_inquiry,
      backgroundColor: chart_colors[7]
    }]
  };
  const chart_datasets_stat_daily_count_request = {
    datasets: [{
      data: data_stat_daily_count_request,
      backgroundColor: chart_colors[7]
    }]
  };

  $(function() {
    new Chart(
      document.getElementById('chart_bar_stat_yearly_sales').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_yearly_sales
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_yearly_outcost').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_yearly_outcost
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_yearly_revenue').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_yearly_revenue
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_yearly_count_inquiry').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_yearly_count_inquiry
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_yearly_count_request').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_yearly_count_request
      }
    );

    new Chart(
      document.getElementById('chart_bar_stat_monthly_sales').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_monthly_sales
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_monthly_outcost').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_monthly_outcost
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_monthly_revenue').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_monthly_revenue
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_monthly_count_inquiry').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_monthly_count_inquiry
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_monthly_count_request').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_monthly_count_request
      }
    );

    new Chart(
      document.getElementById('chart_bar_stat_weekly_sales').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_weekly_sales
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_weekly_outcost').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_weekly_outcost
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_weekly_revenue').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_weekly_revenue
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_weekly_count_inquiry').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_weekly_count_inquiry
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_weekly_count_request').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_weekly_count_request
      }
    );

    new Chart(
      document.getElementById('chart_bar_stat_daily_sales').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_daily_sales
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_daily_outcost').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_daily_outcost
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_daily_revenue').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_daily_revenue
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_daily_count_inquiry').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_daily_count_inquiry
      }
    );
    new Chart(
      document.getElementById('chart_bar_stat_daily_count_request').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_1,
        data: chart_datasets_stat_daily_count_request
      }
    );
  });


  // 문의&확정 상품별 통계  
  const business_label_list = JSON.parse('<?= json_encode($business_label_list) ?>');
  const data_count_inquiry_category = JSON.parse('<?= json_encode($count_inquiry_category) ?>');
  const chart_data_count_inquiry_category = JSON.parse('<?= json_encode($business_data_default) ?>');
  const data_count_request_category = JSON.parse('<?= json_encode($count_request_category) ?>');
  const chart_data_count_request_category = JSON.parse('<?= json_encode($business_data_default) ?>');

  $.each(data_count_inquiry_category, function(key, value) {
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
        backgroundColor: chart_colors[10],
        borderColor: chart_colors[10],
        borderWidth: 2
      },
      {
        label: '확정 건수',
        data: chart_data_count_request_category_result,
        backgroundColor: chart_colors[11],
        borderColor: chart_colors[11],
        borderWidth: 2
      }
    ]
  };

  $(function() {
    new Chart(
      document.getElementById('chart_bar_count_category').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_2,
        data: chart_data_count_category
      }
    );
  });

  // 문의경로 통계
  const data_count_inquiry_category_regpath = JSON.parse('<?= json_encode($count_inquiry_category_regpath) ?>');
  const chart_data_count_inquiry_category_regpath = JSON.parse('<?= json_encode($business_data_default) ?>');

  $.each(data_count_inquiry_category_regpath, function(key, value) {
    chart_data_count_inquiry_category_regpath[value.category].homepage = value.homepage;
    chart_data_count_inquiry_category_regpath[value.category].tel = value.tel;
    chart_data_count_inquiry_category_regpath[value.category].email = value.email;
  });

  const chart_data_count_inquiry_category_regpath_homepage = new Object();
  const chart_data_count_inquiry_category_regpath_tel = new Object();
  const chart_data_count_inquiry_category_regpath_email = new Object();

  const count_total_regpath = {
    'homepage': 0,
    'tel': 0,
    'email': 0,
  };

  $.each(chart_data_count_inquiry_category_regpath, function(key, val) {
    chart_data_count_inquiry_category_regpath_homepage[val.name] = val.homepage;
    chart_data_count_inquiry_category_regpath_tel[val.name] = val.tel;
    chart_data_count_inquiry_category_regpath_email[val.name] = val.email;

    // 컨트롤러에서 루프를 안돌리기 때문에 여기서 합산.
    if (val.homepage) count_total_regpath.homepage += parseInt(val.homepage);
    if (val.tel) count_total_regpath.tel += parseInt(val.tel);
    if (val.email) count_total_regpath.email += parseInt(val.email);
  });

  $("#count_total_regpath_homepage").text(count_total_regpath.homepage);
  $("#count_total_regpath_tel").text(count_total_regpath.tel);
  $("#count_total_regpath_email").text(count_total_regpath.email);

  const chart_data_count_category_regpath = {
    labels: business_label_list,
    datasets: [{
        label: '홈페이지',
        data: chart_data_count_inquiry_category_regpath_homepage,
        backgroundColor: chart_colors[12],
        borderColor: chart_colors[12],
        borderWidth: 2
      },
      {
        label: '전화',
        data: chart_data_count_inquiry_category_regpath_tel,
        backgroundColor: chart_colors[13],
        borderColor: chart_colors[13],
        borderWidth: 2
      },
      {
        label: '이메일',
        data: chart_data_count_inquiry_category_regpath_email,
        backgroundColor: chart_colors[14],
        borderColor: chart_colors[14],
        borderWidth: 2
      },
    ]
  };

  $(function() {
    new Chart(
      document.getElementById('chart_bar_count_category_regpath').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_2,
        data: chart_data_count_category_regpath
      }
    );
  });

  // 디자인&제작 통계  
  const data_count_inquiry_category_workRange = JSON.parse('<?= json_encode($count_inquiry_category_workRange) ?>');
  const chart_data_count_inquiry_category_workRange = JSON.parse('<?= json_encode($business_data_default) ?>');

  $.each(data_count_inquiry_category_workRange, function(key, value) {
    chart_data_count_inquiry_category_workRange[value.category].work1 = value.work1;
    chart_data_count_inquiry_category_workRange[value.category].work2 = value.work2;
    chart_data_count_inquiry_category_workRange[value.category].work3 = value.work3;
  });

  const chart_data_count_inquiry_category_workRange_work1 = new Object();
  const chart_data_count_inquiry_category_workRange_work2 = new Object();
  const chart_data_count_inquiry_category_workRange_work3 = new Object();

  const count_total_workRange = {
    'work1': 0,
    'work2': 0,
    'work3': 0,
  };

  $.each(chart_data_count_inquiry_category_workRange, function(key, val) {
    chart_data_count_inquiry_category_workRange_work1[val.name] = val.work1;
    chart_data_count_inquiry_category_workRange_work2[val.name] = val.work2;
    chart_data_count_inquiry_category_workRange_work3[val.name] = val.work3;

    if (val.work1) count_total_workRange.work1 += parseInt(val.work1); // 컨트롤러에서 루프를 안돌리기 때문에 여기서 합산.
    if (val.work2) count_total_workRange.work2 += parseInt(val.work2);
    if (val.work3) count_total_workRange.work3 += parseInt(val.work3);
  });

  $("#count_total_workRange_work1").text(count_total_workRange.work1);
  $("#count_total_workRange_work2").text(count_total_workRange.work2);
  $("#count_total_workRange_work3").text(count_total_workRange.work3);

  const chart_data_count_category_workRange = {
    labels: business_label_list,
    datasets: [{
        label: '디자인',
        data: chart_data_count_inquiry_category_workRange_work1,
        backgroundColor: chart_colors[15],
        borderColor: chart_colors[15],
        borderWidth: 2
      },
      {
        label: '디자인+제작',
        data: chart_data_count_inquiry_category_workRange_work2,
        backgroundColor: chart_colors[16],
        borderColor: chart_colors[16],
        borderWidth: 2
      },
      {
        label: '제작',
        data: chart_data_count_inquiry_category_workRange_work3,
        backgroundColor: chart_colors[17],
        borderColor: chart_colors[17],
        borderWidth: 2
      },
    ]
  };

  $(function() {
    new Chart(
      document.getElementById('chart_bar_count_category_workRange').getContext("2d"), {
        type: 'bar',
        options: chart_config_bar_2,
        data: chart_data_count_category_workRange
      }
    );
  });


  // 고객사 통계
  const data_count_inquiry_company = JSON.parse('<?= json_encode($count_inquiry_company) ?>');
  const data_count_inquiry_company_value = [];

  $.each(data_count_inquiry_company, function(key, data) {
    data_count_inquiry_company_value.push(data.val);
  });

  const chart_data_count_inquiry_company = {
    labels: ['법인고객', '개인고객', '공공기관', '비과세단체'],
    datasets: [{
      data: data_count_inquiry_company_value,
      backgroundColor: chart_colors,
      hoverOffset: 4
    }]
  };

  const data_count_request_company = JSON.parse('<?= json_encode($count_request_company) ?>');
  const data_count_request_company_value = [];

  $.each(data_count_request_company, function(key, data) {
    data_count_request_company_value.push(data.val);
  });

  const chart_data_count_request_company = {
    labels: ['법인고객', '개인고객', '공공기관', '비과세단체'],
    datasets: [{
      data: data_count_request_company_value,
      backgroundColor: chart_colors,
      hoverOffset: 4
    }]
  };

  $(function() {
    new Chart(
      document.getElementById('chart_pie_count_inquiry_company').getContext("2d"), {
        type: 'pie',
        options: chart_config_pie,
        data: chart_data_count_inquiry_company
      }
    );

    new Chart(
      document.getElementById('chart_pie_count_request_company').getContext("2d"), {
        type: 'pie',
        options: chart_config_pie,
        data: chart_data_count_request_company
      }
    );
  });
</script>