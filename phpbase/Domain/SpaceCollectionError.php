<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午11:00
 */

namespace Domain;


class SpaceCollectionError
{
    private $spaces;

    function add(Space $sp){

        $this->spaces[]=$sp;

    }
}