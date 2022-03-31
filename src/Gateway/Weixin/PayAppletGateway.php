<?php
namespace wcyx\Gateway\Weixin;

use GuzzleHttp\Exception\RequestException;
use wcyx\Contract\GateWayInterface;
use wcyx\Library\Utils;


/****
 *
 * @description 小程序支付
 * @namespace wcyx\Gateway\GZYL\PayGateway
 * @author    lyqiu
 * @date      2022/3/30 11:18
 *
 */

class PayAppletGateway extends WeixinBaseGateway implements GateWayInterface
{

    /****
     *
     * @description 微信小程序支付
     * @author  lyqiu
     * @date    2022/3/30 11:19
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\request
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function request(array $param)
    {
        $post_data = ['json' => [
            'appid'        => $param['appid'],
            'mchid'        => self::$config['merchant_id'],
            'out_trade_no' => $param['out_trade_no'],
            'description'  => $param['body'],
            'notify_url'   => $param['notify_url'],
            'amount'       => [
                'total'    => $param['amount'],
                'currency' => 'CNY'
            ],
            'payer'=> [
                'openid'=> $param['openid']
            ],
        ]];
        $result = $this->uniResponse(GatewayUrl::JSAPI,$post_data);
        return $this->genPaySign($param['appid'],$result['prepay_id']);
    }
}


