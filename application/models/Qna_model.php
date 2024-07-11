<?php

/**
 * Author : 배진환
 * Usage : QnA model
 */
class Qna_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : QnA 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     *  - $param['sch_status'] : 답변 상태
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_qna_list($param)
    {
        $this->db->start_cache();
        $this->db->select(' ROW_NUMBER() OVER (PARTITION BY qna.is_del ORDER BY qna.idx ASC, qna.regdate ASC) AS row_num, qna.* ');
        $this->db->from('qna');
        $this->db->where('is_del', 'N');
        if ($param['sch_keyword']) {
            $this->db->group_start();
            $keywordArray = array(
                'subject' => $param['sch_keyword'],
                'contents' => $param['sch_keyword'],
                'answer' => $param['sch_keyword']
            );
            $this->db->or_like($keywordArray);
            $this->db->group_end();
        }

        if ($param['sch_status']) $this->db->where_in('status', $param['sch_status']);
        
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
     * Usage : Qna 목록 (관리자 분기페이지 대시보드용)
     * Param
     *  - $target_db : 대상 DB (서울,제주)
     */
    function get_qna_list_as_db($target_db)
    {
        $this->db = $this->load->database($target_db, TRUE);

        $this->db->start_cache();
        $this->db->select(" * ");
        $this->db->from('qna');
        $this->db->where_in('status', '0');
        $this->db->where('is_del', 'N');
        $this->db->order_by('regdate', 'ASC');
        $this->db->stop_cache();

        $recordCount = $this->db->count_all_results();        
        $recordData = $this->db->get()->result();

        $this->db->flush_cache();

        return [$recordData, $recordCount];
    }

    /**
     * Author : 배진환
     * Usage : Qna 상세
     * Param
     *  - $idx : 식별값
     */
    function get_qna_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $result = $this->db->get('qna')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : Qna 등록
     * Param
     *  - $param['name'] : 작성자명
     *  - $param['subject'] : 제목
     *  - $param['qna_pass'] : 비밀번호
     *  - $param['contents'] : 내용
     *  - $param['tel'] : 연락처
     *  - $param['email'] : 이메일주소
     */
    function create($param)
    {
        $this->db->set('name', $param['name']);
        $this->db->set('subject', $param['subject']);
        $this->db->set('qna_pass', password_hash($param['qna_pass'], PASSWORD_DEFAULT));
        $this->db->set('contents', $param['contents']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('status', '0');
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("qna");
		$idx = $this->db->insert_id();
		return $idx;        
    }
    
    /**
     * Author : 배진환
     * Usage : Qna 수정
     * Param
     *  - $param['name'] : 작성자명
     *  - $param['subject'] : 제목
     *  - $param['qna_pass'] : 비밀번호
     *  - $param['contents'] : 내용
     *  - $param['tel'] : 연락처
     *  - $param['email'] : 이메일주소
     *  - $param['idx'] : 식별값
     */
    function update($param)
    {
        $this->db->set('name', $param['name']);        
        $this->db->set('subject', $param['subject']);
        $this->db->set('qna_pass', password_hash($param['qna_pass'], PASSWORD_DEFAULT));
        $this->db->set('contents', $param['contents']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);        
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("qna");
        return $param['idx'];
    }    
    
    /**
     * Author : 배진환
     * Usage : QnA 답변
     * Param
     *  - $param['answer'] : 답변 내용
     *  - $param['idx'] : 식별값
     */
    function reply($param)
    {
        $this->db->set('answer', $param['answer']);
        $this->db->set('status', '1');
        $this->db->set('ansdate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("qna");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : QnA 상태 수정
     * Param
     *  - $param['status'] : 상태값
     *  - $param['idx'] : 식별값
     */
    function status_update($param)
    {
        $this->db->set('status', $param['status']);
        $this->db->where('idx', $param['idx']);
        $this->db->update("qna");
    }
    
    /**
     * Author : 배진환
     * Usage : QnA 삭제
     * Param
     *  - $idx : 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('qna');
    }
}
