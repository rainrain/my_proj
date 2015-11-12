<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/11/2
 * Time: 上午11:32
 */
class RainModel{
	public function show(){
		echo 'this is rainmodel';
		$mongoDb = new MongoDbLibrary();
		$mongoDb -> selectDb('rain');
		$mongoDb -> selectColl('ttt');
		print_r($mongoDb -> insert(array('hello'=>'world')));
	}
	
}