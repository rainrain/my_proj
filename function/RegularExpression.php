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

}

var_dump(RegularExpression::isMail("_____@a_df.sdf"));