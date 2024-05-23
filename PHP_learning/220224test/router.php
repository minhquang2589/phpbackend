<?php
include 'utils.php';

class Router {
   private $controller = NULL;
   private $action = NULL;
   private $param = [];

   public function __construct(){
      $this->parseURL();
      $this->dispatch();
   }
   public function parseURL() {
      $url = $_SERVER['REQUEST_URI'];
      $url = explode('/', $url);
      $url = array_filter($url);
      $this->controller = $url[4];
      $this->action = isset($url[5]) ? $url[5] : 'index';
      $this->param = isset($url[6]) ? array_slice($url, 6) : [];

   }
   public function dispatch(){
      $controller = $this ->  controller;
      $action = $this->action;
      $param = $this->param;

      if (file_exists("controller/$controller.php")){
        require_once "controller/$controller.php";
        $controller = $controller."controller";
        $controller = new $controller;
            if (method_exists($controller, $action)){
                call_user_func_array([$controller, $action], $param);
            }else {
                echo 'Không tìm thấy Phương thức Action';
            }
        }else {
            echo 'Không tìm thấy File Controller';
        }
    }  
}

$router = new Router;
?>
