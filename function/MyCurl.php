<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/9/14
 * Time: 下午4:16
 */
class MyCurl
{
    public static function getRequest($url,Array $data=array()){
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
        curl_setopt($ch, CURLOPT_HEADER, 0);//这个设置是否需要拿到header头信息，如果只是要程序返回值，则设置为0，否则为1
        //部分重定向问题，函数中加入下面这条语句
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}


//测试get方法
$url = "http://localhost:8080/test/test.php";//改文件有一行代码  var_dump($_GET);
$data = array('a'=>'b','c'=>'d',8=>666,888);
$result = MyCurl::getRequest($url,$data);
var_dump($result);