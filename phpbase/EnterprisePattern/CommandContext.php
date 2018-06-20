<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:58
 */

namespace EnterprisePattern;


class CommandContext
{

    private $params = array();

    private $error= '';

    function __construct()
    {
        $this->params=$_REQUEST;
    }

    function addParam($key,$val){

        $this->params[$key]=$val;
    }

    function get($key){

        return $this->params[$key];
    }

    function setError($error){

        $this->error=$error;
    }

    function getError(){

        return $this->error;
    }

}