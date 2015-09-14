<?php
/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/9/14
 * Time: 下午5:17
 */

namespace rain1;
require("T2.php");

class T1
{
    public function show(){
        echo 'this is rom \rain1\T1';
    }
}

$obj1 = new \rain1\T1();
$obj1 -> show();

$obj2 = new \rain2\T1();
$obj2 -> show();