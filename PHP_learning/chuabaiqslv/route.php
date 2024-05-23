<?php
class Route
{
    private $controller = null;
    private $action = null;
    private $params = [];

    public function __construct()
    {
        $this->parseURL();
        $this->dispatch();
    }

    public function parseURL()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $url = array_filter($url);
        $this->controller = isset($url[3]) ? $url[3] : "index";
        $this->action = isset($url[4]) ? $url[4] : "index";
        if (isset($url[5])) {
            $parsed_url = parse_url($url[5]);

            if (isset($parsed_url['query'])) {
                $query = $parsed_url['query'];
                parse_str($query, $this->params);
              
            }
            ($this->params)['id'] = isset($url[5]) ? $parsed_url['path'] : '';
        }
    }

    public function dispatch()
    {
        $controller = $this->controller;
        $action = $this->action;
        // $params = $this->params;
        $params[] = $this->params;
        if (file_exists("controller/$controller.php")) {
            require_once "controller/$controller.php";
            $controller = $controller . "Controller";
            $controller = new $controller;  // registerController
            if (method_exists($controller, $action)) {
                call_user_func_array([$controller, $action], $params);
            } else {
                echo "Action not found";
            }
        } else {
            echo "Controller not found";
        }
    }
}

$route = new Route();
