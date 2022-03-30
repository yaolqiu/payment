<?php
namespace wcyx\Gateway\Weixin;

use GuzzleHttp\Exception\RequestException;
use wcyx\Exception\GatewayException;
use wcyx\Library\GateWay;
use wcyx\Library\Utils;
use WeChatPay\Builder;
use WeChatPay\Crypto\Rsa;
use WeChatPay\Util\PemUtil;

class WeixinBaseGateway extends GateWay
{

    /***
     *
     * @description 获取请求实例
     * @author  lyqiu
     * @date    2022/3/30 14:17
     * @package wcyx\Gateway\Weixin\\${CLASS_NAME}\getInstance
     * @return \WeChatPay\BuilderChainable
     *
     */
    public static function getInstance()
    {
        // 商户号
        $merchantId = self::$config['merchant_id'];

        // 从本地文件中加载「商户API私钥」，「商户API私钥」会用来生成请求的签名
        $merchantPrivateKeyPath = self::$config['merchant_private_key_path'];
        if(!file_exists($merchantPrivateKeyPath)) {
            throw new \Exception(sprintf('Not Found merchant private[%s]',$merchantPrivateKeyPath));
        }
        $merchantPrivateKeyInstance = Rsa::from(file_get_contents($merchantPrivateKeyPath), Rsa::KEY_TYPE_PRIVATE);

        // 「商户API证书」的「证书序列号」
        $merchantCertificateSerial = self::$config['merchant_serial'];

        // 从本地文件中加载「微信支付平台证书」，用来验证微信支付应答的签名
        $platformCertificatePath = self::$config['platform_certificate_path'];
        if(!file_exists($platformCertificatePath)) {
            throw new \Exception(sprintf('Not Found platform certificate[%s]',$platformCertificatePath));
        }
        $platformContent = file_get_contents($platformCertificatePath);
        $platformPublicKeyInstance = Rsa::from($platformContent, Rsa::KEY_TYPE_PUBLIC);

        // 从「微信支付平台证书」中获取「证书序列号」
        $platformCertificateSerial = PemUtil::parseCertificateSerialNo($platformContent);

        // 构造一个 APIv3 客户端实例
        return Builder::factory([
            'mchid'      => $merchantId,
            'serial'     => $merchantCertificateSerial,
            'privateKey' => $merchantPrivateKeyInstance,
            'certs'      => [
                $platformCertificateSerial => $platformPublicKeyInstance,
            ],
        ]);

    }


    /***
     *
     * @description 统一处理结果
     * @author  lyqiu
     * @date    2022/3/30 14:17
     * @package wcyx\Gateway\Weixin\\${CLASS_NAME}\uniResponse
     * @param string $raw
     * @return array|mixed
     * @throws GatewayException
     *
     */
    public function uniResponse($url,$data)
    {
        try {
            $response = static::getInstance()
                ->chain($url)
                ->post($data);
            $content = Utils::jsonDecode($response->getBody()->getContents());
        } catch (RequestException $e) {

            throw new \Exception($e->getResponse()->getBody()->getContents());
        }
    }
}


