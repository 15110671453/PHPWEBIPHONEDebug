<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/23
 * Time: 上午9:40
 */

namespace BlockPHP;


class FunctionNOName
{

    private $callbacks;

    /*
     * 该函数 接受回调函数 可以是匿名函数
     *
     * 并测试该标量指向的函数能否调用
     *
     * 然后添加到回调数组
     *
     * is_callable() 检测 可以确保 传进来的回调函数 可以被 call_user_func()或array_walk()等函数调用执行
     *
     * 对比PersonBasic类中的魔法函数 __call的做法
     *
     *
     * */
   public function  registerCallBack($callback){

        //系统函数
        if (!is_callable($callback)){
            throw  new \Exception("callbacl not callable");
        }

        $this->callbacks[]=$callback;
    }


    public function sale($product){

        print "<br/>";
        print "{$product->name}:processing \n";

        foreach ($this->callbacks as $callback){
            //系统函数
            call_user_func($callback,$product);


        }
    }


}