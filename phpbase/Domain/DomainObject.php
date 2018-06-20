<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午10:11
 */

namespace Domain;


  abstract  class DomainObject
{

    private $id;

    function __construct( $id = null)
    {

        $this->id =$id;
    }

    function getId(){

        return $this->id;

    }
    function setId($id_s){
        $this->id=$id_s;
    }


    static  function  getCollection($type){


        return HelperFactory::getCollection($type);

    }


    function collection() {

        return self::getCollection(get_class($this));

    }

}