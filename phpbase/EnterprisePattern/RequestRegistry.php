<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午10:55
 */

namespace EnterprisePattern;


class RequestRegistry extends Registry
{
    private  static  $instance;

    private $request;

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

    static function  getRequest(){

        return self::instance()->get('request');

    }

    static function setRequest(Request $request){

        return self::instance()->set('request',$request);

    }

}