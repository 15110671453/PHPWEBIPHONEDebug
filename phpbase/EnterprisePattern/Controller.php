<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 上午11:27
 */

namespace EnterprisePattern;


class Controller
{

    private $applicationHelper;

    private function __construct(){


    }


    static function run(){
        /*
         * 构造方法 被设定为 private 因此使用中 只能使用 run 方法来实例化控制器类
         * */

        $instance = new Controller();

        $instance->init();

        $instance->handleRequest();

    }

    function init() {

        $applicationHelper = ApplicationHelper::instance();

        $applicationHelper->init();

    }

    function  handleRequest(){

        $request = new Request();

        $cmd_r = new CommandResolver();

        $cmd = $cmd_r->getCommand($request);

        $cmd->execute($request);

    }
}