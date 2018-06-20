<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午5:22
 */

namespace LazerClass;


class Document extends DomainObjet
{

    public static function create(){
        /*静态方法 创建工厂方法  实例化对象  一般这么做 但是 使用static 在父类就实现该方法

        子类不用实现 该怎么做？？


        也就是说 我们不想为每一个子类都创建这段代码 ，我们把create放在超类会怎么样呢？？？

        new self(); 不行  正确做法 new static();

        因为 new self 时 ，Document::create();调用时 self还是被解析绑定为DomainObject
        而不是解析为Document

        因此 PHP 通过 new static 会在对应类调用时 将作用域绑定为 对应的调用类

        这就是 延迟静态绑定 ；

        有点类似js中经常遇到this 作用域不一致 不是被调用者 都通过bind 解决 ；
        */
        return new Document();
    }
}