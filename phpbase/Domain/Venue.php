<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午10:13
 */

namespace Domain;




class Venue extends \Domain\DomainObject
{


    private $name;
    private $spaces;
    private $user_id;

    function __construct($id=null,$name=null)
    {

        $this->name = $name;

        $this->spaces = self::getCollection('Space');

        parent::__construct($id);



    }


    function setSpaces(SpaceCollection $spaces) {

        $this->spaces=$spaces;

    }


    function  getSpaces(){
/*如何延迟实例化 lazy instantiant减少 对数据库的请求*/
        if (!isset($this->spaces))
        {
            $this->spaces = self::getCollection('\Domain\Space');

        }

       return $this->spaces;
    }


    function addSpace(Space $space){

        $this->getSpaces()->add($space);
/*集合中所有Space对象都指向当前Venue上*/
        $space->setVenue($this);




    }

    function setName($name_s){

        if (is_null($name_s))
        {
            $this->name='ceshi null';

        }else
        {
            $this->name=$name_s;
        }

        $this->markDirty();


    }

    function setUser_id($uid){
        $this->user_id=$uid;
    }
    function getUser_id(){
       return $this->user_id;
    }
    function  getName(){

        return $this->name;

    }
    function  markDirty(){


    }

}