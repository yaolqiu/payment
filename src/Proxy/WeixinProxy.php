<?php
namespace wcyx\Proxy;
use wcyx\Contract\PayInterface;
use wcyx\Exception\GatewayException;
use wcyx\Library\GateWay;

class WeixinProxy extends GateWay implements PayInterface
{


    /***
     * @description
     * @param string $channel_name
     * @param array $param
     * @return mixed
     *
     * @package wcyx\Contract\\${CLASS_NAME}\pay
     * @author  lyqiu
     * @date    2022/3/30 10:55
     */
    public function pay(string $channel_name, array $param)
    {
        $channel_gateway_class = $this->getChannelGateway($channel_name);
        if(!class_exists($channel_gateway_class)) {
            throw new GatewayException(sprintf('Gateway[%s] not found ',$channel_gateway_class));
        }
        $obj = new $channel_gateway_class();

        $obj->setChannelName($channel_name);

        return call_user_func([$obj,'request'],$param);
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/30 10:55
     * @package wcyx\Contract\\${CLASS_NAME}\refund
     * @param array $param
     * @return mixed
     *
     */
    public function refund(array $param)
    {
        // TODO: Implement refund() method.
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/30 10:55
     * @package wcyx\Contract\\${CLASS_NAME}\notify
     * @return mixed
     *
     */
    public function notify()
    {
        // TODO: Implement notify() method.
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/30 10:55
     * @package wcyx\Contract\\${CLASS_NAME}\cancel
     * @return mixed
     *
     */
    public function cancel()
    {
        // TODO: Implement cancel() method.
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/30 10:55
     * @package wcyx\Contract\\${CLASS_NAME}\close
     * @return mixed
     *
     */
    public function close()
    {
        // TODO: Implement close() method.
    }


    /***
     *
     * @description 获取基本控制器
     * @author  lyqiu
     * @date    2022/3/28 11:55
     * @package wcyx\Proxy\\${CLASS_NAME}\getChannelGateway
     * @param $channel_name
     * @return string
     *
     */
    public function getChannelGateway($channel_name): string
    {
        return 'wcyx\Gateway\Weixin\\' . 'Pay' .str_replace('_','',ucwords(strtolower($channel_name),'_')) . 'Gateway';
    }


}
