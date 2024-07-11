<?php

/**
 * Author : 배진환
 * Usage : 환경설정  model
 */
class Preferences_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    /**
     * Author : 배진환
     * Usage : 질문 목록
	 * Param
	 *  - $param['category'] : 사업분야
     */
	function get_questions_list($param)
	{
		$this->db->select(' * ');
		$this->db->from('consulting_setup_questions as ccq');
		$this->db->where_in('segment', $param['category']);
		$this->db->where('is_del', 'N');
		$this->db->order_by('seg_sort asc, sort asc');
		$recordData = $this->db->get()->result();

		return $recordData;
	}

    /**
     * Author : 배진환
     * Usage : 답변 목록
	 * Param
	 *  - $param['category'] : 사업분야
     */
	function get_answer_list($param)
	{
		$this->db->select(' * ');
		$this->db->from('consulting_setup_answers');
		$this->db->where_in('segment', $param['category']);
		$this->db->where('is_del', 'N');
		$this->db->order_by('segment asc, sort asc');
		$recordData = $this->db->get()->result_array();

		return $recordData;
	}

    /**
     * Author : 배진환
     * Usage : 질문 등록
	 * Param
	 *  - $param['segment'] : 사업분야 코드명
	 *  - $param['seg_sort'] : 질문 순서
	 *  - $param['question'] : 질문 내용
     */
	function create($param)
	{
		$this->db->set('segment', $param['segment']);
		$this->db->set('seg_sort', $param['seg_sort']);
		$this->db->set('question', ($param['question']));
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('consulting_setup_questions');
		$idx = $this->db->insert_id();
		return $idx;
	}

    /**
     * Author : 배진환
     * Usage : 질문 수정
	 * Param	 
	 *  - $param['seg_sort'] : 질문 순서
	 *  - $param['question'] : 질문 내용
	 *  - $param['idx'] : 식별값
     */
	function update($param)
	{
		$this->db->set('question', ($param['question']));
		$this->db->set('seg_sort', $param['seg_sort']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_questions');
		return $param['idx'];
	}
	
	/**
	 * Author : 배진환
	 * Usage : 질문 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('consulting_setup_questions');
	}

    /**
     * Author : 배진환
     * Usage : 질문 정렬 수정
	 * Param
	 *  - $param['sort'] : 질문 순서
	 *  - $param['idx'] : 식별값
     */
	function sort_update($param)
	{
		$this->db->set('sort', $param['sort']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_questions');
		return $param['idx'];
	}
	
	/**
	 * Author : 배진환
	 * Usage : 답변 등록
	 * Param
	 *  - $param['segment'] : 사업분야 코드명
	 *  - $param['question_idx'] : 질문 식별값
	 *  - $param['answer'] : 답변 내용
	 */
	function ans_create($param)
	{
		$this->db->set('segment', $param['segment']);
		$this->db->set('question_idx', $param['question_idx']);
		$this->db->set('answer', ($param['answer']));
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('consulting_setup_answers');
		$idx = $this->db->insert_id();
		return $idx;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 답변 수정
	 * Param
	 *  - $param['answer'] : 답변 내용
	 *  - $param['idx'] : 식별값
	 */
	function ans_update($param)
	{
		$this->db->set('answer', ($param['answer']));
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_answers');
		return $param['idx'];
	}
	
	/**
	 * Author : 배진환
	 * Usage : 답변 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function ans_delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('consulting_setup_answers');
	}

	/**
	 * Author : 배진환
	 * Usage : 답변 정렬 수정
	 * Param
	 *  - $param['sort'] : 답변 순서
	 *  - $param['idx'] : 식별값
	 */
	function ans_sort_update($param)
	{
		$this->db->set('sort', $param['sort']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_answers');
		return $param['idx'];
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨설팅 수신 이메일 목록 (레코드셋)
	 */
	function get_email_list()
	{
		$this->db->select(' * ');
		$this->db->from('consulting_setup_email');
		$this->db->where('is_del', 'N');
		$this->db->order_by('regdate desc');
		$recordData = $this->db->get()->result();
		
		return $recordData;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨설팅 수신 이메일 목록 (배열)
	 */
	function get_email_array()
	{
		$this->db->select(' group_concat(email SEPARATOR  \'|\') as email_list ');
		$this->db->from('consulting_setup_email');
		$this->db->where('is_del', 'N');
		$this->db->order_by('idx asc');
		$recordData = $this->db->get()->result();
		
		return $recordData;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨설팅 수신 이메일 등록
	 * Param
	 *  - $param['name'] : 수신자명
	 *  - $param['email'] : 이메일주소
	 */
	function email_create($param)
	{
		$this->db->set('name', $param['name']);
		$this->db->set('email', $param['email']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('consulting_setup_email');
		$idx = $this->db->insert_id();
		return $idx;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨설팅 수신 이메일 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function email_delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('consulting_setup_email');
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨설팅 SMS 수신 휴대폰 번호 목록 (레코드셋)
	 */
	function get_smshp_list()
	{
		$this->db->select(' * ');
		$this->db->from('consulting_setup_smshp');
		$this->db->where('is_del', 'N');
		$this->db->order_by('regdate desc');
		$recordData = $this->db->get()->result();
		return $recordData;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨설팅 SMS 수신 휴대폰 번호 목록 (배열)
	 */
	function get_smshp_array()
	{
		$this->db->select(' group_concat(smshp SEPARATOR  \'|\') as smshp_list ');
		$this->db->from('consulting_setup_smshp');
		$this->db->where('is_del', 'N');
		$this->db->order_by('idx asc');
		$recordData = $this->db->get()->result();
		return $recordData;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 SMS 수신 휴대폰 번호 등록
	 * Param
	 *  - $param['name'] : 수신자명
	 *  - $param['smshp'] : 휴대폰번호
	 */
	function smshp_create($param)
	{
		$this->db->set('name', $param['name']);
		$this->db->set('smshp', $param['smshp']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('consulting_setup_smshp');
		$idx = $this->db->insert_id();
		return $idx;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 SMS 수신 휴대폰 번호 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function smshp_delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('consulting_setup_smshp');
	}
}
