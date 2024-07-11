<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 월간디자인 Controller
 */
class Subscribe extends MTMbiz_Controller
{
	private $base_url = '/admin/subscribe';
	private $view_list = '/admin/subscribe/v_subscribe_list';
	private $view_view = '/admin/subscribe/v_subscribe_view';
	private $view_form = '/admin/subscribe/v_subscribe_form';

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
	 * Usage : 월간디자인 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			$this->load->model('Subscribe_model');
			$result = $this->Subscribe_model->get_subscribe_list($page_info);
			$paging = $this->paging($page_info['url_full'], $result[1], $page_info['page_scale']);
			$data = [
				'page_info' => $page_info,
				'dataList' => $result[0],
				'paging' => $paging,
				'business_list' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_list);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 고객사 담당자 목록
	 * Description : 월간디자인 등록 시 선택된 고객사의 담당자 목록
	 * Segment 
	 *  - $idx : 고객사 식별값
	 */	
	public function empList($idx)
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_employee_list($idx);
			if (is_null($result)) throw new Exception('등록된 직원이 없습니다.');

			$result = array("flag" => true, "message" => "", "data" => $result);
		} catch (Exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			echo json_encode($result);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 월간디자인 상세
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

			$this->load->model('Subscribe_model');
			$result = $this->Subscribe_model->get_subscribe_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$data = [
				'page_info' => $page_info,
				'subscribe_info' => $result,
				'business_list' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_view);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 월간디자인 등록 view
	 */	
	public function add()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('create');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_customer_list_subscribe();
			$result2 = $this->Admin_model->get_admin_list_nopaging();

			$dummyData = (object)[
				'idx' => '0',
				'customer_idx' => '',
				'customer_name' => '',
				'employee_idx' => '',
				'employee_name' => '',
				'manager_idx' => '',
				'manager_id' => '',
				'manager_name' => '',
				'category' => '',
				'subject' => '',
				'difficulty' => '',
				'work_sdate' => '',
				'work_edate' => '',
				'status' => '',
			];

			$data = [
				'mode' => 'add',
				'page_info' => $page_info,
				'dataResult' => $dummyData,
				'customer_list' => $result,
				'employee_list' => [],
				'manager_list' => $result2,
				'business_list' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 월간디자인 수정 view
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

			$this->load->model('Subscribe_model');
			$result = $this->Subscribe_model->get_subscribe_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$this->load->model('Customer_model');
			$result2 = $this->Customer_model->get_customer_list_subscribe();
			$result3 = $this->Customer_model->get_employee_list($result->customer_idx);
			$result4 = $this->Admin_model->get_admin_list_nopaging();

			$data = [
				'mode' => 'mod',
				'page_info' => $page_info,
				'dataResult' => $result,
				'customer_list' => $result2,
				'employee_list' => $result3,
				'manager_list' => $result4,
				'business_list' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 월간디자인 저장
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
				array('field' => 'customer_idx', 'label' => '고객사', 'rules' => 'required', 'errors' => array('required' => '고객사는 반드시 지정되어야 합니다.')),
				array('field' => 'subject', 'label' => '건명', 'rules' => 'required', 'errors' => array('required' => '건명은 필수 입력입니다.')),
				array('field' => 'category', 'label' => '의뢰 구분', 'rules' => 'required', 'errors' => array('required' => '의뢰 구분은 반드시 지정되어야 합니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Subscribe_model');
			$idx = $this->Subscribe_model->{$permission_type}($requestData);

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
	 * Usage : 월간디자인 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();

			$this->load->model('Subscribe_model');
			$this->Subscribe_model->delete_update($requestData);

			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
