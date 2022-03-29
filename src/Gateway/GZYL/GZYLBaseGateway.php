<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Exception\GatewayException;
use wcyx\Library\GateWay;
use wcyx\Library\Utils;

class GZYLBaseGateway extends GateWay
{
    /***
     *
     * @description 生成Sign
     * @throws GatewayException
     * @package     wcyx\Gateway\GZYL\\${CLASS_NAME}\genSign
     *
     * @author      lyqiu
     * @date        2022/3/8 10:00
     */
    public function genSign(array $param=[],string $sign_type='SHA256'): string
    {
        /***
         * 1. 生成签名字符串
         * 2. 生成签名
         */
        if($sign_type!='SHA256') {
            throw new GatewayException("Gateway sign_type must SHA256 and got:".$sign_type);
        }
        //1.step 生成签名字符串
        $sign_str = Utils::signSort($param);

        //2.step 生成签名
        $private_key = openssl_get_privatekey($this->getPrivateKey());
        openssl_sign($sign_str, $signature, $private_key, "SHA256");
        openssl_free_key($private_key);
        return bin2hex($signature);
    }

    /***
     *
     * @description 验证签名
     * @author  lyqiu
     * @date    2022/3/9 9:56
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\verifySign
     * @param array $param
     * @param string $sign
     * @param string $sign_type
     * @return false|int
     * @throws GatewayException
     *
     */
    public function verifySign(array $param,string $sign,string $sign_type='SHA256')
    {
        if($sign_type!='SHA256') {
            throw new GatewayException("Gateway sign_type must SHA256 and got:".$sign_type);
        }
        $sign_str = Utils::signSort($param);
        $public_key = $this->getPublicKey();
        $key = openssl_get_publickey($public_key);
        $result = openssl_verify($sign_str,hex2bin($sign), $key, $sign_type);
        openssl_free_key($key);
        return $result;
    }


    /***
     *
     * @description 获取私钥内容（原始文件内容）
     * @author  lyqiu
     * @date    2022/3/8 11:04
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\getPrivateKey
     * @return false|string
     * @throws GatewayException
     *
     */
    public function getPrivateKey(): string
    {
        if(empty(self::$config['private_key_path'])) {
            throw new GatewayException("Gateway private_key_path not config:",GatewayException::ERROR_NOT_CONFIG_PRIVATE_KEY);
        }
        if(!file_exists(self::$config['private_key_path'])) {
            throw new GatewayException(sprintf("Gateway private_key[%s] file not exits.",self::$config['private_key_path']) ,GatewayException::ERROR_NOT_FOUND_PRIVATE_KEY);
        }
        return file_get_contents(self::$config['private_key_path']);
    }


    /***
     *
     * @description 获取公钥内容（原始文件内容）
     * @author  lyqiu
     * @date    2022/3/8 11:05
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\getPublicKey
     *
     */
    public function getPublicKey(): string
    {
        if(empty(self::$config['public_key_path'])) {
            throw new GatewayException("Gateway public_key_path not config:",GatewayException::ERROR_NOT_FOUND_PUBLIC_KEY);
        }
        if(!file_exists(self::$config['private_key_path'])) {
            throw new GatewayException(sprintf("Gateway public_key[%s] file not exits.",self::$config['public_key_path']) ,GatewayException::ERROR_NOT_FOUND_PUBLIC_KEY);
        }
        return file_get_contents(self::$config['public_key_path']);
    }

    /***
     *
     * @description 统一处理错误结果
     * @author  lyqiu
     * @date    2022/3/26 14:16
     * @package wcyx\Library\\${CLASS_NAME}\response
     * @param string $raw
     * @throws GatewayException
     *
     */
    public function uniResponse(string $raw)
    {
        $raw = Utils::toUTF8($raw);
        $result = json_decode($raw,true);
        if(empty($result)) {
            throw new GatewayException(sprintf('raw json_decode error;raw=[%s]',$raw));
        }
        if($result['errorcode']!=='0000') {
            throw new GatewayException(sprintf('GZYL Error: %s',$result['errormessage']),$result['errorcode']);
        }
        $response = $result['response'];
        if(isset($response['url_type'])) {
            switch ($response['url_type']) {
                case 8:
                    $pay_url = base64_decode($response['pay_url']);
                    parse_str($pay_url,$response['pay_url']);
                    $response['pay_url']['paySign'] = str_replace(' ','+',$response['pay_url']['paySign']);
                    break;
            }
        }
        return $response;
    }
}


