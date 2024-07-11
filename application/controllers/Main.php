<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 메인화면 Controller
 */
class Main extends MTMbiz_Controller
{
    private $base_url = '/main';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 메인화면 index
     */
    public function index()
    {
        try {
            $page_info = $this->getPageInfoUser($this->base_url);

            $page_info['sch_keyword'] =  "";
            $page_info['sort_key'] =  "regdate";
            $page_info['sort_direction'] =  "desc";
            $page_info['curr_page'] =  "1";
            $page_info['page_scale'] =  "4";

            $this->load->model('Review_model');
            $review_list = $this->Review_model->get_review_list($page_info);

            $page_info['page_scale'] =  "5";
            $this->load->model('Notice_model');
            $notice_list = $this->Notice_model->get_notice_list($page_info);

            $page_info['sort_key'] =  "sort";
            $page_info['sort_direction'] =  "asc";
            $page_info['page_scale'] =  "999";
            $this->load->model('Portfolio_model');
            $portfolio_list = $this->Portfolio_model->get_portfolio_list2($page_info);

            $this->load->model('Partbanner_model');
            $partbanner_list = $this->Partbanner_model->get_partbanner_list2($page_info);

            $this->load->model('Popup_model');
            $popup_list = $this->Popup_model->get_popup_active();

            foreach ($popup_list as $index => $plist) {
                $hid_popup = get_cookie('hide_popup_' . $plist->idx);
                if ($hid_popup == "1") unset($popup_list[$index]);
            }

            $this->load->model('Reference_model');
            $refrence_list = $this->Reference_model->get_reference_list('proposal');            

            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list,
                'refrence_list'=> $refrence_list,
                'review_list' => $review_list[0],
                'notice_list' => $notice_list[0],
                'portfolio_list' => $portfolio_list[0],
                'partbanner_list' => $partbanner_list[0],
                'popup_list' => $popup_list
            ];
            $this->load->view('/users/include/_1_head', $data);
            $this->load->view('/users/main/v_main', $data);
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 팝업 닫기
     */
    public function popupCloseToday()
    {
        $pop_idx = $this->input->post("idx");
        set_cookie('hide_popup_' . $pop_idx, true, 60 * 60 * 24);
    }


    /**
     * Author : 배진환
     * Usage : 관리자 진입경로
     */
    public function manager()
    {
        $page_info = $this->getPageInfoUser($this->base_url);

        $this->load->model('Consulting_model');
        $result1 = $this->Consulting_model->get_consulting_list_as_db("mtmbds");
        $result3 = $this->Consulting_model->get_consulting_list_as_db("nestds");

        $this->load->model('Qna_model');
        $result2 = $this->Qna_model->get_qna_list_as_db("mtmbds");        
        $result4 = $this->Qna_model->get_qna_list_as_db("nestds");

        $data = [
            'page_info' => $page_info,
            'business_list' => $this->business_list,
            'consulting_new_list_mtmb' => $result1[0],
            'consulting_new_count_mtmb' => $result1[1],
            'qna_list_mtmb' => $result2[0],
            'qna_count_mtmb' => $result2[1],
            'consulting_new_list_nest' => $result3[0],
            'consulting_new_count_nest' => $result3[1],
            'qna_list_nest' => $result4[0],
            'qna_count_nest' => $result4[1],
        ];

        $this->load->view('/users/main/v_manager', $data);
    }
}
