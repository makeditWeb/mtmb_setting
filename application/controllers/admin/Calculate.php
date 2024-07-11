<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 정산 Controller
 */
class Calculate extends MTMbiz_Controller
{
    private $base_url = '/admin/calculate';
    private $view_list = '/admin/calculate/v_calculate_list';
    private $view_view = '/admin/calculate/v_calculate_view';
    private $view_form = '/admin/calculate/v_calculate_form';

    function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    public function index()
    {
        $this->list();
    }

    /**
     * Author : 배진환
     * Usage : 정산대상 목록 (Legacy - 컨설팅에 통합됨. 23/08/21)
     * Description : 컨설팅 문의 중 의뢰로 전환된 대상만 가져오기
     */
    public function list()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['calculate'] = true;
            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_list($page_info);
            $paging = $this->paging($page_info['url_full'], $result[1], $page_info['page_scale']);
            $data = [
                'page_info' => $page_info,
                'dataList' => $result[0],
                'paging' => $paging,
                'business_list' => $this->business_list,
                'consulting_status' => $this->consulting_status
            ];

            $this->adminViewLayout($permission_info['data'], $data, $this->view_list);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 정산 상세 보기 및 수정 view (Legacy - 컨설팅에 통합됨. 23/08/21)
     * Segment 
     *  - $idx : 정산대상의 식별값
     */
    public function mod($idx)
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $idx;
            $page_info['partner'] = false;

            $this->load->model('Consulting_model');
            $result = $this->Consulting_model->get_consulting_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');
            $result2 = $this->Consulting_model->get_consulting_work_list($page_info);

            $data = [
                'page_info' => $page_info,
                'consulting_info' => $result,
                'consulting_work_list' => $result2,
                'business_list' => $this->business_list,
                'consulting_status' => $this->consulting_status
            ];

            $this->adminViewLayout($permission_info['data'], $data, $this->view_form);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 저장
     * Description : 정산 저장
     */    
    public function save()
    {
        $result = [];
        $param_del = [];
        $param_work = [];

        try {
            $requestData = $this->input->post();

            $this->load->model('Consulting_model');
            $calculate_idx = $this->Consulting_model->calculate_info_update($requestData);

            foreach ($requestData['work_values'] as $work) {
                $param_work = [
                    // 'idx' => $work['work_idx'],
                    'consulting_idx' => $calculate_idx,
                    'category' => $work['category'],
                    'price' => (isset($work['price']) && $work['price']) ? $work['price'] : '0',
                    'expenditure' => (isset($work['expenditure']) && $work['expenditure']) ? $work['expenditure'] : '0',
                    'price_vat' => (isset($work['price_vat']) && $work['price_vat']) ? $work['price_vat'] : '0',
                    'out_cost' => (isset($work['out_cost']) && $work['out_cost']) ? $work['out_cost'] : '0',
                    'out_cost_type' => (isset($work['out_cost_type']) && $work['out_cost_type']) ? $work['out_cost_type'] : '0',
                    'out_cost_status' => (isset($work['out_cost_status']) && $work['out_cost_status']) ? $work['out_cost_status'] : '0',
                    'tax_bill_status' => (isset($work['tax_bill_status']) && $work['tax_bill_status']) ? $work['tax_bill_status'] : '0',
                ];
                $this->Consulting_model->calculate_work_update($param_work);
            }

            $result = array("flag" => true, "message" => "저장되었습니다.", "idx" => $calculate_idx);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }
}
