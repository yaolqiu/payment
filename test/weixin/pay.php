<?php

require '../../vendor/autoload.php';
$config = require './config.php';

try {

    $data = [
        'out_trade_no'=> 'PAY'.time(),
        'appid'=> 'wx409b18fe87732520',
        'amount'=> 1000,
        'notify_url'=> 'https://wcyx.dianxfu.com/noftify',
        'openid'=> 'oDsRMuJiQ9N0KMdMel9Vu47Q_FUc',
        'subject'=> 'testpay', //经测试发现这个字段不能带空格
        'body'=> 'testpay',
    ];

    $payment = new \wcyx\Payment('WEIXIN',$config);
    $channel = 'APPLET';
    $info = $payment->pay($channel,$data);
    var_dump($info);
} catch (Exception $e) {
    print_R($e->getTrace());
    print_R([$e->getMessage(),$e->getCode()]);
    exit();
}

