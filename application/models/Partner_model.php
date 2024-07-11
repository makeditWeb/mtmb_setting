<?php

/**
 * Author : 배진환
 * Usage : 협력업체 model
 */
class Partner_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 협력업체 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     *  - $param['sch_category'] : 외주분야
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_partner_list($param)
    {
        $this->db->start_cache();
        $this->db->select(' * ');
        $this->db->from('partner');
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
        
        if ($param['sch_category']) {
            foreach ($param['sch_category'] as $category) {
                $this->db->where("JSON_EXTRACT(category, '$." . $category . "') = true ", null, false);
            }
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
     * Usage : 협력업체 목록 (페이징 없음)
     */
    function get_partner_list_nopaging()
    {
        $this->db->select(' * ');
        $this->db->from('partner');
        $this->db->where('is_del', 'N');
        $this->db->order_by('name', 'asc');
        $recordData = $this->db->get()->result();

        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 협력업체 상세
     * Param
     *  - $idx : 식별값
     */
    function get_partner_info($idx)
    {
        $this->db->where('idx', $idx);
        $this->db->select(' * ');
        $this->db->where('is_del', 'N');
        $result = $this->db->get('partner')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 협력업체 담당자 목록
     * Param
     *  - $idx : 협력업체 식별값
     */
    function get_employee_list($idx)
    {
        $this->db->select(' * ');
        $this->db->from('partner_employee');
        $this->db->where('is_del', 'N');
        $this->db->where('partner_idx', $idx);
        $this->db->order_by('moddate', 'desc');
        $recordData = $this->db->get()->result();
        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 협력업체 등록
     * Param
     *  - $param['category'] : 외주분야
     *  - $param['name'] : 협력업체명
     *  - $param['brn'] : 사업자등록번호
     *  - $param['ceo'] : 대표자명
     *  - $param['addr'] : 주소
     *  - $param['addr_more'] : 상세주소
     *  - $param['tel'] : 대표번호
     *  - $param['fax'] : 팩스
     *  - $param['homepage'] : 홈페이지
     *  - $param['account_bank'] : 계좌 은행
     *  - $param['account_num'] : 계좌번호
     *  - $param['account_name'] : 예금주
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
        $this->db->set('tel', $param['tel']);
        $this->db->set('fax', $param['fax']);
        $this->db->set('homepage', $param['homepage']);
        $this->db->set('account_bank', $param['account_bank']);
        $this->db->set('account_num', $param['account_num']);
        $this->db->set('account_name', $param['account_name']);
        $this->db->set('memo', $param['memo']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("partner");
        $idx = $this->db->insert_id();
        return $idx;
    }
    
    /**
     * Author : 배진환
     * Usage : 협력업체 수정
     * Param
     *  - $param['category'] : 외주분야
     *  - $param['name'] : 협력업체명
     *  - $param['brn'] : 사업자등록번호
     *  - $param['ceo'] : 대표자명
     *  - $param['addr'] : 주소
     *  - $param['addr_more'] : 상세주소
     *  - $param['tel'] : 대표번호
     *  - $param['fax'] : 팩스
     *  - $param['homepage'] : 홈페이지
     *  - $param['account_bank'] : 계좌 은행
     *  - $param['account_num'] : 계좌번호
     *  - $param['account_name'] : 예금주
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
        $this->db->set('tel', $param['tel']);
        $this->db->set('fax', $param['fax']);
        $this->db->set('homepage', $param['homepage']);
        $this->db->set('account_bank', $param['account_bank']);
        $this->db->set('account_num', $param['account_num']);
        $this->db->set('account_name', $param['account_name']);
        $this->db->set('memo', $param['memo']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("partner");
        return $param['idx'];
    }
    
    /**
     * Author : 배진환
     * Usage : 협력업체 삭제
     * Param
     *  - $idx : 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('partner');
    }
    
    /**
     * Author : 배진환
     * Usage : 협력업체 직원 등록
     * Param
     *  - $param['partner_idx'] : 협력업체 식별값
     *  - $param['name'] : 직원 명
     *  - $param['tel'] : 직원 연락처
     *  - $param['email'] : 직원 이메일
     */
    function emp_create($param)
    {
        $this->db->set('partner_idx', $param['partner_idx']);
        $this->db->set('name', $param['name']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("partner_employee");
    }
    
    /**
     * Author : 배진환
     * Usage : 협력업체 직원 수정
     * Param
     *  - $param['name'] : 직원 명
     *  - $param['tel'] : 직원 연락처
     *  - $param['email'] : 직원 이메일
     *  - $param['idx'] : 식별값
     */
    function emp_update($param)
    {
        $this->db->set('name', $param['name']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update("partner_employee");
    }
    
    /**
     * Author : 배진환
     * Usage : 협력업체 직원 삭제
     * Param
     *  - $idx : 식별값
     */
    function emp_delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('partner_employee');
    }
}
