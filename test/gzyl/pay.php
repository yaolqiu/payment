<?php

require '../../vendor/autoload.php';

try {
    $app_id = time();
    $config = [
        'syscode'=> '20000269',
        'account'=> '9262001437',
        'private_key_path'=> 'D:\PhpstormProjects\composer\Payment\test\gzyl\cert\9262001437_rsa_private_key_2048.pem',
        'public_key_path'=> 'D:\PhpstormProjects\composer\Payment\test\gzyl\cert\9262001437_rsa_public_key_2048.pem',
    ];
    $data = [
        'app_id'=> $app_id,
        'amount'=> 100,
        'notify_url'=> 'https://wcyx.dianxfu.com/noftify',
        'auth_app_id'=> 'wxf22dc65e896004ba',
        'openid'=> 'oEzLM5Jvhlkh6tpDWGVgPUr3aJ2o',
        'subject'=> '测试', //经测试发现这个字段不能带空格
        'body'=> '测试',
    ];
    $payment = new \wcyx\Payment('GZYL',$config);
    $channel = 'API_WXAPPLET';
    $info = $payment->pay($channel,$data);
    var_dump($info);
} catch (Exception $e) {
    print_R([$e->getMessage(),$e->getCode()]);
    exit();
}

