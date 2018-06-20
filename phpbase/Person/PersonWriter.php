<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/22
 * Time: 上午11:51
 */

namespace Person;


class PersonWriter
{
    /*
     *
     *
     * print 是打印字符串

print_r 则是打印复合类型 如数组 对象等

在PHP中的执行速率从快到慢为：echo(),   print(),   print_r()

echo是php语句, print和print_r是函数,语句没有返回值,函数可以有返回值(即便没有用)
      printf("%s---%d---%b---%x---%o---%f",$num,$num,$num,$num,$num,$num)
     printf("参数1",参数2)：参数1=按什么格式输出；参数2=输出的变量。($s:按字符串;$d:按整型;$b:按二进制；$x:按16进制；$o:按八进制; $f:按浮点型)
    print_r()
     功能：只用于输出数组
    var_dump();  --取得变量的详细信息
    功能: 输出变量的内容，类型或字符串的内容，类型，长度。常用来调试
     *
     *
     * */

    function  writeName(PersonBasic $p)
    {
        echo "<br>";
        print $p->getName()."\n";
        echo "<br>";
    }


    function writeAge(PersonBasic $p)
    {
        echo "<br>";
        print_r($p->getAge()."\n") ;
        echo "<br>";

    }

}