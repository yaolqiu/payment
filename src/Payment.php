<?php

namespace wcyx;

use wcyx\Library\PaymentConfig;
use wcyx\Library\ProxyFactory;

/***
 *
 * @description 主入口
 * @namespace wcyx\Payment
 * @author    lyqiu
 * @date      2022/3/3 18:16
 *
 */



class Payment extends PaymentConfig
{
    public $proxy_instance = null;

    public function __construct($proxy,$config)
    {
        $this->proxy_instance = ProxyFactory::getInstance($proxy);
        $this->proxy_instance->setConfig($config);
        return $this->proxy_instance;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        if(!method_exists($this->proxy_instance,$name)) {
            throw new \InvalidArgumentException(sprintf('method:[%s] not exists',$name));
        }
        $reflection_method = new \ReflectionMethod($this->proxy_instance,$name);
        $need_num = count($reflection_method->getParameters());
        $got_num = count($arguments);
        if($need_num!=$got_num) {
            throw new \InvalidArgumentException(sprintf('method:[%s] param expert num: %s and got is: ',$name,$need_num,$got_num));
        }
        return $this->proxy_instance->$name(...$arguments);
    }

}










