<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/23
 * Time: 上午11:25
 */

namespace PHPLangReflection;


class PersonModule implements Module
{

    function setPerson(PersonReflect $person)
    {
        print "<br/>";
        print "PersonModule::setPerson(): {$person->name}\n";
    }
    function  execute()
    {
        // TODO: Implement execute() method.
        print "<br/>";
        print "PersonModule实现接口execute";
        print "<br/>";
    }
}