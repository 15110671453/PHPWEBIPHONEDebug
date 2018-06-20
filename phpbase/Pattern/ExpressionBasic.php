<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 上午11:54
 */

namespace Pattern;


/*这里 类中 有一个抽象的方法 要求子类必须实现 则该类必须也是adstract 因此 要加关键字abstract*/
/*这里 是一个 抽象类  抽象类 不可以被直接实例化 抽象类只定义或部分实现子类需要的方法

子类可以继承它 并且可以通过实现其中的抽象方法 使抽象类具体化；
大部分情况下 抽象类至少包含一个抽象方法 抽象方法用abstract 关键字声明，其中不能有具体内容
你可以 像声明普通类方法那样声明抽象方法 但要以分号而不是方法体结束
*/
abstract class ExpressionBasic
{

    private static $keycount = 0;
    private $key ;
    //大部分情况下 抽象类至少包含一个抽象方法 抽象方法用abstract 关键字声明，其中不能有具体内容
    abstract function interpret (InterpreterContext $context);

    function getKey(){

        if(!asset($this->key)){
            self::$keycount++;
            $this->key=self::$keycount;
        }
        return $this->key;
    }
}