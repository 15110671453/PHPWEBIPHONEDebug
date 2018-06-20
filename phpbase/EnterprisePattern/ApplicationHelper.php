<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:34
 */

namespace EnterprisePattern;


class ApplicationHelper
{

    private static $instance;

    private $config = 'options.xml';

    private function __construct()
    {


    }

    static function instance(){

        if (!self::$instance){

            self::$instance = new self();

        }

        return self::$instance;

    }

    function  init(){

        $dsn= ApplicationRegistry::getDSN();

        if (!is_null($dsn)){

            return;

        }

        $this->getOptions();

    }

    private function getOptions(){
        $this->ensure(file_exists($this->config),'Could not find options file');

        $options =\simplexml_load_file($this->config);

        print get_class($options);

        $dsn = (string)$options->dsn;

        $this->ensure($dsn,"NO DSN Found");
        ApplicationRegistry::setDSN($dsn);

    }

    private function ensure($expr,$message){

        if (!$expr){
            throw new AppException($message);
        }
    }



}