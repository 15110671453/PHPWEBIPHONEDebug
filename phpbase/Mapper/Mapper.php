<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午10:22
 */

namespace Mapper;


use Domain\DomainObject;

use EnterprisePattern\ApplicationRegistry;

abstract class Mapper
{

    protected  static $PDO;

    function __construct()
    {
        if (!isset(self::$PDO)){

            $dsn = ApplicationRegistry::getDSN();

            if (is_null($dsn)){
                $dbms = 'mysql';


                $host = '127.0.0.1';

                $dbname = 'test';


                $dsn = "$dbms:host=$host;dbname=$dbname";


            }
            /* Mac Company user root paswd asd1453NMDmysql  服务器Centos asd1453nmd*/
            /*
             * 准备测试数据库
             *
             * mysql> drop database yii2basic;
Query OK, 1 row affected (0.09 sec)

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
| test               |
| tpshop             |
+--------------------+
6 rows in set (0.00 sec)

mysql>
            清除mysql test数据库中 几个表中 之前 的数据

            delete from user;

            mysql> desc user;
+-------+-----------+------+-----+---------+-------+
| Field | Type      | Null | Key | Default | Extra |
+-------+-----------+------+-----+---------+-------+
| id    | int(20)   | YES  |     | NULL    |       |
| name  | char(255) | YES  |     | NULL    |       |
| age   | char(255) | YES  |     | NULL    |       |
+-------+-----------+------+-----+---------+-------+
3 rows in set (0.00 sec)

mysql>

            删除  后  原先表的结构 并没有变

             我们 新建表 用于 目前功能测试
  mysql> create table venue (id int  auto_increment ,name varchar(255) not null,user_id int(20) primary key,key(id));
Query OK, 0 rows affected (0.09 sec)

mysql> desc venue;
+---------+--------------+------+-----+---------+----------------+
| Field   | Type         | Null | Key | Default | Extra          |
+---------+--------------+------+-----+---------+----------------+
| id      | int(11)      | NO   | MUL | NULL    | auto_increment |
| name    | varchar(255) | NO   |     | NULL    |                |
| user_id | int(20)      | NO   | PRI | NULL    |                |
+---------+--------------+------+-----+---------+----------------+
3 rows in set (0.00 sec)

mysql>
             *
             *
             *
             *
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
             * */
            $user = 'root';

            $pass = 'asd1453NMDmysql';
            self::$PDO = new \PDO($dsn,$user,$pass);

            self::$PDO -> setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

        }

    }


    function find($id){
/*
 * find 方法 负责调用预编译过的SQL语句 （方法 需要具体子类 实现提供）并获得行数据
 * 然后调用 createObject方法 将数据从数组转换为对象
 * */
        $this->selectStmt()->execute(array($id));

        $array = $this->selectStmt()->fetch();

        $this->selectStmt()->closeCursor();

        if (!is_array($array)){

            return null;
        }


        if (!isset($array['id'])){

            return null;
        }


        $object = $this->createObject($array);


        return $object;


    }



    function createObject($array){

        $obj= $this->doCreateObject($array);

        return $obj;
    }


    function insert(DomainObject $obj){

        $this->doInsert($obj);


    }

    function findAll(){

        $this->selectAllStmt()->execute(array());
        return $this->getCollection($this->selectAllStmt()->fetchAll(\PDO::FETCH_ASSOC));
    }

    protected  abstract  function getCollection(array $raw);
    abstract  function  update(DomainObject $object);

    protected  abstract  function doCreateObject(array $array);

    protected abstract function doInsert(DomainObject $object);

    protected  abstract  function  selectStmt();
    protected  abstract  function  selectAllStmt();

}