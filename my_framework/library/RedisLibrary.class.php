<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 下午5:56
 *
 * 参考地址：http://www.cnblogs.com/ikodota/archive/2012/03/05/php_redis_cn.html#key_keys
 *
 */
class RedisLibrary{
	private $_conn;
	public function __construct($host,$port,$timeout=0){
		$this->_conn = new Redis($host,$port);
	}


	public function set($key,$value){
		return $this->_conn->set($key,$value);
	}

	public function setex($key,$expireSec,$value){//存在则被覆盖
		$this->_conn->setex($key,$expireSec,$value);
	}


	public function get($key){
		return $this->_conn->get($key);//没有返回false
	}

	public function del($key){
		return $this->_conn->del($key);//不存在返回int(0),成功返回true(1)
	}

	public function mset(Array $arr){//array('key1'=>'val1','key2'=>'val2')
		if(empty($arr)){
			return false;
		}
		return $this ->_conn->mset($arr);

	}

	public function mget(Array $arr){
		if(empty($arr)){
			return false;
		}
		return $this->_conn->mget($arr);
	}

	public function keys($pattern){//"*o*","t??"
		return $this->_conn->keys($pattern);
	}

	public function randomKey(){
		return $this->_conn->randomKey();
	}

	public function exists($key){
		return $this->_conn->exists($key);
	}

	public function expire($key,$expireSec){
		return $this->_conn->expire($key,$expireSec);
	}


}