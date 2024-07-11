<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 담당직원 Controller
 */
class Manager extends MTMbiz_Controller
{
    private $base_url = '/admin/manager';
    private $view_list = '/admin/manager/v_manager_list';
    private $view_view = '/admin/manager/v_manager_view';
    private $view_form = '/admin/manager/v_manager_form';

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
     * Usage : 담당직원 목록
     * Description : 로그인 계정 관리 기능.
     */
    public function list()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $this->load->model('Admin_model');
            $result = $this->Admin_model->get_admin_list($page_info);
            $paging = $this->paging($page_info['url_full'], $result[1], $page_info['page_scale']);
            $data = [
                'page_info' => $page_info,
                'data_list' => $result[0],
                'paging' => $paging
            ];
            $this->adminViewLayout($permission_info['data'], $data, $this->view_list);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 담당직원 상세 view
     * Segment 
     *  - $idx : 식별값
     */
    public function view($idx)
    {
        try {
            $permission_info = $this->getAdminNavByPermission('read');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);
            $page_info['idx'] = $idx;

            $this->load->model('Admin_model');
            $result = $this->Admin_model->get_admin_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $page_info['list_for'] = 'manager';

            $this->load->model('Subscribe_model');
            $result2 = $this->Subscribe_model->get_subscribe_list_nopaging($page_info);

            $this->load->model('Consulting_model');
            $result3 = $this->Consulting_model->get_consulting_list_nopaging($page_info);

            $data = [
                'page_info' => $page_info,
                'dataResult' => $result,
                'subscribe_work_list' => $result2,
                'consulting_list' => $result3,
                'business_list' => $this->business_list,
                'consulting_status' => $this->consulting_status
            ];
            $this->adminViewLayout($permission_info['data'], $data, $this->view_view);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 담당직원 등록 view
     */
    public function add()
    {
        try {
            $permission_info = $this->getAdminNavByPermission('create');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);
            $page_info = $this->getPageInfoAdmin($this->base_url);

            $dummyData = (object)[
                'idx' => '0',
                'adm_id' => '',
                'name' => '',
                'email' => '',
                'dept' => '',
                'is_active' => 'Y',
                'grade' => '1',
                'permission' => json_encode(array_keys($this->admin_menu_list))
            ];

            $data = [
                'mode' => 'add',
                'page_info' => $page_info,
                'dataResult' => $dummyData,
                'menu_list' => $this->admin_menu_list
            ];
            $this->adminViewLayout($permission_info['data'], $data, $this->view_form);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 담당직원 수정 view
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
            $this->load->model('Admin_model');
            $result = $this->Admin_model->get_admin_info($idx);
            if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

            $data = [
                'mode' => 'mod',
                'page_info' => $page_info,
                'dataResult' => $result,
                'menu_list' => $this->admin_menu_list
            ];

            $this->adminViewLayout($permission_info['data'], $data, $this->view_form);
        } catch (Exception $e) {
            $this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
        }
    }

    /**
     * Author : 배진환
     * Usage : 담당직원 저장
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
                $valid_config = array(
                    array('field' => 'adm_id', 'label' => '아이디', 'rules' => 'required', 'errors' => array('required' => '아이디는 필수 입력입니다.')),
                    array('field' => 'adm_pass', 'label' => '비밀번호', 'rules' => 'matches[adm_pass_conf]', 'errors' => array('matches' => '비밀번호가 일치하지 않습니다.')),
                    array('field' => 'adm_pass_conf', 'label' => '비밀번호 확인', 'rules' => 'matches[adm_pass]', 'errors' => array('matches' => '비밀번호가 일치하지 않습니다.')),
                    array('field' => 'name', 'label' => '이름', 'rules' => 'required', 'errors' => array('required' => '이름은 필수 입력입니다.')),
                    array('field' => 'email', 'label' => '이메일', 'rules' => 'required|valid_email', 'errors' => array('required' => '이메일은 필수 입력입니다.', 'valid_email' => '이메일 양식으로 입력하여 주십시오.')),
                );
            } else if ($mode == 'add') {
                $permission_type = 'create';
                $valid_config = array(
                    array('field' => 'adm_pass', 'label' => '비밀번호', 'rules' => 'required|matches[adm_pass_conf]', 'errors' => array('required' => '비밀번호는 필수 입력입니다.', 'matches' => '비밀번호가 일치하지 않습니다.')),
                    array('field' => 'adm_pass_conf', 'label' => '비밀번호 확인', 'rules' => 'required|matches[adm_pass]', 'errors' => array('required' => '비밀번호 확인은 필수 입력입니다.', 'matches' => '비밀번호가 일치하지 않습니다.')),
                    array('field' => 'name', 'label' => '이름', 'rules' => 'required', 'errors' => array('required' => '이름은 필수 입력입니다.')),
                    array('field' => 'email', 'label' => '이메일', 'rules' => 'required|valid_email', 'errors' => array('required' => '이메일은 필수 입력입니다.', 'valid_email' => '이메일 양식으로 입력하여 주십시오.')),
                );
            } else {
                throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
            }

            $permission_info = $this->getAdminNavByPermission($permission_type);
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $this->load->model('Admin_model');
            $uniqueID_flag = $this->Admin_model->check_unique_id($requestData['adm_id']);
            if ($mode == 'add' && $uniqueID_flag > 0) throw new Exception('중복된 아이디입니다. 다른 아이디를 입력해 주세요.');

            $this->form_validation->set_rules($valid_config);
            if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

            $idx = $this->Admin_model->{$permission_type}($requestData);

            $result = array("flag" => true, "message" => "저장되었습니다.", "idx" => $idx);
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->sessionsLogging($result, "/admin");
            echo json_encode($result);
        }
    }

    /**
     * Author : 배진환
     * Usage : 담당직원 삭제
     */
    public function del()
    {
        $result = [];
        try {
            $permission_info = $this->getAdminNavByPermission('delete');
            if (!$permission_info['flag']) throw new Exception($permission_info['data']);

            $requestData = $this->input->post();
            $this->load->model('Admin_model');
            $this->Admin_model->delete_update($requestData);

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
     * Usage : TEST 함수
     * Description : dauoffice 그룹웨어에서 대상 계정의 이메일을 가져오는 기능.
     */
    public function test()
    {
        $config['imap_host'] = 'mtmbkorea.daouoffice.com'; // IMAP 서버 주소
        $config['imap_user'] = 'bjh@mtmbkorea.com'; // 이메일 주소
        $config['imap_pass'] = 'dltkehlwk1@'; // 이메일 비밀번호
        $config['imap_port'] = 993; // IMAP 포트 (일반적으로 993)
        $config['imap_mailbox'] = 'consulting'; // 읽을 메일함 이름
        $config['imap_secure'] = 'ssl'; // 연결 보안 설정 (ssl 또는 tls)

        $this->load->library('email');
        $this->email->initialize($config);

        $mailbox = $config['imap_mailbox'];
        $imap = imap_open("{{$config['imap_host']}}", $config['imap_user'], $config['imap_pass']);

        //$emails = imap_search($imap, 'UNSEEN');

        $searchKeyword  = 'TEST';
        $emails = imap_search($imap, 'SUBJECT "' . $searchKeyword . '"');

        // var_dump($emails);
        echo '<br/><br/>';

        if ($emails) {
            foreach ($emails as $email) {
                // 메일 헤더 정보 가져오기
                $headerInfo = imap_headerinfo($imap, $email);

                // 발신자, 수신자, 제목 가져오기
                $from = $headerInfo->from[0]->mailbox . "@" . $headerInfo->from[0]->host;
                $to = $headerInfo->to[0]->mailbox . "@" . $headerInfo->to[0]->host;
                $subject = imap_utf8($headerInfo->subject);
                $regdate = $headerInfo->date;

                echo "From: $from<br>";
                echo "Date: $regdate<br>";
                echo "Subject: $subject<br>";

                // 메일 내용 가져오기
                $message = imap_fetchbody($imap, $email, 2);

                echo "Message: " . base64_decode($message) . "<br><br><br>";
            }
        }
        imap_close($imap);
    }
}
