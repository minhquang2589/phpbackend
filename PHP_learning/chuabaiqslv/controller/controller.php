<?php
class Controller{
    private $conn = null;

    public function __construct(){
        $this->conn = (new Connection)->getConn();

    }
    
    public function view($view, $data = []){
        extract($data);
        require_once "view/$view.php";
    }


    // detect is post method
    public function isPost(){
        return $_SERVER['REQUEST_METHOD'] == "POST";
    }

    // detect is get method

    public function isGet(){
        return $_SERVER['REQUEST_METHOD'] == "GET";
    }

    public function getConn(){
        return $this->conn;
    }

    public function input(){
        return array(
            'get' => $_GET,
            'post' => $_POST
        );
    }

    public function loadModel($model){
        require_once "model/$model.php";   //user.php
        $model = $model."Model"; // userModel
        return new $model;
    }

}