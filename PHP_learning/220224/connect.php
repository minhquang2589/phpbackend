<?php

class install {
   private $host = 'localhost';
   private $user = 'root';
   private $pass = '';
   private $connect = NULL;

      public function __construct(){
         $this -> connect = new mysqli($this -> host, $this -> user, $this -> pass);

      } 

      public function CrDB (){
         $sql = "CREATE DATABASE IF NOT EXISTS DB_Bai2202";
         if ($this -> connect -> query($sql) === TRUE){
            $this -> connect -> query("USE DB_Bai2202");
         }else {
            echo 'Create database Fail'. $this -> connect -> error;
         }
      }

      public function createTBProductCate (){
         $sql = "CREATE TABLE IF NOT EXISTS productcate (
            id INT PRIMARY KEY AUTO_INCREMENT,
            Cate_Name VARCHAR(255)
         );";
         if ($this->connect->query($sql) === TRUE){
         } else {
            echo 'Create Table Fail'. $this -> connect -> error;
         }
      } 

      public function createTBProducts (){
         $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY AUTO_INCREMENT,
            Product_Name VARCHAR(50),
            Cate_id INT,
            Product_Description VARCHAR(150),
            Brand_Name VARCHAR(50),
            Price DECIMAL(10, 2),
            Image VARCHAR(100),
            FOREIGN KEY (Cate_id) REFERENCES productcate (id)
         );";
         if ($this->connect->query($sql) === TRUE){
         } else {
            echo 'Create Table Fail'. $this -> connect -> error;
         }
      }  
      public function getConnect (){
         return $this -> connect;
      }
   }
   
   $install = new install;
   $install->CrDB ();
   $install->createTBProductCate();
   $install->createTBProducts();
   $install -> getConnect();
 ?>