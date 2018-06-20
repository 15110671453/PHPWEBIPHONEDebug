<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午3:10
 */

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
//echo "<br/>";
//echo "Path:".$path;
//echo "<br/>";
set_include_path(get_include_path().":{$path}");
const NAMESPACE_SEPARATOR='\\';




function __autoload( $classname ) {

//    echo "\n".NAMESPACE_SEPARATOR."\n";

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
//var_dump($_SERVER);
$remoteIP=$_SERVER["REMOTE_ADDR"];
$post =$_SERVER['REQUEST_METHOD'];

$nicheng = 'test111';
$tucaocontent = 'testneirong2222';
$tijiaocishu = 2;

if ($post == 'POST')
{
    $nicheng = $_POST['username'];
    $tucaocontent = $_POST['tucaocontent'];
    $tijiaocishu = $_POST['cishuvalue'];
}else
{
 if (isset($_GET['username']))
 {
     $nicheng=$_GET['username'];
 }
    if (isset($_GET['tucaocontent']))
    {
        $tucaocontent=$_GET['tucaocontent'];
    }
    if (isset($_GET['cishuvalue']))
    {
        $tijiaocishu=$_GET['cishuvalue'];
    }
}




$selectStmt =$dbconnect->prepare("SELECT detail FROM tempuser WHERE temp_id=?");

$values1 = array(ip2long($remoteIP)+$tijiaocishu);

$selectStmt->execute($values1);



$selectOK=$selectStmt->fetch(\PDO::FETCH_ASSOC);

if ($selectOK){
    print_r($selectOK);
//    while ($row=$selectStmt->fetch(\PDO::FETCH_ASSOC)){
//        print_r($row);
//        echo '<br/>';
//    }

    $jsonDataObj=array('substatus'=>-1,'failtext'=>'该IP地址已经提交重复数据!');
    $result=json_encode(array('result'=>$jsonDataObj));

//动态执行回调函数
    $callback=$_GET['jsonpCallback'];

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
        $conf = new \Conf\ConfBasic('./conf/test.xml');

        $conf->insertConf('substate','0');

        $conf->write();




    }catch (Exception $e)
    {
        /*
         * 抛出异常 内容 和终端断点 日志内容一样 很棒 简单直接
         * */
        die($e->__toString());
    }
    echo $result;
}else
{



    $insertStmt = $dbconnect->prepare("INSERT INTO tempuser (username,detail,eval_nums,ip_add,temp_id) VALUES (?,?,?,?,?)");



    $values = array($nicheng,$tucaocontent,$tijiaocishu,$remoteIP,ip2long($remoteIP)+$tijiaocishu);


//var_dump($values);

    $insertStmt->execute($values);

    $id=$dbconnect->lastInsertId();

//echo '</br>';
//echo "$id";
//echo '</br>';
    $jsonDataObj=array('substatus'=>0,'successstext'=>'成功');
    $result=json_encode(array('result'=>$jsonDataObj));

//动态执行回调函数
    $callback=$_GET['jsonpCallback'];
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
        $conf = new \Conf\ConfBasic('./conf/test.xml');

        $conf->insertConf('substate','1');

        $conf->write();




    }catch (Exception $e)
    {
        /*
         * 抛出异常 内容 和终端断点 日志内容一样 很棒 简单直接
         * */
        die($e->__toString());
    }
    echo $result;

}





