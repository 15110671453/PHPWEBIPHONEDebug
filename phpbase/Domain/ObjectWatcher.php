<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午2:27
 */

namespace Domain;

/*用于标识 已经映射过了 减少 不必要的重复开销 */
class ObjectWatcher
{


    private $all = array();

    private static  $instance;

    private function __construct(){}

    static function instance(){

        if (!self::$instance){

            self::$instance=new ObjectWatcher();

        }
        return self::$instance;

    }

    function globalKey(DomainObject $obj){

        $key = get_class($obj).".".$obj->getId();

        return $key;
    }

    static function add(DomainObject $obj){
        $inst = self::instance();
        $inst->all[$inst->globalKey($obj)] = $obj;
    }

    static function exsits($classname,$id){

        $inst = self::instance();
        $key = "$classname.$id";
        if (isset($inst->all[$key])){

            return $inst->all[$key];
        }

        return null;
    }

}