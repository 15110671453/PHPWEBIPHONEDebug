<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 下午12:42
 */

namespace EnterprisePattern;


class CommandResolver
{
    private static $base_cmd;

    private static $default_cmd;

    function __construct()
    {
        if (!self::$base_cmd)
        {

            self::$base_cmd = new \ReflectionClass("Command");

            self::$default_cmd = new DefaultCommand();

        }

    }


    function getCommand(Request $request){

        $cmd = $request ->getProperty('cmd');

        $sep = DIRECTORY_SEPARATOR;

        if (!$cmd)
        {

            return self::$default_cmd;

        }


        $cmd= str_replace(array('.',$sep),"",$cmd);

        $filepath = "{$cmd}.php";
        $classname ="{$cmd}";

        if (file_exists($filepath)){

            @require_once ("$filepath");

            if (class_exists($classname)){

                $cmd_class=new \ReflectionClass($classname);

                if ($cmd_class->isSubclassOf(self::$base_cmd)){


                    /*这里由于Command基类 声明构造方法时用了final 关键字
                    任何子类都不能覆盖这个构造方法 因此 所有Command类都不需要参数

                    */
                    return $cmd_class->newInstance();
                }else{

                    $request->addFeedBack('Command is not found');
                }

            }

        }


        $request->addFeedBack('Command is not found');

        return clone self::$default_cmd;

    }



}