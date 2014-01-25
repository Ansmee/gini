<?php

namespace Controller;
    
abstract class CLI {

    public $action;
    public $params;
 
    function __preAction($action, &$params) { }
    
    function __postAction($action, &$params, $response) { }

    function execute() {

        $action = $this->action ?: '__index';
        $params = (array) $this->params;

        $this->__preAction($action, $params);
        $response = call_user_func(array($this, $action), $params);
        return $this->__postAction($action, $params, $response) ?: $response;
    }
    
    function __index($params) {
        $this->__unknown($params);
    }

    function action_help($params) {
        echo "\e[1;34mgini\e[0m: help is unavailable.\n";
    }
        
    function __unknown($params) {
        echo "\e[1;34mgini\e[0m: unknown command.\n";
    }

}

