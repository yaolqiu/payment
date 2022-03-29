<?php
namespace wcyx\Gateway\GZYL;

class GatewayUrl {
    //基本URL
    const GATEWAY_BASE = 'http://117.48.192.183:8880/cgi-bin/';
    //支付网关
    const PAY = self::GATEWAY_BASE . 'n_web_pay.api';
    //进件()
    const UPLOAD = self::GATEWAY_BASE . 'n_pic_upload.api';
    //订单可分账查询
    const ORDER_SETTLE_RESULT = self::GATEWAY_BASE . 'n_get_settle_result.api';
    //退款网关(分账)
    const SPLIT_REFUND = self::GATEWAY_BASE . 'n_split_refund.api';
    //分账结果查询
    const SPLIT_REFUND_RESULT= self::GATEWAY_BASE . 'n_get_split_refund_result.api';
    //个人进件(C类)
    const REGISTER_PERSON = self::GATEWAY_BASE . 'n_person_open_apply.api';
    //企业进件(B类)
    const REGISTER_BUSINESS = self::GATEWAY_BASE . 'n_business_open_apply.api';
    //更换结算账号信息
    const REGISTER_SETTLE_UPDATE = self::GATEWAY_BASE . 'n_update_account_info.api';
    //结算账号信息查询
    const REGISTER_SETTLE_RESULT = self::GATEWAY_BASE . 'n_update_account_query.api';
    //发送短信
    const SMS_SEND = self::GATEWAY_BASE . 'n_reside_resend_sms.api';
    //确认短信
    const SMS_CONFIRM = self::GATEWAY_BASE . 'n_reside_confirm_sms.api';
    //进件进度查询
    const ACCOUNT_QUERY = self::GATEWAY_BASE . 'n_apply_account_query.api';
    //单次分账
    const SPLIT_SINGLE = self::GATEWAY_BASE . 'n_single_split.api';
    //多次分账
    const SPLIT_MULTI = self::GATEWAY_BASE . 'n_multi_split.api';
    //完结分账
    const SPLIT_CLOSE = self::GATEWAY_BASE . 'n_close_split.api';
    //分账结果查询
    const SPLIT_RESULT = self::GATEWAY_BASE . 'n_get_split_result.api';
    //打账结果查询
    const SPLIT_TRANSFER_RESULT = self::GATEWAY_BASE . 'n_get_transfer_result.api';
}
