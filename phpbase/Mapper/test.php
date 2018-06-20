<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午10:53
 */
$path=$_SERVER['DOCUMENT_ROOT']."/Conf/";
echo "<br/>";
echo "Path:".$path;
echo "<br/>";
set_include_path(get_include_path().":{$path}");
const NAMESPACE_SEPARATOR='\\';


function __autoload( $classname ) {

    echo "</br>".NAMESPACE_SEPARATOR."</br>";

//$classname = strtolower( $classname );


    $classname = str_replace( NAMESPACE_SEPARATOR,'/' , $classname );

    require_once( dirname(dirname( __FILE__ )) . '/' . $classname . '.php' );
}

$venue = new \Domain\Venue();

$venue->setName("The Likey 3333");
$venue->setUser_id('1009');

/*
 *
 *
 * */
//插入对象到数据库

$mapper = new \Mapper\VenueMapper();

$mapper->insert($venue);

//从数据库中 读出 刚才插入的对象 验证插入操作是否生效

$venue = $mapper->find($venue->getUser_id());

var_dump($venue);

echo "</br>".'--------'."</br>";

$venue->setName('ZThe Bibble');
$venue->setUser_id('1010');

//调用update 来更新数据库记录

$mapper->update($venue);


//再次读出对象数据 验证 更新操作是否生效

$venue=$mapper->find($venue->getId());

print_r($venue);