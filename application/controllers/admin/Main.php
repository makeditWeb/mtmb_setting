<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 메인 Controller
 */
class Main extends MTMbiz_Controller
{
    private $base_url = '/admin/main';

    function __construct()
    {
        parent::__construct();
        $this->checkAdminLogin();
    }

    public function index()
    {
        $this->main();
    }

    /**
     * Author : 배진환
     * Usage : 메인화면 
     */
    public function main()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            $page_info = $this->getPageInfoAdmin($this->base_url);

            $page_info['sch_status'] = array('0');
            $page_info['calculate'] = false;
            $page_info['is_user'] = false;
            $page_info['page_scale'] = 100;
            $page_info['sort_direction'] = 'ASC';
            $this->load->model('Consulting_model');
            $result1 = $this->Consulting_model->get_consulting_list($page_info);

            $page_info['sch_status'] = array('3', '4', '7');
            $result2 = $this->Consulting_model->get_consulting_list($page_info);

            $page_info['manager_idx'] = $this->session->userdata('adm_idx');
            $result7 = $this->Consulting_model->get_consulting_list($page_info);

            unset($page_info['manager_idx']);
            $page_info['sch_status'] = array('0', '1');
            $this->load->model('Subscribe_model');
            $result3 = $this->Subscribe_model->get_subscribe_list($page_info);

            $page_info['manager_idx'] = $this->session->userdata('adm_idx');
            $result8 = $this->Subscribe_model->get_subscribe_list($page_info);

            $page_info['sch_status'] = array('0');
            $this->load->model('Review_model');
            $result4 = $this->Review_model->get_review_list($page_info);

            $this->load->model('Qna_model');
            $result5 = $this->Qna_model->get_qna_list($page_info);

            $page_info['sch_subscribe'] = true;
            $page_info['sort_key'] = 'subscribe_edate';
            $this->load->model('Customer_model');
            $result6 = $this->Customer_model->get_customer_list($page_info);

            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list,
                'consulting_new_list' => $result1[0],
                'consulting_new_count' => $result1[1],
                'consulting_request_list' => $result2[0],
                'consulting_request_count' => $result2[1],
                'subscribe_work_new_list' => $result3[0],
                'subscribe_work_new_count' => $result3[1],
                'review_list' => $result4[0],
                'review_count' => $result4[1],
                'qna_list' => $result5[0],
                'qna_count' => $result5[1],
                'subscribe_expire_list' => $result6[0],
                'subscribe_expire_count' => $result6[1],
                'consulting_request_list_my' => $result7[0],
                'consulting_request_count_my' => $result7[1],
                'subscribe_work_new_list_my' => $result8[0],
                'subscribe_work_new_count_my' => $result8[1],
            ];
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $this->adminViewLayout($permission_info['data'], $data, '/admin/main/v_main');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 현재 사용할 수 있는 모든 icon 종류 확인용.
     */
    public function icons()
    {
        $permission_info = $this->getAdminNavByPermission('read');
        $page_info = $this->getPageInfoAdmin($this->base_url);
        $queryResult = [];
        $data = [
            'page_info' => $page_info
        ];
        $pagenation;

        $this->adminViewLayout($permission_info['data'], $data, '/admin/font_awesome_exam');
    }
}
