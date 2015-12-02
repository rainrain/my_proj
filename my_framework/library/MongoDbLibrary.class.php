<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 下午5:56
 *
 * ./mongod --dbpath=/usr/local/Cellar/mongodb/3.0.4/data
 *
 */
class MongoDbLibrary{
	private $host="localhost";
	private $port=27017;
	private $conn;
	private $db;
	private $coll;

	public function __construct(){
		//--$m = new MongoClient("mongodb://testUser:testPass@localhost");---带密码的方式

		//--集群的链接方式
		// 传递逗号分隔的服务器名称列表到构造器
		// 注意我们不需要传入集群的所有成员，驱动能够获取完整的列表
		//$m1 = new MongoClient("mongodb://sf2.example.com,ny1.example.com", array("replicaSet" => "myReplSet"));
		//这里要改成单例
		$this->conn = new MongoClient("mongodb://localhost:27017");
	}

	public function selectDb($dbName){
		$this->db = $this->conn ->selectDB($dbName);
	}

	public function selectColl($coll){
		$this->coll = $this->db->selectCollection($coll);
	}

	public function insert(array $data,$option=array()){
		return $this -> coll -> insert($data,$option);
	}

	public function remove($condition,$option){
		return $this->coll -> remove($condition,$option);
	}

	public function findOne($query,$fields){
		$res = $this->coll->findOne($query,$fields);
		return $this->makeResult2Arr($res);
	}

	public function find($query,$field=array()){
		$res = $this->coll->find($query,$field);
		return $this -> makeResult2Arr($res);
	}


	private function makeResult2Arr($res){
		$return = array();
		if(empty($res)){
			return $return;
		}
		while($res->hasNext()){
			$return[] = $res->getNext();
		}
		return $return;
	}



	//系统方法
	public function setSlaveOkay($bool){
		return $this -> db -> setSlaveOkay($bool);
	}

	public function getSlaveOkay(){
		return $this->db->getSlaveOkay();
	}


	public static function getVersion(){
		return MongoClient::VERSION;
	}

}