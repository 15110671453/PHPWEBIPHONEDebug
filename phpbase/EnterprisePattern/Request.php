<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午10:40
 */

namespace EnterprisePattern;


class Request
{

    private $properties;

    private $feedback = array();

    function __construct()
    {
        $this->init();

        RequestRegistry::instance($this);
    }

    function init(){

        if (isset($_SERVER['REQUEST_METHOD']))
        {

            $this->properties=$_REQUEST;
            return;
        }

        foreach ($_SERVER['argv'] as $arg){

            if (strpos($arg,'=')){


                list($key,$val)=explode("=",$arg);

                $this->setProperty($key,$val);
            }

        }

    }


    function getProperty($key){

        if (isset($this->properties[$key])){

            return $this->properties[$key];
        }

    }

    function  setProperty($key,$val){

        $this->properties[$key]=$val;

    }


    function addFeedBack(){

        array_push($this->feedback,$msg);



    }

    function getFeedBack(){


        return $this->feedback;

    }

    function  getFeedBackString($separator="\n")
    {
        return implode($separator,$this->feedback);

    }

}