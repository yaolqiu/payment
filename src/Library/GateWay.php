<?php

namespace wcyx\Library;

use wcyx\Exception\GatewayException;

/***
 *
 * @description 所有支付网关的基类
 * @namespace wcyx\Library\GateWay
 * @author    lyqiu
 * @date      2022/3/3 18:02
 *
 */
abstract class GateWay
{
    const VERSION = '1.0.0';

    protected static $config = [];
    protected $channel_name = null;

    /***
     *
     * @description 获取当前版本
     * @author  lyqiu
     * @date    2022/3/3 18:05
     * @package wcyx\Library\\${CLASS_NAME}\getVersion
     * @return string
     *
     */
    public static function getVersion() : string
    {
        return self::VERSION;
    }

    /***
     *
     * @description 获取分类名称
     * @author  lyqiu
     * @date    2022/3/3 18:06
     * @package wcyx\Library\\${CLASS_NAME}\getClassName
     * @return string
     *
     */
    public function getClassName() : string
    {
        return get_called_class();
    }

    /***
     *
     * @description 加载配置信息
     * @author  lyqiu
     * @date    2022/3/7 13:43
     * @package wcyx\Library\\${CLASS_NAME}\setConfig
     * @param mixed $config
     *
     */
    public function setConfig($config=[])
    {
        self::$config = $config;
    }

    /***
     *
     * @description 读取配置文件
     * @author  lyqiu
     * @date    2022/3/7 13:45
     * @package wcyx\Library\\${CLASS_NAME}\getConfig
     * @param string $field
     * @return array|mixed|string
     *
     */
    public function getConfig(string $field='')
    {
        return $field=='' ? self::$config : (self::$config[$field] ?? '');
    }


    /***
     *
     * @description 设置渠道
     * @author  lyqiu
     * @date    2022/3/7 19:19
     * @package wcyx\Library\\${CLASS_NAME}\setChannelName
     * @param $channel_name
     *
     */
    public function setChannelName($channel_name)
    {
        $this->channel_name = $channel_name;
    }

    /***
     *
     * @description 获取渠道
     * @author  lyqiu
     * @date    2022/3/7 19:19
     * @package wcyx\Library\\${CLASS_NAME}\getChannelName
     * @return null
     *
     */
    public function getChannelName(){
        return $this->channel_name;
    }


    /***
     *
     * @description 删除空元素
     * @author  lyqiu
     * @date    2022/3/10 18:37
     * @package wcyx\Library\\${CLASS_NAME}\dealEmptyParam
     * @param array $param
     * @return array
     *
     */
    public function dealEmptyElement(array $param=[]) : array
    {
        foreach ($param as $key=>$item) {
            if(empty($item)) {
                unset($param[$key]);
            }
        }
        return $param;
    }


}
