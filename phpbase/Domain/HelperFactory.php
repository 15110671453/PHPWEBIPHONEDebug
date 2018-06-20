<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午1:22
 */

namespace Domain;


use Mapper\VenueCollection;

class HelperFactory
{
    static function getCollection($type){

        return new VenueCollection();
    }
}