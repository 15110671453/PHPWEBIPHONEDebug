<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/23
 * Time: 上午11:21
 */

namespace PHPLangReflection;


class PersonReflect
{

    public $name;


    function __construct($name)
    {
        $this->name = $name;
    }

}