<?php
class MTMbiz_Controller extends CI_Controller
{
	/**
	 * Author : 배진환
	 * Usage : 관리자 메뉴 목록
	 * Description : 
	 *  - icon : /admin/main/icons에서 다른 아이콘도 확인 가능 (운영에선 안됨)
	 *  - is_used : 해당 메뉴의 권한 세분화.
	 */
	public $admin_menu_list = [
		'main' => [
			'name' => '대시보드', 'segment' => 'main', 'icon' => 'fa-fw fa-book-open', 'visible' => true,
			'is_used' => ['read' => true, 'create' => false, 'update' => false, 'delete' => false]
		],
		'business' => [
			'name' => '사업분야', 'segment' => 'business', 'icon' => 'fa-align-left', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'preferences' => [
			'name' => '컨설팅설정', 'segment' => 'preferences', 'icon' => 'fa-cog', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'consulting' => [
			'name' => '컨설팅', 'segment' => 'consulting', 'icon' => 'fa-file-signature', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'customer' => [
			'name' => '고객사', 'segment' => 'customer', 'icon' => 'fa-users', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'subscribe' => [
			'name' => '월간디자인', 'segment' => 'subscribe', 'icon' => 'fa-calendar-alt', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'partner' => [
			'name' => '협력업체', 'segment' => 'partner', 'icon' => 'fa-hospital-user', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		// 'calculate' => [
		// 	'name' => '정산', 'segment' => 'calculate', 'icon' => 'fa-hand-holding-usd', 'visible' => false,
		// 	'is_used' => ['read' => true, 'create' => false, 'update' => true, 'delete' => false]
		// ],
		'statistics' => [
			'name' => '매출통계', 'segment' => 'statistics', 'icon' => 'fa-won-sign', 'visible' => true,
			'is_used' => ['read' => true, 'create' => false, 'update' => true, 'delete' => false]
		],
		'review' => [
			'name' => '만족도', 'segment' => 'review', 'icon' => 'fa-handshake', 'visible' => true,
			'is_used' => ['read' => true, 'create' => false, 'update' => true, 'delete' => true]
		],
		'qna' => [
			'name' => 'QnA', 'segment' => 'qna', 'icon' => 'fa-question-circle', 'visible' => true,
			'is_used' => ['read' => true, 'create' => false, 'update' => true, 'delete' => true]
		],
		'notice' => [
			'name' => '공지사항', 'segment' => 'notice', 'icon' => 'fa-volume-up', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'popup' => [
			'name' => '팝업', 'segment' => 'popup', 'icon' => 'fa-comment-alt', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'manager' => [
			'name' => '담당직원', 'segment' => 'manager', 'icon' => 'fa-user-cog', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'partbanner' => [
			'name' => '파트너사', 'segment' => 'partbanner', 'icon' => 'fa-user-friends', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		],
		'portfolio' => [
			'name' => '포트폴리오', 'segment' => 'portfolio', 'icon' => 'fa-file-image', 'visible' => true,
			'is_used' => ['read' => true, 'create' => true, 'update' => true, 'delete' => true]
		]
	];

	/**
	 * Author : 배진환
	 * Usage : 상담분야
	 * Description : 리팩터링 대상 (초기엔 19개 고정이었으나 갈수록 뭐가 하나씩 늘어남. 이제 예측 안됨. DB에서 관리하길 권장.)	 
	 *  - use_partner : 협력업체 사용 범위
	 *  - use_subscribe : 월간디자인 의뢰 범위
	 *  - use_top : 사용자 화면에서 최상단 메뉴 여부
	 *  - use_menu : 사용자 메뉴창 표시여부
	 *  - use_statistics : 매출통계 사용여부
	 *  - sort : 정렬 순서
	 *  - color : 매출통계에서 사용하는 색상
	 * History : 
	 * 	- [2023-09-27] set_business_list() 함수를 통해 DB화된 정보 대입 후 사용.
	 */
	public $business_list = [];

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 상태값
	 * Description : 상태값이 계속 변경됨에 따라 제어기능을 추가할지 검토 필요.
	 *  - name : 상태 표기 이름
	 *  - color : 상태값 표시 색상
	 *  - calculate : 정산대상 상태값 (매출 확정인 상태값)
	 *  - sort : 상태값 나열시 순서	 
	 */
	public $consulting_status = [
		'0' => ['code' => '0', 'name' => '접수', 'color' => '#3f7ee7', 'calculate' => false, 'sort' => 0],
		'1' => ['code' => '1', 'name' => '상담', 'color' => '#6c25c7', 'calculate' => false, 'sort' => 1],
		'2' => ['code' => '2', 'name' => '견적발송', 'color' => '#db921a', 'calculate' => false, 'sort' => 2],
		'3' => ['code' => '3', 'name' => '입금확인', 'color' => '#179417', 'calculate' => true, 'sort' => 4],
		'4' => ['code' => '4', 'name' => '작업진행', 'color' => '#5c9f85', 'calculate' => true, 'sort' => 5],
		'5' => ['code' => '5', 'name' => '취소', 'color' => '#db2375', 'calculate' => false, 'sort' => 6],
		'6' => ['code' => '6', 'name' => '완료', 'color' => '#1a4386', 'calculate' => true, 'sort' => 7],
		'7' => ['code' => '7', 'name' => '확정', 'color' => '#5c9fbb', 'calculate' => true, 'sort' => 3],
	];

	function __construct()
	{
		parent::__construct();
		$this->set_business_list();
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 전역 설정
	 */
	public function set_business_list()
	{
		$this->load->model('Business_model');
		$result = $this->Business_model->get_business_list();
		$blist = [];

		foreach ($result as $key => $value) {
			$blist[$value->segment] = [
				'name' => $value->name,
				'segment' => $value->segment,
				'use_partner' => ($value->use_partner == 1) ? true : false,
				'use_subscribe' => ($value->use_subscribe == 1) ? true : false,
				'use_top' => ($value->use_top == 1) ? true : false,
				'use_menu' => ($value->use_menu == 1) ? true : false,
				'use_contents' => ($value->use_contents == 1) ? true : false,
				'use_statistics' => ($value->use_statistics == 1) ? true : false,
				'sort' => $value->sort,
				'color' => $value->color
			];
		}

		$this->business_list = $blist;
	}


	/**
	 * Author : 배진환
	 * Usage : 서버 시간 가져오기
	 */
	public function getServerTime()
	{
		echo date("Y년 m월 d일 h:i A");
	}

	/**
	 * Author : 배진환
	 * Usage : POST 데이터 정제 치환
	 */
	protected function sanitize_post_data()
	{
		foreach ($this->input->post() as $key => $value) {
			$_POST[$key] = sanitize_input($value);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : GET 데이터 정제 치환
	 */
	protected function sanitize_get_data()
	{
		foreach ($this->input->get() as $key => $value) {
			$_GET[$key] = sanitize_input($value);
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 로그인 확인
	 */
	public function checkAdminLogin()
	{
		$is_login = $this->session->userdata('is_login');
		$is_admin = $this->session->userdata('is_admin');
		if (!$is_login || !$is_admin) redirect("/admin/login/");
	}

	/**
	 * Author : 배진환
	 * Usage : 세션의 요청 데이터 기록
	 * Param
	 *  - $result : 해당 세션 요청의 결과값.
	 *  - $path : 최상단 저장경로를 의미. (현재는 사용자와 관리자 구분만 하고 있음.)
	 * Description : session, post, get 데이터와 경로, IP, agent 정보들을 저장.
	 */
	public function sessionsLogging($result, $path = "")
	{
		$this->load->model('Admin_model');
		$this->Admin_model->session_log_save(array(
			'homepath' => $path,
			'controller' => $this->router->class,
			'method' => $this->router->method,
			'session_data' => json_encode($this->session->userdata()),
			'param_post' => json_encode($this->input->post()),
			'param_get' => json_encode($this->input->get()),
			'result' => json_encode($result)
		));
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자의 권한에 따른 메뉴 표시.
	 * Param
	 *  - $permission_type : 권한의 종류.
	 * Description : 메뉴의 사용여부와 현재 세션의 접근 권한을 확인.
	 */
	public function getAdminNavByPermission($permission_type = 'read')
	{
		try {
			$current_segment = ($this->uri->segment(2)) ? $this->uri->segment(2) : 'main';

			$adm_grade = $this->session->userdata('adm_grade');
			$adm_idx = $this->session->userdata('adm_idx');

			if (!$this->admin_menu_list[$current_segment]['is_used'][$permission_type]) throw new Exception('현재 사용되지 않는 메뉴입니다.');

			$this->load->model('Admin_model');
			$admin_info = $this->Admin_model->get_admin_info($adm_idx);
			$permission_list =  json_decode($admin_info->permission);

			if ($adm_grade != '0' && !$permission_list->{$current_segment}->{$permission_type}) throw new Exception('해당 기능에 접근하실 수 없습니다.');

			foreach ($this->admin_menu_list as $key => $val) {
				$this->admin_menu_list[$key]['visible'] = ((isset($permission_list->{$key}) && $permission_list->{$key}->read) || $adm_grade == '0') ? true : false;
				$this->admin_menu_list[$key]['current'] = ($key == $current_segment) ? true : false;
			}

			$nav_info['menu_list'] = $this->admin_menu_list;
			$nav_info['current_menu_info'] = $this->admin_menu_list[$current_segment];

			$result_flag = true;
			$result_data = $nav_info;
		} catch (exception $e) {
			$result_flag = false;
			$result_data = $e->getMessage();
		}

		return array("flag" => $result_flag, "data" => $result_data);
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자에서 각 페이지 이동마다 사용되는 기본 파라미터 초기화 후 response.
	 * Param
	 *  - $url : 페이지의 기본 정보에서 사용할 URL.
	 * Description : 관리자에서 기본적으로 받게되는 파라미터들과 현재 페이지의 segment정보를 통해 정보 취합 후 return.
	 */
	public function getPageInfoAdmin($url)
	{
		$current_segment = ($this->uri->segment(2)) ? $this->uri->segment(2) : 'main';

		$result = [];
		$result['base_url'] = $url;
		$result["curr_title"] = $this->admin_menu_list[$current_segment]['name'];
		$result['curr_page'] = ($this->input->get('curr_page')) ? html_escape($this->input->get('curr_page')) : 1;
		$result['sch_keyword'] = ($this->input->get('sch_keyword')) ? html_escape($this->input->get('sch_keyword')) : '';
		$result['sch_monthly'] = ($this->input->get('sch_monthly')) ? html_escape($this->input->get('sch_monthly')) : '';

		$arr_sch_category = (strlen($this->input->get('sch_category')) > 0) ? explode(',', $this->input->get('sch_category')) : array();
		$arr_sch_status = (strlen($this->input->get('sch_status')) > 0) ? explode(',', $this->input->get('sch_status')) : array();

		$result['sch_category'] = $arr_sch_category;
		$result['sch_status'] = $arr_sch_status;

		$result['page_scale'] = ($this->input->get('page_scale')) ? html_escape($this->input->get('page_scale')) : 10;
		$result['sort_key'] = ($this->input->get('sort_key')) ? html_escape($this->input->get('sort_key')) : 'regdate';
		$result['sort_direction'] = ($this->input->get('sort_direction')) ? html_escape($this->input->get('sort_direction')) : 'desc';
		$result['url_param'] = '?page_scale=' . $result['page_scale']
			. '&sch_keyword=' . $result['sch_keyword']
			. '&sort_key=' . $result['sort_key']
			. '&sort_direction=' . $result['sort_direction']
			. '&sch_category=' . $this->input->get('sch_category')
			. '&sch_status=' . $this->input->get('sch_status')
			. '&sch_monthly=' . $this->input->get('sch_monthly');
		$result['url_full'] = $url . $result['url_param'];

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 사용자에서 각 페이지 이동마다 사용되는 기본 파라미터 초기화 후 response.
	 * Param
	 *  - $url : 페이지의 기본 정보에서 사용할 URL.
	 * Description : 사용자에서 기본적으로 받게되는 파라미터들과 현재 페이지의 segment정보를 통해 정보 취합 후 return.
	 */
	public function getPageInfoUser($url)
	{
		$current_segment = ($this->uri->segment(1)) ? $this->uri->segment(1) : 'main';
		$result = [];
		$result['curr_segment'] = $current_segment;
		$result['base_url'] = $url;
		$result['section'] = ($this->input->get('section')) ? html_escape($this->input->get('section')) : '';
		$result["curr_title"] = 'MTMbiz Design';

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자에서 사용하는 view 통일 구조.
	 * Param
	 *  - $nav_info : navigation에서 사용할 정보들.
	 *  - $data : 컨텐츠 view에 전달할 정보들.
	 *  - $view_page : view페이지 이름
	 */
	public function adminViewLayout($nav_info, $data, $view_page)
	{
		$this->load->view('/admin/include/_1_head');
		$this->load->view('/admin/include/_2_nav', $nav_info);
		$this->load->view($view_page, $data);
		$this->load->view('/admin/include/_3_modal');
		$this->load->view('/admin/include/_4_footer');
	}

	/**
	 * Author : 배진환
	 * Usage : 게시판 페이징.
	 * Param
	 *  - $base_url : 페이지를 클릭할때 이동할 기본 URL
	 *  - $total_rows : 총 데이터 수
	 *  - $page_scale : 페이지당 보여줄 데이터 수
	 */
	public function paging($base_url = '', $total_rows, $page_scale)
	{
		$this->load->library('pagination');
		$pnConfig['base_url'] = $base_url;
		$pnConfig['per_page'] = $page_scale;
		$pnConfig['total_rows'] = $total_rows;
		$pnConfig['num_links'] = 4;
		$pnConfig['use_page_numbers'] = true;
		$pnConfig['page_query_string'] = true;
		$pnConfig['attributes'] = array('class' => 'page-link');

		$pnConfig['full_tag_open'] = '<ul class="pagination">';
		$pnConfig['full_tag_close'] = '</ul>';

		$pnConfig['first_link'] = '◀◀';
		$pnConfig['first_tag_open'] = '<li class="paginate_button page-item previous">';
		$pnConfig['first_tag_close'] = '</li>';

		$pnConfig['last_link'] = '▶▶';
		$pnConfig['last_tag_open'] = '<li class="paginate_button page-item next">';
		$pnConfig['last_tag_close'] = '</li>';

		$pnConfig['prev_link'] = '◀';
		$pnConfig['prev_tag_open'] = '<li class="paginate_button page-item previous">';
		$pnConfig['prev_tag_close'] = '</li>';

		$pnConfig['next_link'] = '▶';
		$pnConfig['next_tag_open'] = '<li class="paginate_button page-item next">';
		$pnConfig['next_tag_close'] = '</li>';

		$pnConfig['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
		$pnConfig['cur_tag_close'] = '</a></li>';

		$pnConfig['num_tag_open'] = '<li class="paginate_button page-item">';
		$pnConfig['num_tag_close'] = '</li>';

		$this->pagination->initialize($pnConfig);
		$pagination_result = $this->pagination->create_links();

		return $pagination_result;
	}

	/**
	 * Author : 배진환
	 * Usage : 폴더 생성.
	 * Param
	 *  - $path : 생성 경로
	 */
	public function dirMake($path)
	{
		$upload_physical_path = FCPATH . $path;
		$oldumask = umask(0);
		if (!is_dir($upload_physical_path)) {
			mkdir($upload_physical_path, 0777, true);
		}
		umask($oldumask);
	}

	/**
	 * Author : 배진환
	 * Usage : summernote 이미지 업로드.
	 */
	public function editorUpload()
	{ //이미지 업로드만		
		$filepath = $this->input->post('upload_path');
		$this->dirmake($filepath);
		$config['upload_path'] = FCPATH . $filepath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10 * 1024;
		$config['max_width']  = '9999';
		$config['max_height']  = '9999';
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('sn_editor')) {
			$upload_result = $this->upload->data();
			$upload_result['flag'] = true;
			$upload_result['file_virtual_path'] = $filepath . $upload_result['file_name'];
		} else {
			$upload_result['flag'] = false;
			$upload_result['file_virtual_path'] = $this->upload->display_errors();
		}

		echo json_encode($upload_result);
	}

	/**
	 * Author : 배진환
	 * Usage : 이미지 업로드
	 * Param
	 *  - $el : 파일을 갖고있는 파라미터 명
	 *  - $filepath : 파일 저장 경로
	 *  - $filename : 파일명
	 *  - $encryptFlag : 파일명 난수화 여부
	 */
	public function fileUpload($el, $filepath, $filename, $encryptFlag)
	{
		$this->dirmake($filepath);
		$config['upload_path'] = FCPATH . $filepath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10 * 1024;
		$config['max_width']  = '9999';
		$config['max_height']  = '9999';
		$config['encrypt_name'] = ($encryptFlag) ? true : false;
		$config['file_name'] = (!$encryptFlag) ? $filename : '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload($el)) {
			$upload_result = $this->upload->data();
			$upload_result['flag'] = true;
			$upload_result['file_virtual_path'] = $filepath . $upload_result['file_name'];
		} else {
			$upload_result['flag'] = false;
			$upload_result['message'] = $this->upload->display_errors();
		}

		return $upload_result;
	}

	/**
	 * Author : 배진환
	 * Usage : 이미지, 문서업로드
	 * Param
	 *  - $el : 파일을 갖고있는 파라미터 명
	 *  - $filepath : 파일 저장 경로
	 *  - $filename : 파일명
	 *  - $encryptFlag : 파일명 난수화 여부
	 */
	public function fileUpload_doc($el, $filepath, $filename, $encryptFlag)
	{
		$this->dirmake($filepath);
		$config['upload_path'] = FCPATH . $filepath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|txt|doc|docx|xls|xlsx|ppt|pptx|hwp|hwpx';
		$config['max_size'] = 10 * 1024;
		$config['max_width']  = '9999';
		$config['max_height']  = '9999';
		$config['encrypt_name'] = ($encryptFlag) ? true : false;
		$config['file_name'] = (!$encryptFlag) ? $filename : '';
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload($el)) {
			$upload_result = $this->upload->data();
			$upload_result['flag'] = true;
			$upload_result['file_virtual_path'] = $filepath . $upload_result['file_name'];
		} else {
			$upload_result['flag'] = false;
			$upload_result['message'] = $this->upload->display_errors();
		}

		return $upload_result;
	}

	/**
	 * Author : 배진환
	 * Usage : 이미지 업로드 (멀티)
	 * Param
	 *  - $arr_el : 파일을 갖고있는 파라미터 명
	 *  - $filepath : 파일 저장 경로
	 */
	public function fileUploadArr($arr_el, $filepath)
	{
		$this->dirmake($filepath);
		$config['upload_path'] = FCPATH . $filepath;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 10 * 1024;
		$config['max_width']  = '99999';
		$config['max_height']  = '99999';
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		$err_count = 0;
		$upload_result = [];
		$files_name = $_FILES[$arr_el]['name'];
		$files = $_FILES[$arr_el];

		foreach ($files_name as $key => $val) {
			$_FILES[$arr_el] = array(
				'name' => $files['name'][$key],
				'type' => $files['type'][$key],
				'tmp_name' => $files['tmp_name'][$key],
				'error' => $files['error'][$key],
				'size' => $files['size'][$key]
			);

			if ($this->upload->do_upload($arr_el)) {
				$upload_data = $this->upload->data();
				$upload_result[] = [
					'flag' => true,
					'file_virtual_path' => $filepath . $upload_data['file_name'],
					'data' => $this->upload->data()
				];
			} else {
				$err_count++;
				$upload_result[] = [
					'flag' => false,
					'data' => $this->upload->data()
				];
			}
		}

		if ($err_count > 0) {
			$result['flag'] = false;
			$result['upload_result'] = $upload_result;
			$result['message'] = 'fileupload failed';
		} else {
			$result['flag'] = true;
			$result['upload_result'] = $upload_result;
			$result['message'] = 'fileupload success';
		}

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 파일 다운로드
	 * Param
	 *  - $file_path : 파일 경로
	 *  - $file_name : 파일명
	 */
	public function file_download($file_path, $file_name)
	{
		$file_path = urldecode($file_path);
		$file_name = urldecode($file_name);

		$file_path = FCPATH . substr($file_path, 1);

		if (file_exists($file_path)) {
			$this->load->helper('download');
			$data = file_get_contents($file_path);
			force_download($file_name, $data);
		} else {
			echo 'File not found.';
		}
	}

	/**
	 * Author : 배진환
	 * Usage : 세션 활동정보 가져오기
	 * Description : 특정 컨트롤러, 메서드에서 특정 데이터에 대한 활동기록을 가져오는 기능.
	 * Param
	 *  - $param['controller'] : 컨트롤러 명. 
	 *  - $param['method'] : 메소드 명
	 *  - $param['idx'] : 식별값
	 */
	function get_session_log($param)
	{
		$this->db->select(" * ");
		$this->db->from('sessions_log');
		$this->db->where_in('controller', $param['controller']);
		$this->db->where_in('method', $param['method']);
		$this->db->where(' json_value(param_post, \'$.idx\') = ', $param['idx']);
		$this->db->order_by('idx', 'ASC');
		$recordData = $this->db->get()->result();
		return $recordData;
	}

	/**
	 * Author : 배진환
	 * Usage : 메일 발신기
	 * Param
	 *  - $mail_to : 수신대상
	 *  - $mail_subject : 제목
	 *  - $mail_contents : 내용
	 */
	public function sendMail($mail_to, $mail_subject, $mail_contents)
	{
		$result = [];
		$gmail_id = 'mtmbkorea@gmail.com';
		$gmail_pw = 'oeohjzdckaafrmyn';

		try {
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'smtp.gmail.com';
			$config['smtp_port'] = 465;
			$config['smtp_user'] = $gmail_id;
			$config['smtp_pass'] = $gmail_pw;
			$config['smtp_crypto'] = 'ssl';
			$config['mailtype'] = 'html';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;
			$config['newline'] = "\r\n";

			$this->load->library('email', $config);
			$this->email->from('mtmbkorea@gmail.com', 'MTMBds System');
			$this->email->to($mail_to);
			$this->email->subject($mail_subject);
			$this->email->message($mail_contents);

			$this->email->send();
			$result = array("flag" => true, "message" => "success");
		} catch (exception $e) {
			$result = array("flag" => false, "message" => $e);
		} finally {
			return $result;
		}
	}

	/**
	 * Author : 배진환
	 * Usage : mtmbds의 문의 알림 메일 기본 양식
	 * Param
	 *  - $params : 메일 내용에 담길 기본 정보.
	 */
	public function consultingMailContents($params)
	{
		$resultHtml = "
		<table width='780' border='0' cellspacing='0' cellpadding='0'>
			<tr>
				<td align='center' style='background:#f4f4f4; padding:20px 0'>
					<table width='740' border='0' align='center' cellpadding='0' cellspacing='0' style='margin:0 auto'>
						<tr>
							<td width='50%' height='70' align='left' valign='middle' style='background:#fff; padding:0 20px'><img src='https://mtmbds.com/resources/users/img/site_logo.jpg' width='184.5' height='77.25' /></td>
							<td width='50%' height='70' align='right' valign='middle' style='background:#fff;padding:0 20px'><a href='http://mtmbds.com/admin/' class='btn' target='_blank' style='text-align:center; background:#fff; padding:10px 0; display:block; width:150px; border:1px solid #066386; font-weight:bold; color:#066386; text-decoration:none;font-size:12px; '>시스템 바로가기</a></td>
						</tr>
						<tr>
							<td height='70' colspan='2' align='left' valign='middle' style='background:#fff; padding:30px 20px'>
								<table width='100%' border='0' cellspacing='0' cellpadding='0'>
									<tr>
										<td width='460' align='left' valign='middle' style='font-size:12px; color:#999; letter-spacing:-1px'>
											<strong style='color:#066386'>컨설팅 문의가 접수되었습니다.</strong> <br />
										</td>
									</tr>
								</table>
								<p style='border-bottom:1px dashed #ccc; height:40px; margin-bottom:20px'></p>
								<table width='700' border='0' cellspacing='0' cellpadding='0' style='border-collapse:collapse; border-top:1px solid #066386;border-left:1px solid #ebebeb;border-right:1px solid #ebebeb;'>
									<caption style='height:20px; padding:30px 0 5px 0; color:#333; text-align:left; font-weight:bold; font-size:14px; letter-spacing:-1px'></caption>
									<tr>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>단체명</strong></td>
										<td width='280' height='30' align='center' bgcolor='#FFFFFF'><strong style='color: #333'>" . $params['name'] . "</strong></td>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>담당자</strong></td>
										<td width='280' height='30' align='center' bgcolor='#FFFFFF'><strong style='color: #333'>" . $params['employee_name'] . "</strong></td>
									</tr>
									<tr>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>휴대전화</strong></td>
										<td width='280' height='30' align='center' bgcolor='#FFFFFF'><strong style='color: #333'>" . $params['employee_tel'] . "</strong></td>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>일반전화</strong></td>
										<td width='280' height='30' align='center' bgcolor='#FFFFFF'><strong style='color: #333'>" . $params['tel'] . "</strong></td>
									</tr>
									<tr>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>이메일</strong></td>
										<td width='280' height='30' align='center' bgcolor='#FFFFFF'><strong style='color: #333'>" . $params['employee_email'] . "</strong></td>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>문의경로</strong></td>
										<td width='280' height='30' align='center' bgcolor='#FFFFFF'><strong style='color: #333'>" . replaceConsultingRegPath($params['reg_path']) . "</strong></td>										
									</tr>
									<tr>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>문의내용</strong></td>
										<td colspan='3' height='30' align='left' bgcolor='#FFFFFF'><strong style='color: #333'>
									";
		$prev_segment = "";
		foreach ($params['question_values'] as $questions) {
			if ($prev_segment != $questions['segment']) $resultHtml .= "<br/>" . $this->business_list[$questions['segment']]['name'] . "<br/>";
			$resultHtml .= strip_tags(htmlspecialchars_decode($questions['answer']));
			$resultHtml .= "<br/>";
			$prev_segment = $questions['segment'];
		}

		$resultHtml .= "<br/><br/>";
		$resultHtml .= "			
										</strong></td>
									</tr>	
									<tr>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>세부사항</strong></td>
										<td colspan='3' height='30' align='left' bgcolor='#FFFFFF'><strong style='color: #333'>" . stripslashes(nl2br2($params['request'])) . "</strong></td>
									</tr>
									<tr>
										<td width='120' height='30' align='center' bgcolor='F5F5F5'><strong style='color:#066386'>첨부파일</strong></td>
										<td colspan='3' height='30' align='left' bgcolor='#FFFFFF'><strong style='color: #333'>" . (($params['file_count'] > 0) ? '파일이 있습니다. 관리자에서 확인하여 주십시오.' : ''). "</strong></td>
									</tr>									
								</table>
							</td>
						</tr>
						<tr>
							<td height='70' colspan='2' align='left' valign='middle' style='background:#f4f4f4;'>
								<p style='font-size:11px; padding:20px 0 10px 5px;margin: 0; color:#999;letter-spacing:-1px; line-height:18px; text-align:left;'>
								<span style='color: #666'>+ 본 메일은 발신전용이므로 회신하실 경우 답변되지 않습니다.</span>
								</p>
							</td>
						</tr>
						<tr>
							<td height='70' colspan='2' align='left' valign='middle' style='background:#fff; padding:20px'>
							<table width='100%' cellpadding='0' cellspacing='0' style='font-size:11px; padding:20px 0 10px 5px;margin: 0; color:#999;letter-spacing:-1px; line-height:18px; text-align:left;'>
								<tr>
									<td>
										(주)엠티엠비코리아
										<br/>
										서울특별시 강서구 양천로 424 데시앙플렉스 지식산업센터 1231호
									</td>
								</tr>
								<tr>
									<td>
										COPYRIGHT (c) 2023 MTMBKOREA Co., Ltd. ALL RIGHTS RESERVED.
									</td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		";

		return $resultHtml;
	}
}
