<?php

require '../../vendor/autoload.php';
$config = require './config.php';

try {
    $pic_path =  dirname(__DIR__).'/assets/pic.png';

    $payment = new \wcyx\Payment('GZYL',$config);
    $data = $payment->upload($pic_path);
    var_dump($data);
} catch (Exception $e) {
    print_R([$e->getMessage(),$e->getCode()]);
    exit();
}

