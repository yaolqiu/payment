<?php
namespace wcyx\Library;

class Utils
{
    /***
     *
     * @description 获取常规签名字符串
     * @author  lyqiu
     * @date    2022/3/8 10:28
     * @package wcyx\Library\\${CLASS_NAME}\signSort
     * @param array $param
     * @param string[] $hide_field
     * @return string
     *
     */
    public static function signSort(array $param=[], array $hide_field=['signature']) : string
    {
        ksort($param);
        $sign_data = [];
        foreach ($param as $k=>$v) {
            if(!in_array($k,$hide_field)) {
                $sign_data[] = $k.'='.$v;
            }
        }
        return implode('&', $sign_data);
    }


    /***
     *
     * @description gbk转为utf-8
     * @author  lyqiu
     * @date    2022/3/26 13:55
     * @package wcyx\Library\\${CLASS_NAME}\gbk2utf8
     * @param $string
     * @return array|false|string
     *
     */
    public static function toUTF8($string)
    {
        $encode = mb_detect_encoding($string, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
        return $encode == "UTF-8" ? $encode : mb_convert_encoding($string,'UTF-8',$encode);
    }

    /***
     *
     * @description 获取随机字符
     * @author  lyqiu
     * @date    2022/3/30 18:47
     * @package wcyx\Library\\${CLASS_NAME}\nonceStr
     * @param int $length
     * @return string
     *
     */
    public static function nonceStr($length=6)
    {
        $str = 'abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789';
        $str_len = strlen($str) - 1;
        $nonce_str = '';
        for ($i=0;$i<$length;$i++) {
            $nonce_str = $nonce_str . $str[mt_rand(0,$str_len)];
        }
        return $nonce_str;
    }



    /****
     *
     * @description 统一解压
     * @author  lyqiu
     * @date    2022/3/30 15:51
     * @package wcyx\Library\\${CLASS_NAME}\jsonDecode
     * @param $str
     * @return mixed
     *
     */
    public static function jsonDecode($str)
    {
        return json_decode($str,true);
    }




}
