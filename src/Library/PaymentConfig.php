<?php

namespace wcyx\Library;

/***
 *
 * @description 支付方式常量定义
 * @namespace ${NAMESPACE}\PaymentConfig
 * @author    lyqiu
 * @date      2022/3/3 18:23
 *
 */

abstract class PaymentConfig
{
    // 微信支付
    const WECHAT = "wechat";
    // 支付宝支付
    const ALIPAY = "Alipay";
    //广州银联支付
    const GZYL = "GZYL";



    //广州银联支付渠道
    const GZYL_CHANNEL = [
        'API_WXAPPLET'=> [
            'label'=> '微信小程序支付',
            'value'=> 'API_WXAPPLET'
        ],
        'API_WXQRCODE'=> [
            'label'=> '微信扫码支付',
            'value'=> 'API_WXQRCODE'
        ],
        'API_WXSCAN'=> [
            'label'=> '微信付款码支付',
            'value'=> 'API_WXSCAN'
        ],
        'H5_WXWEB'=> [
            'label'=> '微信H5支付',
            'value'=> 'H5_WXWEB'
        ],
        'API_WXAPP'=> [
            'label'=> '微信APP支付',
            'value'=> 'API_WXAPP'
        ],
        'API_GATEWAY'=> [
            'label'=> 'B2C个人网银支付',
            'value'=> 'API_GATEWAY'
        ],
        'DIR_GATEWAY'=> [
            'label'=> 'B2B企业网银支付',
            'value'=> 'DIR_GATEWAY'
        ],
        'H5_ZFBWEB'=> [
            'label'=> '支付宝H5支付',
            'value'=> 'H5_ZFBWEB'
        ],
        'API_ZFBQRCODE'=> [
            'label'=> '支付宝扫码支付',
            'value'=> 'API_ZFBQRCODE'
        ],
        'API_CUQRCODE'=> [
            'label'=> '银联扫码支付',
            'value'=> 'API_CUQRCODE'
        ],
        'API_CUAPP'=> [
            'label'=> '银联APP支付',
            'value'=> 'API_CUAPP'
        ],
        'API_ZFBAPP'=> [
            'label'=> '支付宝APP支付',
            'value'=> 'API_ZFBAPP'
        ],
        'API_ZFBAPPLET'=> [
            'label'=> '支付宝小程序支付',
            'value'=> 'API_ZFBAPPLET'
        ],
        'H5_WXJSAPI'=> [
            'label'=> '微信公众号支付',
            'value'=> 'H5_WXJSAPI'
        ],
        'H5_ZFBJSAPI'=> [
            'label'=> '支付宝生活号支付',
            'value'=> 'H5_ZFBJSAPI'
        ],
        'API_ZFBSCAN'=> [
            'label'=> '支付宝付款码支付',
            'value'=> 'API_ZFBSCAN'
        ]
    ];




}
