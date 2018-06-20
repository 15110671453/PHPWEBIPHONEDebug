<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/21
 * Time: 下午4:46
 */


namespace BasicFirst;

use Product\ShopProduct;


class TextProductWriter extends ShopProductWriter
{

    public  function  write()
    {
        // TODO: Implement write() method.
        $str ="PRODUCTS:\n";

        foreach ($this->products as  $shopProduct){


            $str .= $shopProduct->getSummaryLine()."\n";


        }

        print  $str;
    }

}