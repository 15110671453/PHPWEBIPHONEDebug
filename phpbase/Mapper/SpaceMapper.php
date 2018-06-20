<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午1:59
 */

namespace Mapper;


class SpaceMapper extends Mapper
{
    private $selectAllStmt ;
    private $findByVenueStmt;

    function __construct()
    {

        parent::__construct();
        $this->selectAllStmt=self::$PDO->prepare("SELECT * FROM space");

        $this->findByVenueStmt=self::$PDO->prepare("SELECT * FROM space WHERE venue=?");
    }

    function getCollection(array  $raw){

        return new SpaceCollection($raw,$this);
    }

    function selectAllStmt()
    {
        // TODO: Implement selectAllStmt() method.

        return $this->selectAllStmt;
    }

    function findByVenue($vid){

        $this->findByVenueStmt->execute(array($vid));

        return new SpaceCollection($this->findByVenueStmt->fetchAll(),$this);

    }
}