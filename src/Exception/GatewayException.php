<?php

/****
 *
 * 统一异常类
 *
 */

namespace wcyx\Exception;

class GatewayException extends \Exception
{
    const ERROR_NOT_CONFIG_PRIVATE_KEY = 5000;
    const ERROR_NOT_FOUND_PRIVATE_KEY = 5001;
    const ERROR_NOT_CONFIG_PUBLIC_KEY = 5100;
    const ERROR_NOT_FOUND_PUBLIC_KEY = 5101;
}
