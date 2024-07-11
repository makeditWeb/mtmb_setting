<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 포트폴리오 Controller
 */
class Portfolio extends MTMbiz_Controller
{
	private $base_url = '/admin/portfolio';
	private $view_list = '/admin/portfolio/v_portfolio_list';

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
	 * Usage : 포트폴리오 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);

			$this->load->model('Portfolio_model');
			$result = $this->Portfolio_model->get_portfolio_list($page_info);
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
	 * Usage : 포트폴리오 상세
	 */	
	public function view()
	{
		try {
			$requestData = $this->input->post();

			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);
			$page_info['idx'] = $requestData['idx'];

			$this->load->model('Portfolio_model');
			$result = $this->Portfolio_model->get_portfolio_info($page_info['idx']);
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
	 * Usage : 포트폴리오 저장
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
			if ($mode == "add" && !isset($_FILES['portfolio_img'])) throw new Exception('최소 하나 이상의 이미지 파일을 등록하여 주십시오.');


			if (isset($_FILES['portfolio_img'])) {
				$upload_result = $this->fileUploadArr('portfolio_img', '/uploads/portfolio/');

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

			$this->load->model('Portfolio_model');
			$this->Portfolio_model->{$permission_type}($requestData);

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
	 * Usage : 포트폴리오 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Portfolio_model');
			$this->Portfolio_model->delete_update($requestData);

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
	 * Usage : 포트폴리오 정렬 저장
	 * Description : 현재 정렬 상태를 기반으로 전체 저장.
	 */	
	public function sort()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Portfolio_model');

			foreach ($requestData['portfolio_sort'] as $sort_list) {
				$requestData['idx'] = $sort_list['idx'];
				$requestData['sort'] = $sort_list['sort'];
				$this->Portfolio_model->sort_update($requestData);
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
