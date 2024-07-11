<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : Ci 인스턴스 가져오긔
 */
function get_ci_instance()
{
	static $ci_instance = null;
	if (!$ci_instance) $ci_instance = &get_instance();
	return $ci_instance;
}

/**
 * Author : 배진환
 * Usage : URL 정규식 validate
 * Param
 *  - $url : 대상 url
 */
if (!function_exists('valid_url')) {
	function valid_url($url)
	{
		if (filter_var($url, FILTER_VALIDATE_URL))
			return TRUE;
		else
			return FALSE;
	}
}


/**
 * Author : 배진환
 * Usage : 배열 내 데이터 조회
 * Param
 *  - $needle : 검색 키워드
 *  - $haystack : 검색 대상 배열
 *  - $strict : 엄격함 기준
 */
if (!function_exists('in_array_r')) {
	function in_array_r($keyword, $arr, $strict = false)
	{
		foreach ($arr as $item) {
			if (($strict ? $item === $keyword : $item == $keyword) || (is_array($item) && in_array_r($keyword, $item, $strict))) {
				return true;
			}
		}
		return false;
	}
}

/**
 * Author : 배진환
 * Usage : 개인정보처리 (마스킹 출력)
 * Param
 *  - $name : 대상 문자열
 */
if (!function_exists('masking_name')) {
	function masking_name($name)
	{
		$arrName = explode(' ', $name);
		$lasIndex = count($arrName) - 1;
		$result = '';
		if ($lasIndex < 1) {
			$result = preg_replace('/(?<=.{1})./u', '*', $name);
		} else {
			foreach ($arrName as $key => $val) {
				$val = preg_replace('/(?<=.{1})./u', '*', $val);
				if ($lasIndex != $key) $result .= ' ' . $val;
			}
			$result .= ' ' . $arrName[$lasIndex];
		}
		return $result;
	}
}

/**
 * Author : 배진환
 * Usage : 배열 내 특정 key의 값 가져오기
 * Param
 *  - $arr : 대상 배열
 *  - $key : 찾고자 하는 키
 */
if (!function_exists('get_array_value')) {
	function get_array_value($arr, $key)
	{
		if (!isset($key) || trim($key) === '') {
			return '';
		} else {
			if (array_key_exists($key, $arr)) {
				return $arr[(string)$key];
			} else {
				return '';
			}
		}
	}
}

/**
 * Author : 배진환
 * Usage : YYYY-MM-DD 형식으로 날짜값 fomatting 
 * Param
 *  - $timestamp : 대상 날짜값
 */
if (!function_exists('replaceDate')) {
	function replaceDate($timestamp)
	{
		try {
			if (strtotime($timestamp)) {
				return date('Y-m-d', strtotime($timestamp));
			} else {
				return '-';
			}
		} catch (Exception $e) {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : YYYY.MM.DD 형식으로 날짜값 fomatting 
 * Param
 *  - $timestamp : 대상 날짜값
 */
if (!function_exists('replaceDate2')) {
	function replaceDate2($timestamp)
	{
		try {
			if (strtotime($timestamp)) {
				return date('Y.m.d', strtotime($timestamp));
			} else {
				return '-';
			}
		} catch (Exception $e) {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : YYYY-MM-DD HH:mm:SS 형식으로 날짜값 fomatting 
 * Param
 *  - $timestamp : 대상 시간
 */
if (!function_exists('replaceDatetime')) {
	function replaceDatetime($timestamp)
	{
		try {
			if (strtotime($timestamp)) {
				return date('Y-m-d H:i:s', strtotime($timestamp));
			} else {
				return '-';
			}
		} catch (Exception $e) {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 지정된 타입으로 넘어온 파라미터를 일방적 치환
 * Description : 사용자쪽은 무조건 모두 실행하고 있음.
 * Param
 *  - $input : get, post 구분.
 */
if (!function_exists('sanitize_input')) {
	function sanitize_input($input)
	{
		$CI = get_ci_instance();
		if (is_array($input)) {
			foreach ($input as $key => $value) {
				$input[$key] = sanitize_input($value);
			}
		} else {
			$input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
			$input = $CI->db->escape_str($input);
		}
		return $input;
	}
}


/**
 * Author : 배진환
 * Usage : 줄바꿈을 BR태그로 변경.
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('nl2br2')) {
	function nl2br2($val)
	{
		return str_replace("\\n", "<br/>", $val);
	}
}

/**
 * Author : 배진환
 * Usage : 파일 용량 표현 
 * Param
 *  - $bytes : 치환 대상 값
 *  - $precision : 소수점 자리수
 */
function formatBytes($bytes, $precision = 2) {
    $units = array('KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Convert bytes to the selected unit
    $bytes /= pow(1024, $pow);

    // Format the result with the specified precision
    return round($bytes, $precision) . ' ' . $units[$pow];
}

/**
 * Author : 배진환
 * Usage : 활성화 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceActive')) {
	function replaceActive($val)
	{
		if ($val == 'Y') {
			return '활성';
		} else if ($val == 'N') {
			return '비활성';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 관리자 등급 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceManagerGrade')) {
	function replaceManagerGrade($val)
	{
		if ($val == '0') {
			return '총괄책임자';
		} else if ($val == '1') {
			return '담당자';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 기업형태 구분 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceCustomerType')) {
	function replaceCustomerType($val)
	{
		if ($val == '0') {
			return '법인고객';
		} else if ($val == '1') {
			return '개인고객';
		} else if ($val == '2') {
			return '공공기관';
		} else if ($val == '3') {
			return '비과세단체';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 컨설팅의 등록 경로 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceConsultingRegPath')) {
	function replaceConsultingRegPath($val)
	{
		if ($val == '0') {
			return '홈페이지';
		} else if ($val == '1') {
			return '전화문의';
		} else if ($val == '2') {
			return '이메일문의';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 컨설팅 의뢰범위 상세 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceConsultingDetailStatus')) {
	function replaceConsultingDetailStatus($val)
	{
		if ($val == '0') {
			return '작업대기';
		} else if ($val == '1') {
			return '진행중';
		} else if ($val == '2') {
			return '외주발주';
		} else if ($val == '3') {
			return '작업완료';
		} else if ($val == '4') {
			return '취소';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 컨설팅 의뢰범위 상세의 수정 횟수 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceConsultingDetailModCount')) {
	function replaceConsultingDetailModCount($val)
	{
		if ($val == '0') {
			return '수정 없음';
		} else if ($val == '1') {
			return '1회차 수정';
		} else if ($val == '2') {
			return '2회차 수정';
		} else if ($val == '3') {
			return '3회차 수정';
		} else if ($val == '4') {
			return '4회차 수정';
		} else if ($val == '5') {
			return '5회차 수정';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 컨설팅 의뢰범위 상세의 외주 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceConsultingDetailPartnerStatus')) {
	function replaceConsultingDetailPartnerStatus($val)
	{
		if ($val == '0') {
			return '내부작업';
		} else if ($val == '1') {
			return '외주접수';
		} else if ($val == '2') {
			return '결제완료';
		} else if ($val == '3') {
			return '시안확인';
		} else if ($val == '4') {
			return '제작중';
		} else if ($val == '5') {
			return '발송완료';
		} else {
			return '-';
		}
	}
}


/**
 * Author : 배진환
 * Usage : 묻고답하기(QnA) 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceQnaStatus')) {
	function replaceQnaStatus($val)
	{
		if ($val == '0') {
			return '답변대기';
		} else if ($val == '1') {
			return '답변완료';
		} else {
			return '-';
		}
	}
}



/**
 * Author : 배진환
 * Usage : 월간디자인 작업 난이도 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceDifficulty')) {
	function replaceDifficulty($val)
	{
		if ($val == '1') {
			return '매우쉬움';
		} else if ($val == '2') {
			return '쉬움';
		} else if ($val == '3') {
			return '보통';
		} else if ($val == '4') {
			return '어려움';
		} else if ($val == '5') {
			return '매우어려움';
		} else {
			return '-';
		}
	}
}


/**
 * Author : 배진환
 * Usage : 월간디자인 작업 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceSubscribeWorkStatus')) {
	function replaceSubscribeWorkStatus($val)
	{
		if ($val == '0') {
			return '작업대기';
		} else if ($val == '1') {
			return '진행중';
		} else if ($val == '2') {
			return '작업완료';
		} else if ($val == '3') {
			return '취소';
		} else {
			return '-';
		}
	}
}


/**
 * Author : 배진환
 * Usage : 외주업체 의뢰대금 지불 형태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceOutCostType')) {
	function replaceOutCostType($val)
	{
		if ($val == '0') {
			return '지정없음';
		} else if ($val == '1') {
			return '무통장입금';
		} else if ($val == '2') {
			return '카드결제';
		} else {
			return '-';
		}
	}
}



/**
 * Author : 배진환
 * Usage : 외주업체 의뢰대금 지불 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceOutCostStatus')) {
	function replaceOutCostStatus($val)
	{
		if ($val == '0') {
			return '지정없음';
		} else if ($val == '1') {
			return '지불 전';
		} else if ($val == '2') {
			return '지불완료';
		} else {
			return '-';
		}
	}
}

/**
 * Author : 배진환
 * Usage : 외주업체 의뢰대금 세금계산서 발행 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceOutCostBillStatus')) {
	function replaceOutCostBillStatus($val)
	{
		if ($val == '0') {
			return '발행 전';
		} else if ($val == '1') {
			return '발행 완료';
		} else {
			return '-';
		}
	}
}


/**
 * Author : 배진환
 * Usage : 만족도 상태 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceReviewStatus')) {
	function replaceReviewStatus($val)
	{
		if ($val == '0') {
			return '답변 전';
		} else if ($val == '1') {
			return '답변완료';
		} else {
			return '-';
		}
	}
}


/**
 * Author : 배진환
 * Usage : 사업분야 Bool값 text 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('bool2Str')) {
	function bool2Str($val)
	{
		if ($val == '0') {
			return '비활성';
		} else if ($val == '1') {
			return '활성';
		} else {
			return '-';
		}
	}
}



/**
 * Author : 배진환
 * Usage : 컨설팅 작업범위 코드 String 치환
 * Param
 *  - $val : 치환 대상 값
 */
if (!function_exists('replaceConsultingDetailWorkRange')) {
	function replaceConsultingDetailWorkRange($val)
	{
		if ($val == '0') {
			return '디자인';
		} else if ($val == '1') {
			return '디자인+제작';
		} else if ($val == '2') {
			return '제작';
		} else {
			return '-';
		}
	}
}


