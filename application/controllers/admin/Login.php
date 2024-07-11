<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 로그인 Controller
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->login();
    }

	/**
	 * Author : 배진환
	 * Usage : 로그인 view
	 */
    public function login()
    {
        $this->load->view('/admin/login/v_login');
    }

	/**
	 * Author : 배진환
	 * Usage : 로그인 처리
	 */
    public function loginSubmit()
    {
        $result = [];
        try {
            $request = $this->input->post();
            $login_id = $request['loginID'];
            $login_pw = $request['loginPW'];

            $this->load->model('Admin_model');
            $user = $this->Admin_model->get_admin_id($login_id);

            if (is_null($user)) throw new Exception("로그인에 실패하였습니다.<br/>아이디와 비밀번호를 확인하여 주십시오.");
            if (!password_verify($login_pw, $user->adm_pass)) throw new Exception("로그인에 실패하였습니다.<br/>아이디와 비밀번호를 확인하여 주십시오.");
            if ($user->is_active != 'Y') throw new Exception("로그인에 실패하였습니다.<br/>관리자에게 문의하여 주십시오.");

            $this->setSession($user);
            $this->Admin_model->log_admin_login($user->idx);
            $result = array("flag" => true, "message" => "로그인.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $request['loginPW'] = null;
            $this->Admin_model->session_log_save(array(
                'homepath' => "/admin",
                'controller' => $this->router->class,
                'controller' => $this->router->class,
                'method' => $this->router->method,
                'session_data' => json_encode($this->session->userdata()),
                'param_post' => json_encode($request),
                'param_get' => json_encode($this->input->get()),
                'result' => json_encode($result)
            ));
            echo json_encode($result);
        }
    }

	/**
	 * Author : 배진환
	 * Usage : 로그아웃 처리
	 */    
    public function logoutSubmit()
    {
        $result = [];
        try {
            $admin_session = $this->session->userdata();
            $this->load->model('Admin_model');
            $this->session->unset_userdata('admin_ID');
            $session_data = array(
                'is_admin' => false,
                'is_login' => false,
            );
            $this->session->set_userdata($session_data);
            $result = array("flag" => true, "message" => "로그아웃.");
        } catch (exception $e) {
            $result = array("flag" => false, "message" => $e->getMessage());
        } finally {
            $this->Admin_model->session_log_save(array(
                'homepath' => "/admin",
                'controller' => $this->router->class,
                'method' => $this->router->method,
                'session_data' => json_encode($this->session->userdata()),
                'param_post' => json_encode($this->input->post()),
                'param_get' => json_encode($this->input->get()),
                'result' => json_encode($result)
            ));
            echo json_encode($result);
        }
    }

	/**
	 * Author : 배진환
	 * Usage : 세션 정보 불러오기
	 */
    function setSession($user)
    {
        $session_data = array(
            'adm_idx' => $user->idx,
            'adm_id' => $user->adm_id,
            'adm_name' => $user->name,
            'adm_grade' => $user->grade,
            'is_admin' => true,
            'is_login' => true
        );
        $this->session->set_userdata($session_data);
    }
}
