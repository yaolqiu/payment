<?php

namespace wcyx\Contract;

    /****
     *
     * @description 广州银联分账实现
     * @namespace wcyx\Contract\GZYLBankInterface
     * @author    lyqiu
     * @date      2022/3/11 14:09
     *
     */

    interface GZYLSplitInterface
    {
        //文件上传
        public function upload($pic_file);
        //个人进件
        public function registerByPerson(array $param);
        //企业进件
        public function registerByBusiness(array $param);
        //发送短信
        public function sendSms(array $param);

}
