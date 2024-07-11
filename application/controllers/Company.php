<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 회사소개 Controller
 */
class Company extends MTMbiz_Controller
{
    private $base_url = '/company';

    function __construct()
    {
        parent::__construct();
        $this->sanitize_post_data();
        $this->sanitize_get_data();
    }

    /**
     * Author : 배진환
     * Usage : 회사소개 index
     */
    public function index()
    {
        try {
            $page_info = $this->getPageInfoUser($this->base_url);
            $data = [
                'page_info' => $page_info,
                'business_list' => $this->business_list
            ];

            $this->load->view('/users/include/_1_head', $data);
            $this->load->view('/users/include/_2_nav', $data);
            $this->load->view('/users/company/v_company', $data);
            $this->load->view('/users/include/_4_footer');
        } catch (exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }
}
