<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 上午11:55
 */

namespace Pattern;


class LiteralExpression extends  ExpressionBasic
{
    private $value;

    function __construct($value){

        $this->value = $value;

    }

    function interpret(InterpreterContext $context) {

        $context->replace($this,$this->value);
    }

}