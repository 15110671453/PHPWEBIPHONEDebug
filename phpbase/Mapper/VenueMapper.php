<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午10:39
 */

namespace Mapper;


use Domain\DomainObject;
use Domain\Venue;

class VenueMapper extends Mapper
{

    private $selectStmt;
    private $updateStmt;
    private $insertStmt;


    function  __construct()
    {

        parent::__construct();

        $this->selectStmt= self::$PDO->prepare("SELECT * FROM venue WHERE user_id=?");

        $this->updateStmt= self::$PDO->prepare("UPDATE venue set name=?,id=? where id=?");

        $this->insertStmt = self::$PDO->prepare("INSERT INTO venue (name,user_id) VALUES (?,?)");
    }


    function getCollection(array  $raw){

        return new SpaceCollection($raw,$this);

    }

    protected function doCreateObject(array $array)
    {
        // TODO: Implement doCreateObject() method.

        $obj = new Venue($array['id']);

        $obj->setName($array['name']);

        /*这里 使用映射器 将 space 添加到Venue 缺点是 不得两次访问数据库 我们可以将 下面代码 移到 Venue的getSpaces 中
        这样第二次数据库连接只在需要的时候才发生

        */
        $space_mapper = new SpaceMapper();
        $space_collection = $space_mapper->findByVenue($array['id']);
        $obj->setSpaces($space_collection);

        return $obj;
    }



    protected function doInsert(DomainObject $object)
    {
        // TODO: Implement doInsert() method.

        print "inserting\n";

//        debug_print_backtrace();

        $values = array($object->getName(),$object->getUser_id());

        $this->insertStmt->execute($values);

        $id=self::$PDO->lastInsertId();

        $object->setId($id);
    }

    function update(DomainObject $object){

        print "updating\n";


        $values = array($object->getName(),$object->getId(),$object->getId());

        $this->updateStmt->execute($values);

    }

    function selectStmt()
    {
        // TODO: Implement selectStmt() method.

        return $this->selectStmt;
    }
}