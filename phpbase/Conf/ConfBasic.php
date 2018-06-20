<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午5:31
 */

namespace Conf;


class ConfBasic
{
    private  $ServerRoot;

    private $file;

    private $xml;

    private $lastmatch;
    private $canGO = false;


      function  setServerRoot()
    {
        $this->ServerRoot= $_SERVER['DOCUMENT_ROOT'];
    }
    public function __construct($file)
    {
        //dirname(__FILE__).$f
        $this->file=$file;

        echo "<br/>";
        echo $this->file;

        /*
         *
         * SimpleXML 扩展需要 PHP 5 支持。
自 PHP 5 起，SimpleXML 函数是 PHP 核心的组成部分。无需安装即可使用这些函数
         * */
//        $this->xml=\simplexml_load_file('test2.xml');


        if(!file_exists($file))
        {

            throw  new \Exception("file does not exsit");
        }
        //$_SERVER['DOCUMENT_ROOT'].'/Conf/test.xml'

        $this->xml=\simplexml_load_file($file);



    }

    function write(){

        if (!is_writable($this->file))
        {

            throw  new \Exception("file is not writeable");
        }
        file_put_contents($this->file,$this->xml->asXML());
    }


    function checkKey($str){

        var_dump($this->xml);
        $matches='';
        if (!is_bool($this->xml) )
        {
            echo 'true'."\n";
            $this->canGO=true;
            $matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");

        }else
        {
            $this->canGO=false;
            echo 'xml 文件路径 无法打开'."\n";
            return null;

        }


        if(count($matches)){

            echo '找到Key'."\n";
            $this->lastmatch = $matches[0];

            return (string)$matches[0];

        }

        return null;

    }


    function  insertConf($key,$value){

        if (!is_null($this->checkKey($key)))
        {
            echo '更新key'."\n";
            $this->lastmatch[0]=$value;

            return ;
        }

        if ($this->canGO)
        {
            echo '插入新key'."\n";
            $conf = $this->xml->conf;

            $this->xml->addChild('item',$value)->addAttribute('name',$key);

        }else
        {
            echo '插入失败 ，无法打开指定的xml文件'."\n";

        }



    }

}