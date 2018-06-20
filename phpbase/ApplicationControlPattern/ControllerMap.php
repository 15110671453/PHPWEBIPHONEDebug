<?php
/**
 * Created by PhpStorm.
 * User: admindyn
 * Date: 2017/9/13
 * Time: 下午2:22
 */

namespace ApplicationControlPattern;


class ControllerMap
{
    private $viewMap = array();

    private $forwardMap = array();

    private $classrootMap = array();

    function addClassRoot($command,$classroot){

        $this->classrootMap[$command]=$classroot;

    }

    function getClassRoot($command){

        if (isset($this->classrootMap[$command])){

            return $this->classrootMap[$command];

        }

        return $command;

    }

    function addView($command='default',$status=0,$view){

        $this->viewMap[$command][$status]=$view;
    }

    function getView($command,$status){

        if (isset($this->viewMap[$command])){

            return $this->viewMap[$command][$status];

        }

        return null;
    }


    function  addForward($command,$status=0,$newCommand){

        $this->forwardMap[$command][$status]=$newCommand;

    }
    function getForward($command,$status){

        if (isset($this->forwardMap[$command][$status])){

            return $this->forwardMap[$command][$status];
        }

        return null;

    }
}