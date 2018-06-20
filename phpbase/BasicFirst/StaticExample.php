<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午1:37
 */

namespace BasicFirst;


class StaticExample
{

    /*这里为类添加静态方法 静态属性

    静态方法 不能访问这个类中的普通属性（也就是对象成员属性 因为哪些属性是属于对象的）

    但是静态方法 可以访问静态属性

    因为是通过类而不是实例来访问静态元素的 所以访问静态元素时 不需要引用对象的变量
    而是使用::双冒号来连接类名和属性或类名和方法
    */
    static public $aNum =0;
    static  public  function sayHello() {

        print "hello";

        self::$aNum++;

        print "Hello (".self::$aNum.") \n";

    }
}