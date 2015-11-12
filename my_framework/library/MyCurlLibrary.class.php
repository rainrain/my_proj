<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 下午4:08
 */
class MyCurlLibrary{
	public static function getRequest($url,Array $data=array(),$isNeedHeader=0){
		$ch = curl_init();
		if($data){
			$bindQurey = http_build_query($data);
			$url.="?".$bindQurey;
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		//设置是否需要返回值
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//解决https证书问题
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, $isNeedHeader);//这个设置是否需要拿到header头信息，如果只是要程序返回值，则设置为0，否则为1
		//部分重定向问题，函数中加入下面这条语句
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public static function postRequest($url,Array $data=array()){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($ch, CURLOPT_POST, 1);
		// post的变量
		if($data){
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		$output = curl_exec($ch);
		curl_close($ch);
		//打印获得的数据
		return $output;
	}
	
}

/**
 * sample
 *
 * //准备数据
	$url = "http://localhost:8080/test/test.php";//改文件有代码  print_r($_GET);         print_r($_POST)
	$data = array('a'=>'b','c'=>'d',8=>666,888);
	//测试get方法
	$result = MyCurl::getRequest($url,$data);
	//测试post方法
	$result = MyCurl::postRequest($url,$data);
	//打印结果
	var_dump($result);
 *
 *
 */