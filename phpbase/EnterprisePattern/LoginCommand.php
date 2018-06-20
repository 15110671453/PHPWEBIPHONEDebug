<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:54
 */

namespace EnterprisePattern;


class LoginCommand extends Command
{

    function execute(CommandContext $context)
    {
        // TODO: Implement execute() method.

        $manager =Registry::getAccessManager();

        $user =$context->get('username');

        $pass =$context->get('pass');

        $user_obj=$manager->login($user,$pass);

        if (is_null($user_obj)){

            $context->setError($manager->getError);

            return false;
        }

        $context->addParam('user',$user_obj);

        return true;

    }

}