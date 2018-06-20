<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 上午11:57
 */

/*
 *
 *
 * 1、常量前面没有美元符号($)

2、常量只能通过define()函数定义，而不能通过赋值语句

3、常量可以不用理会变量的作用域在任何地方定义和访问

4、常量一旦定义就不能重新定义或取消定义

5、常量的值只能是标量

使用const使得代码简单易读，const本身就是一个语言结构，而define是一个函数。另外const在编译时要比define快很多。

1、const用于类成员变量的定义，一经定义，不可修改。Define不可以用于类成员变量的定义，可用于全局常量。

2、Const可在类中使用，define不能

3、Const不能再条件语句中定义常量

 * */


/*
   *
   * 我们使用命名空间来编写项目 很方便的引用文件 ；但是 公司代码 如果过旧 不得不使用Pear风格 require_once
 *
 *  我们需要使用 set_include_path 函数 动态把这些要访问的路径 设置到include_path中
 *
 * set_include_path(get_include_path().":/home/dyn/projectlib/");
 *
 * 除了动态设置 也可以 在php.ini的配置文件 中提前设置好 以后require_once 就方便了
 *
 * 例如：
 * 以前使用 require_once('/home/dyn/projectlib/business/User.php')来包含类库文件
 * 当将 /home/dyn/projectlib/ 目录加到include_path后 ，只需要使用
 *
 *require_once('business/User.php')即可
 *
   * */
$path=$_SERVER['DOCUMENT_ROOT']."/Conf/";
echo "<br/>";
echo "Path:".$path;
echo "<br/>";
set_include_path(get_include_path().":{$path}");
const NAMESPACE_SEPARATOR='\\';

use Person\PersonBasic;

use  Conf\ConfBasic;
use  BasicFirst\BasicPro;
use Pattern\LiteralExpression;
use PHPLangReflection\ModuleRunner;




function __autoload( $classname ) {

    echo "\n".NAMESPACE_SEPARATOR."\n";

//$classname = strtolower( $classname );


    $classname = str_replace( NAMESPACE_SEPARATOR,'/' , $classname );

    require_once( dirname( __FILE__ ) . '/' . $classname . '.php' );
}
$dbms = 'mysql';


$host = 'localhost';
/*
 *
 *
 *
 * mysql> create table tempuser (id int  auto_increment, username varchar(255), detail text,eval_nums int(20), ip_add varchar(255),temp_id int(20) primary key,key(id));
Query OK, 0 rows affected (0.09 sec)

mysql> desc tempuser;
+-----------+--------------+------+-----+---------+----------------+
| Field     | Type         | Null | Key | Default | Extra          |
+-----------+--------------+------+-----+---------+----------------+
| id        | int(11)      | NO   | MUL | NULL    | auto_increment |
| username  | varchar(255) | YES  |     | NULL    |                |
| detail    | text         | YES  |     | NULL    |                |
| eval_nums | int(20)      | YES  |     | NULL    |                |
| ip_add    | varchar(255) | YES  |     | NULL    |                |
| temp_id   | int(20)      | NO   | PRI | NULL    |                |
+-----------+--------------+------+-----+---------+----------------+
6 rows in set (0.00 sec)

mysql>
 *
 *
 *
 * */

$dbname = 'test';
/* Mac Company user root paswd asd1453NMDmysql */
$user = 'root';

$pass = 'asd1453NMDmysql';

$dsn = "$dbms:host=$host;dbname=$dbname";

$dbconnect = new PDO($dsn,$user,$pass);

$remoteIP=$_SERVER["REMOTE_ADDR"];




echo '--------Perfect Start---------'.'<br/>';
/*使用命名空间 依旧找不到class 必须同时加入autoload函数 在mac上 才能执行成功*/


$basic1 = new BasicPro('1','2','3',120);


$exp = new LiteralExpression('test');

/*
 * 检测对象类型
 * */
print "<br/>";
print "<br/>";

print  get_class($exp);
if (get_class($exp) == 'ExpressionBasic')
{

    print "<br/>";
     print "检测对象类型 确认一个对象的类型 ExpressionBasic类型";
    print "<br/>";

}

if (get_class($exp) == 'LiteralExpression')
{

    print "<br/>";
    print "检测对象类型 确认一个对象的类型 LiteralExpression类型";
    print "<br/>";

}


if (get_class($exp) == 'Pattern\LiteralExpression')
{

    print "<br/>";
    print "检测对象类型 确认一个对象的类型 Pattern\\LiteralExpression类型";
    print "<br/>";

}

if ($exp instanceof \Pattern\ExpressionBasic)
{
    print "<br/>";
    print "被测对象 属于ExpressionBasic家族的";
    print "<br/>";

}
print "<br/>Methods:::::";
print_r(get_class_methods(get_class($exp)));
print "<br/>";

$method="getTitle";

if (is_callable(array($exp,$method)))
{
    print "<br/>";
    print $exp->$method();
    print "<br/>";

}else
{
    print "<br/>";
    print "如果该方法在类中存在 is_callable()函数返回true";
    print "<br/>";

}

if (method_exists($exp,$method))
{

    print $exp->$method();

}else
{
    print "如果该方法在类中存在 method_exists()函数返回true";

}

try{
/*
 *
 * 异常抛出时 会停止执行类的方法
 * */
/*
 * 由于之前将test..xml 误写文件名 多加了一个不注意观察到的点 引来很多错误
 *
 * 使用 相对 程序入口文件 的 相对路径 可以访问到 我们需要的资源文件./conf/test.xml
 *
 * */
    $conf = new ConfBasic('./conf/test.xml');

    $conf->insertConf('test1','testvalue');

    $conf->write();




}catch (Exception $e)
{
    /*
     * 抛出异常 内容 和终端断点 日志内容一样 很棒 简单直接
     * */
    die($e->__toString());
}

$w = new \Person\PersonWriter();

$p = new PersonBasic($w);

$p->name="oooName";
$p->age="asd123";

print  $p;

print $p->writeName();



print "<br/>PHP5.3后 匿名函数的使用";

$objFunc = new \BlockPHP\FunctionNOName();

$logFunc = function ($msg){

    print "<br/>注意只是以内联的方式使用function关键字，并没有函数名，因为是一条内联语句 所以在代码块末尾需要使用分号";
    print "<br/>注意这种做法只是生成匿名函数指针 但不是闭包 注意闭包 可是除了传参 还可以捕获上下文的作用域内变量的";

};

$objFunc->registerCallBack($logFunc);

$objFunc->sale($p);

var_dump($exp);


var_dump($basic1);


$basicProduct1 =new BasicPro("Shoes","ShoesFirst","ShoesMain",6);
$basicProduct2 =new BasicPro("Coffee","CoffeeFirst","CoffeeMain",6);

$processor = new \BlockPHP\FunctionNOName();

$processor->registerCallBack(\BlockPHP\BlockObj::BlockFactory(8));
$processor->sale($basicProduct1);

print "<br/>";
$processor->sale($basicProduct2);



$className ="Task";

$path = "DynamicClass/{$className}.php";

if (!file_exists($path)){

    throw new  Exception("No such file as {$path}");
}

require_once ($path);


$qclassname = "\\DynamicClass\\$className";

if (!class_exists($qclassname))
{
    throw new Exception("NO such class as $qclassname");

}
/*
 * 这里我们使用字符串动态的引用类 但是 我们无法确定该类的构造函数是否需要参数啊
 *
 * 这个级别的安全 我们需要求助于 类的反射机制 PHP类的反射API
 *
 * */
$myObj = new $qclassname();

$myObj->doSpeak();


$moduleRunner = new  ModuleRunner();

$moduleRunner->init();

