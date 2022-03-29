<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Contract\GateWayInterface;
use wcyx\Library\HttpClient;
use wcyx\Library\StaticTrait;

/***
 *
 * @description 多次分账退款
 * @namespace wcyx\Gateway\GZYL\SplitRefund
 * @author    lyqiu
 * @date      2022/3/28 14:38
 *
 */

class Refund extends GZYLBaseGateway implements GateWayInterface
{
    use StaticTrait;

    /***
     * @description
     * @param array $param
     * @return mixed
     *
     * @throws \wcyx\Exception\GatewayException
     * @package wcyx\Contract\\${CLASS_NAME}\request
     * @author  lyqiu
     * @date    2022/3/28 14:38
     */
    public function request(array $param)
    {
        //完成的参数
        $data = [
            'syscode'=> self::$config['syscode'],             //M 系统码
            'account'=> self::$config['account'],             //M 商户号
            'charset'=> 'UTF8',             //C 编码格式UTF8 表示UTF8编码   默认GBK
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],            //M 商户退款订单号
            'trans_id'=> $param['trans_id'],        //原交易流水号
            'amount'=> $param['amount'],            //退款金额 单位：分
            'refund_mode'=> $param['refund_mode'],  //差错模式  02：商户打款 03 ：轧退款账户 10：轧资
            'memo '=> $param['memo'] ?? '',              //退款备注
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_REFUND,$data));

    }


    /****
     *
     * @description 退款进度查询
     * @author  lyqiu
     * @date    2022/3/29 14:30
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\result
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function result(array $param)
    {
        //完成的参数
        $data = [
            'syscode'=> self::$config['syscode'],             //M 系统码
            'account'=> self::$config['account'],             //M 商户号
            'charset'=> 'UTF8',             //C 编码格式UTF8 表示UTF8编码   默认GBK
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],            //M 商户退款订单号
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_REFUND_RESULT,$data));
    }


}


