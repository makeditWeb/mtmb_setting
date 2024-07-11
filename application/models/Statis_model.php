<?php

/**
 * Author : 배진환
 * Usage : 매출통계 model
 */
class Statis_model extends CI_Model
{
	private $status_calculate; // 매출집계 대상들만 모인 배열
	private $status_calculate_str; // 매출집계 대상들로만 만든 전체 문자열
	private $except_category; // 사업분야 중 통계수집 대상이 아닌 것들 배열 (ex:상담신청)
	private $except_category_str; // 사업분야 중 통계수집 대상이 아닌 것들 전체 문자열

	function __construct()
	{
		parent::__construct();

		// 매출로 인정할 상태값 배열 및 문자열 생성
		$status_list = array_filter($this->consulting_status, function ($item) {
			return $item['calculate'] === true;
		});
		$this->status_calculate = array_column($status_list, 'code');
		$this->status_calculate_str = "'" . implode("','", $this->status_calculate) . "'";

		// 집계대상이 아닌 사업분야 배열 및 문자열 생성
		$category_list = array_filter($this->business_list, function ($item) {
			return $item['use_statistics'] === false;
		});
		$this->except_category = array_column($category_list, 'segment');
		$this->except_category_str = "'" . implode("','", $this->except_category) . "'";
	}

	/**
	 * Author : 배진환
	 * Usage : 매출통계 (년도별, 월별, 주간별, 일별)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_stat_total($param)
	{
		$this->db->start_cache();
		$this->db->select(' IFNULL(sum(price), 0) AS sales, 
							IFNULL(sum(out_cost), 0) AS outcost, 
							IFNULL(sum(revenue), 0) AS revenue, 
							COUNT(idx) AS count ');
		$this->db->where('is_del', 'N');
		$this->db->where('paydate BETWEEN date(\'' . $param['sch_sdate'] . '\') AND date(\'' . $param['sch_edate'] . '\')', NULL, FALSE);
		$this->db->from('consulting');
		$this->db->stop_cache();

		$this->db->select('YEAR(paydate) AS yyyy');
		$this->db->group_by('yyyy');
		$this->db->order_by('yyyy', 'asc');
		$result_yyyy = $this->db->get()->result();

		$this->db->select(' DATE_FORMAT(paydate, \'%Y%m\') AS yyyymm');
		$this->db->group_by('yyyymm');
		$this->db->order_by('yyyymm', 'asc');
		$result_yyyymm = $this->db->get()->result();

		$this->db->select(' CONCAT(YEARWEEK(paydate)) AS yyyyww');
		$this->db->group_by('yyyyww');
		$this->db->order_by('yyyyww', 'asc');
		$result_yyyyww = $this->db->get()->result();

		$this->db->select(' DATE_FORMAT(paydate, \'%Y%m%d\') AS yyyymmdd');
		$this->db->group_by('yyyymmdd');
		$this->db->order_by('yyyymmdd', 'asc');
		$result_yyyymmdd = $this->db->get()->result();

		$this->db->flush_cache();

		$result = [
			'yearly' => $result_yyyy,
			'monthly' => $result_yyyymm,
			'weekly' => $result_yyyyww,
			'daily' => $result_yyyymmdd,
		];

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 문의건수 (년도별, 월별, 주간별, 일별)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_stat_count($param)
	{
		$this->db->start_cache();
		$this->db->select(' COUNT(idx) AS count ');
		$this->db->where('is_del', 'N');
		$this->db->where('regdate BETWEEN date(\'' . $param['sch_sdate'] . '\') AND date(\'' . $param['sch_edate'] . '\')', NULL, FALSE);
		$this->db->from('consulting');
		$this->db->stop_cache();

		$this->db->select('YEAR(regdate) AS yyyy');
		$this->db->group_by('yyyy');
		$this->db->order_by('yyyy', 'asc');
		$result_yyyy = $this->db->get()->result();

		$this->db->select(' DATE_FORMAT(regdate, \'%Y%m\') AS yyyymm');
		$this->db->group_by('yyyymm');
		$this->db->order_by('yyyymm', 'asc');
		$result_yyyymm = $this->db->get()->result();

		$this->db->select(' CONCAT(YEARWEEK(regdate)) AS yyyyww');
		$this->db->group_by('yyyyww');
		$this->db->order_by('yyyyww', 'asc');
		$result_yyyyww = $this->db->get()->result();

		$this->db->select(' DATE_FORMAT(regdate, \'%Y%m%d\') AS yyyymmdd');
		$this->db->group_by('yyyymmdd');
		$this->db->order_by('yyyymmdd', 'asc');
		$result_yyyymmdd = $this->db->get()->result();

		$this->db->flush_cache();

		$result = [
			'yearly' => $result_yyyy,
			'monthly' => $result_yyyymm,
			'weekly' => $result_yyyyww,
			'daily' => $result_yyyymmdd,
		];

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야별 집계 합 (문의,확정,매출,순익 등 순위까지)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_statis_result_category($param)
	{
		$result = $this->db->query("
			SELECT TOTAL.category,
				   IFNULL(count_total, 0) count_total,
				   IFNULL(count_request, 0) count_request,
				   IFNULL(rank_count, 99) rank_count,
				   IFNULL(rank_sales, 99) rank_sales,
				   IFNULL(rank_revenue, 99) rank_revenue,
				   IFNULL(sales, 0) sales,
				   IFNULL(cost, 0) cost,
				   IFNULL(expenditure, 0) expenditure,
				   IFNULL(revenue, 0) revenue 
			FROM (SELECT category , count(idx) AS count_total FROM consulting_detail 
					WHERE regdate BETWEEN date('{$param['sch_sdate']}') AND date('{$param['sch_edate']}') AND is_del ='N' AND category not in ({$this->except_category_str})
					GROUP BY category) AS TOTAL LEFT JOIN 
				(SELECT B.category , count(B.idx) AS count_request
						, DENSE_RANK() over (ORDER BY count(B.idx) desc) AS rank_count
						, DENSE_RANK() over (ORDER BY sum(B.price) desc) AS rank_sales
						, DENSE_RANK() over (ORDER BY (sum(B.price) - sum(B.out_cost) - sum(B.expenditure)) desc) AS rank_revenue
						, sum(B.price) AS sales , sum(B.out_cost) AS cost  , sum(B.expenditure) AS expenditure 
						, (sum(B.price) - sum(B.out_cost) - sum(B.expenditure)) AS revenue
					FROM consulting_detail AS B INNER JOIN consulting AS A ON B.consulting_idx = A.idx 
					WHERE A.paydate  BETWEEN date('{$param['sch_sdate']}') AND date('{$param['sch_edate']}') 
						AND A.status IN ({$this->status_calculate_str}) AND A.is_del ='N' AND B.is_del ='N' AND B.category not in ({$this->except_category_str})
					GROUP BY B.category ) AS REQUEST
					ON TOTAL.category = REQUEST.category
					ORDER BY rank_sales ASC;
		")->result();

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 문의 건수 조회 (사업분야 중 통계대상만)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_count_inquiry_category($param)
	{
		$this->db->select(' csd.category, count(csd.idx) AS val ');
		$this->db->where('cs.is_del', 'N');
		$this->db->where('csd.is_del', 'N');
		$this->db->where_not_in('csd.category', $this->except_category);
		$this->db->where('cs.regdate BETWEEN date(\'' . $param['sch_sdate'] . '\') AND date(\'' . $param['sch_edate'] . '\')', NULL, FALSE);
		$this->db->from('consulting_detail AS csd');
		$this->db->join('consulting AS cs', 'csd.consulting_idx =cs.idx');
		$this->db->group_by('csd.category');
		$result = $this->db->get()->result_array();
		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 의뢰 건수 조회 (사업분야 중 통계대상만)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_count_request_category($param)
	{
		$this->db->select(' csd.category, count(csd.idx) AS val ');
		$this->db->where('cs.is_del', 'N');
		$this->db->where('csd.is_del', 'N');
		$this->db->where_not_in('csd.category', $this->except_category);
		$this->db->where('cs.paydate BETWEEN date(\'' . $param['sch_sdate'] . '\') AND date(\'' . $param['sch_edate'] . '\')', NULL, FALSE);
		$this->db->where_in('cs.status', $this->status_calculate);
		$this->db->from('consulting_detail AS csd');
		$this->db->join('consulting AS cs', 'csd.consulting_idx =cs.idx');
		$this->db->group_by('csd.category');
		$result = $this->db->get()->result_array();
		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 문의 경로별 건수 조회 (사업분야 중 통계대상만)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_count_inquiry_category_regpath($param)
	{
		$result = $this->db->query("
			SELECT category, sum(homepage) AS homepage, sum(tel) AS tel, sum(email) AS email
			FROM (SELECT csd.category, 
						CASE WHEN cs.reg_path='0' THEN count(csd.idx) ELSE 0 END AS homepage,
						CASE WHEN cs.reg_path='1' THEN count(csd.idx) ELSE 0 END AS tel,
						CASE WHEN cs.reg_path='2' THEN count(csd.idx) ELSE 0 END AS email
					FROM consulting_detail AS csd LEFT JOIN consulting AS cs ON csd.consulting_idx =cs.idx
					WHERE cs.is_del = 'N' AND csd.is_del='N' AND csd.category NOT IN ({$this->except_category_str})
						AND cs.regdate BETWEEN date('{$param['sch_sdate']}') AND date('{$param['sch_edate']}') 
					GROUP BY csd.category, cs.reg_path) AS TBL
			GROUP BY category;
		")->result_array();

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 문의 의뢰범위별 건수 조회 (사업분야 중 통계대상만)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_count_inquiry_category_workRange($param)
	{
		$result = $this->db->query("
			SELECT category, sum(work1) AS work1, sum(work2) AS work2, sum(work3) AS work3
			FROM (SELECT csd.category, 
						CASE WHEN csd.work_range='0' THEN count(csd.idx) ELSE 0 END AS work1,
						CASE WHEN csd.work_range='1' THEN count(csd.idx) ELSE 0 END AS work2,
						CASE WHEN csd.work_range='2' THEN count(csd.idx) ELSE 0 END AS work3
					FROM consulting_detail AS csd LEFT JOIN consulting AS cs ON csd.consulting_idx =cs.idx
					WHERE cs.is_del = 'N' AND csd.is_del='N' AND csd.category NOT IN ({$this->except_category_str})
						AND cs.regdate BETWEEN date('{$param['sch_sdate']}') AND date('{$param['sch_edate']}') 
					GROUP BY csd.category, csd.work_range) AS TBL
			GROUP BY category
		")->result_array();

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 문의 기업유형별 통계
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_count_inquiry_company($param)
	{
		$this->db->select(' category, count(idx) AS val ');
		$this->db->where('is_del', 'N');
		$this->db->where('regdate BETWEEN date(\'' . $param['sch_sdate'] . '\') AND date(\'' . $param['sch_edate'] . '\')', NULL, FALSE);
		$this->db->where('category IS NOT NULL AND LENGTH(category) > 0', NULL, FALSE);
		$this->db->from('consulting');
		$this->db->group_by('category');
		$result = $this->db->get()->result_array();

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 컨설팅 의뢰 기업유형별 통계
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_count_request_company($param)
	{
		$this->db->select(' category, count(idx) AS val ');
		$this->db->where('is_del', 'N');
		$this->db->where('paydate BETWEEN date(\'' . $param['sch_sdate'] . '\') AND date(\'' . $param['sch_edate'] . '\')', NULL, FALSE);
		$this->db->where('category IS NOT NULL AND LENGTH(category) > 0', NULL, FALSE);
		$this->db->where_in('status', $this->status_calculate);
		$this->db->from('consulting');
		$this->db->group_by('category');
		$result = $this->db->get()->result_array();

		return $result;
	}

	/**
	 * Author : 배진환
	 * Usage : 사업분야별 집계 합 (문의,확정,매출,순익 등 순위까지)
	 * Param
	 *  - $param['sch_sdate'] : 조회 기준 시작일
	 *  - $param['sch_edate'] : 조회 기준 종료일
	 */
	function get_company_rank_sales($param)
	{
		$result = $this->db->query("
			SELECT TBL1.customer_idx, TBL1.rank_sales, TBL1.name, TBL2.business, TBL1.cnt, TBL1.sales, TBL1.cost, TBL1.revenue, TBL1.revenue_rate 
			FROM (SELECT cs.customer_idx, cus.name
						, count(cs.idx) AS cnt, sum(cs.price) AS sales
						, sum(cs.out_cost) cost, sum(cs.revenue) AS revenue, avg(cs.revenue_rate) AS revenue_rate
						, DENSE_RANK() OVER (ORDER BY sum(cs.price) DESC) AS rank_sales
					FROM consulting AS cs JOIN customer AS cus ON cs.customer_idx = cus.idx
					WHERE cs.is_del = 'N' AND cus.is_del = 'N' AND cs.paydate BETWEEN date('{$param['sch_sdate']}') AND date('{$param['sch_edate']}')
					GROUP BY cs.customer_idx) AS TBL1 JOIN 
					(SELECT customer_idx, GROUP_CONCAT(DISTINCT(category)) AS business
					FROM (SELECT customer_idx, csd.category 
							FROM consulting AS cs JOIN consulting_detail AS csd ON cs.idx = csd.consulting_idx
							WHERE cs.is_del='N' AND csd.is_del='N' AND csd.category NOT IN ({$this->except_category_str})
									AND cs.paydate BETWEEN date('{$param['sch_sdate']}') AND date('{$param['sch_edate']}')
							GROUP BY cs.customer_idx, csd.category) AS tbl
					GROUP BY customer_idx) AS TBL2 ON TBL1.customer_idx = TBL2.customer_idx
			ORDER BY rank_sales;
		")->result();

		return $result;
	}

}
