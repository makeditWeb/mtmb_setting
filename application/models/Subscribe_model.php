<?php

/**
 * Author : 배진환
 * Usage : 월간디자인 model
 */
class Subscribe_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 월간디자인 작업 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     *  - $param['sch_monthly'] : 이번달, 지난달 구분
     *  - $param['manager_idx'] : 담당자(관리자) 식별값
     *  - $param['sch_category'] : 사업분야 코드명
     *  - $param['sch_status'] : 진행 상태
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_subscribe_list($param)
    {
        $this->db->start_cache();
        $this->db->select(' * ');
        $this->db->from('customer_subscribe_work');
        $this->db->where('is_del', 'N');
        if ($param['sch_keyword']) {
            $this->db->group_start();
            $keywordArray = array(
                'subject' => $param['sch_keyword'],
                'manager_name' => $param['sch_keyword'],
                'manager_id' => $param['sch_keyword'],
                'customer_name' => $param['sch_keyword'],
                'employee_name' => $param['sch_keyword']
            );
            $this->db->or_like($keywordArray);
            $this->db->group_end();
        }

        if (isset($param['sch_monthly']) && $param['sch_monthly'] == "prev") {
            $this->db->where('YEAR(regdate)', 'YEAR(CURRENT_DATE())', false);
            $this->db->where('MONTH(regdate)', 'MONTH(CURRENT_DATE())', false);
        } else if (isset($param['sch_monthly']) && $param['sch_monthly'] == "curr") {
            $this->db->where('YEAR(regdate)', 'YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)', false);
            $this->db->where('MONTH(regdate)', 'MONTH(CURRENT_DATE() - INTERVAL 1 MONTH)', false);
        }

        if (isset($param['manager_idx']) && $param['manager_idx']) $this->db->where('manager_idx', $param['manager_idx']);
        if ($param['sch_category']) $this->db->where_in('category', $param['sch_category']);
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
     * Usage : 월간디자인 작업 목록 (페이징 없음)
     * Param
     *  - $param['list_for'] : 조회 기준 (고객사 기준 or 작업담당자 기준)
     *  - $param['idx'] : 식별값
     */
    function get_subscribe_list_nopaging($param)
    {
        $this->db->select(' * ');
        $this->db->from('customer_subscribe_work');

        if ($param['list_for'] == 'customer') {
            $this->db->where('customer_idx', $param['idx']);
        } else if ($param['list_for'] == 'manager') {
            $this->db->where('manager_idx', $param['idx']);
        }
        $this->db->where('is_del', 'N');

        $this->db->order_by('status asc, moddate desc');
        $recordData = $this->db->get()->result();

        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 월간디자인 작업 상세
     * Param
     *  - $idx : 식별값
     */
    function get_subscribe_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $result = $this->db->get('customer_subscribe_work')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 월간디자인 작업 등록
     * Param
     *  - $param['customer_idx'] : 고객사 식별값
     *  - $param['customer_name'] : 고객사명
     *  - $param['employee_idx'] : 고객사 담당자 식별값
     *  - $param['employee_name'] : 고객사 담당자명
     *  - $param['manager_idx'] : 작업 담당자(관리자) 식별값
     *  - $param['manager_id'] : 작업 담당자(관리자) 아이디
     *  - $param['manager_name'] : 작업 담당자(관리자) 이름
     *  - $param['category'] : 월간디자인 작업 의뢰 분야 코드명
     *  - $param['subject'] : 의뢰 명
     *  - $param['difficulty'] : 난이도
     *  - $param['work_sdate'] : 작업 시작일
     *  - $param['work_edate'] : 작업 종료일
     *  - $param['status'] : 진행 상태
     */
    function create($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('customer_name', $param['customer_name']);
        $this->db->set('employee_idx', $param['employee_idx']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('category', $param['category']);
        $this->db->set('subject', $param['subject']);
        $this->db->set('difficulty', $param['difficulty']);
        $this->db->set('work_sdate', $param['work_sdate']);
        $this->db->set('work_edate', $param['work_edate']);
        $this->db->set('status', $param['status']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("customer_subscribe_work");
        $idx = $this->db->insert_id();
        return $idx;
    }

    /**
     * Author : 배진환
     * Usage : 월간디자인 작업 수정
     * Param
     *  - $param['customer_idx'] : 고객사 식별값
     *  - $param['customer_name'] : 고객사명
     *  - $param['employee_idx'] : 고객사 담당자 식별값
     *  - $param['employee_name'] : 고객사 담당자명
     *  - $param['manager_idx'] : 작업 담당자(관리자) 식별값
     *  - $param['manager_id'] : 작업 담당자(관리자) 아이디
     *  - $param['manager_name'] : 작업 담당자(관리자) 이름
     *  - $param['category'] : 월간디자인 작업 의뢰 분야 코드명
     *  - $param['subject'] : 의뢰 명
     *  - $param['difficulty'] : 난이도
     *  - $param['work_sdate'] : 작업 시작일
     *  - $param['work_edate'] : 작업 종료일
     *  - $param['status'] : 진행 상태
     *  - $param['idx'] : 식별값
     */
    function update($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('customer_name', $param['customer_name']);
        $this->db->set('employee_idx', $param['employee_idx']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('category', $param['category']);
        $this->db->set('subject', $param['subject']);
        $this->db->set('difficulty', $param['difficulty']);
        $this->db->set('work_sdate', $param['work_sdate']);
        $this->db->set('work_edate', $param['work_edate']);
        $this->db->set('status', $param['status']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("customer_subscribe_work");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : 월간디자인 작업 삭제
     * Param
     *  - $idx : 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('customer_subscribe_work');
    }
}
