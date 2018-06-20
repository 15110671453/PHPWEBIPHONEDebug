<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:00
 */

namespace EnterprisePattern;


class SessionRegistry extends Registry
{

    private  static  $instance;

    private $request;

    private $values = array();

    private function __construct(){

        /*
         * 使用PHP中内置session启动当大
         *
         * 要一直使用会话 必须确保在使用这个类之前没有发送任何文字给用户
         *
         * */

        session_start();

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

    protected function  set($key,$value){

        /*
     *
         *
         * 使用PHP中内置$_SESSION来设值和取回值
     *
     * 要一直使用会话 必须确保在使用这个类之前没有发送任何文字给用户
     *
     * */

        $_SESSION[__CLASS__][$key]=$value;
        $this->values[$key]=$value;
    }

    function  setComplex(Complex $complex){

        self::instance()->set('complex',$complex);

    }

    function getComplex(){

        return self::instance()->get('complex');

    }




}