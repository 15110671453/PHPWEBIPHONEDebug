<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午9:31
 */

namespace Process;


use EnterprisePattern\ApplicationRegistry;

abstract class Base
{
    static $DB;
    static $stms = array();

    function __construct()
    {
        /*ApplicationRegistry  获得一个数据源字符串DSN*/
        $dsn = ApplicationRegistry::getDSN();

        if (is_null($dsn)){



        }

        self::$DB = new \PDO($dsn);

        self::$DB->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

    }

    function prepareStatement($stmt_s){

        /*把数据源的Sql句柄缓存在一个静态数组$stmts 中 ，我们使用Sql语句本身作为数组元素的索引*/
        if (isset(self::$stms[$stmt_s])){
            return self::$stms[$stmt_s];
        }

        $stmt_handle = self::$DB->prepare($stmt_s);

        self::$stms[$stmt_s] = $stmt_handle;

        return$stmt_handle;

    }
/*上面的prepareStatement 方法 可以被子类 直接调用 但更多情况是 通过doStatement方法间接调用*/
    function doStatement($stmt_s,$values_a){

        $sth = $this->prepareStatement($stmt_s);

        $sth->closeCursor();

        $db_result =$sth->execute($values_a);

        return $sth;

    }
}