<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/23
 * Time: 上午11:28
 */

namespace PHPLangReflection;



class ModuleRunner
{

    private $configData = array("PersonModule"=>array('person'=>'bob'),
        "FtpModule"=>array('host'=>'example.com','user'=>'anon'));

    private $modules =array();

    function init(){

//        $interface = new \ReflectionClass('Module');

        $interface = new \ReflectionClass('\PHPLangReflection\Module');

        foreach ($this->configData as $modulename => $params)
        {

//            $module_class = new \ReflectionClass($modulename);
            $module_class = new \ReflectionClass('\PHPLangReflection\\'.$modulename);

            if (!$module_class->isSubclassOf($interface))
            {
                throw new \Exception("unknown module type : $modulename");

            }

            $module = $module_class->newInstance();

            foreach ($module_class->getMethods() as $method){

                $this->handleMethod($module,$method,$params);

            }

            array_push($this->modules,$module);

        }
    }


    function handleMethod(Module $module,\ReflectionMethod $method ,$params)
    {
        $name = $method->getName();

        $args =$method->getParameters();

        if (count($args)!=1||substr($name,0,3)!="set")
        {
            return false;
        }

        $property = strtolower(substr($name,3));

        if (!isset($params[$property]))
        {

            return false;
        }

        $arg_class = $args[0]->getClass();

        if (empty($arg_class))
        {
            $method->invoke($module,$params[$property]);
        }else
        {

            $method->invoke($module,$arg_class->newInstance($params[$property]));
        }

    }


}