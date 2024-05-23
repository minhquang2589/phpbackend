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
         $sql = "CREATE DATABASE IF NOT EXISTS DB_Bai2002";
         if ($this -> connect -> query($sql) === TRUE){
            $this -> connect -> query("USE DB_Bai2002");
         }else {
            echo 'Create database Fail';
         }
      }

      public function createTBProductCate (){
         $sql = "CREATE TABLE IF NOT EXISTS productcate (
            id INT PRIMARY KEY AUTO_INCREMENT,
            Cate_Name VARCHAR(255)
         );";
         if ($this->connect->query($sql) === TRUE){
         } else {
            echo 'Create Table Fail';
         }
      } 
      public function createTBProducts (){
         $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT PRIMARY KEY AUTO_INCREMENT,
            Product_Name VARCHAR(50),
            CatId INT,
            Product_Description VARCHAR(150),
            Brand_Name VARCHAR(50),
            Price DECIMAL(10, 2),
            Image VARCHAR(100),
            FOREIGN KEY (CatId) REFERENCES productcate (id)
         );";
         if ($this->connect->query($sql) === TRUE){
         } else {
            echo 'Create Table Fail';
         }
      }  
   }
   
   $install = new Install;
   $install->CrDB ();
   $install->createTBProductCate();
   $install->createTBProducts();

 ?>