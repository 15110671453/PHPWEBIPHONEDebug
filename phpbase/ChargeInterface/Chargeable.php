<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午4:59
 */

namespace ChargeInterface;



/*

抽象类提供了 具体实现的标准

但是 接口interface 则是纯粹的模版 接口只是定义功能

而不包含实现的内容 接口可用关键字interface来声明

接口可以包含属性和方法的声明 但是方法体为空

接口和类很相似 任何实现接口的类必须实现接口中所定义的所有方法

否则必须声明为abstract
*/

interface Chargeable
{
    public function getPrice();

}