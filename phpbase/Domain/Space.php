<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 上午11:00
 */

namespace Domain;


class Space extends \Domain\DomainObject
{
    private $venue;

    function setVenue(Venue $v){

        $this->venue=$v;
    }

}