<?php

/**
 * Author : 배진환
 * Usage : 고객사 model
 */
class Customer_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 고객사 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     *  - $param['sch_category'] : 고객사 유형 (법인, 개인, 관공서)
     *  - $param['sch_subscribe'] : 월간디자인 이용 여부
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_customer_list($param)
    {
        $this->db->start_cache();
        $this->db->select(' * ');
        $this->db->from("(SELECT *, (SELECT expire_edate FROM customer_subscribe WHERE customer_idx = cu.idx AND NOW() BETWEEN expire_sdate AND expire_edate AND is_del ='N' ORDER BY expire_edate DESC LIMIT 1) AS subscribe_edate FROM customer AS cu) AS TBL");
        $this->db->where('is_del', 'N');
        if ($param['sch_keyword']) {
            $this->db->group_start();
            $keywordArray = array(
                'name' => $param['sch_keyword'],
                'brn' => $param['sch_keyword'],
                'ceo' => $param['sch_keyword'],
                'tel' => $param['sch_keyword'],
                'addr' => $param['sch_keyword'],
                'addr_more' => $param['sch_keyword'],
            );
            $this->db->or_like($keywordArray);
            $this->db->group_end();
        }

        if ($param['sch_category']) $this->db->where_in('category', $param['sch_category']);
        if ($param['sch_subscribe']) $this->db->where('(DATE(subscribe_edate) IS NOT NULL AND subscribe_edate <= DATE_ADD(NOW(), INTERVAL 7 DAY))');

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
     * Usage : 고객사 목록 (페이징 없음)
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     */
    function get_customer_list_nopaging($param)
    {
        $this->db->select(' * ');
        $this->db->from('customer');
        $this->db->where('is_del', 'N');
        if ($param['sch_keyword']) {
            $this->db->group_start();
            $keywordArray = array(
                'name' => $param['sch_keyword'],
                'brn' => $param['sch_keyword'],
                'ceo' => $param['sch_keyword'],
                'tel' => $param['sch_keyword'],
                'addr' => $param['sch_keyword'],
                'addr_more' => $param['sch_keyword'],
            );
            $this->db->or_like($keywordArray);
            $this->db->group_end();
        }

        $this->db->order_by('name', 'asc');
        $recordData = $this->db->get()->result();

        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 현재 월간디자인 이용중인 고객사 목록
     */
    function get_customer_list_subscribe()
    {
        $this->db->select(' * ');
        $this->db->from('customer AS cu');
        $this->db->where('is_del', 'N');
        $this->db->where('(SELECT count(idx) FROM customer_subscribe WHERE (now() BETWEEN expire_sdate AND expire_edate) AND customer_idx=cu.idx) > ', '0');
        $this->db->order_by('name', 'asc');
        $recordData = $this->db->get()->result();

        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 고객사 상세
     * Param
     *  - $idx : 식별값
     */    
    function get_customer_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $result = $this->db->get('customer')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 고객사의 담당자 목록
     * Param
     *  - $idx : 고객사 식별값
     */
    function get_employee_list($idx)
    {
        $this->db->select(' * ');
        $this->db->from('customer_employee');
        $this->db->where('is_del', 'N');
        $this->db->where('customer_idx', $idx);
        $this->db->order_by('moddate', 'desc');
        $recordData = $this->db->get()->result();
        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 고객사의 월간디자인 구독 목록
     * Param
     *  - $idx : 고객사 식별값
     */
    function get_subscribe_list($idx)
    {
        $this->db->select(' * ');
        $this->db->from('customer_subscribe');
        $this->db->where('is_del', 'N');
        $this->db->where('customer_idx', $idx);
        $this->db->order_by('expire_edate', 'desc');
        $recordData = $this->db->get()->result();
        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 고객사의 월간디자인 구독 상세
     * Param
     *  - $idx : 식별값
     */
    function get_subscribe_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $result = $this->db->get('customer_subscribe')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 고객사 등록
     * Param
     *  - $param['category'] : 고객사 유형 (법인, 개인, 관공서)
     *  - $param['name'] : 고객사명
     *  - $param['brn'] : 사업자등록번호
     *  - $param['ceo'] : 대표자명
     *  - $param['addr'] : 주소
     *  - $param['addr_more'] : 주소 상세 
     *  - $param['business_type'] : 업태
     *  - $param['business_item'] : 종목
     *  - $param['tel'] : 대표번호
     *  - $param['email'] : 대표이메일주소
     *  - $param['memo'] : 메모
     */
    function create($param)
    {
        $this->db->set('category', $param['category']);
        $this->db->set('name', $param['name']);
        $this->db->set('brn', $param['brn']);
        $this->db->set('ceo', $param['ceo']);
        $this->db->set('addr', $param['addr']);
        $this->db->set('addr_more', $param['addr_more']);
        $this->db->set('business_type', $param['business_type']);
        $this->db->set('business_item', $param['business_item']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('memo', $param['memo']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("customer");
        $idx = $this->db->insert_id();
        return $idx;
    }

    /**
     * Author : 배진환
     * Usage : 고객사 수정
     * Param
     *  - $param['category'] : 고객사 유형 (법인, 개인, 관공서)
     *  - $param['name'] : 고객사명
     *  - $param['brn'] : 사업자등록번호
     *  - $param['ceo'] : 대표자명
     *  - $param['addr'] : 주소
     *  - $param['addr_more'] : 주소 상세 
     *  - $param['business_type'] : 업태
     *  - $param['business_item'] : 종목
     *  - $param['tel'] : 대표번호
     *  - $param['email'] : 대표이메일주소
     *  - $param['memo'] : 메모
     *  - $param['idx'] : 식별값
     */
    function update($param)
    {
        $this->db->set('category', $param['category']);
        $this->db->set('name', $param['name']);
        $this->db->set('brn', $param['brn']);
        $this->db->set('ceo', $param['ceo']);
        $this->db->set('addr', $param['addr']);
        $this->db->set('addr_more', $param['addr_more']);
        $this->db->set('business_type', $param['business_type']);
        $this->db->set('business_item', $param['business_item']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('memo', $param['memo']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("customer");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : 고객사 삭제
     * Param
     *  - $idx : 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('customer');
    }

    /**
     * Author : 배진환
     * Usage : 고객사 담당자 등록
     * Param
     *  - $param['customer_idx'] : 고객사 식별값
     *  - $param['name'] : 담당자명
     *  - $param['tel'] : 담당자 연락처
     *  - $param['email'] : 담당자 이메일
     */
    function emp_create($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('name', $param['name']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("customer_employee");
    }

    /**
     * Author : 배진환
     * Usage : 고객사 담당자 수정
     * Param
     *  - $param['name'] : 담당자명
     *  - $param['tel'] : 담당자 연락처
     *  - $param['email'] : 담당자 이메일
     *  - $param['idx'] : 식별값
     */
    function emp_update($param)
    {
        $this->db->set('name', $param['name']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("customer_employee");
    }

    /**
     * Author : 배진환
     * Usage : 고객사 담당자 삭제
     * Param
     *  - $idx : 식별값
     */
    function emp_delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('customer_employee');
    }

    /**
     * Author : 배진환
     * Usage : 고객사 월간디자인 등록
     * Param
     *  - $param['customer_idx'] : 고객사 식별값
     *  - $param['category'] : 구독 의뢰 분야
     *  - $param['expire_sdate'] : 시작일
     *  - $param['expire_edate'] : 만료일
     *  - $param['manager_idx'] : 담당 직원(관리자) 식별값
     *  - $param['manager_id'] : 담당 직원(관리자) 아이디
     *  - $param['manager_name'] : 담당 직원(관리자) 이름
     */
    function sub_create($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('category', $param['category']);
        $this->db->set('expire_sdate', $param['expire_sdate']);
        $this->db->set('expire_edate', $param['expire_edate']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("customer_subscribe");
    }

    /**
     * Author : 배진환
     * Usage : 고객사 월간디자인 수정
     * Param     
     *  - $param['category'] : 구독 의뢰 분야
     *  - $param['expire_sdate'] : 시작일
     *  - $param['expire_edate'] : 만료일
     *  - $param['manager_idx'] : 담당 직원(관리자) 식별값
     *  - $param['manager_id'] : 담당 직원(관리자) 아이디
     *  - $param['manager_name'] : 담당 직원(관리자) 이름
     *  - $param['idx'] : 식별값
     */
    function sub_update($param)
    {
        $this->db->set('category', $param['category']);
        $this->db->set('expire_sdate', $param['expire_sdate']);
        $this->db->set('expire_edate', $param['expire_edate']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("customer_subscribe");
    }

    /**
     * Author : 배진환
     * Usage : 고객사 월간디자인 삭제
     * Param     
     *  - $param['idx'] : 식별값
     */
    function sub_delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('customer_subscribe');
    }

    /**
     * Author : 배진환
     * Usage : 고객사 월간디자인 업무 등록
     * Param
     *  - $param['customer_idx'] : 고객사 식별값
     *  - $param['customer_name'] : 고객사명
     *  - $param['employee_idx'] : 고객사 담당자 식별값
     *  - $param['employee_name'] : 고객사 담당자 이름
     *  - $param['manager_idx'] : 담당 직원(관리자) 식별값
     *  - $param['manager_id'] : 담당 직원(관리자) 아이디
     *  - $param['manager_name'] : 담당 직원(관리자) 이름
     *  - $param['category'] : 의뢰 분야
     *  - $param['name'] : 의뢰 건명
     *  - $param['difficulty'] : 작업난이도
     *  - $param['status'] : 진행상태
     */
    function sub_work_create($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('customer_name', $param['customer_name']);
        $this->db->set('employee_idx', $param['employee_idx']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('category', $param['category']);
        $this->db->set('name', $param['name']);
        $this->db->set('difficulty', $param['difficulty']);
        $this->db->set('status', $param['status']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("customer_subscribe_work");
    }

    /**
     * Author : 배진환
     * Usage : 고객사 월간디자인 업무 수정
     * Param
     *  - $param['customer_idx'] : 고객사 식별값
     *  - $param['customer_name'] : 고객사명
     *  - $param['employee_idx'] : 고객사 담당자 식별값
     *  - $param['employee_name'] : 고객사 담당자 이름
     *  - $param['manager_idx'] : 담당 직원(관리자) 식별값
     *  - $param['manager_id'] : 담당 직원(관리자) 아이디
     *  - $param['manager_name'] : 담당 직원(관리자) 이름
     *  - $param['category'] : 의뢰 분야
     *  - $param['name'] : 의뢰 건명
     *  - $param['difficulty'] : 작업난이도
     *  - $param['status'] : 진행상태
     *  - $param['idx'] : 식별값
     */
    function sub_work_update($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('customer_name', $param['customer_name']);
        $this->db->set('employee_idx', $param['employee_idx']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('category', $param['category']);
        $this->db->set('name', $param['name']);
        $this->db->set('difficulty', $param['difficulty']);
        $this->db->set('status', $param['status']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->insert("customer_subscribe_work");
    }

    /**
     * Author : 배진환
     * Usage : 고객사 월간디자인 업무 삭제
     * Param
     *  - $idx : 식별값
     */
    function sub_work_delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('customer_subscribe_work');
    }
}
