<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:52
 */

namespace EnterprisePattern;


abstract  class Command
{

    final function  __construct()
    {
    }

    function execute(Request $request){

        $this->doExecute($request);

    }
    abstract function  doExecute(Request $request);

}