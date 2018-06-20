<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午5:39
 */

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






}catch (Exception $e)
{
    /*
     * 抛出异常 内容 和终端断点 日志内容一样 很棒 简单直接
     * */
    die($e->__toString());
}



$status = $conf->checkKey('substate');

$result=json_encode(array('result'=>array($status)));
$callback=$_GET['callback'];
echo $result;
