<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午1:45
 */

namespace Mapper;


class SpaceCollection extends Collection implements \Domain\SpaceCollection
{
    function targetClass()
    {
        // TODO: Implement targetClass() method.
        return '\Domain\Space';
    }

}