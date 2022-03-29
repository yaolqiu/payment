<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Contract\GateWayInterface;
use wcyx\Library\HttpClient;

/****
 *
 * @description B2C个人网银支付
 * @namespace wcyx\Gateway\GZYL\ApiWxappletGateway
 * @author    lyqiu
 * @date      2022/3/10 18:58
 *
 */

class PayApiGatewayGateway extends GZYLBaseGateway implements GateWayInterface
{

    /***
     *
     * @description B2C个人网银支付
     * @author  lyqiu
     * @date    2022/3/29 16:55
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\request
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function request(array $param)
    {
        //完成的参数
        $data = [
            'syscode'=> self::$config['syscode'],               //M 系统码
            'account'=> self::$config['account'],               //M 商户号
            'charset'=> 'UTF8',                                 //C 编码格式UTF8 表示UTF8编码   默认GBK
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'amount'=> $param['amount'],                        //M 交易金额 交易金额,单位分
            'pay_mode'=> $this->getChannelName(),               //M 参数支付方式说明
            'aging'=> '1',                                      //M 结算周期：1：T+1
            'app_id'=> $param['app_id'],                        //M 商户订单号
            'callback_url'=> $param['callback_url'],            //C 前端页面跳转地址，支付完成后将回跳该地址，不能携带参数
            'notify_url'=> $param['notify_url'],                //M 异步通知回调地址 接收统一支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数
            'subject'=> $param['subject'],                      //C 商品描述
            'body'=> $param['body'],                            //C 商品详情
            'limit_credit_pay'=> $param['limit_credit_pay'] ?? '',    //C 是否限制信用卡
            'hb_fq_num'=> $param['hb_fq_num'] ?? '',            //C 花呗分期数
            'expire_date'=> '',                                 //C 订单支付有效期时间
            'time_expire'=> '',                                 //C 该笔订单允许的最晚付款时间
            'memo'=> $param['memo'] ?? '' //C 备注说明
        ];

        //过滤参数
        $data = $this->dealEmptyElement($data);
        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::PAY,$data));
    }
}


