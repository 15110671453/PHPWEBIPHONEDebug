<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午12:50
 */

namespace BasicFirst;


class AddressManager
{

    private  $addresses = array("209.131.36.159","74.125.19.106");

    //这里应该是传入布尔值  而不是字符串false 或 true

    function outputAddress($resolve){

        foreach ($this->addresses as $address)
        {

            print  $address;

            if (is_string($resolve))
            {
                    $resolve = (preg_match("/false|no|off/i",$resolve))?false:true;
            }
            if (!is_bool($resolve)){

                die("outputAddress() require a Boolean argument\n");
            }
            if ($resolve){
                print "(".gethostbyaddr($address).")";

            }
            print  "\n";
        }

    }
}