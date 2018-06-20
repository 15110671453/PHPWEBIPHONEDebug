<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/22
 * Time: 上午10:44
 */

namespace Conf;


class XMLException extends \Exception
{

    private $error;

    function __construct(\LibXMLError $error)
    {
        $shortfile = basename($error->file);

        $msg = "[{$shortfile},line {$error->line},col {$error->column}] {$error->message}";

        $this->error = $error;


        parent::__construct($msg, $error->code);
    }



    function  getLibXmlError(){


        return $this->error;



    }
}