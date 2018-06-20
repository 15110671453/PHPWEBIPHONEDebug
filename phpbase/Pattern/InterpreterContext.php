<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 上午11:56
 */

namespace Pattern;


class InterpreterContext
{
    private $expressionstore = array();

    function replace(ExpressionBasic $exp,$value) {

        $this->expressionstore[$exp->getKey()]=$value;

    }

    function lookup(ExpressionBasic $exp){

        return $this->expressionstore[$exp->getKey()];

    }

}