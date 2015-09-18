<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/9/15
 * Time: 上午10:38
 */
class mongoConnect
{
    private $conn=null;
    private $db;
    public function __construct($host,$dbname='',$port=27017){
        $this -> conn = new MongoClient("mongodb://".$host.":".$port);
        //new MongoClient("mongodb://rain:123455@localhost:21017/dbname);  //如果你指定了一个用户名和密码，你可以指定一个要验证的数据库。 如果没有指定 db，将会使用 "admin"。

        //链接集群
        //$m1 = new MongoClient("mongodb://sf2.example.com,ny1.example.com", array("replicaSet" => "myReplSet"));
        if($dbname){
            $this -> db = $this->conn -> $dbname;
        }
        var_dump($this->conn);
    }

    public function selectDb($dbName){
        $this -> db = $dbName;



    }

}

new mongoConnect("localhost");

