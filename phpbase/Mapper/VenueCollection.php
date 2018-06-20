<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/10/20
 * Time: 下午1:09
 */

namespace Mapper;


class VenueCollection extends Collection implements \Domain\VenueCollection
{

    function targetClass()
    {
        // TODO: Implement targetClass() method.

        return '\Domain\Venue';
    }

}