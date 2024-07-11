<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 환경설정 Controller
 */
class Preferences extends MTMbiz_Controller
{
	private $base_url = '/admin/preferences';
	private $view_list = '/admin/preferences/v_preferences';

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
	 * Usage : 환경설정 문의 수신 이메일, 컨설팅 질문 답변 목록
	 */
	public function list($category = 'consultation')
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			if (!array_key_exists($category, $this->business_list)) throw new Exception('올바르지 않은 구분값입니다.');
			$page_info['category'] = $category;
			$page_info['seg_sort'] = $this->business_list[$category]['sort'];

			$this->load->model('Preferences_model');
			$result = $this->Preferences_model->get_questions_list($page_info);
			$result2 = $this->Preferences_model->get_answer_list($page_info);
			$result3 = $this->Preferences_model->get_email_list($page_info);
			$result4 = $this->Preferences_model->get_smshp_list($page_info);

			$data = [
				'page_info' => $page_info,
				'question_list' => $result,
				'answer_list' => $result2,
				'email_list' => $result3,
				'smshp_list' => $result4,
				'category' => $this->business_list
			];
			$this->adminViewLayout($permission_info['data'], $data, $this->view_list);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 질문, 답변 저장
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
				array('field' => 'question', 'label' => '질문', 'rules' => 'required', 'errors' => array('required' => '질문의 내용은 필수 입력입니다.')),
				array('field' => 'segment', 'label' => '분류', 'rules' => 'required', 'errors' => array('required' => '분류값이 누락되었습니다.')),
			);
			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Preferences_model');
			$this->Preferences_model->{$permission_type}($requestData);

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
	 * Usage : 질문 삭제
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
	 * Usage : 질문 정렬 저장
	 * Description : 현재 정렬 상태를 일괄 저장
	 */
	public function sort()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Preferences_model');

			foreach ($requestData['question_sort'] as $sort_list) {
				$requestData['idx'] = $sort_list['idx'];
				$requestData['sort'] = $sort_list['sort'];
				$this->Preferences_model->sort_update($requestData);
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
	 * Usage : 답변 저장
	 * Segment 
	 *  - $mode : 등록, 수정 구분
	 */
	public function ansSave($mode)
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
				array('field' => 'answer', 'label' => '답변', 'rules' => 'required', 'errors' => array('required' => '답변의 내용은 필수 입력입니다.')),
				array('field' => 'question_idx', 'label' => '질문식별값', 'rules' => 'required', 'errors' => array('required' => '질문식별값이 누락되었습니다.')),
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Preferences_model');
			$this->Preferences_model->{'ans_' . $permission_type}($requestData);

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
	 * Usage : 답변 삭제
	 */
	public function ansDel()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Preferences_model');
			$this->Preferences_model->ans_delete_update($requestData);

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
	 * Usage : 답변 정렬 저장
	 * Description : 현재 정렬 상태를 일괄 저장
	 */
	public function ansSort()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Preferences_model');

			foreach ($requestData['answer_sort'] as $sort_list) {
				$requestData['idx'] = $sort_list['idx'];
				$requestData['sort'] = $sort_list['sort'];
				$this->Preferences_model->ans_sort_update($requestData);
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
	 * Usage : 컨설팅 수신 이메일 등록
	 */
	public function emailAdd()
	{
		$result = [];
		try {
			$requestData = $this->input->post();
			$permission_info = $this->getAdminNavByPermission("create");
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$valid_config = array(
				array('field' => 'name', 'label' => '사용자', 'rules' => 'required', 'errors' => array('required' => '사용자 이름은 필수값입니다.')),
				array('field' => 'email', 'label' => '이메일주소', 'rules' => 'required|valid_email', 'errors' => array('required' => '이메일 주소는 필수값입니다.', 'valid_email' => '올바른 이메일 주소를 입력하여 주십시오.')),
			);
			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Preferences_model');
			$this->Preferences_model->email_create($requestData);
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
	 * Usage : 컨설팅 수신 이메일 삭제
	 */
	public function emailDel()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$idx = $this->input->post("idx");
			$this->load->model('Preferences_model');
			$this->Preferences_model->email_delete_update($idx);

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
	 * Usage : 컨설팅 수신 휴대폰번호 등록
	 */
	public function smshpAdd()
	{
		$result = [];
		try {
			$requestData = $this->input->post();
			$permission_info = $this->getAdminNavByPermission("create");
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$valid_config = array(
				array('field' => 'name', 'label' => '사용자', 'rules' => 'required', 'errors' => array('required' => '사용자 이름은 필수값입니다.')),
				array('field' => 'smshp', 'label' => '휴대폰번호', 'rules' => 'required', 'errors' => array('required' => '휴대폰번호는 필수값입니다.')),
			);
			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Preferences_model');
			$this->Preferences_model->smshp_create($requestData);
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
	 * Usage : 컨설팅 수신 휴대폰번호 삭제
	 */
	public function smshpDel()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$idx = $this->input->post("idx");
			$this->load->model('Preferences_model');
			$this->Preferences_model->smshp_delete_update($idx);

			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
