<?php

/**
 * Author : 배진환
 * Usage : 컨설팅 model
 */
class Consulting_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 목록
     * Param
     *  - $param['sch_keyword'] : 검색 keyword
     *  - $param['is_user'] : 고객 등록 여부
     *  - $param['sch_status'] : 컨설팅 상태 코드
     *  - $param['sch_category'] : 의뢰 분야
     *  - $param['sort_key'] : 정렬 기준
     *  - $param['sort_direction'] : 정렬 방향 (asc, desc)
     *  - $param['curr_page'] : 현재 페이지
     *  - $param['page_scale'] : limit offset
     */
    function get_consulting_list($param)
    {
        $this->db->start_cache();
        $this->db->select(" ROW_NUMBER() OVER (PARTITION BY cs.is_del ORDER BY cs.idx ASC, cs.regdate ASC) AS row_num, cs.*, (SELECT GROUP_CONCAT(category SEPARATOR ',') FROM consulting_detail WHERE consulting_idx = cs.idx and is_del='N') AS business ");
        $this->db->from('consulting as cs');
        $this->db->where('is_del', 'N');
        if ($param['sch_keyword']) {
            $this->db->group_start();
            $keywordArray = array(
                'name' => $param['sch_keyword'],
                'employee_name' => $param['sch_keyword'],
                'brn' => $param['sch_keyword'],
                'ceo' => $param['sch_keyword'],
                'tel' => $param['sch_keyword'],
                'addr' => $param['sch_keyword'],
                'addr_more' => $param['sch_keyword'],
            );
            $this->db->or_like($keywordArray);
            $this->db->group_end();
        }

        // 통계에서 상세보기로 전달받은 파라미터
        if (isset($param['sch_customer']) && $param['sch_customer']) $this->db->where('customer_idx', $param['sch_customer']);

        if (isset($param['sch_sdate']) && $param['sch_sdate']){
            $this->db->where('paydate IS NOT NULL');
            $this->db->where('paydate >=', $param['sch_sdate']);
        }

        if (isset($param['sch_edate']) && $param['sch_edate']) {
            $this->db->where('paydate IS NOT NULL');
            $this->db->where('paydate <=', $param['sch_edate']);
        }

        // if ($param['calculate']) $this->db->where_in('status', ['3', '4', '6']);
        if (isset($param['manager_idx']) && $param['manager_idx']) $this->db->where('manager_idx', $param['manager_idx']);
        if ($param['is_user']) $this->db->where('reg_path', '0');
        if ($param['sch_status']) $this->db->where_in('status', $param['sch_status']);
        if ($param['sch_category']) $this->db->where("(SELECT count(idx) FROM consulting_detail WHERE consulting_idx = cs.idx and is_del='N' AND category IN ('" . implode("','", $param['sch_category']) . "') ) > 0", null, false);

        $this->db->stop_cache();

        $recordCount = $this->db->count_all_results();

        $this->db->order_by($param['sort_key'], $param['sort_direction']);
        $offset = ($param['curr_page'] - 1) * $param['page_scale'];
        $this->db->limit($param['page_scale'], $offset);
        $recordData = $this->db->get()->result();

        // echo $this->db->last_query();

        $this->db->flush_cache();

        return [$recordData, $recordCount];
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 목록 (페이징 없음)
     * Param
     *  - $param['list_for'] : 사용처 구분  
     */
    function get_consulting_list_nopaging($param)
    {
        $this->db->select(" *, (SELECT GROUP_CONCAT(category SEPARATOR ',') FROM consulting_detail WHERE consulting_idx = cs.idx and is_del='N') AS business ");
        $this->db->from('consulting as cs');

        if ($param['list_for'] == 'customer') {
            $this->db->where('customer_idx', $param['idx']);
        } else if ($param['list_for'] == 'manager') {
            $this->db->where('manager_idx', $param['idx']);
        }
        $this->db->where('is_del', 'N');

        $this->db->order_by('regdate', 'desc');
        $recordData = $this->db->get()->result();

        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 목록 (관리자 분기페이지 대시보드용)
     * Param
     *  - $target_db : 대상 DB (서울,제주)
     */
    function get_consulting_list_as_db($target_db)
    {
        $this->db = $this->load->database($target_db, TRUE);

        $this->db->start_cache();
        $this->db->select(" *, (SELECT GROUP_CONCAT(category SEPARATOR ',') FROM consulting_detail WHERE consulting_idx = cs.idx and is_del='N') AS business ");
        $this->db->from('consulting as cs');
        $this->db->where_in('status', '0');
        $this->db->where('is_del', 'N');
        $this->db->stop_cache();

        $recordCount = $this->db->count_all_results();

        $this->db->order_by('regdate', 'DESC');
        $recordData = $this->db->get()->result();

        $this->db->flush_cache();

        return [$recordData, $recordCount];
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 상세
     * Param
     *  - $idx : 식별값
     */
    function get_consulting_info($idx)
    {
        $this->db->select(" *, (SELECT GROUP_CONCAT(category SEPARATOR ',') FROM consulting_detail WHERE consulting_idx = cs.idx and is_del='N') AS business  ");
        $this->db->where('idx', $idx);
        $this->db->where('is_del', 'N');
        $result = $this->db->get('consulting as cs')->row();
        return $result;
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 상세 작업 목록
     * Description : 협력업체의 작업목록인지 컨설팅의 작업목록인지 파라미터를 통해 판단 후 전달.
     * Param
     *  - $param['partner'] : 검색기준 협력업체 여부
     *  - $param['idx'] : 식별값
     */
    function get_consulting_work_list($param)
    {
        $this->db->select(' * ');
        $this->db->from('consulting_detail');
        $this->db->where('is_del', 'N');
        if ($param['partner']) {
            $this->db->where('partner_idx', $param['idx']);
        } else {
            $this->db->where('consulting_idx', $param['idx']);
        }

        $this->db->order_by('idx', 'asc');
        $recordData = $this->db->get()->result();
        return $recordData;
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 등록 (사용자)
     * Param
     * - $param['consulting_pass'] : 컨설팅 비밀번호 (고객이 확인 시 사용)
     * - $param['name'] : 회사명
     * - $param['employee_name'] : 담당자명
     * - $param['employee_tel'] : 담당자 연락처
     * - $param['tel'] : 회사 대표번호
     * - $param['employee_email'] : 담당자 이메일주소
     * - $param['request'] : 요청 세부사항
     */
    function consulting_create($param)
    {
        $this->db->set('consulting_pass', password_hash($param['consulting_pass'], PASSWORD_DEFAULT));
        $this->db->set('name', $param['name']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('employee_tel', $param['employee_tel']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('employee_email', $param['employee_email']);
        $this->db->set('request', $param['request']);
        $this->db->set('status', '0');
        $this->db->set('reg_path', '0');
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);

        $this->db->insert("consulting");
        $idx = $this->db->insert_id();
        return $idx;
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 등록 (관리자)
     * Param
     * - $param['customer_idx'] : 고객사 식별값
     * - $param['name'] : 고객사명
     * - $param['category'] : 기업 유형
     * - $param['brn'] : 사업자 등록번호
     * - $param['ceo'] : 대표자명
     * - $param['addr'] : 주소
     * - $param['addr_more'] : 상세주소
     * - $param['tel'] : 대표번호
     * - $param['email'] : 대표이메일주소
     * - $param['business_type'] : 업태
     * - $param['business_item'] : 종목
     * - $param['employee_name'] : 담당자명
     * - $param['employee_tel'] : 담당자 연락처
     * - $param['employee_email'] : 담당자 이메일주소
     * - $param['request'] : 요청 세부사항
     */
    function consulting_create2($param)
    {
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('name', $param['name']);
        $this->db->set('category', $param['category']);
        $this->db->set('brn', $param['brn']);
        $this->db->set('ceo', $param['ceo']);
        $this->db->set('addr', $param['addr']);
        $this->db->set('addr_more', $param['addr_more']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('business_type', $param['business_type']);
        $this->db->set('business_item', $param['business_item']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('employee_tel', $param['employee_tel']);
        $this->db->set('employee_email', $param['employee_email']);
        $this->db->set('request', $param['request']);
        $this->db->set('status', '0');
        $this->db->set('reg_path', $param['reg_path']);
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);

        $this->db->insert("consulting");
        $idx = $this->db->insert_id();
        return $idx;
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 등록 (관리자)
     * Param
     * - $param['category'] : 의뢰분야
     * - $param['consulting_idx'] : 컨설팅 대상 식별값
     * - $param['question_value'] : 해당 의뢰분야의 질문과 답변 내용 (json 형태)
     *                              question_idx : 질문 식별값
     *                              question : 질문 내용
     *                              answer_idx : 의뢰인의 답변 식별값
     *                              answer : 의뢰인의 답변 내용
     */
    function consulting_add_work($param)
    {
        $this->db->set('category', $param['category']);
        $this->db->set('consulting_idx', $param['consulting_idx']);
        $this->db->set('question_value', $param['question_value']);
        $this->db->set('status', '0');
        $this->db->set('regdate', 'NOW(6)', false);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->insert("consulting_detail");
        $idx = $this->db->insert_id();
        return $idx;
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 수정
     * Param
     * - $param['category'] : 의뢰분야
     * - $param['customer_idx'] : 고객사 식별값
     * - $param['name'] : 고객사명(단체명)
     * - $param['brn'] : 사업자등록번호
     * - $param['ceo'] : 대표자
     * - $param['addr'] : 주소
     * - $param['addr_more'] : 상세주소
     * - $param['business_type'] : 업태
     * - $param['business_item'] : 종목
     * - $param['tel'] : 대표번호
     * - $param['email'] : 대표 이메일주소
     * - $param['employee_name'] : 담당자명
     * - $param['employee_tel'] : 담당자 연락처
     * - $param['employee_email'] : 담당자 이메일주소
     * - $param['memo'] : 메모
     * - $param['status'] : 상태값
     * - $param['manager_idx'] : 담당 총괄 식별값
     * - $param['manager_id'] : 담당 총괄 아이디
     * - $param['manager_name'] : 담당 총괄 이름
     * - $param['paydate'] : 매출기준일
     * - $param['enddate'] : 종료일
     * - $param['idx'] : 식별값
     */
    function consulting_reply($param)
    {
        $this->db->set('category', $param['category']);
        $this->db->set('customer_idx', $param['customer_idx']);
        $this->db->set('name', $param['name']);
        $this->db->set('brn', $param['brn']);
        $this->db->set('ceo', $param['ceo']);
        $this->db->set('addr', $param['addr']);
        $this->db->set('addr_more', $param['addr_more']);
        $this->db->set('business_type', $param['business_type']);
        $this->db->set('business_item', $param['business_item']);
        $this->db->set('tel', $param['tel']);
        $this->db->set('email', $param['email']);
        $this->db->set('employee_name', $param['employee_name']);
        $this->db->set('employee_tel', $param['employee_tel']);
        $this->db->set('employee_email', $param['employee_email']);
        $this->db->set('memo', $param['memo']);
        $this->db->set('status', $param['status']);
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('reg_path', $param['reg_path']);
        $this->db->set('moddate', 'NOW(6)', false);
        if ($param['paydate']) $this->db->set('paydate', $param['paydate']);
        if ($param['enddate']) $this->db->set('enddate', $param['enddate']);
        $this->db->where('idx', $param['idx']);
        $this->db->update("consulting");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 작업범위 삭제
     * Param
     * - $param['category'] : 의뢰분야
     * - $param['idx'] : 컨설팅 식별값
     */
    function delete_work_update($param)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('category', $param['category']);
        $this->db->where('consulting_idx', $param['idx']);
        $this->db->update('consulting_detail');
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 상세내역 수정
     * Param
     *  - $param['manager_idx'] : 담당자 식별값
     *  - $param['manager_id'] : 담당자 아이디
     *  - $param['manager_name'] : 담당자 이름
     *  - $param['work_range'] : 작업범위
     *  - $param['mod_count'] : 수정차수
     *  - $param['partner_idx'] : 외주업체 식별값
     *  - $param['partner_name'] : 외주업체 이름
     *  - $param['partner_status'] : 외주진행상태
     *  - $param['status'] : 컨설팅 상세 진행상태
     *  - $param['consulting_idx'] : 컨설팅 식별값
     *  - $param['segment'] : 의뢰분야 식별 코드
     */
    function consulting_mod_reply_work($param)
    {
        $this->db->set('manager_idx', $param['manager_idx']);
        $this->db->set('manager_id', $param['manager_id']);
        $this->db->set('manager_name', $param['manager_name']);
        $this->db->set('work_range', $param['work_range']);
        $this->db->set('mod_count', $param['mod_count']);
        $this->db->set('partner_idx', $param['partner_idx']);
        $this->db->set('partner_name', $param['partner_name']);
        $this->db->set('partner_status', $param['partner_status']);
        $this->db->set('status', $param['status']);
        $this->db->set('moddate', 'NOW(6)', false);

        if ($param['partner_status'] == '1') $this->db->set('out_sdate', 'NOW(6)', false);
        if ($param['partner_status'] == '5') $this->db->set('out_edate', 'NOW(6)', false);

        $this->db->where('consulting_idx', $param['consulting_idx']);
        $this->db->where('is_del', 'N');
        $this->db->where('category', $param['segment']);
        $this->db->update("consulting_detail");
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 삭제
     * Param
     *  - $param['idx'] : 컨설팅 식별값
     */
    function delete_update($idx)
    {
        $this->db->set('is_del', 'Y');
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where_in('idx', $idx);
        $this->db->update('consulting');
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 의뢰 정산 수정
     * Param
     *  - $param['memo2'] : 정산메모 내용
     *  - $param['price'] : 총 견적 금액
     *  - $param['out_cost'] : 총 지출 비용
     *  - $param['revenue'] : 수익 금액
     *  - $param['revenue_rate'] : 수익률
     *  - $param['idx'] : 컨설팅 식별값
     */
    function calculate_info_update($param)
    {
        $this->db->set('memo2', $param['memo2']);
        $this->db->set('price', $param['price']);
        $this->db->set('out_cost', $param['out_cost']);
        $this->db->set('revenue', $param['revenue']);
        $this->db->set('revenue_rate', $param['revenue_rate']);
        $this->db->set('moddate', 'NOW(6)', false);

        $this->db->where('idx', $param['idx']);
        $this->db->update("consulting");
        return $param['idx'];
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 의뢰 상세내역 정산 수정
     * Param
     *  - $param['price'] : 견적금액
     *  - $param['expenditure'] : 제반비용
     *  - $param['out_cost'] : 외주 지불금액
     *  - $param['out_cost_type'] : 외주 비용 지불형태
     *  - $param['out_cost_status'] : 외주 비용 지불상태
     *  - $param['tax_bill_status'] : 외주 비용 지불 세금계산서 발행상태
     *  - $param['idx'] : 상세내역 식별값
     *  - $param['consulting_idx'] : 컨설팅 식별값
     *  - $param['category'] : 의뢰분야 식별 코드
     */
    function calculate_work_update($param)
    {
        $this->db->set('price', $param['price']);
        $this->db->set('expenditure', $param['expenditure']);
        $this->db->set('out_cost', $param['out_cost']);
        $this->db->set('out_cost_type', $param['out_cost_type']);
        $this->db->set('out_cost_status', $param['out_cost_status']);
        $this->db->set('tax_bill_status', $param['tax_bill_status']);
        $this->db->set('moddate', 'NOW(6)', false);

        // $this->db->where('idx', $param['idx']);
        $this->db->where('consulting_idx', $param['consulting_idx']);
        $this->db->where('category', $param['category']);
        $this->db->where('is_del', 'N');
        $this->db->update("consulting_detail");
    }

    /**
     * Author : 배진환
     * Usage : 컨설팅 지정 단일값 수정
     * Param
     *  - $param['column'] : 수정대상 항목
     *  - $param['value'] : 대상의 변경될 값
     *  - $param['idx'] : 컨설팅 식별값
     */
    function update_single_column($param)
    {
        $this->db->set($param['column'], $param['value']);
        $this->db->set('moddate', 'NOW(6)', false);
        $this->db->where('idx', $param['idx']);
        $this->db->update('consulting');
    }
}
