<?php
/***
 *
 * 支付工厂类
 *
 */

namespace wcyx\Library;

class ProxyFactory
{
    public static $factory = [];

    public static function getInstance($proxy)
    {
        $factory_name = self::getProxyFactoryName($proxy);

        if(!isset(self::$factory[$factory_name])) {
            self::$factory[$factory_name] = new $factory_name;
        }
        return self::$factory[$factory_name];
    }

    protected static function getProxyFactoryName($proxy): string {
        return 'wcyx\Proxy\\' . ucfirst($proxy) . 'Proxy';
    }
}
