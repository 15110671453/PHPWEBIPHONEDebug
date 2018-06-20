<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 下午12:59
 */

namespace EnterprisePattern;


class DefaultCommand extends Command
{

    function doExecute(Request $request)
    {
        // TODO: Implement doExecute() method.

        $request->addFeadback('WelCome to my site');

        include ('view/main.php');
    }

}