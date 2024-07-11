<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 고객사 Controller
 */
class Customer extends MTMbiz_Controller
{
	private $base_url = '/admin/customer';
	private $view_list = '/admin/customer/v_customer_list';
	private $view_view = '/admin/customer/v_customer_view';
	private $view_form = '/admin/customer/v_customer_form';

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
	 * Usage : 고객사 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$page_info = $this->getPageInfoAdmin($this->base_url);
			$page_info['sch_subscribe'] = false;

			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_customer_list($page_info);
			$paging = $this->paging($page_info['url_full'], $result[1], $page_info['page_scale']);
			$data = [
				'page_info' => $page_info,
				'dataList' => $result[0],
				'paging' => $paging
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_list);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 고객사 목록 - 컨설팅 등록 시 고객사 검색에서 사용
	 */
	public function customerList()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$requestData = $this->input->post();

			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_customer_list_nopaging($requestData);

			$result = array("flag" => true, "message" => "", "data" => $result);
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			echo json_encode($result);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 고객사 상세 view
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
			//$page_info['customer_idx'] = $idx;

			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_customer_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');
			$result2 = $this->Customer_model->get_employee_list($idx);
			$result3 = $this->Customer_model->get_subscribe_list($idx);
			$result4 = $this->Admin_model->get_admin_list_nopaging();

			$page_info['list_for'] = 'customer';

			$this->load->model('Subscribe_model');
			$result5 = $this->Subscribe_model->get_subscribe_list_nopaging($page_info);

			$this->load->model('Consulting_model');
			$result6 = $this->Consulting_model->get_consulting_list_nopaging($page_info);

			$data = [
				'page_info' => $page_info,
				'customer_info' => $result,
				'customer_employee' => $result2,
				'customer_subscribe' => $result3,
				'manager_list' => $result4,
				'subscribe_work_list' => $result5,
				'consulting_list' => $result6,
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
	 * Usage : 고객사 구독 내역
	 */
	public function subscribeInfo()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_subscribe_info($requestData['idx']);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$result->expire_sdate = replaceDateTime($result->expire_sdate);
			$result->expire_edate = replaceDateTime($result->expire_edate);

			$result = array("flag" => true, "message" => "", "data" => $result);
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			echo json_encode($result);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 고객사 등록 view
	 */
	public function add()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('create');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			$dummyData = (object)[
				'idx' => '0',
				'category' => '0',
				'name' => '',
				'brn' => '',
				'ceo' => '',
				'addr' => '',
				'addr_more' => '',
				'business_type' => '',
				'business_item' => '',
				'tel' => '',
				'email' => '',
				'memo' => ''
			];

			$data = [
				'mode' => 'add',
				'page_info' => $page_info,
				'dataResult' => $dummyData,
				'category_use_customer' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 고객사 수정 view
	 */
	public function mod($idx)
	{
		try {
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$page_info = $this->getPageInfoAdmin($this->base_url);
			$page_info['idx'] = $idx;

			$this->load->model('Customer_model');
			$result = $this->Customer_model->get_customer_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$data = [
				'mode' => 'mod',
				'page_info' => $page_info,
				'dataResult' => $result,
				'category_use_customer' => $this->business_list,
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 고객사 저장(등록,수정 모두)
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
				array('field' => 'name', 'label' => '기업명', 'rules' => 'required', 'errors' => array('required' => '기업명은 필수 입력입니다.')),
				array('field' => 'brn', 'label' => '사업자등록번호', 'rules' => 'required', 'errors' => array('required' => '사업자등록번호는 필수 입력입니다.')),
				array('field' => 'ceo', 'label' => '대표자명', 'rules' => 'required', 'errors' => array('required' => '대표자명은 필수 입력입니다.')),
				array('field' => 'addr', 'label' => '주소', 'rules' => 'required', 'errors' => array('required' => '주소는 필수 입력입니다.')),
				array('field' => 'addr_more', 'label' => '상세주소', 'rules' => 'required', 'errors' => array('required' => '상세주소는 필수 입력입니다.')),
				array('field' => 'business_type', 'label' => '업태', 'rules' => 'required', 'errors' => array('required' => '업태는 필수 입력입니다.')),
				array('field' => 'business_item', 'label' => '종목', 'rules' => 'required', 'errors' => array('required' => '종목은 필수 입력입니다.')),
				array('field' => 'tel', 'label' => '대표번호', 'rules' => 'required', 'errors' => array('required' => '대표번호는 필수 입력입니다.')),
				array('field' => 'email', 'label' => '이메일', 'rules' => 'required|valid_email', 'errors' => array('required' => '이메일은 필수 입력입니다.', 'valid_email' => '이메일 양식으로 입력하여 주십시오.')),
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Customer_model');
			$idx = $this->Customer_model->{$permission_type}($requestData);

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
	 * Usage : 고객사 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();

			$this->load->model('Customer_model');
			$this->Customer_model->delete_update($requestData);

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
	 * Usage : 고객사의 담당자 저장 (등록, 수정 모두)
	 */
	public function empSave($mode)
	{
		$result = [];
		try {
			$requestData = $this->input->post();
			$permission_type = 'update';

			$permission_info = $this->getAdminNavByPermission($permission_type);
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			if ($mode == 'mod') {
				$method_name = 'emp_update';
			} else if ($mode == 'add') {
				$method_name = 'emp_create';
			} else {
				throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
			}

			$valid_config = array(
				array('field' => 'name', 'label' => '담당자명', 'rules' => 'required', 'errors' => array('required' => '담당자명은 필수 입력입니다.')),
				array('field' => 'tel', 'label' => '연락처', 'rules' => 'required', 'errors' => array('required' => '연락처는 필수 입력입니다.')),
				array('field' => 'email', 'label' => '이메일', 'rules' => 'required', 'errors' => array('required' => '이메일은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Customer_model');
			$idx = $this->Customer_model->{$method_name}($requestData);

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
	 * Usage : 고객사의 담당자 삭제
	 */
	public function empDel()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();

			$this->load->model('Customer_model');
			$this->Customer_model->emp_delete_update($requestData);

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
	 * Usage : 고객사의 월간디자인 저장 (등록,수정 모두)
	 */
	public function subSave($mode)
	{
		$result = [];
		try {
			$requestData = $this->input->post();
			$permission_type = 'update';

			$permission_info = $this->getAdminNavByPermission($permission_type);
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			if ($mode == 'mod') {
				$method_name = 'sub_update';
			} else if ($mode == 'add') {
				$method_name = 'sub_create';
			} else {
				throw new Exception('어떤 저장이 필요한지 확인할 수 없습니다.');
			}

			$valid_config = array(
				array('field' => 'expire_sdate', 'label' => '시작일', 'rules' => 'required', 'errors' => array('required' => '시작일은 필수 입력입니다.')),
				array('field' => 'expire_edate', 'label' => '종료일', 'rules' => 'required', 'errors' => array('required' => '종료일은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Customer_model');
			$idx = $this->Customer_model->{$method_name}($requestData);

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
	 * Usage : 고객사의 월간디자인 삭제
	 */
	public function subDel()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();

			$this->load->model('Customer_model');
			$this->Customer_model->sub_delete_update($requestData);

			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
