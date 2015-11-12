<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 上午11:32
 */
class RainController{

	public function run($params){
		//$parmas为客户端传的数据，已经在框架里转成数组
		$data = range(0,10);
		$rainModel = new RainModel();
		$rainModel -> show();
		return $data;
	}

	
}