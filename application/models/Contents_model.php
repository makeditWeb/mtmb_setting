<?php

/**
 * Author : 배진환
 * Usage : 컨텐츠 model
 */
class Contents_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

    /**
     * Author : 배진환
     * Usage : 컨텐츠 목록
	 * Param
	 *  - $segment : 사업분야 코드명
     */
	function get_contents_list($segment)
	{
		$this->db->select(' * ');
		$this->db->from('consulting_setup_category_con');
		$this->db->where('is_del', 'N');
		$this->db->where('segment', $segment);
		$this->db->order_by('sort', 'asc');
		$recordData = $this->db->get()->result();

		return $recordData;
	}

    /**
     * Author : 배진환
     * Usage : 컨텐츠 상세
	 * Param
	 *  - $idx : 식별값
     */
	function get_contents_info($idx)
	{
		$this->db->select(' * ');
		$this->db->where('idx', $idx);
		$this->db->where('is_del', 'N');
		$result = $this->db->get('consulting_setup_category_con')->row();
		return $result;
	}

    /**
     * Author : 배진환
     * Usage : 컨텐츠 등록
	 * Param
	 *  - $param['title'] : 제목
	 *  - $param['segment'] : 사업분야 코드명
	 *  - $param['img_name'] : 이미지
     */
	function create($param)
	{
		$this->db->set('title', $param['title']);
		$this->db->set('segment', $param['segment']);
		$this->db->set('img_name', $param['img_name']);
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('consulting_setup_category_con');
		$idx = $this->db->insert_id();
		return $idx;
	}

    /**
     * Author : 배진환
     * Usage : 컨텐츠 등록
	 * Param
	 *  - $param['title'] : 제목	 
	 *  - $param['img_name'] : 이미지
	 *  - $param['idx'] : 식별값
     */
	function update($param)
	{
		$this->db->set('title', $param['title']);
		if (isset($param['img_name'])) $this->db->set('img_name', $param['img_name']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_category_con');
		return $param['idx'];
	}

    /**
     * Author : 배진환
     * Usage : 컨텐츠 삭제
	 * Param
	 *  - $param['title'] : 제목	 
	 *  - $param['img_name'] : 이미지
	 *  - $param['idx'] : 식별값
     */
	function delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('consulting_setup_category_con');
	}
	
	/**
	 * Author : 배진환
	 * Usage : 컨텐츠 정렬 수정
	 * Param
	 *  - $param['sort'] : 정렬값
	 *  - $param['idx'] : 식별값
	 */
	function sort_update($param)
	{
		$this->db->set('sort', $param['sort']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_category_con');
		return $param['idx'];
	}
}
