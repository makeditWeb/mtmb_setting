<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 파트너사 Controller
 */
class Partbanner extends MTMbiz_Controller
{
	private $base_url = '/admin/partbanner';
	private $view_list = '/admin/partbanner/v_partbanner_list';

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
	 * Usage : 파트너사 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			$this->load->model('Partbanner_model');
			$result = $this->Partbanner_model->get_partbanner_list($page_info);
			$data = [
				'page_info' => $page_info,
				'dataList' => $result,
				'category' => $this->business_list
			];
			$this->adminViewLayout($permission_info['data'], $data, $this->view_list);
		} catch (Exception $e) {
			$this->load->view('/errors/html/error_custom', ['message' => $e->getMessage()]);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 파트너사 저장
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
				array('field' => 'title', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목을 입력해주세요.'))
			);
			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			// 파일 저장 처리
			$img_result = $this->fileupload("partbanner_img", '/uploads/partbanner/', '', true);
			//var_dump($img_result);

			if ($mode == 'add' && !$img_result['flag']) throw new Exception($img_result['message']);
			$requestData['img_name'] = '';
			if ($img_result['flag']) $requestData['img_name'] = $img_result['file_virtual_path'];

			$this->load->model('Partbanner_model');
			$this->Partbanner_model->{$permission_type}($requestData);

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
	 * Usage : 파트너사 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Partbanner_model');
			$this->Partbanner_model->delete_update($requestData);

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
	 * Usage : 파트너사 정렬 저장
	 * Description : 파트너사 배너의 전체 순서를 일괄 저장
	 */	
	public function sort()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Partbanner_model');

			foreach ($requestData['partbanner_sort'] as $sort_list) {
				$requestData['idx'] = $sort_list['idx'];
				$requestData['sort'] = $sort_list['sort'];
				$this->Partbanner_model->sort_update($requestData);
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
