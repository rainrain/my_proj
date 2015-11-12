<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 上午11:19
 */
!defined("RAIN_FRAMEWORK") && exit("ileagel request");

//自动加载
function myAutoload($className){
	//controller,model,library
	$str = substr($className,-4);
	switch($str){
		case 'ller':
			$file = "./controller/{$className}.class.php";
			break;
		case 'odel':
			$file = "./model/{$className}.class.php";
			break;
		case 'rary':
			$file = "./library/{$className}.class.php";
			break;
		default:
			throw new Exception("NOT CORRECT SUFFIX:(".$str.")",SUFFIX_NOT_CORRECT);
	}
	if(!file_exists($file)){
		throw new Exception("FILE:".$className.".class.php NOT EXISTS",FILE_NOT_EXSITS);
	}
	require $file;
}
spl_autoload_register("myAutoload");




class RainFramwork{
	/**
	 * 构造函数，处理请求并返回结果
	 * 1.检验参数是否合法【加密和时间戳】
	 * 2.根据?a=/rain/rain获取要调用的controller
	 * 3.调用响应的controller并得到一个数组
	 * 4.将得到的结果加工成客户端需要的数据格式并返回
	 */
	public function __construct(){

		try{
			$params = self::getParams();//这里将客户端传进来的数据换成数组给到方法里
			self::checkParams($params);//验证客户端是不是合法
			$runInfo = self::getRunInfo();
			$controllerName = $runInfo[0];
			$functionName = $runInfo[1];
			$controllerObj = new $controllerName();
			$result = $controllerObj -> $functionName($params);
			self::responseResult($result);
		}catch (Exception $e){
			self::responseResult(array(),$e->getCode(),$e->getMessage());
		}
	}


	/**
	 * 检测参数是否合法，不合法直接
	 */
	private static function checkParams($params){
		//参数验证md5(rain_{param1:12,param2:13,timestamp:时间戳})//忽略空白后的加密
		//按照参数1值1参数2值2.。。的顺序将data里的数据组成一个字符长加密，必须带上时间戳

		$data = $params['data'];
		$str = MD5_PREFIX;
		foreach($data as $k=>$v){
			$str.=$k.$v;
		}
		if(md5($str) != $params['sign']){
			throw new Exception("err sign",SIGN_NOT_CORRECT);
		}
	}


	/**
	 * @param $data
	 *
	 * 将控制器处理好的数组处理为需要的格式返回
	 *
	 */
	private static function responseResult($data,$errCode=0,$errMsg=""){
		$return = array(
			'errCode' => $errCode,
			'errMsg' => $errMsg,
			'data' => $data,
			'timestamp' => time(),

		);

		echo json_encode($return);
		exit;
	}


	/**
	 * @return mixed
	 * 将客户端发送的参数转成数组
	 *
	 */
	private static function getParams(){
		$params = file_get_contents("php://input");
		$params = json_decode($params,true);
		if(!is_array($params)) {
			throw new Exception("error params format",PARAM_FORMAT_NOT_CORRECT);
		}
		return $params;
	}


	/**
	 * @return array
	 * 根据index.php?a=/rain/rain返回要调用的信息
	 * 索引数组，第一个为controller,第二个为functionName
	 *
	 */
	private static function getRunInfo(){
		$act = isset($_GET['a'])?$_GET['a']:'/run';//默认设置为RunController
		$info = explode("/",$act);
		$controllerName = ucfirst(strtolower($info[1]))."Controller";
		if(empty($info[2])){
			$functionName = "run";
		}else{
			$functionName = $info[2];
		}
		return array($controllerName,$functionName);
	}


	
}