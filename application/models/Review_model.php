<?php

/**
 * Author : 배진환
 * Usage : 만족도 model
 */
class Review_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 만족도 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     *  - $param['sch_status'] : 답변 상태
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_review_list($param)
    {
        $this->db->start_cache();
        $this->db->select(' ROW_NUMBER() OVER (PARTITION BY rv.is_del ORDER BY rv.idx ASC, rv.regdate asc) AS row_num, rv.* ');
        $this->db->from('review as rv');
        $this->db->where('is_del', 'N');
        if ($param['sch_keyword']) {
            $this->db->group_start();
            $keywordArray = array(
                'subject' => $param['sch_keyword'],
                'contents' => $param['sch_keyword'],
            );
            $this->db->or_like($keywordArray);
            $this->db->group_end();
        }

        if (isset($param['sch_status']) && $param['sch_status']) $this->db->where_in('status', $param['sch_status']);

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
     * Usage : 만족도 상세
     * Param
     *  - $idx : 식별값
     */
    function get_review_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $result = $this->db->get('review')->row();
        return $result;
    }
    
    /**
     * Author : 배진환
     * Usage : 만족도 등록
     * Param
     *  - $param['name'] : 작성자명
     *  - $param['score'] : 만족도 점수
     *  - $param['subject'] : 제목
     *  - $param['review_pass'] : 비밀번호
     *  - $param['contents'] : 내용
     *  - $param['reply'] : 답변내용
     *  - $param['status'] : 답변상태
     */
    function create($param)
    {
        $this->db->set('name', $param['name']);
        $this->db->set('score', $param['score']);
        $this->db->set('subject', $param['subject']);
        $this->db->set('review_pass', password_hash($param['review_pass'], PASSWORD_DEFAULT));
        $this->db->set('contents', $param['contents']);
        if (isset($param['reply'])) $this->db->set('reply', $param['reply']);
        if (isset($param['status'])) $this->db->set('status', $param['status']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("review");
        $idx = $this->db->insert_id();
        return $idx;
    }
    
    /**
     * Author : 배진환
     * Usage : 만족도 수정
     * Param
     *  - $param['name'] : 작성자명
     *  - $param['score'] : 만족도 점수
     *  - $param['subject'] : 제목
     *  - $param['review_pass'] : 비밀번호
     *  - $param['contents'] : 내용
     *  - $param['reply'] : 답변내용
     *  - $param['status'] : 답변상태
     *  - $param['idx'] : 식별값
     */
    function update($param)
    {
        $this->db->set('name', $param['name']);
        $this->db->set('score', $param['score']);
        $this->db->set('subject', $param['subject']);
        if (isset($param['review_pass'])) $this->db->set('review_pass', password_hash($param['review_pass'], PASSWORD_DEFAULT));
        $this->db->set('contents', $param['contents']);
        $this->db->set('reply', $param['reply']);
        $this->db->set('status', $param['status']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("review");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : 만족도 조회수 증가
     * Param
     *  - $idx : 식별값
     */
    function read_count_update($idx)
    {
        $this->db->set('read_count', 'read_count+1', false);
        $this->db->where('idx', $idx);
        $this->db->update("review");
    }
    
    /**
     * Author : 배진환
     * Usage : 만족도 삭제
     * Param
     *  - $idx : 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('review');
    }
}
