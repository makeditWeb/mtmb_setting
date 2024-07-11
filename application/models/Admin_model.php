<?php

/**
 * Author : 배진환
 * Usage : 관리자 model
 */
class Admin_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 계정정보
	 * Description : 해당 계정의 모든 정보를 불러오지만 현재는 로그인의 아이디 검증 부분만으로 쓰임.
	 * Param
	 *  - $id : 조회대상의 id
	 */
	function get_admin_id($id)
	{
		$result = $this->db->get_where('admin_info', array('adm_id' => $id, 'is_del' => 'N'))->row();
		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 계정정보
	 * Param
	 *  - $idx : 식별값
	 */
	function get_admin_info($idx)
	{
		$this->db->select(" * ");
		$this->db->where('idx', $idx);
		$this->db->where('is_del', 'N');
		$result = $this->db->get('admin_info')->row();
		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 최종 로그인 업데이트
	 * Param
	 *  - $idx : 식별값
	 */
	function log_admin_login($idx)
	{
		$this->db->set('last_login', 'NOW(6)', false);
		$this->db->where('idx', $idx);
		$this->db->update('admin_info');
	}

	/**
	 * Author : 배진환
	 * Usage : 현재 세션의 요청정보를 logging
	 * Param
	 *  - $log['homepath'] : 사용자 관리자 구분
	 *  - $log['controller'] : 요청 대상 controller 경로
	 *  - $log['method'] : 요청 대상 method 경로
	 *  - $log['session_data'] : 세션 정보
	 *  - $log['param_post'] : post 파라미터
	 *  - $log['param_get'] : get 파라미터
	 *  - $log['result'] : 요청 결과
	 */
	function session_log_save($log)
	{
		$this->db->set('remote_addr', $_SERVER['REMOTE_ADDR']);
		$this->db->set('user_agent', $_SERVER['HTTP_USER_AGENT']);
		$this->db->set('home_path', $log['homepath']);
		$this->db->set('controller', $log['controller']);
		$this->db->set('method', $log['method']);
		$this->db->set('session_data', $log['session_data']);
		$this->db->set('param_post', $log['param_post']);
		$this->db->set('param_get', $log['param_get']);
		$this->db->set('result', $log['result']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->insert('sessions_log');
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 목록
	 * Param
	 *  - $param['sch_keyword'] : 검색 keyword
	 *  - $param['sort_key'] : 정렬 기준
	 *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
	 *  - $param['curr_page'] : 현재 페이지
	 *  - $param['page_scale'] : limit offset
	 */
	function get_admin_list($param)
	{
		$this->db->start_cache();
		$this->db->select(" * ");
		$this->db->from('admin_info');
		$this->db->where('is_del', 'N');
		if ($param['sch_keyword']) {
			$this->db->group_start();
			$keywordArray = array(
				'adm_id' => $param['sch_keyword'],
				'name' => $param['sch_keyword'],
				'email' => $param['sch_keyword'],
				'dept' => $param['sch_keyword']
			);
			$this->db->or_like($keywordArray);
			$this->db->group_end();
		}
		$this->db->stop_cache();

		$recordCount = $this->db->count_all_results();

		$this->db->order_by($param['sort_key'], $param['sort_direction']);
		$offset = ($param['curr_page'] - 1) * $param['page_scale'];
		$this->db->limit($param['page_scale'], $offset);
		$recordData = $this->db->get()->result();

		$this->db->flush_cache();

		return [$recordData, $recordCount];
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 목록 (페이징, 검색 없음)
	 */
	function get_admin_list_nopaging()
	{
		$this->db->select(" * ");
		$this->db->from('admin_info');
		$this->db->where('is_del', 'N');
		$this->db->order_by('name', 'asc');
		$recordData = $this->db->get()->result();
		return $recordData;
	}

	/**
	 * Author : 배진환
	 * Usage : 아이디 중복 검사
	 */
	function check_unique_id($adminID)
	{
		$this->db->where('adm_id', $adminID);
		$result = $this->db->get('admin_info')->num_rows();
		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 등록
	 * Param
	 *  - $param['adm_id'] : 관리자 아이디
	 *  - $param['adm_pass'] : 관리자 비밀번호
	 *  - $param['name'] : 이름
	 *  - $param['email'] : 이메일주소
	 *  - $param['dept'] : 부서
	 *  - $param['is_active'] : 활성화 여부 
	 *  - $param['grade'] : 등급 (총괄, 담당)
	 *  - $param['permission'] : 관리권한
	 */
	function create($param)
	{
		$this->db->set('adm_id', $param['adm_id']);
		$this->db->set('adm_pass', password_hash($param['adm_pass'], PASSWORD_DEFAULT));
		$this->db->set('name', $param['name']);
		$this->db->set('email', $param['email']);
		$this->db->set('dept', $param['dept']);
		$this->db->set('is_active', $param['is_active']);
		$this->db->set('grade', $param['grade']);
		$this->db->set('is_del', 'N');
		$this->db->set('permission', $param['permission']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('admin_info');
		$idx = $this->db->insert_id();
		return $idx;
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 수정
	 * Param
	 *  - $param['adm_pass'] : 관리자 비밀번호
	 *  - $param['name'] : 이름
	 *  - $param['email'] : 이메일주소
	 *  - $param['dept'] : 부서
	 *  - $param['is_active'] : 활성화 여부 
	 *  - $param['grade'] : 등급 (총괄, 담당)
	 *  - $param['permission'] : 관리권한
	 *  - $param['idx'] : 식별값
	 */
	function update($param)
	{
		if ($param['adm_pass']) $this->db->set('adm_pass', password_hash($param['adm_pass'], PASSWORD_DEFAULT));
		$this->db->set('name', $param['name']);
		$this->db->set('email', $param['email']);
		$this->db->set('dept', $param['dept']);
		$this->db->set('is_active', $param['is_active']);
		$this->db->set('grade', $param['grade']);
		$this->db->set('permission', $param['permission']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('admin_info');
		return $param['idx'];
	}

	/**
	 * Author : 배진환
	 * Usage : 관리자 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('admin_info');
	}
}
