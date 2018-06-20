<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/22
 * Time: 上午11:01
 */

namespace FinalClass;


class CheckFunction
{
    final function  totalSize()
    {
        echo "我不可以被子类重写";
    }
}