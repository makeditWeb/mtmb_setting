<?php

/**
 * Author : 배진환
 * Usage : 파트너사 model
 */
class Partbanner_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    /**
     * Author : 배진환
     * Usage : 파트너사 목록 (페이징 없음)
     */
	function get_partbanner_list($param)
	{
		$this->db->select(' * ');
		$this->db->from('partner_banner');
		$this->db->where('is_del', 'N');
		$this->db->order_by('sort', 'asc');
		$recordData = $this->db->get()->result();

		return $recordData;
	}

    /**
     * Author : 배진환
     * Usage : 파트너사 목록
     * Param     
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */	
	function get_partbanner_list2($param)
	{
		$this->db->start_cache();
		$this->db->select(' * ');
		$this->db->from('partner_banner');
		$this->db->where('is_del', 'N');
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
     * Usage : 파트너사 등록
     * Param
	 *  - $param['title'] : 파트너사(배너) 명
	 *  - $param['img_name'] : 이미지
     */
	function create($param)
	{
		$this->db->set('title', $param['title']);
		$this->db->set('img_name', $param['img_name']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('partner_banner');
		$idx = $this->db->insert_id();
		return $idx;		
	}

    /**
     * Author : 배진환
     * Usage : 파트너사 등록
     * Param
	 *  - $param['title'] : 파트너사(배너) 명
	 *  - $param['img_name'] : 이미지
	 *  - $param['idx'] : 식별값
     */
	function update($param)
	{
		$this->db->set('title', $param['title']);		
		if (strlen($param['img_name']) > 0) $this->db->set('img_name', $param['img_name']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('partner_banner');
		return $param['idx'];
	}
	
	/**
	 * Author : 배진환
	 * Usage : 파트너사 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('partner_banner');
	}
	
	/**
	 * Author : 배진환
	 * Usage : 파트너사 정렬
	 * Param
	 *  - $param['sort'] : 정렬값
	 *  - $param['idx'] : 식별값
	 */
	function sort_update($param)
	{
		$this->db->set('sort', $param['sort']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('partner_banner');
		return $param['idx'];
	}
}
