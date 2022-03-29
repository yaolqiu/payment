<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Library\HttpClient;
use wcyx\Library\StaticTrait;

/***
 *
 * @description 分账
 * @namespace wcyx\Gateway\GZYL\SplitRefund
 * @author    lyqiu
 * @date      2022/3/28 14:38
 *
 */

class Split extends GZYLBaseGateway
{
    use StaticTrait;

    /***
     *
     * @description 单次分账
     * @author  lyqiu
     * @date    2022/3/29 13:57
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\single
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function single(array $param)
    {
        //完成的参数
        if(is_array($param['split_list'])) {
            $split_list =  json_encode($param['split_list'],JSON_UNESCAPED_UNICODE) ;
        }
        $data = [
            'syscode'   => self::$config['syscode'],            //M 系统码
            'account'   => self::$config['account'],            //M 商户号
            'charset'   => 'UTF8',                              //C 编码格式UTF8 表示UTF8编码   默认GBK
            'amount'    => $param['amount'],                    //金额单位：分, 与原交易金额一致
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],                        //M 商户退款订单号
            'ori_app_id'=> $param['ori_app_id'],                //与原交易商户订单号一致
            'split_mode'=> $param['split_mode'],                //分账模式：1：金额 2：比例分账金额时，单位分；分账比例时，仅支持整数比例
            'split_list'=> $split_list,                         //分账接收方列表
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_SINGLE,$data));

    }

    /***
     *
     * @description 多次分账
     * @author  lyqiu
     * @date    2022/3/29 13:57
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\multi
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function multi(array $param)
    {
        //完成的参数
        if(is_array($param['split_list'])) {
            $split_list =  json_encode($param['split_list'],JSON_UNESCAPED_UNICODE) ;
        }
        $data = [
            'syscode'   => self::$config['syscode'],            //M 系统码
            'account'   => self::$config['account'],            //M 商户号
            'charset'   => 'UTF8',                              //C 编码格式UTF8 表示UTF8编码   默认GBK
            'amount'    => $param['amount'],                    //金额单位：分, 与原交易金额一致
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],                        //M 商户退款订单号
            'ori_app_id'=> $param['ori_app_id'],                //与原交易商户订单号一致
            'split_mode'=> $param['split_mode'],                //分账模式：1：金额 2：比例分账金额时，单位分；分账比例时，仅支持整数比例
            'split_list'=> $split_list,                         //分账接收方列表
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_MULTI,$data));

    }

    /***
     *
     * @description 分账结果
     * @author  lyqiu
     * @date    2022/3/29 14:35
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\result
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function result(array $param)
    {
        //完整参数
        $data = [
            'syscode'   => self::$config['syscode'],            //M 系统码
            'account'   => self::$config['account'],            //M 商户号
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],                        //M 商户退款订单号
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_RESULT,$data));
    }

    /***
     *
     * @description 完结订单
     * @author  lyqiu
     * @date    2022/3/29 14:27
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\close
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function close(array $param)
    {
        //完整参数
        $data = [
            'syscode'   => self::$config['syscode'],            //M 系统码
            'account'   => self::$config['account'],            //M 商户号
            'charset'   => 'UTF8',                              //C 编码格式UTF8 表示UTF8编码   默认GBK
            'amount'    => $param['amount'],                    //金额单位：分, 与原交易金额一致
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],                        //M 商户退款订单号
            'ori_app_id'=> $param['ori_app_id'],                //与原交易商户订单号一致
            'remark'=> $param['remark'],                        //完结分账备注
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_CLOSE,$data));
    }

    /***
     *
     * @description 订单明细
     * @author  lyqiu
     * @date    2022/3/29 14:36
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\orderSettleInfo
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function orderSettleInfo(array $param)
    {
        //完整参数
        $data = [
            'syscode'   => self::$config['syscode'],            //M 系统码
            'account'   => self::$config['account'],            //M 商户号
            'amount'    => $param['amount'],                    //金额单位：分, 与原交易金额一致
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'=> $param['app_id'],                        //M 商户订单号
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::ORDER_SETTLE_RESULT,$data));
    }

    /***
     *
     * @description 划分结果(银行卡汇款进度)
     * @author  lyqiu
     * @date    2022/3/29 14:38
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\transferResult
     * @param array $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function transferResult(array $param)
    {
        //完整参数
        $data = [
            'syscode'   => self::$config['syscode'],            //M 系统码
            'account'   => self::$config['account'],            //M 商户号
            'amount'    => $param['amount'],                    //金额单位：分, 与原交易金额一致
            'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
            'app_id'    => $param['app_id'],                        //M 商户分账订单号
        ];

        $data['sign'] = $this->genSign($data);

        return $this->uniResponse(HttpClient::post(GatewayUrl::SPLIT_TRANSFER_RESULT,$data));
    }



}
