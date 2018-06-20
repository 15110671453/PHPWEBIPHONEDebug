<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午10:36
 */

namespace EnterprisePattern;


class Registry
{
    private  static  $instance;



    private $values = array();

    private function __construct(){

    }

    static function instance(){

        if (!isset(self::$instance))
        {

            self::$instance = new self();

        }

        return self::$instance;
    }



    function get($key){

        if (isset($this->values[$key]))
        {
            return $this->values[$key];
        }

        return null;

    }

    function  set($key,$value){
        $this->values[$key]=$value;
    }

    function getAccessManager()
    {

    }
}