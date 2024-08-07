<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 팝업 Controller
 */
class Popup extends MTMbiz_Controller
{
	private $base_url = '/admin/popup';
	private $view_list = '/admin/popup/v_popup_list';
	private $view_view = '/admin/popup/v_popup_view';
	private $view_form = '/admin/popup/v_popup_form';

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
	 * Usage : 팝업 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);
			$this->load->model('Popup_model');
			$result = $this->Popup_model->get_popup_list($page_info);
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
	 * Usage : 팝업 상세
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

			$this->load->model('Popup_model');
			$result = $this->Popup_model->get_popup_info($idx);
			if (is_null($result)) throw new Exception('존재하지  않거나 삭제된 데이터 입니다.');

			$data = [
				'page_info' => $page_info,
				'dataResult' => $result
			];
			$this->adminViewLayout($permission_info['data'], $data, $this->view_view);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 팝업 등록 view
	 */	
	public function add()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('create');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			$dummyData = (object)[
				'idx' => '0',
				'title' => '',
				'contents' => '',
				'ex_sdate' => '',
				'ex_edate' => '',
				'size_width' => '100',
				'size_height' => '100',
				'location_left' => '0',
				'location_top' => '0',
				'is_active' => 'N'
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
	 * Usage : 팝업 수정 view
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

			$this->load->model('Popup_model');
			$result = $this->Popup_model->get_popup_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$data = [
				'mode' => 'mod',
				'page_info' => $page_info,
				'dataResult' => $result
			];
			$this->adminViewLayout($permission_info['data'], $data, $this->view_form);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 팝업 저장
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
				array('field' => 'title', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목은 필수 입력입니다.')),
				array('field' => 'contents', 'label' => '내용', 'rules' => 'required', 'errors' => array('required' => '내용은 필수 입력입니다.')),
				array('field' => 'size_width', 'label' => '가로사이즈', 'rules' => 'required|numeric', 'errors' => array('required' => '가로사이즈는 필수 입력입니다.', 'numeric' => '가로사이즈는 숫자로만 입력하실 수 있습니다.')),
				array('field' => 'size_height', 'label' => '세로사이즈', 'rules' => 'required|numeric', 'errors' => array('required' => '세로사이즈는 필수 입력입니다.', 'numeric' => '세로사이즈는 숫자로만 입력하실 수 있습니다.')),
				array('field' => 'location_left', 'label' => '좌측위치', 'rules' => 'required|numeric', 'errors' => array('required' => '좌측위치는 필수 입력입니다.', 'numeric' => '좌측위치는 숫자로만 입력하실 수 있습니다.')),
				array('field' => 'location_top', 'label' => '상단위치', 'rules' => 'required|numeric', 'errors' => array('required' => '상단위치는 필수 입력입니다.', 'numeric' => '상단위치는 숫자로만 입력하실 수 있습니다.'))
			);
			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Popup_model');
			$idx = $this->Popup_model->{$permission_type}($requestData);

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
	 * Usage : 팝업 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$requestData = $this->input->post();
			$this->load->model('Popup_model');
			$this->Popup_model->delete_update($requestData);
			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
