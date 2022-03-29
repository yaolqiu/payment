<?php
namespace wcyx\Contract {

    /***
     *
     * @namespace wcyx\PayInterface
     * @description 支付统一对外接口
     * @author    lyqiu
     * @date      2022/3/3 17:20
     *
     */

    interface PayInterface
    {
        /**
         * @description 发起交易
         * @author lyqiu
         * @date   2022/3/3 15:59
         * @url    ${APP}/${CLASS}/pay
         * @param string $channel_name 支付渠道
         * @param array $param 支付参数
         * @return mixed
         */
        public function pay(string $channel_name,array $param);

        /***
         *
         * @description 发起退款
         * @author  lyqiu
         * @date    2022/3/3
         * @package wcyx\PayInterface\refund
         * @param array $param
         * @return mixed
         */
        public function refund(array $param);

        /***
         * @description 异步通知
         * @author  lyqiu
         * @date    2022/3/3
         * @package wcyx\\${CLASS_NAME}\notify
         * @return mixed
         */
        public function notify();

        /***
         * @description 取消交易
         * @author  lyqiu
         * @date    2022/3/3
         * @package wcyx\\${CLASS_NAME}\cancel
         * @return mixed
         */
        public function cancel();

        /***
         *
         * @description 关闭交易
         * @author  lyqiu
         * @date    2022/3/3 17:18
         * @package wcyx\PayInterface\close
         * @return mixed
         */
        public function close();

    }
}
