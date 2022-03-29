<?php

namespace wcyx\Library;

/****
 * 静态方法调用 trait
 */

trait StaticTrait
{
    public static $instance;
    public static function __callStatic($fn,$argv)
    {
        if(empty(self::$instance)) {
            self::$instance = new self();
        }
        $fn = str_replace('__','',$fn);
        if(method_exists(self::$instance,$fn)) {
            return self::$instance->$fn(...$argv);
        } else {
            throw new \Exception(sprintf('class[%s],method[%s] not exists',get_called_class(),$fn));
        }
    }
}
