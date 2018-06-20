<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/8/23
 * Time: 上午9:40
 */

namespace BlockPHP;


class BlockObj
{

    static function FunctionNoNameFactory(){


        return function ($product){

            if ($product->price>5){

                print "<br/>";
                print "reached high price : {$product->price}";
            }
        };
    }

    static  function BlockFactory($amt){

        $count =0;

        return function ($product) use ($amt,&$count)
        {

            $count+= $product->price;

            print "count :$count\n";

            if ($count>$amt){

                print "high price reached:{$count}\n";

            }
        };
    }
}