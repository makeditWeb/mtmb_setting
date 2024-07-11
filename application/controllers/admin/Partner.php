<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 협력업체 Controller
 */
class Partner extends MTMbiz_Controller
{
	private $base_url = '/admin/partner';
	private $view_list = '/admin/partner/v_partner_list';
	private $view_view = '/admin/partner/v_partner_view';
	private $view_form = '/admin/partner/v_partner_form';

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
	 * Usage : 협력업체 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$page_info = $this->getPageInfoAdmin($this->base_url);
			$this->load->model('Partner_model');
			$result = $this->Partner_model->get_partner_list($page_info);
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
	 * Usage : 협력업체 상세
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
			$page_info['partner'] = true;

			$this->load->model('Partner_model');
			$result = $this->Partner_model->get_partner_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');
			$result2 = $this->Partner_model->get_employee_list($idx);
			$this->load->model('Consulting_model');
			$result3 = $this->Consulting_model->get_consulting_work_list($page_info);

			$data = [
				'page_info' => $page_info,
				'dataResult' => $result,
				'employee_list' => $result2,
				'work_list' => $result3,
				'business_list' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_view);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 협력업체 등록 view
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
				'brn' => '',
				'ceo' => '',
				'addr' => '',
				'addr_more' => '',
				'tel' => '',
				'fax' => '',
				'homepage' => '',
				'account_bank' => '',
				'account_num' => '',
				'account_name' => '',
				'category' => json_encode(array_keys($this->business_list)),
				'memo' => ''
			];

			$data = [
				'mode' => 'add',
				'page_info' => $page_info,
				'dataResult' => $dummyData,
				'business_list' => $this->business_list
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 협력업체 수정 view
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

			$this->load->model('Partner_model');
			$result = $this->Partner_model->get_partner_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$data = [
				'mode' => 'mod',
				'page_info' => $page_info,
				'dataResult' => $result,
				'business_list' => $this->business_list,
			];

			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 협력업체 저장
	 * Segment 
	 *  - $mode : 등록, 수정 구분.
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
				array('field' => 'tel', 'label' => '대표번호', 'rules' => 'required', 'errors' => array('required' => '대표번호는 필수 입력입니다.')),
				array('field' => 'account_bank', 'label' => '은행명', 'rules' => 'required', 'errors' => array('required' => '은행명은 필수 입력입니다.')),
				array('field' => 'account_num', 'label' => '계좌번호', 'rules' => 'required', 'errors' => array('required' => '계좌번호는 필수 입력입니다.')),
				array('field' => 'account_name', 'label' => '예금주명', 'rules' => 'required', 'errors' => array('required' => '예금주명은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Partner_model');
			$idx = $this->Partner_model->{$permission_type}($requestData);

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
	 * Usage : 협력업체 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();

			$this->load->model('Partner_model');
			$this->Partner_model->delete_update($requestData);

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
	 * Usage : 협력업체 담당자 저장
	 * Segment 
	 *  - $mode : 등록, 수정 구분.
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

			$this->load->model('Partner_model');
			$idx = $this->Partner_model->{$method_name}($requestData);

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
	 * Usage : 협력업체 담당자 삭제
	 */		
	public function empDel()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();

			$this->load->model('Partner_model');
			$this->Partner_model->emp_delete_update($requestData);

			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
