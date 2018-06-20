<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/23
 * Time: 上午11:23
 */

namespace PHPLangReflection;


class FtpModule implements Module
{

    function  setHost($host){

        print "<br/>";
        print "FtpModule::setHost(): $host\n";
        print "<br/>";
    }

    function setUser($user){

        print "<br/>";
        print "FtpModule::setUser(): $user\n";
        print "<br/>";
    }
    function execute()
    {
        // TODO: Implement execute() method.
        print "<br/>";
        print "FtpModule实现接口execute";
        print "<br/>";
    }
}