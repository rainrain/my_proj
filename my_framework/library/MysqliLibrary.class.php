<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 下午5:41
 */
class MysqliLibrary{

	public function __construct(){
		global $dbConfig;

		$dsn = "mysql:dbname={$dbConfig['dbName']};host={$dbConfig['host']}";
		$user = $dbConfig['username'];
		$password = $dbConfig['password'];

		try {
			$dbh = new PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}



	}





}