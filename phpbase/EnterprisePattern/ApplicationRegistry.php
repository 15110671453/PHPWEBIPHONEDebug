<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:08
 */

namespace EnterprisePattern;


class ApplicationRegistry extends Registry
{

    /*
     * 该类 使用 序列化 来存储 和 获取 每个属性的值
     *
     * 如果文件存在并且在上次读之后被修改过 来决定访问新文件
     *
     * 同时避免访问每个变量都打开一次文件 我们把所有属性保存在一个文件
     *
     * 访问一次 就修改 时间标记数组 并一次性序列化 所有保存数据
     *
     * 减少开销
     *
     * */

    /*
     * php 的shm扩展  可以使用该扩展中的函数 实现应用程序注册表
     *
     * 如果想更高效 可以使用 memcached第三方工具 或者APC 将数据换存在内存中供随时取用
     * */
    private  static  $instance;

    private $freezedir = "data";

    private $mtimes = array();

    private $values = array();

    private function __construct(){

    }

    static function instance(){

        if (!isset(self::$instance))
        {

            self::$instance = new self();

        }

        return self::$instance;
    }



    function get($key){

        $path = $this->freezedir.DIRECTORY_SEPARATOR.$key;
        if (file_exists($path)){

            clearstatcache();

            $mtime =filemtime($path);

            if (!isset($this->mtimes[$key])){
                $this->mtimes[$key]=0;
            }
            if ($mtime>$this->mtimes[$key]){

                $data = file_get_contents($path);

                $this->mtimes[$key]=$mtime;

                return ($this->values[$key]=unserialize($data));


            }

        }

        if (isset($this->values[$key])){

            return $this->values[$key];

        }

    }

    function  set($key,$value){
        $this->values[$key]=$value;

        $path =$this->freezedir.DIRECTORY_SEPARATOR.$key;

        file_put_contents($path,serialize($value));

        $this->mtimes[$key]=time();
    }

    static function getDSN(){

        return self::instance()->get('dsn');

    }

    static function setDSN($dsn){

        return self::instance()->set('dsn',$dsn);

    }


}