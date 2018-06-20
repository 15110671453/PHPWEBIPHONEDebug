<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午12:59
 */

namespace BasicFirst;


class BasicClassWriter
{
        /*这里没有直接增加write方法到 BasicClass对象 是想划分责任区 Basic指管理产品数据 Writer 负责写入数据*/
        /*这里我们希望接受一个BasicClass对象 为了避免接收到非预期的对象或数据类型 PHP5引入类型的typehint 增加方法参数的类型提示*/
    public  function write(BasicClass $shopProduct)
    {

        $str ="{$shopProduct->title}".$shopProduct->getProducer()."({$shopProduct->price})\n";

        print $str;

    }

}