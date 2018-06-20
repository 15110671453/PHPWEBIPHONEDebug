<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/22
 * Time: 上午10:50
 */

namespace Conf;


class FileException extends \Exception
{
    function __construct($message, $code, \Exception $previous)
    {
        parent::__construct($message, $code, $previous);
    }

}