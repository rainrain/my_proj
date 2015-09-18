<?php

/**
 * Created by PhpStorm.
 * User: rain
 * Date: 15/9/14
 * Time: 下午6:09
 */
class RegularExpression
{
    public static function isMail($email){
        $result=filter_var($email,FILTER_VALIDATE_EMAIL);//验证成功返回邮箱，失败返回false,只要后边有.并符合域名要求，就算成功了。
        return $result;
    }

    public static function isUrl($url){
        $result = filter_var($url,FILTER_VALIDATE_URL);
        return $result;
    }

    public static function isChineseCharacter($str){
        $pattern= '/[u4e00-u9fa5]/';
//        $pattern= '/a/';
        return preg_match($pattern,$str);
    }

    public static function isQq($qq){
        $pattern = '/^[1-9][0-9]{4,}$/';
        return preg_match($pattern,$qq);
    }


}

var_dump(RegularExpression::isMail("_____@a_df.sdf"));
var_dump(RegularExpression::isUrl('http://www.baidu.com'));
var_dump(RegularExpression::isChineseCharacter('洪文'));
var_dump(RegularExpression::isQq("67788998"));