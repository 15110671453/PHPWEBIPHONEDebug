<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午1:11
 */

namespace Domain;


interface VenueCollection extends \Iterator
{
    function add(DomainObject $venue);
}