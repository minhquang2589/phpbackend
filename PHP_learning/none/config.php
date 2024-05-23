<?php

class Connection {
    public $connect;
    public $host =  'localhost';
    public $username = 'root';
    public $password = "";
    public $charset = 'utf8';
    public $database = "MyDatabases";

    public function __construct (){
        try {
            $this->connect = new PDO("mysql:host=$this->host;dbname=$this->database;charset=$this->charset", $this->username, $this->password);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $aa) {
            echo "Connection failed: " . $aa->getMessage();
        }
      }

    public function getConnect (){
        return $this->connect;
    }
}

$connection = new Connection();
$connect = $connection -> getConnect();
