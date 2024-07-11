<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 만족도 Controller
 */
class Review extends MTMbiz_Controller
{
	private $base_url = '/admin/review';
	private $view_list = '/admin/review/v_review_list';
	private $view_view = '/admin/review/v_review_view';
	private $view_form = '/admin/review/v_review_form';

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
	 * Usage : 만족도 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$page_info = $this->getPageInfoAdmin($this->base_url);
			$this->load->model('Review_model');
			$result = $this->Review_model->get_review_list($page_info);
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
	 * Usage : 만족도 상세
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

			$this->load->model('Review_model');
			$result = $this->Review_model->get_review_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

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
	 * Usage : 만족도 등록 test
	 */
	public function test()
	{
		$permission_info = $this->getAdminNavByPermission('read');
		$page_info = $this->getPageInfoAdmin($this->base_url);

		$data = [
			'page_info' => $page_info
		];

		$this->adminViewLayout($permission_info['data'], $data, '/admin/review/test.php');
	}

	/**
	 * Author : 배진환
	 * Usage : 만족도 저장 test
	 */	
	public function testSave()
	{
		$result = [];
		try {
			$requestData = $this->input->post();

			$permission_info = $this->getAdminNavByPermission('create');

			$valid_config = array(
				array('field' => 'name', 'label' => '작성자', 'rules' => 'required', 'errors' => array('required' => '작성자명은 필수 입력입니다.')),
				array('field' => 'subject', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목은 필수 입력입니다.')),
				array('field' => 'review_pass', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
				array('field' => 'contents', 'label' => '내용', 'rules' => 'required', 'errors' => array('required' => '내용은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Review_model');
			$idx = $this->Review_model->create($requestData);

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
	 * Usage : 만족도 수정 view
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

			$this->load->model('Review_model');
			$result = $this->Review_model->get_review_info($idx);
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
	 * Usage : 만족도 저장
	 */	
	public function save()
	{
		$result = [];
		try {
			$requestData = $this->input->post();
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData['status'] = (strlen(strip_tags($requestData['reply'])) > 0) ? "1" : "0";

			$valid_config = array(
				array('field' => 'name', 'label' => '작성자', 'rules' => 'required', 'errors' => array('required' => '작성자는 필수 입력입니다.')),
				array('field' => 'score', 'label' => '별점', 'rules' => 'required', 'errors' => array('required' => '별점은 필수 입력입니다.')),
				array('field' => 'subject', 'label' => '제목', 'rules' => 'required', 'errors' => array('required' => '제목은 필수 입력입니다.')),
				array('field' => 'contents', 'label' => '내용', 'rules' => 'required', 'errors' => array('required' => '내용은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Review_model');
			$idx = $this->Review_model->update($requestData);

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
	 * Usage : 만족도 삭제
	 */	
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Review_model');
			$this->Review_model->delete_update($requestData);

			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
