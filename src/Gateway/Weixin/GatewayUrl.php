<?php
namespace wcyx\Gateway\Weixin;

class GatewayUrl {
    //基本URL
    const GATEWAY_BASE = 'https://api.mch.weixin.qq.com/v3/';
    //jsapi，微信支付入口
    const JSAPI = self::GATEWAY_BASE . 'pay/transactions/jsapi';
    //APP下单API
    const APP = self::GATEWAY_BASE . 'pay/transactions/app';
    //H5下单API
    const H5 = self::GATEWAY_BASE . 'pay/transactions/h5';
    //Native下单API
    const NATIVE = self::GATEWAY_BASE . 'pay/transactions/native';
    //付款码支付
    const MICROPAY = 'https://api.mch.weixin.qq.com/pay/micropay';

    //支付结算查询
    const RESULT = self::GATEWAY_BASE . 'pay/transactions/id/{transaction_id}';

    //关闭订单
    const CLOSE = self::GATEWAY_BASE . 'pay/transactions/out-trade-no/{out_trade_no}/close';
    //发起退款（N）
    const REFUND = self::GATEWAY_BASE . 'refund/domestic/refunds';
    //退款结果
    const REFUND_RESULT = self::GATEWAY_BASE . 'refund/domestic/refunds/{out_refund_no}';
    //申请交易账单
    const BILL_APPLY = self::GATEWAY_BASE . 'bill/tradebill';
    //申请资金账单API
    const BILL_FLOW= self::GATEWAY_BASE . 'bill/fundflowbill';

}
