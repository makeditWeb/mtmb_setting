<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 비즈니스 Controller
 */
class Business extends MTMbiz_Controller
{
    private $base_url = '/business';

    function __construct()
    {
        parent::__construct();
        $this->sanitize_post_data();
        $this->sanitize_get_data();
    }

    /**
     * Author : 배진환
     * Usage : 비즈니스 index
     * Description : 분야 유무에 따라 비즈니스 상세, 메인에 대한 분기 처리
     * Segment 
     *  - $category : 분야의 식별값
     */
    public function index($category = null)
    {
        $this->businessMain();
        // var_dump($category);
        // if (is_null($category)) {
        //     $this->businessMain();
        // } else if ($category == "referenceView") {
        //     $this->referenceView();
        // } else {
        //     $this->list($category);
        // }
    }

    /**
     * Author : 배진환
     * Usage : 비즈니스 메인
     */
    public function businessMain()
    {
        try {
            $page_info = $this->getPageInfoUser($this->base_url);
            $active_tab = (isset($_REQUEST['tab'])) ?  $_REQUEST['tab'] : '0';
            $data = [
                'page_info' => $page_info,
                'active_tab' => $active_tab,
                'business_list' => $this->business_list
            ];

            $this->load->view('/users/include/_1_head', $data);
            $this->load->view('/users/include/_2_nav', $data);
            $this->load->view('/users/business/v_business', $data);
            $this->load->view('/users/include/_4_footer');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 비즈니스 상세
     * Description : 함수명을 list로 했으나 사실상 비즈니스 상세 화면
     * Segment 
     *  - $business : 분야의 식별값
     */
    public function list($business)
    {
        try {
            $view_page = $business;

            $this->load->model('Reference_model');
            $reference_list = $this->Reference_model->get_reference_list($business);

            $this->load->model('Contents_model');
            $contents_list = $this->Contents_model->get_contents_list($business);

            $page_info = $this->getPageInfoUser($this->base_url);

            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list,
                'business_current' => $this->business_list[$business],
                'reference_list' => $reference_list,
                'contents_list' => $contents_list,
                'business' => $business
            ];

            $this->load->view('/users/include/_1_head', $data);
            $this->load->view('/users/include/_2_nav_business', $data);
            $this->load->view('/users/business/list/' . $view_page, $data);
            // $this->load->view('/users/business/v_reference', $data);
            $this->load->view('/users/include/_4_footer');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 레퍼런스 상세
     */
    public function referenceView()
    {
        $result = [];
        try {
            $idx = $this->input->post("idx");
            $this->load->model('Reference_model');
            $result = $this->Reference_model->get_reference_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $result = array("flag" => true, "message" => "data load success.", "data" => $result);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }
}
