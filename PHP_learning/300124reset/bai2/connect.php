<?php
$host = 'localhost';
$username = 'root';
$pass = '';
$connect = new mysqli($host, $username, $pass);
if (!$connect){
   echo "Error connecting";
}else {
   $sql = "CREATE DATABASE IF NOT EXISTS DBBai2";
   $stmt = $connect -> prepare($sql);
   try{
      $stmt -> execute();
      $sql ="USE DBBai2";
      $connect -> query($sql);
   }catch(EXCeption $a){
      echo 'Error !'. $a -> getMessage();
   }
   $sql = "CREATE TABLE If NOT EXISTS User (
      ID INT AUTO_INCREMENT PRIMARY KEY,
      Username varchar(50) NOT NULL,
      Password varchar(40) NOT NULL,
      Phone varchar(20),
      Avatar varchar (255),
      Email varchar(40)
   );";
   try{
      $stmt = $connect-> prepare($sql);
      $stmt -> execute();
   }catch(EXCeption $a){
      echo 'Error !'. $a -> getMessage();
   }
}