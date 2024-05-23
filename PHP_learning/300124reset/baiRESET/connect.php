<?php
$host = 'localhost';
$username = 'root';
$pass = '';
$connect = new mysqli($host, $username, $pass);
if (!$connect){
   echo "Error connecting";
}else {
   $sql = "CREATE DATABASE IF NOT EXISTS mydbuser";
   $stmt = $connect -> prepare($sql);
   try{
      $stmt -> execute();
      $sql ="USE mydbuser";
      $connect -> query($sql);
   }catch(EXCeption $a){
      echo 'Error !'. $a -> getMessage();
   }
   $sql = "CREATE TABLE If NOT EXISTS mydb_user (
      USERNAME VARCHAR (100) UNIQUE,
      PASSWORD_HASH VARCHAR (40),
      PHONE VARCHAR (10)
   );";
   try{
      $stmt = $connect-> prepare($sql);
      $stmt -> execute();
   }catch(EXCeption $a){
      echo 'Error !'. $a -> getMessage();
   }
}