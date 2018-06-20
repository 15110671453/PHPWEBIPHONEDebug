<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午12:50
 */

namespace Mapper;


use Domain\DomainObject;

abstract class Collection implements \Iterator
{

    protected $mapper;
    protected $total = 0;
    protected $raw = array();


    private $result;
    private $pointer = 0;
    private $objects = array();

    function __construct(array $raw =null,Mapper $mapper=null)
    {
        /*
         *
         * 构造对象 最终给这个类 赋予  一组对象的原始数据 和 一个 映射器的引用
         * */
        if (!is_null($raw)&&!is_null($mapper)){
            $this->raw=$raw;
            $this->total=count($raw);


        }

        $this->mapper=$mapper;
    }

    function add(DomainObject $object){

        /*
         * 前面 构造方法  如果没有传递参数 那么类中的数据为空
         *
         * 我们可以通过 add 方法 添加数据到 该集合类
         *
         * */

        $class = $this->targetClass();

        if (!($object instanceof $class)){

        }
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;


    }
    abstract function targetClass();

    protected function notifyAccess(){

        //暂时留空 主要用于 Lazy Load 延迟加载 模式
    }

    private function getRow($num){

        $this->notifyAccess();

        if ($num >= $this->total||$num<0){


            return null;
        }


        if (isset($this->objects[$num])){
            return $this->objects[$num];
        }

        if (isset($this->raw[$num])){

            $this->objects[$num]=$this->mapper->createObject($this->raw[$num]);

            return $this->objects[$num];

        }

    }


    public function rewind()
    {
        // TODO: Implement rewind() method.
        $this->pointer=0;
    }


    public function current()
    {
        // TODO: Implement current() method.

        return $this->getRow($this->pointer);
    }

    public function key(){

        return $this->pointer;
    }

    public function  next()
    {
        // TODO: Implement next() method.

        $row = $this->getRow($this->pointer);

        if ($row){
            $this->pointer++;
        }
        return $row;
    }
    public  function valid()
    {
        // TODO: Implement valid() method.

        return (!is_null($this->current()));
    }

}