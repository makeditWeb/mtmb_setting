<?php

/**
 * Author : 배진환
 * Usage : 사업분야 model
 */
class Business_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 목록
	 * Description : 디자인 사업부에서 수행하는 사업분야 전체 목록.
	 */
	function get_business_list()
	{
		$this->db->select(' * ');
		$this->db->from('consulting_setup_category');
		$this->db->where('is_del', 'N');
		$this->db->order_by('sort asc');
		$recordData = $this->db->get()->result();

		return $recordData;
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 상세
	 * Param
	 *  - $idx : 식별값
	 */
	function get_business_info($idx)
	{
		$this->db->where('idx', $idx);
		$this->db->where('is_del', 'N');
		$this->db->select(' * ');
		$result = $this->db->get('consulting_setup_category')->row();
		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 등록
	 * Param
	 *  - $param['name'] : 분야명
	 *  - $param['segment'] : 고유식별코드
	 *  - $param['use_partner'] : 협력업체 의뢰 사용 여부
	 *  - $param['use_subscribe'] : 월간디자인 의뢰범위 사용 여부
	 *  - $param['use_statistics'] : 매출통계 출력 대상 여부
	 *  - $param['color'] : 매출 통계 색상
	 */
	function create($param)
	{
		$this->db->set('name', $param['name']);
		$this->db->set('segment', $param['segment']);
		$this->db->set('use_partner', $param['use_partner']);
		$this->db->set('use_subscribe', $param['use_subscribe']);
		$this->db->set('use_statistics', $param['use_statistics']);
		$this->db->set('color', $param['color']);
		$this->db->set('sort', '99');
		$this->db->set('regdate', 'NOW(6)', false);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->insert('consulting_setup_category');
		$idx = $this->db->insert_id();
		return $idx;
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 수정
	 * Param
	 *  - $param['name'] : 분야명	 
	 *  - $param['use_partner'] : 협력업체 의뢰 사용 여부
	 *  - $param['use_subscribe'] : 월간디자인 의뢰범위 사용 여부
	 *  - $param['use_statistics'] : 매출통계 출력 대상 여부
	 *  - $param['color'] : 매출 통계 색상
	 *  - $param['idx'] : 수정대상 식별값
	 */
	function update($param)
	{
		$this->db->set('name', $param['name']);
		$this->db->set('use_partner', $param['use_partner']);
		$this->db->set('use_subscribe', $param['use_subscribe']);
		$this->db->set('use_statistics', $param['use_statistics']);
		$this->db->set('color', $param['color']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_category');
		return $param['idx'];
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 삭제
	 * Param
	 *  - $idx : 식별값
	 */
	function delete_update($idx)
	{
		$this->db->set('is_del', 'Y');
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where_in('idx', $idx);
		$this->db->update('consulting_setup_category');
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야 정렬 수정
	 * Param
	 *  - $param['sort'] : 정렬값
	 *  - $param['idx'] : 식별값
	 */
	function sort_update($param)
	{
		$this->db->set('sort', $param['sort']);
		$this->db->set('moddate', 'NOW(6)', false);
		$this->db->where('idx', $param['idx']);
		$this->db->update('consulting_setup_category');
		return $param['idx'];
	}
}
