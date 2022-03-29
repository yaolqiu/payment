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


}
