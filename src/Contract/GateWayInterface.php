<?php
namespace wcyx\Contract;

interface GateWayInterface
{


    /***
     *
     * @description 统一向第三方发起的请求方法
     * @author  lyqiu
     * @date    2022/3/3 17:41
     * @package wcyx\Contract\\${CLASS_NAME}\request
     * @param array $param
     * @return mixed
     * @example
     *       系统码	syscode	8	Y	上线时分配 测试用20000023
     *       商户号	account	10	Y	商户号，系统对接时提供，唯一。
     *       编码格式	charset	8	C	UTF8 表示UTF8编码   默认GBK
     *       交易时间	trans_time	14	Y	交易时间 YYYYMMDDHHMMSS
     *       交易金额	amount	10	Y	交易金额,单位分
     *       支付方式	pay_mode	30	Y	参数支付方式说明
     *       结算周期	aging	1	Y	结算周期：1：T+1
     *       商户订单号	app_id	32	Y	商户系统内部订单号，要求32个字符内，只能是数字、大小写字母_-|*且在同一个商户号下唯一
     *       成功通知回调地址	callback_url	128	C	前端页面跳转地址，支付完成后将回跳该地址，不能携带参数
     *       异步通知回调地址	notify_url	128	Y	接收统一支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数
     *       终端IP	terminal_ip	32	C	H5-微信支付时必填，客户端访问IP
     *       终端设备	terminal_device	2	C	1:PC浏览器  2:WEB浏览器  3:微信公众号
     *       4:微信小程序 5:手机APP  6:其它
     *       银行编码	bank_id	12	C	参考银行编码表
     *       应用APPID	auth_app_id	32	C	微信或支付宝应用APPID
     *       （公众号和小程序支付必传应用APPID）
     *       微信用户标识	openid	32	C	微信公众号支付和微信小程序支付必传微信用户openid
     *       是否原生支付	is_raw	1	C	是否微信原生H5支付 1：是; 2：否 不传默认是1
     *       （如果传值为2，则使用H5打开URL Schema拉起微信小程序支付，调用方式详见第10章说明）
     *       支付宝用户标识	buyer_id	32	C	支付宝生活号和支付宝小程序支付必传支付宝用户buyer_id
     *       支付授权码	auth_code	32	C	微信付款码或支付宝付款码支付时，必传支付授权码
     *       商品描述	subject	256	C	微信支付和支付宝支付必填商品描述
     *       例如：Iphone6 16G
     *       商品详情	body	128	C	例如：Iphone6 16G
     *       是否限制信用卡	limit_credit_pay	10	C	是否限制信用卡。值为 1 表示禁用信用卡，0 或为空表示不限制
     *       花呗分期数	hb_fq_num
     *       10	C	代表花呗分期数，仅支持传入 3、6、12，仅支持支付宝支付
     *       订单支付有效期时间	expire_date	14	C	订单支付有效期时间，格式YYYYMMDDHHMMSS 无特殊要求时，设置为30分钟之内有效
     *       该笔订单允许的最晚付款时间	time_expire	30	C	该笔订单允许的最晚付款时间，逾期将关闭交易。取值范围：1m～15d。m-分钟，h-小时，d-天，1c-当天（1c-当天的情况下，无论交易何时创建，都在0点关闭）。 该参数数值不接受小数点， 如 1.5h，可转换为 90m。
     *       支付宝支付需要，其它支付方式可选
     *       备注说明	memo	40	C	订单备注说明
     *       交易签名	sign	32	Y	Sha256WithRSA签名
     *
     */
    public function request(array $param);

    // 完整的参数
    // public function paramDoc() {
    //     $data = [
    //         'syscode'=> '', //M 系统码
    //         'account'=> '', //M 商户号
    //         'charset'=> 'UTF8', //C 编码格式UTF8 表示UTF8编码   默认GBK
    //         'trans_time'=> date('YmdHis',$_SERVER['REQUEST_TIME']), //M 交易时间
    //         'amount'=> '',  //M 交易金额 交易金额,单位分
    //         'pay_mode'=> $this->getChannelName(),   //M 参数支付方式说明
    //         'aging'=> '1',  //M 结算周期：1：T+1
    //         'app_id'=> '',  //M 商户订单号
    //         'callback_url'=> '',  //C 前端页面跳转地址，支付完成后将回跳该地址，不能携带参数
    //         'notify_url'=> '',  //M 异步通知回调地址 接收统一支付异步通知回调地址，通知url必须为直接可访问的url，不能携带参数
    //         'terminal_ip'=> '', //C 终端IP H5-微信支付时必填，客户端访问IP
    //         'terminal_device'=>'4', //C	终端设备 1:PC浏览器  2:WEB浏览器  3:微信公众号 4:微信小程序 5:手机APP  6:其它
    //         'bank_id'=> '',//C 银行编码
    //         'auth_app_id'=> '',  //M 应用APPID 微信或支付宝应用APPID （公众号和小程序支付必传应用APPID）
    //         'openid'=> 'openid',    //C 微信用户标识
    //         'is_raw'=> '',  //C 是否原生支付
    //         'buyer_id'=> 'buyer_id', //C 支付宝用户标识
    //         'auth_code'=> '',   //C 支付授权码
    //         'subject'=> 'subject',  //C 商品描述
    //         'body'=> 'body',    //C 商品详情
    //         'limit_credit_pay'=> '',    //C 是否限制信用卡
    //         'hb_fq_num'=> 'hb_fq_num',  //C 花呗分期数
    //         'expire_date'=> 'expire_date',//C 订单支付有效期时间
    //         'time_expire'=> 'time_expire',//C 该笔订单允许的最晚付款时间
    //         'memo'=> 'memo' //C 备注说明
    //     ];
    // }

}
