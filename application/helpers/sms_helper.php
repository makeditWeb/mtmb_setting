<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Author : 배진환
 * Usage : 알리고 SMS curl post 전송
 * Param
 *  - $receiver : 수신전화번호 배열 
 *  - $content : SMS 내용
 */
if (!function_exists('aligo_sms_send')) {
	function aligo_sms_send($receiver, $content)
	{
		/****************** 인증정보 시작 ******************/
		$sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
		$sms['user_id'] = "mtmbkorea"; // SMS 아이디
		$sms['key'] = "jc9rmj4ism7f5wk8cpvyagxfl6xdygt2"; //인증키
		/****************** 인증정보 끝 ********************/

		$receiver_str = implode(", ", $receiver);
		$receiver_str = str_replace("-", "", $receiver_str);
		$sms['msg'] = $content;
		$sms['receiver'] = $receiver_str;
		$sms['sender'] = "02-3663-0332";
		$sms['testmode_yn'] = '';
		$sms['msg_type'] = "SMS";

		$oCurl = curl_init();
		curl_setopt($oCurl, CURLOPT_PORT, 443);
		curl_setopt($oCurl, CURLOPT_URL, $sms_url);
		curl_setopt($oCurl, CURLOPT_POST, 1);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		$ret = curl_exec($oCurl);
		curl_close($oCurl);

		// echo $ret;
		$retArr = json_decode($ret); // 결과배열

		return $retArr;
		// print_r($retArr); // Response 출력 (연동작업시 확인용)
	}
}

