<?php

/**
 * Author : 배진환
 * Usage : 공지사항 model
 */
class Notice_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    /**
     * Author : 배진환
     * Usage : 공지사항 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword     
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
	function get_notice_list($param)
	{
		$this->db->start_cache();
		$this->db->select(' * ');
		$this->db->from('notice');
		$this->db->where('is_del', 'N');
		if ($param['sch_keyword']) {
			$this->db->group_start();
			$keywordArray = array(
				'title' => $param['sch_keyword'],
				'contents' => $param['sch_keyword']
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
	 * Usage : 공지사항 상세
	 * Param
	 *  - $idx : 식별값
	 */
	function get_notice_info($idx)
	{
		$this->db->where('idx', $idx);
		$this->db->select(' * ');
		$this->db->where('is_del', 'N');
		$result = $this->db->get('notice')->row();
		return $result;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 공지사항 등록
	 * Param
	 *  - $param['title'] : 제목
	 *  - $param['contents'] : 내용
	 */
	function create($param)
	{
		$this->db->set('title', $param['title']);
		$this->db->set('contents', $param['contents']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert("notice");
		$idx = $this->db->insert_id();
		return $idx;
	}
	
	/**
	 * Author : 배진환
	 * Usage : 공지사항 수정
	 * Param
	 *  - $param['title'] : 제목
	 *  - $param['contents'] : 내용
	 *  - $param['idx'] : 식별값
	 */
	function update($param)
	{
		$this->db->set('title', $param['title']);
		$this->db->set('contents', $param['contents']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update("notice");
		return $param['idx'];
	}

	/**
	 * Author : 배진환
	 * Usage : 공지사항 수정
	 * Param
	 *  - $idx : 식별값
	 */
	function delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('notice');
	}
}
