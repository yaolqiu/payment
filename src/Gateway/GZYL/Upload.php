<?php
namespace wcyx\Gateway\GZYL;

use wcyx\Contract\GateWayInterface;
use wcyx\Library\HttpClient;
use wcyx\Library\StaticTrait;

/***
 *
 * @description 文件上传
 * @namespace wcyx\Gateway\GZYL\Upload
 * @author    lyqiu
 * @date      2022/3/28 15:30
 * @method __request
 *
 */

class Upload extends GZYLBaseGateway implements GateWayInterface
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
            'account'=> self::$config['account']             //M 商户号
        ];
        $data['sign'] = $this->genSign($data);
        $data['pic_file'] = fopen($param['pic_file'],'r');
        //pic_file 不参与签名

        return $this->uniResponse(HttpClient::post(GatewayUrl::UPLOAD,$data,'multipart'));
    }

}


