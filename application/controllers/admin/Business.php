<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 사업분야 Controller
 */
class Business extends MTMbiz_Controller
{
    private $base_url = '/admin/business';
    private $view_list = '/admin/business/v_business_list';
    private $view_form = '/admin/business/v_business_form';

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
     * Usage : 사업분야 목록
     */
    public function list()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);

            $this->load->model('Business_model');
            $result = $this->Business_model->get_business_list();

            $data = [
                'page_info' => $page_info,
                'business_list' => $result,
            ];
            $this->adminViewLayout($permission_info['data'], $data, $this->view_list);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 사업분야 등록 화면
     */
    public function add()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('create');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);

            $dummyData = (object)[
                'idx' => '0',
                'name' => '',
                'segment' => '',
                'use_partner' => false,
                'use_subscribe' => false,
                'use_statistics' => false,
                'color' => '#000000',
            ];

            $data = [
                'mode' => 'add',
                'page_info' => $page_info,
                'dataResult' => $dummyData
            ];
            $this->adminViewLayout($permission_info['data'], $data, $this->view_form);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 사업분야 수정 화면
     * Segment 
     *  - $idx : 식별값
     */
    public function mod($idx)
    {
        try {
            $permission_info = $this->getAdminNavByPermission('update');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $idx;

            $this->load->model('Business_model');
            $result = $this->Business_model->get_business_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $this->load->model('Reference_model');
            $result2 = $this->Reference_model->get_reference_list($result->segment);

            $this->load->model('Contents_model');
            $result3 = $this->Contents_model->get_contents_list($result->segment);

            $data = [
                'mode' => 'mod',
                'page_info' => $page_info,
                'dataResult' => $result,
                'reference_list' => $result2,
                'contents_list' => $result3,
            ];
            $this->adminViewLayout($permission_info['data'], $data, $this->view_form);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 사업분야 저장
     * Segment 
     *  - $mode : 등록, 수정 구분
     */
    public function save($mode)
    {
        $result = [];
        try {
            $requestData = $this->input->post();

            if ($mode == 'mod') {
                $permission_type = 'update';
            } else if ($mode == 'add') {
                $permission_type = 'create';
            } else {
                throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
            }

            $permission_info = $this->getAdminNavByPermission($permission_type);
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $valid_config = array(
                array('field' => 'name', 'label' => '분야명', 'rules' => 'required', 'errors' => array('required' => '분야명은 필수 입력입니다.')),
                array('field' => 'use_partner', 'label' => '협력업체 의뢰범위', 'rules' => 'required', 'errors' => array('required' => '협력업체 의뢰범위가 누락되었습니다.')),
                array('field' => 'use_subscribe', 'label' => '월간디자인 의뢰범위', 'rules' => 'required', 'errors' => array('required' => '월간디자인 의뢰범위가 누락되었습니다.')),
                array('field' => 'use_statistics', 'label' => '매출통계 대상', 'rules' => 'required', 'errors' => array('required' => '매출통계 대상이 누락되었습니다.')),
                array('field' => 'color', 'label' => '매출통계 색상', 'rules' => 'required', 'errors' => array('required' => '매출통계 색상이 누락되었습니다.')),
            );
            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

            $this->load->model('Business_model');
            $this->Business_model->{$permission_type}($requestData);

            $result = array("flag" => true, "message" => "저장되었습니다.", "idx" => $requestData['idx']);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 사업분야 삭제
     */
    public function del()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('delete');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Preferences_model');
            $this->Preferences_model->delete_update($requestData);

            $result = array("flag" => true, "message" => "삭제되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 사업분야 정렬 순서 저장
     * Description : 현재 정렬 상태를 일괄 저장
     */
    public function sort()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('update');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Business_model');

            foreach ($requestData['business_sort'] as $sort_list) {
                $requestData['idx'] = $sort_list['idx'];
                $requestData['sort'] = $sort_list['sort'];
                $this->Business_model->sort_update($requestData);
            }

            $result = array("flag" => true, "message" => "재정렬 되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 레퍼런스 상세
     */
    public function refView()
    {
        try {
            $requestData = $this->input->post();

            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $requestData['idx'];

            $this->load->model('Reference_model');
            $result = $this->Reference_model->get_reference_info($page_info['idx']);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $data = [
                'page_info' => $page_info,
                'dataResult' => $result
            ];
            $result = array("flag" => true, "message" => "", "data" => $data);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 레퍼런스 저장
     * Segment 
     *  - $mode : 등록, 수정 구분
     */
    public function refSave($mode)
    {
        $result = [];
        try {
            $requestData = $this->input->post();

            if ($mode == 'mod') {
                $permission_type = 'update';
            } else if ($mode == 'add') {
                $permission_type = 'create';
            } else {
                throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
            }

            $permission_info = $this->getAdminNavByPermission($permission_type);
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            // $valid_config = array(
            // 	array('field' => 'title', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목을 입력해주세요.'))
            // );
            // $this->form_validation->set_rules($valid_config);            
            // if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());


            if ($mode == "add" && !isset($_FILES['reference_img'])) throw new Exception('최소 하나 이상의 이미지 파일을 등록하여 주십시오.');


            if (isset($_FILES['reference_img'])) {
                $upload_result = $this->fileUploadArr('reference_img', '/uploads/reference/');

                if (!$upload_result['flag']) {
                    $exception_file_list = array_filter($upload_result['upload_result'], function ($arr) {
                        return $arr['flag'] === false;
                    });

                    $err_msg = '<p>저장에 실패하였습니다. 다음 파일을 확인하십시오.</p>';
                    foreach ($exception_file_list as $elist) {
                        $err_msg .= '<p>파일명 : ' . $elist['data']['file_name'] . '</p>';
                    }

                    throw new Exception($err_msg);
                }

                $save_file_arr = [];
                foreach ($upload_result['upload_result'] as $file_list) {
                    $save_file_arr[] = $file_list['file_virtual_path'];
                }

                $requestData['img_name'] = json_encode($save_file_arr);
            }

            $this->load->model('Reference_model');
            $this->Reference_model->{$permission_type}($requestData);

            $result = array("flag" => true, "message" => "저장되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 레퍼런스 삭제
     */
    public function refDel()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('delete');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Reference_model');
            $this->Reference_model->delete_update($requestData);

            $result = array("flag" => true, "message" => "삭제되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 레퍼런스 정렬 저장
     * Description : 현재 정렬 상태를 기반으로 전체 저장.
     */
    public function refSort()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('update');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Reference_model');

            foreach ($requestData['reference_sort'] as $sort_list) {
                $requestData['idx'] = $sort_list['idx'];
                $requestData['sort'] = $sort_list['sort'];
                $this->Reference_model->sort_update($requestData);
            }

            $result = array("flag" => true, "message" => "재정렬 되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }




    /**
     * Author : 배진환
     * Usage : 컨텐츠 상세
     */
    public function conView()
    {
        try {
            $requestData = $this->input->post();

            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $requestData['idx'];

            $this->load->model('Contents_model');
            $result = $this->Contents_model->get_contents_info($page_info['idx']);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $data = [
                'page_info' => $page_info,
                'dataResult' => $result
            ];
            $result = array("flag" => true, "message" => "", "data" => $data);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨텐츠 저장
     * Segment 
     *  - $mode : 등록, 수정 구분
     */
    public function conSave($mode)
    {
        $result = [];
        try {
            $requestData = $this->input->post();

            if ($mode == 'mod') {
                $permission_type = 'update';
            } else if ($mode == 'add') {
                $permission_type = 'create';
            } else {
                throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
            }

            $permission_info = $this->getAdminNavByPermission($permission_type);
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            // $valid_config = array(
            // 	array('field' => 'title', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목을 입력해주세요.'))
            // );
            // $this->form_validation->set_rules($valid_config);            
            // if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());


            if ($mode == "add" && !isset($_FILES['contents_img'])) throw new Exception('최소 하나 이상의 이미지 파일을 등록하여 주십시오.');


            if (isset($_FILES['contents_img'])) {
                $upload_result = $this->fileUploadArr('contents_img', '/uploads/contents/');

                if (!$upload_result['flag']) {
                    $exception_file_list = array_filter($upload_result['upload_result'], function ($arr) {
                        return $arr['flag'] === false;
                    });

                    $err_msg = '<p>저장에 실패하였습니다. 다음 파일을 확인하십시오.</p>';
                    foreach ($exception_file_list as $elist) {
                        $err_msg .= '<p>파일명 : ' . $elist['data']['file_name'] . '</p>';
                    }

                    throw new Exception($err_msg);
                }

                $save_file_arr = [];
                foreach ($upload_result['upload_result'] as $file_list) {
                    $save_file_arr[] = $file_list['file_virtual_path'];
                }

                $requestData['img_name'] = json_encode($save_file_arr);
            }

            $this->load->model('Contents_model');
            $this->Contents_model->{$permission_type}($requestData);

            $result = array("flag" => true, "message" => "저장되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨텐츠 삭제
     */
    public function conDel()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('delete');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Contents_model');
            $this->Contents_model->delete_update($requestData);

            $result = array("flag" => true, "message" => "삭제되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 컨텐츠 정렬 저장
     * Description : 현재 정렬 상태를 기반으로 전체 저장.
     */
    public function conSort()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('update');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Contents_model');

            foreach ($requestData['contents_sort'] as $sort_list) {
                $requestData['idx'] = $sort_list['idx'];
                $requestData['sort'] = $sort_list['sort'];
                $this->Contents_model->sort_update($requestData);
            }

            $result = array("flag" => true, "message" => "재정렬 되었습니다.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }
}
