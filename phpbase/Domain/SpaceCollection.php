<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午1:14
 */

namespace Domain;


interface SpaceCollection extends \Iterator
{
    function add(DomainObject $space);
}