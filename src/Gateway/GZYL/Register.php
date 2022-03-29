<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Contract\GateWayInterface;
use wcyx\Library\HttpClient;
use wcyx\Library\StaticTrait;

/****
 *
 * @description 进件控制
 * @namespace wcyx\Gateway\GZYL\SplitRefund
 * @author    lyqiu
 * @date      2022/3/28 16:50
 * @method __registerByPerson
 *
 */

class Register extends GZYLBaseGateway
{
    use StaticTrait;

    /***
     *
     * @description 进件结果查询
     * @author  lyqiu
     * @date    2022/3/29 10:43
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\result
     * @param string $reside_account   入驻商户号
     * @param string $apply_no 进件申请单编号
     * @param string $apply_date    申请日期(yyyymmdd)
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function result(string $reside_account,string $apply_no,string $apply_date)
    {
        $data = [
            'syscode'           => self::$config['syscode'],    //系统码
            'account'           => self::$config['account'],    //商户号
            'reside_account'   => $reside_account,              //入驻商户号
            'apply_no'          => $apply_no,                   //进件申请单编号
            'apply_date'       => $apply_date,                  //申请单编号
        ];
        $data['sign'] = $this->genSign($data);
        return $this->uniResponse(HttpClient::post(GatewayUrl::ACCOUNT_QUERY,$data));
    }

    /***
     *
     * @description 个人进件(C类)
     * @author  lyqiu
     * @date    2022/3/29 9:39
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\registerByPerson
     * @param $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function registerByPerson($param)
    {
       $data = [
           //must
           'syscode'            => self::$config['syscode'],        //系统码
           'account'            => self::$config['account'],         //商户号
           'apply_no'           => $param['apply_no'],              //申请单编号
           'user_id'            => $param['user_id'],               //用户ID
           'customer_name'      => $param['customer_name'],         //真实姓名
           'short_name'         => $param['short_name'],            //真实姓名简称
           'corporate_name'     => $param['corporate_name'],        //银行户名(真实性名)
           'corporate_id_no'    => $param['corporate_id_no'],       //身份证号码
           'id_no_valid_type'   => $param['id_no_valid_type'],      //身份证有效期类型
           'id_no_eff_date'     => $param['id_no_eff_date'],        //身份证有效日期（开始时间）
           'id_no_exp_date'     => $param['id_no_exp_date'],        //身份证失效日期（结束时间）
           'card_no'            => $param['card_no'],               //结算银行卡号
           'card_name'          => $param['card_name'],             //结算银行卡名称（个人一般是真实姓名）
           'bank_no'            => $param['bank_no'],               //结算开户行别
           'bank_branch_name'   => $param['bank_branch_name'],      //结算银行支行名称
           'province_name'      => $param['province_name'],         //结算银行开户省
           'city_name'          => $param['city_name'],             //结算银行开户市
           'mobile'             => $param['mobile'],                //结算人手机号
           'remark'             => $param['remark'],                //备注
           'certificate_pic_id' => $param['certificate_pic_id'],    //分账证明材料

           //optional
           'charset'            => 'UTF8',                          //编码格式
           // 'com_province_name'  => $param['com_province_name'],     //商户所在省
           // 'com_city_name'      => $param['com_city_name'],         //商户所在市
           // 'address'            => $param['address'],               //商户联系地址
           // 'contact_name'       => $param['contact_name'],          //联系人姓名
           // 'contact_id_no'      => $param['contact_id_no'],         //联系人证件号
           // 'contact_tel'        => $param['contact_tel'],           //联系人手机号
           // 'contact_email'      => $param['contact_email'],         //联系人邮箱
           // 'bank_name'          => $param['bank_name'],             //结算银行名称
           // 'bank_code'          => $param['bank_code'],             //结算开户行别
           // 'bank_branch_no'     => $param['bank_branch_no'],        //结算银行支行号
           // 'id_no'              => $param['id_no'],                 //结算人身份证号
           // 'id_no_front_pic_id' => $param['id_no_front_pic_id'],    //法人身份证头像面
           // 'id_no_back_pic_id'  => $param['id_no_back_pic_id'],     //法人身份证国徽面
           // 'bank_card_back_pic_id'  => $param['bank_card_back_pic_id'], //法人结算卡正面照
           // 'bank_card_front_pic_id' => $param['bank_card_front_pic_id'],//法人结算卡反面照
           // 'door_pic_id'         => $param['door_pic_id'],           //门头照
           // 'store_pic_id'        => $param['store_pic_id'],          //室内场景照

       ];

        //过滤参数
        $data = $this->dealEmptyElement($data);
        $data['sign'] = $this->genSign($data);

        // 1:审核通过
        // 2:审核拒绝
        // 3:待审核
        // 4:待短信确认
        // 5:申请已接收
        // 6:申请失败
        return $this->uniResponse(HttpClient::post(GatewayUrl::REGISTER_PERSON,$data));
    }

    /****
     *
     * @description 企业进件(B类)
     * @author  lyqiu
     * @date    2022/3/29 9:40
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\registerByBusiness
     * @param $param
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function registerByBusiness($param)
    {
        $data = [
            //must
            'syscode'                   => self::$config['syscode'],            //系统码
            'account'                   => self::$config['account'],            //商户号
            'apply_no'                  => $param['apply_no'],                  //申请单编号
            'user_id'                   => $param['user_id'],                   //用户ID
            //企业信息
            'company_name'              => $param['company_name'],              //企业名称
            'short_name'                => $param['short_name'],                //企业简称简称
            'com_type'                  => $param['com_type '],                 //企业类型0:企业商户1:个体商户
            'nature'                    => $param['nature'],                    //企业性质：00:国营企业 01:民营企业 02:外资企业 03:其他组织 04:政府机构 05:个体工商户 06:事业单位
            'social_credit_code'        => $param['social_credit_code'],        //社会统一信用代码
            'license_valid_type'        => $param['license_valid_type'],        //营业执照有效期类型 1:定期 2：长期
            'license_effected_date'     => $param['license_effected_date'],     //营业执照申请时间  yyyy-MM-dd
            'license_expired_date'      => $param['license_expired_date'],      //营业执照失效日期  格式 yyyy-MM-dd 如果长期直接填：长期
            //法人信息
            'corporate_name'            => $param['corporate_name'],            //法人姓名
            'corporate_id_no'           => $param['corporate_id_no'],           //法人身份证号码
            'corporate_id_valid_type'   => $param['corporate_id_valid_type'],   //法人身份证有效期类型
            'corporate_id_eff_date'     => $param['corporate_id_eff_date'],     //法人身份证有效日期（开始时间）
            'corporate_id_exp_date'     => $param['corporate_id_exp_date'],     //法人身份证失效日期（结束时间）
            'id_no_front_pic_id'        => $param['id_no_front_pic_id'],        //法人身份证头像面
            'id_no_back_pic_id'         => $param['id_no_back_pic_id'],         //法人身份证国徽面
            //银行信息
            'settle_card_type'          => $param['settle_card_type'],          //银行账户类型1:对私 2：对公
            'card_no'                   => $param['card_no'],                   //结算银行卡号
            'card_name'                 => $param['card_name'],                 //结算银行卡名称
            'bank_name'                 => $param['bank_name'],                 //结算银行名称
            'bank_no'                   => $param['bank_no'],                   //结算开户行别
            'bank_code'                 => $param['bank_code'],                 //结算开户行别
            'bank_branch_name'          => $param['bank_branch_name'],          //结算银行支行名称
            'bank_branch_no'            => $param['bank_branch_no'],            //电子联行号(结算银行支行号)
            'province_name'             => $param['province_name'],             //结算银行开户省
            'city_name'                 => $param['city_name'],                 //结算银行开户市
            'mobile'                    => $param['mobile'],                    //结算人手机号
            'remark'                    => $param['remark'],                    //0:贷款 1:平台抽佣 2:收益分配 3:结算款  4:劳动报酬 5:售后服务款 9:其他
            'permit_pic'                => $param['permit_pic'],                //企业商户需要 图片名称，调用图片上传接口获取
            'certificate_pic_id'        => $param['certificate_pic_id'],        //分账证明材料
            'door_pic_id'               => $param['door_pic_id'],               //门头照

            //optional
            'charset'            => 'UTF8',                             //编码格式
            // 'com_province_name'  => $param['com_province_name'],     //商户所在省
            // 'com_city_name'      => $param['com_city_name'],         //商户所在市
            // 'address'            => $param['address'],               //商户联系地址
            // 'contact_name'       => $param['contact_name'],          //联系人姓名
            // 'contact_id_no'      => $param['contact_id_no'],         //联系人证件号
            // 'contact_tel'        => $param['contact_tel'],           //联系人手机号
            // 'contact_email'      => $param['contact_email'],         //联系人邮箱
            // 'bank_name'          => $param['bank_name'],             //结算银行名称
            // 'id_no'              => $param['id_no'],                 //结算人身份证号
            // 'bank_card_back_pic_id'  => $param['bank_card_back_pic_id'], //法人结算卡正面照
            // 'bank_card_front_pic_id' => $param['bank_card_front_pic_id'],//法人结算卡反面照
            // 'store_pic_id'       => $param['store_pic_id'],          //室内场景照

        ];

        //过滤参数
        $data = $this->dealEmptyElement($data);
        $data['sign'] = $this->genSign($data);

        // 1:审核通过
        // 2:审核拒绝
        // 3:待审核
        // 4:待短信确认
        // 5:申请已接收
        // 6:申请失败
        return $this->uniResponse(HttpClient::post(GatewayUrl::REGISTER_BUSINESS,$data));
    }


    /****
     *
     * @description
     * @param string $reside_account 入驻商户号
     * @param string $apply_no       申请单编号
     * @param int $sms_type          短信类型 0：进件短信 1：账户变更申请，则默认表示为进件短信
     *
     * @throws \wcyx\Exception\GatewayException
     * @author  lyqiu
     * @date    2022/3/29 9:53
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\sendSms
     */
    public function sendSms(string $reside_account,string $apply_no,int $sms_type=0)
    {
        $data = [
            'syscode'       => self::$config['syscode'],    //系统码
            'account'       => self::$config['account'],    //商户号
            'reside_account'=> $reside_account,             //入驻商户号
            'apply_no'      => $apply_no,                   //申请单编号
            'sms_type'      => $sms_type,                   //短信类型
        ];
        $data['sign'] = $this->genSign($data);
        return $this->uniResponse(HttpClient::post(GatewayUrl::SMS_SEND,$data));
    }

    /***
     *
     * @description
     * @author  lyqiu
     * @date    2022/3/29 9:59
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\smsConfirm
     * @param string $reside_account
     * @param string $apply_no
     * @param string $verify_code
     * @param int $sms_type
     * @param string $expire_time
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function smsConfirm(string $reside_account,string $apply_no,string $verify_code,int $sms_type=0,$expire_time='')
    {
        $data = [
            'syscode'       => self::$config['syscode'],    //系统码
            'account'       => self::$config['account'],    //商户号
            'reside_account'=> $reside_account,             //入驻商户号
            'apply_no'      => $apply_no,                   //申请单编号
            'verify_code'   => $verify_code,                //短信验证码
            'sms_type'      => $sms_type,                   //短信类型
        ];
        $data['sign'] = $this->genSign($data);
        return $this->uniResponse(HttpClient::post(GatewayUrl::SMS_CONFIRM,$data));
    }


    /***
     *
     * @description 基于现有的时件结算帐号更新信息
     * @author  lyqiu
     * @date    2022/3/29 10:52
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\settleUpdate
     * @param   array $param
     * @return  array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function settleUpdate(array $param)
    {
        $data = [
            //must
            'syscode'                   => self::$config['syscode'],            //系统码
            'account'                   => self::$config['account'],            //商户号
            'apply_no'                  => $param['apply_no'],                  //申请单编号
            'reside_account'            => $param['reside_account'],            //入驻商户号
            //银行信息
            'settle_card_type'          => $param['settle_card_type'],          //银行账户类型1:对私 2：对公
            'card_no'                   => $param['card_no'],                   //结算银行卡号
            'card_name'                 => $param['card_name'],                 //结算银行卡名称
            'bank_name'                 => $param['bank_name'],                 //结算银行名称
            'bank_no'                   => $param['bank_no'],                   //结算开户行别
            'bank_code'                 => $param['bank_code'],                 //结算开户行别
            'bank_branch_no'            => $param['bank_branch_no'],            //电子联行号(结算银行支行号)
            'bank_branch_name'          => $param['bank_branch_name'],          //结算银行支行名称
            'province_name'             => $param['province_name'],             //结算银行开户省
            'city_name'                 => $param['city_name'],                 //结算银行开户市
            'mobile'                    => $param['mobile'],                    //结算人手机号
            'permit_pic'                => $param['permit_pic'],                //企业商户需要 图片名称，调用图片上传接口获取
            //optional
            'charset'                   => 'UTF8',                             //编码格式
        ];

        //过滤参数
        $data = $this->dealEmptyElement($data);
        $data['sign'] = $this->genSign($data);

        // 1:审核通过
        // 2:审核拒绝
        // 3:待审核
        // 4:待短信确认
        // 5:申请已接收
        // 6:申请失败
        return $this->uniResponse(HttpClient::post(GatewayUrl::REGISTER_SETTLE_UPDATE,$data));
    }

    /***
     *
     * @description 结算账号更新结果查询
     * @author  lyqiu
     * @date    2022/3/29 10:43
     * @package wcyx\Gateway\GZYL\\${CLASS_NAME}\settleResult
     * @param string $reside_account   入驻商户号
     * @param string $apply_no          变更申请单编号
     * @param string $apply_date        变理申请日期(yyyymmdd)
     * @return array|mixed
     * @throws \wcyx\Exception\GatewayException
     *
     */
    public function settleResult(string $reside_account,string $apply_no,string $apply_date)
    {
        $data = [
            'syscode'           => self::$config['syscode'],    //系统码
            'account'           => self::$config['account'],    //商户号
            'reside_account'   => $reside_account,              //入驻商户号
            'apply_no'          => $apply_no,                   //变更申请单编号
            'apply_date'       => $apply_date,                  //变更申请单编号
        ];
        $data['sign'] = $this->genSign($data);
        return $this->uniResponse(HttpClient::post(GatewayUrl::REGISTER_SETTLE_RESULT,$data));
    }

}


