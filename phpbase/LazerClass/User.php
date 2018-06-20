<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午5:28
 */

namespace LazerClass;


class User extends DomainObjet
{

    static  function  getGroup()
    {
        /*这里父类 已经实现了该静态方法 但Document将它 覆写了 第一见覆写静态方法的*/
        /*静态 属性  方法 也是可以改变 只要不是const 常量*/


        return "document";


    }

}