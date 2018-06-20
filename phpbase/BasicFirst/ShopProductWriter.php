<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午1:17
 */

namespace BasicFirst;


use Product\ShopProduct;

class ShopProductWriter
{

    /*这里将属性 $products设置为private 阻止程序员直接操作数组 避免人员增加错误的对象到数组中
     强制开发人员 使用addProduct方法调用添加，因为这里有类型检查
    */
    //下哦啊没走啊外部代码无法访问数组 了  只能 通过对象方法 调用
    protected $products = array();

    public  function  addProduct(ShopProduct $shopProduct){

        $this->products[] = $shopProduct;

    }


    abstract public  function  write();


}