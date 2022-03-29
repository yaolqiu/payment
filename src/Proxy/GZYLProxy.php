<?php
namespace wcyx\Proxy;

use wcyx\Contract\GZYLSplitInterface;
use wcyx\Contract\PayInterface;
use wcyx\Exception\GatewayException;
use wcyx\Gateway\GZYL\Refund;
use wcyx\Gateway\GZYL\Register;
use wcyx\Gateway\GZYL\SplitRefund;
use wcyx\Gateway\GZYL\Upload;
use wcyx\Library\GateWay;

class GZYLProxy extends GateWay implements PayInterface,GZYLSplitInterface
{

    public function pay(string $channel_name, array $param)
    {

        //$channel_gateway_class = $this->getChannelGateway($channel_name);
        $channel_gateway_class = $this->getCommonGateway();
        if(!class_exists($channel_gateway_class)) {
            throw new GatewayException(sprintf('Gateway[%s] not found ',$channel_gateway_class));
        }
        $obj = new $channel_gateway_class();

        $obj->setChannelName($channel_name);

        return call_user_func([$obj,'request'],$param);
        // TODO: Implement pay() method.
    }

    /***
     * @description
     * @param array $param
     * @return mixed
     *
     * @throws GatewayException
     * @package wcyx\Contract\\${CLASS_NAME}\refund
     * @author  lyqiu
     * @date    2022/3/3 17:56
     */
    public function refund(array $param)
    {
        // TODO: Implement refund() method.
        $refund = new Refund();
        return $refund->request($param);
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/3 17:56
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
     * @date    2022/3/3 17:56
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
     * @date    2022/3/3 17:56
     * @package wcyx\Contract\\${CLASS_NAME}\close
     * @return mixed
     *
     */
    public function close()
    {
    // TODO: Implement close() method.
    }


    /***
     * @description
     * @param $pic_file
     * @return mixed
     *
     * @throws GatewayException
     * @package wcyx\Contract\\${CLASS_NAME}\upload
     * @author  lyqiu
     * @date    2022/3/28 11:55
     */
    public function upload($pic_file):  array
    {
        return Upload::__request(['pic_file'=>$pic_file]);
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/28 11:55
     * @package wcyx\Contract\\${CLASS_NAME}\registerByPerson
     * @param array $param
     * @return mixed
     *
     */
    public function registerByPerson(array $param)
    {
        // TODO: Implement registerByPerson() method.
        // $object = new Register();
        // return $object->registerByPerson($param);
        return Register::__registerByPerson($param);
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/28 11:55
     * @package wcyx\Contract\\${CLASS_NAME}\registerByBusiness
     * @param array $param
     * @return mixed
     *
     */
    public function registerByBusiness(array $param)
    {
        // TODO: Implement registerByBusiness() method.
        $object = new Register();
        return $object->registerByPerson($param);
    }

    /***
     * @description
     * @author  lyqiu
     * @date    2022/3/28 11:55
     * @package wcyx\Contract\\${CLASS_NAME}\sendSms
     * @param array $param
     * @return mixed
     *
     */
    public function sendSms(array $param)
    {
        // TODO: Implement sendSms() method.
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
        return 'wcyx\Gateway\GZYL\\' . 'Pay' .str_replace('_','',ucwords(strtolower($channel_name),'_')) . 'Gateway';
    }

    /***
     *
     * @description 返回统一支付处理类
     * @author  lyqiu
     * @date    2022/3/29 17:07
     * @package wcyx\Proxy\\${CLASS_NAME}\getCommonGateway
     * @return string
     *
     */
    public function getCommonGateway(): string
    {
        return 'wcyx\Gateway\GZYL\\PayGateway';
    }

}
