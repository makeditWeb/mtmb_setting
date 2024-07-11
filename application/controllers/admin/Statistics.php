<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 매출통게 Controller
 */
class Statistics extends MTMbiz_Controller
{
    private $base_url = '/admin/Statistics';
    private $status_calculate; // 매출집계 대상들만 모인 배열
    private $status_calculate_str; // 매출집계 대상들로만 만든 전체 문자열    

    function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();

        // 매출로 인정할 상태값 배열 및 문자열 생성
        $status_list = array_filter($this->consulting_status, function ($item) {
            return $item['calculate'] === true;
        });
        $this->status_calculate = array_column($status_list, 'code');
        $this->status_calculate_str = "'" . implode("','", $this->status_calculate) . "'";
    }

    public function index()
    {
        $this->statics_init();
    }


    /**
     * Author : 배진환
     * Usage : 매출통게
     */
    public function statics_init()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['sch_sdate'] = ($this->input->get('sch_sdate')) ? date("Y-m-d 00:00", strtotime($this->input->get('sch_sdate'))) : date("Y-m-d 00:00");
            $page_info['sch_edate'] = ($this->input->get('sch_edate')) ? date("Y-m-d 23:59", strtotime($this->input->get('sch_edate'))) : date("Y-m-d 23:59");

            $result_stat = array();
            $result_stat_sum = array(
                'sales' => 0,
                'outcost' => 0,
                'revenue' => 0,
                'count_inquiry' => 0,
                'count_request' => 0,
            );

            $loop_end = new DateTime($page_info['sch_edate']);

            // 년도별 
            $loop_year_curr = new DateTime($page_info['sch_sdate']);
            while ($loop_year_curr <= $loop_end) {
                $yyyy = $loop_year_curr->format('Y');
                $result_stat['yearly'][$yyyy] = array(
                    'yyyy' => $yyyy,
                    'label' => $yyyy . '년',
                    'sales' => 0,
                    'outcost' => 0,
                    'revenue' => 0,
                    'count_inquiry' => 0,
                    'count_request' => 0,
                );
                $loop_year_curr->add(new DateInterval('P1Y'));
            }

            // 월별
            $loop_month_curr = new DateTime($page_info['sch_sdate']);
            while ($loop_month_curr <= $loop_end) {
                $yyyymm = $loop_month_curr->format('Ym');
                $result_stat['monthly'][$yyyymm] = array(
                    'yyyymm' => $yyyymm,
                    'label' => substr($yyyymm, 0, 4) . '년 ' . substr($yyyymm, 4, 2) . '월',
                    'sales' => 0,
                    'outcost' => 0,
                    'revenue' => 0,
                    'count_inquiry' => 0,
                    'count_request' => 0,
                );
                $loop_month_curr->add(new DateInterval('P1M'));
            }

            // 주간별
            $loop_week_curr = new DateTime($page_info['sch_sdate']);
            $loop_week_end = new DateTime($page_info['sch_edate']);

            $loop_week_curr->modify('last sunday');
            $loop_week_end->modify('this saturday');

            $stat_weekly_first = clone $loop_week_curr;
            $stat_weekly_first->modify('next sunday');
            $stat_weekly_last = clone $loop_week_end;

            while ($loop_week_curr <= $loop_week_end) {
                $week_close_date = clone $loop_week_curr;
                $week_close_date->modify('this saturday');

                $week_set_num = clone $loop_week_curr; // DB와 주차 계산이 1주씩 차이나서 임의로 다음주차로 이동시킴.
                $week_set_num->modify('next sunday');

                $yyyyww = $week_set_num->format('oW');

                $result_stat['weekly'][$yyyyww] = array(
                    // 'sdate' => $loop_week_curr->format('Y-m-d'),
                    // 'edate' => $week_close_date->format('Y-m-d'),
                    'yyyyww' => $yyyyww,
                    'label' => $loop_week_curr->format('Y-m-d') . ' ~ ' . $week_close_date->format('Y-m-d'),
                    'sales' => 0,
                    'outcost' => 0,
                    'revenue' => 0,
                    'count_inquiry' => 0,
                    'count_request' => 0,
                );

                $loop_week_curr->add(new DateInterval('P1W'));
            }

            $result_stat['weekly'][$stat_weekly_first->format('oW')]['sdate'] = date('Y-m-d', strtotime($page_info['sch_sdate']));
            $result_stat['weekly'][$stat_weekly_last->format('oW')]['edate'] = date('Y-m-d', strtotime($page_info['sch_edate']));

            // 일별
            $loop_day_curr = new DateTime($page_info['sch_sdate']);

            while ($loop_day_curr <= $loop_end) {
                $yyyymmdd = $loop_day_curr->format('Ymd');
                $result_stat['daily'][$yyyymmdd] = array(
                    'yyyymmdd' => $yyyymmdd,
                    'label' => $loop_day_curr->format('Y-m-d'),
                    'sales' => 0,
                    'outcost' => 0,
                    'revenue' => 0,
                    'count_inquiry' => 0,
                    'count_request' => 0,
                );
                $loop_day_curr->add(new DateInterval('P1D'));
            }

            $this->load->model('Statis_model');
            $result_stat_total = $this->Statis_model->get_stat_total($page_info);
            $result_stat_count = $this->Statis_model->get_stat_count($page_info);

            foreach ($result_stat_total['yearly'] as $list) {
                $result_stat['yearly'][$list->yyyy]['sales'] = $list->sales;
                $result_stat['yearly'][$list->yyyy]['outcost'] = $list->outcost;
                $result_stat['yearly'][$list->yyyy]['revenue'] = $list->revenue;
                $result_stat['yearly'][$list->yyyy]['count_request'] = $list->count;
            }

            foreach ($result_stat_total['monthly'] as $list) {
                $result_stat['monthly'][$list->yyyymm]['sales'] = $list->sales;
                $result_stat['monthly'][$list->yyyymm]['outcost'] = $list->outcost;
                $result_stat['monthly'][$list->yyyymm]['revenue'] = $list->revenue;
                $result_stat['monthly'][$list->yyyymm]['count_request'] = $list->count;
            }

            foreach ($result_stat_total['weekly'] as $list) {
                $result_stat['weekly'][$list->yyyyww]['sales'] = $list->sales;
                $result_stat['weekly'][$list->yyyyww]['outcost'] = $list->outcost;
                $result_stat['weekly'][$list->yyyyww]['revenue'] = $list->revenue;
                $result_stat['weekly'][$list->yyyyww]['count_request'] = $list->count;
            }

            foreach ($result_stat_total['daily'] as $list) {
                $result_stat['daily'][$list->yyyymmdd]['sales'] = $list->sales;
                $result_stat['daily'][$list->yyyymmdd]['outcost'] = $list->outcost;
                $result_stat['daily'][$list->yyyymmdd]['revenue'] = $list->revenue;
                $result_stat['daily'][$list->yyyymmdd]['count_request'] = $list->count;

                $result_stat_sum['sales'] += $list->sales;
                $result_stat_sum['outcost'] += $list->outcost;
                $result_stat_sum['revenue'] += $list->revenue;
                $result_stat_sum['count_request'] += $list->count;
            }

            foreach ($result_stat_count['yearly'] as $list) {
                $result_stat['yearly'][$list->yyyy]['count_inquiry'] = $list->count;
            }

            foreach ($result_stat_count['monthly'] as $list) {
                $result_stat['monthly'][$list->yyyymm]['count_inquiry'] = $list->count;
            }

            foreach ($result_stat_count['weekly'] as $list) {
                $result_stat['weekly'][$list->yyyyww]['count_inquiry'] = $list->count;
            }

            foreach ($result_stat_count['daily'] as $list) {
                $result_stat['daily'][$list->yyyymmdd]['count_inquiry'] = $list->count;
                $result_stat_sum['count_inquiry'] += $list->count;
            }

            // 금 : 고객사 유형별, 고객사 매출순위
            // 월 : 컨설팅 파일등록

            $result_statis_category = $this->Statis_model->get_statis_result_category($page_info); // 집계 합 (분야별)
            $result_count_inquiry_category = $this->Statis_model->get_count_inquiry_category($page_info); // 문의 건수 (분야별)
            $result_count_request_category = $this->Statis_model->get_count_request_category($page_info); // 의뢰 건수 (분야별)
            $result_count_inquiry_category_regpath = $this->Statis_model->get_count_inquiry_category_regpath($page_info); // 의뢰 건수 (분야별-경로별)
            $result_count_inquiry_category_workRange = $this->Statis_model->get_count_inquiry_category_workRange($page_info); // 의뢰 건수 (분야별-의뢰범위별)
            $result_count_inquiry_company = $this->Statis_model->get_count_inquiry_company($page_info);
            $result_count_request_company = $this->Statis_model->get_count_request_company($page_info);
            $result_company_rank_sales = $this->Statis_model->get_company_rank_sales($page_info);

            $business_list = array_filter($this->business_list, function ($item) {
                return $item['use_statistics'] === true;
            });

            $business_label_list = [];
            $business_data_default = [];

            foreach ($business_list as $blist) {
                $business_label_list[] = $blist['name'];
                $business_data_default[$blist['segment']]['name'] = $blist['name'];
                $business_data_default[$blist['segment']]['val'] = 0;
            }

            $data = [
                'page_info' => $page_info,
                'result_stat' => $result_stat,
                'result_stat_sum' => $result_stat_sum,
                'business_list' => $business_list,
                'result_statis_category' => $result_statis_category,
                'status_calculate_str' => $this->status_calculate_str,
                'business_label_list' => $business_label_list,
                'count_inquiry_category' => $result_count_inquiry_category,
                'count_request_category' => $result_count_request_category,
                'business_data_default' => $business_data_default,
                'count_inquiry_category_regpath' => $result_count_inquiry_category_regpath,
                'count_inquiry_category_workRange' => $result_count_inquiry_category_workRange,
                'count_inquiry_company' => $result_count_inquiry_company,
                'count_request_company' => $result_count_request_company,
                'company_rank_sales' =>$result_company_rank_sales,
            ];

            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $this->adminViewLayout($permission_info['data'], $data, '/admin/statistics/v_statistics');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }
}
