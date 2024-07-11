<?php

/**
 * Author : 배진환
 * Usage : 공지사항 model
 */
class Popup_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 팝업 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword     
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_popup_list($param)
    {
        $this->db->start_cache();
        $this->db->select(' * ');
        $this->db->from('popup');
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
     * Usage : 팝업 상세
     * Param
     *  - $idx : 식별값
     */
    function get_popup_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $result = $this->db->get('popup')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 활성화 팝업 목록
     */
    function get_popup_active()
    {
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $this->db->where('is_active', 'Y');
        $this->db->where('NOW() BETWEEN ex_sdate AND ex_edate');
        $result = $this->db->get('popup')->result();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 팝업 등록
     * Param
     *  - $param['title'] : 제목
     *  - $param['contents'] : 내용
     *  - $param['ex_sdate'] : 게시일
     *  - $param['ex_edate'] : 종료일
     *  - $param['size_width'] : 가로 길이
     *  - $param['size_height'] : 세로 길이
     *  - $param['location_left'] : 위치 (X축 - 좌부터 0)
     *  - $param['location_top'] : 위치 (Y축 - 위부터 0)
     *  - $param['is_active'] : 활성화 상태
     */
    function create($param)
    {
        $this->db->set('title', $param['title']);
        $this->db->set('contents', $param['contents']);
        $this->db->set('ex_sdate', $param['ex_sdate']);
        $this->db->set('ex_edate', $param['ex_edate']);
        $this->db->set('size_width', $param['size_width']);
        $this->db->set('size_height', $param['size_height']);
        $this->db->set('location_left', $param['location_left']);
        $this->db->set('location_top', $param['location_top']);
        $this->db->set('is_active', $param['is_active']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("popup");
        $idx = $this->db->insert_id();
        return $idx;
    }

    /**
     * Author : 배진환
     * Usage : 팝업 수정
     * Param
     *  - $param['title'] : 제목
     *  - $param['contents'] : 내용
     *  - $param['ex_sdate'] : 게시일
     *  - $param['ex_edate'] : 종료일
     *  - $param['size_width'] : 가로 길이
     *  - $param['size_height'] : 세로 길이
     *  - $param['location_left'] : 위치 (X축 - 좌부터 0)
     *  - $param['location_top'] : 위치 (Y축 - 위부터 0)
     *  - $param['is_active'] : 활성화 상태
     *  - $param['idx'] : 식별값
     */
    function update($param)
    {
        $this->db->set('title', $param['title']);
        $this->db->set('contents', $param['contents']);
        $this->db->set('ex_sdate', $param['ex_sdate']);
        $this->db->set('ex_edate', $param['ex_edate']);
        $this->db->set('size_width', $param['size_width']);
        $this->db->set('size_height', $param['size_height']);
        $this->db->set('location_left', $param['location_left']);
        $this->db->set('location_top', $param['location_top']);
        $this->db->set('is_active', $param['is_active']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("popup");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : 팝업 수정
     * Param
     *  - $idx : 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('popup');
    }
}
