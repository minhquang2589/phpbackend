<?php

class Connection{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $database = "qlsv";
    private $conn = null;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->database);
    }

    public function getConn(){
        return $this->conn;
    }
}