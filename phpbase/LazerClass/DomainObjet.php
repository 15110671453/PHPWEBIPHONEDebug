<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午5:18
 */

namespace LazerClass;


abstract class DomainObjet
{

    private $group;

    public function __construct()
    {
        $this->group = static::getGroup();
    }

    /*延迟静态绑定 静态方法 可以用作工厂方法*/
    public  static  function create(){

        return new static();

    }

    static function getGroup(){

        return 'default';

    }



}