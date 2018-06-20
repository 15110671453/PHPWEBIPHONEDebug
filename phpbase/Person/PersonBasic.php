<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/22
 * Time: 上午11:10
 */

namespace Person;


class PersonBasic
{

    private $_name;

    private $_age;

    private $writer;


    private $id;

    function setId($id)
    {
        $this->id = $id;

    }

    function __construct(PersonWriter $w)
    {
        $this->writer=$w;
    }

    function __set($property,$value)
    {
        echo "<br>";
        echo "我在进行设置未定义字段1";
        $pr=ucfirst($property);
        $method = "set{$pr}";

        if (method_exists($this,$method))
        {
            print $method;
            echo "我在进行设置未定义字段2";
            return $this->$method($value);

        }

    }


    function __get($property){

        echo "<br>";
        echo "我在进行取值未定义字段1";
        $pr=ucfirst($property);
        $method = "get{$pr}";

        if (method_exists($this,$method))
        {

            print $method;
            echo "我在进行取值未定义字段2";

            return $this->$method();

        }
    }


    function getName()
    {

        echo "<br>";
        return $this->_name;
    }

    function setName($name)
    {
        $this->_name=$name;
        if (!is_null($name)){

            $this->_name = strtoupper($this->_name);
        }
    }

    function setAge($age){

        $this->_age = strtoupper($age);
    }

    function getAge(){

        echo "<br>";
        return $this->_age;

    }
    function getCheck(){

        echo "<br>";
        return "我是未定义年龄字段Check";
    }

    function __isset($name)
    {
        // TODO: Implement __isset() method.

        $pr=ucfirst($name);

        $method = "get{$pr}";

        return (method_exists($this,$method));

    }

    function __unset($name)
    {
        // TODO: Implement __unset() method.
        $pr=ucfirst($name);

        $method = "set{$pr}";

        if (method_exists($this,$method))
        {

            $this->$method(null);
        }

    }


    function __call($methodname, $arguments)
    {
        // TODO: Implement __call() method.

        if (method_exists($this->writer,$methodname))
        {
            return $this->writer->$methodname($this);

        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.

        if (!empty($this->id))
        {
            echo "<br/>";

            print  "析构函数 保存Person数据 再释放资源";

        }

    }

/*
 * 在PHP中 对象的赋值和传递是通过指针（但是有些书说引用 ）进行的
 * 当在一个对象上调用clone关键字时 其__clone() 就会被调用
 * 该函数可以控制复制什么属性
 * */
    function __clone()
    {
        // TODO: Implement __clone() method.

        $this->id = 123;
        $this->_name= "testClone";

        $this->_age=28;
        /*对以上这些属性 由于只是基本数据类型  浅复制 可以满足需求  但是要是还要复制引用的对象 就需要深复制*/

        /*
         *
         * 比如这里的writer属性  是对象 如果需要对它也复制 那也必须对该对象 也实现clone 方法
         * */
    }

    function __toString()
    {
        // TODO: Implement __toString() method.

        echo "<br/>";
        return "放便我们print打印任何一个自定义类的详情";
    }

}