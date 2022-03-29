<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Contract\GateWayInterface;
use wcyx\Library\HttpClient;

/****
 *
 * @description 小程序支付
 * @namespace wcyx\Gateway\GZYL\ApiWxappletGateway
 * @author    lyqiu
 * @date      2022/3/10 18:58
 *
 */


class PayApiWxappletGateway extends GZYLBaseGateway implements GateWayInterface
{
    /***
     * @description  小程序支付
     * @param array $param
     * @return mixed
     * @throws \wcyx\Exception\GatewayException
     * @package      wcyx\Contract\\${CLASS_NAME}\request
     *
     * @author       lyqiu
     * @date         2022/3/7 18:57
     */
    public function request(array $param)
    {
        //完成的参数
        $data = [
            'syscode'=> self::$config['syscode'],             //M 系统码
            'account'=> self::$config['account'],             //M 商户号
            'charset'=> 'UTF8',         //C 编码格式UTF8 表示UTF8编码   默认GBK
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'amount'=> $param['amount'],              //M 交易金额 交易金额,单位分
            'pay_mode'=> $this->getChannelName(),   //M 参数支付方式说明
            'aging'=> '1',              //M 结算周期：1：T+1
            'app_id'=> $param['app_id'],  //M 商户订单号
            'callback_url'=> '',        //C 前端页面跳转地址，支付完成后将回跳该地址，不能携带参数
            'notify_url'=> $param['notify_url'],  //M 异步通知回调地址 接收统一支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数
            'terminal_ip'=> '',         //C 终端IP H5-微信支付时必填，客户端访问IP
            'terminal_device'=>'4',     //C	终端设备 1:PC浏览器  2:WEB浏览器  3:微信公众号 4:微信小程序 5:手机APP  6:其它
            'bank_id'=> '',             //C 银行编码
            'auth_app_id'=> $param['auth_app_id'],     //C 应用APPID 微信或支付宝应用APPID （公众号和小程序支付必传应用APPID）
            'openid'=> $param['openid'],        //C 微信用户标识
            'is_raw'=> '',              //C 是否原生支付
            'buyer_id'=> '',            //C 支付宝用户标识
            'auth_code'=> '',           //C 支付授权码
            'subject'=> $param['subject'],  //C 商品描述
            'body'=> $param['body'],    //C 商品详情
            'limit_credit_pay'=> $param['limit_credit_pay'] ?? '',    //C 是否限制信用卡
            'hb_fq_num'=> $param['hb_fq_num'] ?? '',      //C 花呗分期数
            'expire_date'=> '',  //C 订单支付有效期时间
            'time_expire'=> '',  //C 该笔订单允许的最晚付款时间
            'memo'=> $param['memo'] ?? '' //C 备注说明
        ];

        //过滤参数
        $data = $this->dealEmptyElement($data);
        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::PAY,$data));
    }
}


