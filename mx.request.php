<?php
header("content-type:text/html; charset=utf-8");
//curl模拟POST&GET请求类
class curl{
	function Request($apiUrl,$data,$type){
		$curlHttp = curl_init();
		switch ($type){
			case 'POST':
			case 'post':
				curl_setopt($curlHttp, CURLOPT_URL, $apiUrl);
				curl_setopt($curlHttp, CURLOPT_POST, 1);
				curl_setopt($curlHttp, CURLOPT_POSTFIELDS, $data);
				break;
			case 'GET':
			case 'get':
			default:
				$param = '?';
				foreach ($data as $key=>$value){
					$param .= $key.'='.$value.'&';
				}
				$param = substr($param, 0, -1);
				curl_setopt($curlHttp, CURLOPT_URL, $apiUrl.$param);
				break;
		}
		curl_setopt($curlHttp, CURLOPT_HEADER, 0);
		curl_setopt($curlHttp, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curlHttp);
		curl_close($curlHttp);
		return $result;
	}

	function POST($apiUrl,$data){
		return $this->Request($apiUrl,$data,'POST');
	}

	function GET($apiUrl,$data){
		return $this->Request($apiUrl,$data,'GET');	
	}
}