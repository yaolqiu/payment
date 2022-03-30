<?php

require '../../vendor/autoload.php';
$config = require './config.php';
$data = require './data.php';

try {
    //
    // $data = [
    //     'app_id'=> time(),
    //     'amount'=> 100,
    //     'notify_url'=> 'https://wcyx.dianxfu.com/noftify',
    //     'auth_app_id'=> 'wxf22dc65e896004ba',
    //     'openid'=> 'oEzLM5Jvhlkh6tpDWGVgPUr3aJ2o',
    //     'subject'=> '测试', //经测试发现这个字段不能带空格
    //     'body'=> '测试',
    // ];




    $payment = new \wcyx\Payment('GZYL',$config);
    $channel = 'API_WXAPPLET';
    $info = $payment->pay($channel,$data);
    var_dump($info);
} catch (Exception $e) {
    print_R([$e->getMessage(),$e->getCode()]);
    exit();
}

