<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : QnA Controller
 */
class Qna extends MTMbiz_Controller
{
	private $base_url = '/admin/qna';
	private $view_list = '/admin/qna/v_qna_list';
	private $view_view = '/admin/qna/v_qna_view';
	private $view_form = '/admin/qna/v_qna_form';

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
	 * Usage : QnA 목록
	 */
	public function list()
	{
		try {
			$permission_info = $this->getAdminNavByPermission('read');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$page_info = $this->getPageInfoAdmin($this->base_url);
			$this->load->model('Qna_model');
			$result = $this->Qna_model->get_qna_list($page_info);
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
	 * Usage : QnA 상세
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

			$this->load->model('Qna_model');
			$result = $this->Qna_model->get_qna_info($idx);
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
	 * Usage : QnA 등록 test
	 */	
	public function test()
	{
		$permission_info = $this->getAdminNavByPermission('read');
		$page_info = $this->getPageInfoAdmin($this->base_url);

		$data = [
			'page_info' => $page_info
		];

		$this->adminViewLayout($permission_info['data'], $data, '/admin/qna/test.php');
	}

	/**
	 * Author : 배진환
	 * Usage : QnA 저장 test
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
				array('field' => 'qna_pass', 'label' => '비밀번호', 'rules' => 'required', 'errors' => array('required' => '비밀번호는 필수 입력입니다.')),
				array('field' => 'contents', 'label' => '내용', 'rules' => 'required', 'errors' => array('required' => '내용은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Qna_model');
			$idx = $this->Qna_model->create($requestData);

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
	 * Usage : QnA 답변
	 * Segment 
	 *  - $idx : 식별값
	 */		
	public function reply($idx)
	{
		try {
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);
			$page_info = $this->getPageInfoAdmin($this->base_url);
			$page_info['idx'] = $idx;

			$this->load->model('Qna_model');
			$result = $this->Qna_model->get_qna_info($idx);
			if (is_null($result)) throw new Exception('존재하지 않거나 삭제된 데이터 입니다.');

			$data = [
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
	 * Usage : QnA 저장
	 */		
	public function save()
	{
		$result = [];
		try {
			$requestData = $this->input->post();
			$permission_info = $this->getAdminNavByPermission('update');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$valid_config = array(
				array('field' => 'answer', 'label' => '답변내용', 'rules' => 'required', 'errors' => array('required' => '답변내용은 필수 입력입니다.'))
			);

			$this->form_validation->set_rules($valid_config);
			if (!$this->form_validation->run()) throw new Exception($this->form_validation->error_string());

			$this->load->model('Qna_model');
			$idx = $this->Qna_model->reply($requestData);

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
	 * Usage : QnA 삭제
	 */		
	public function del()
	{
		$result = [];
		try {
			$permission_info = $this->getAdminNavByPermission('delete');
			if (!$permission_info['flag']) throw new Exception($permission_info['data']);

			$requestData = $this->input->post();
			$this->load->model('Qna_model');
			$this->Qna_model->delete_update($requestData);

			$result = array("flag" => true, "message" => "삭제되었습니다.");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e->getMessage());
		} finally {
			$this->sessionsLogging($result, "/admin");
			echo json_encode($result);
		}
	}
}
