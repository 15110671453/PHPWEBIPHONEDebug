<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午1:11
 */

namespace BasicFirst;


use Product\ShopProduct;

/*PHP类的继承

子类重写（覆写） 父类的方法

public private protected 管理类的访问
*/

class CDProduct extends ShopProduct
{

    /*对类属性进行访问限制*/
    private $playLength;

    function __construct($title, $firstName, $mainName, $price ,$playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);

        $this->playLength = $playLength;
    }


    function getPlayLength(){

        return $this->playLength;

    }

    function  getSummaryLine()
    {
        /*对类属性进行访问限制 由于父类 对属性也进行访问限制 设置为了private 因此这里在子类方法中无法直接访问 只能
        通过 父类的开放的方法进行调用
        */



        $base = parent::getSummaryLine();

//        $base = "{$this->title} ( {$this->producerMainName},";
//
//        $base .= "{$this->producerFirstName}";

        $base .= ":play time - {$this->playLength}";

        return $base;
    }

}