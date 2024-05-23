<?php
session_start();
$host = "localhost";
$username = 'root';
$password = '';

$connect = new mysqli($host,$username,$password);
   if (!$connect ){
      die ('Connection Failed'. mysqli_connect_error());
   } 
$sql = 'CREATE DATABASE IF NOT EXISTS abc12';
$connect -> Query($sql);
$sql = "USE abc12";
$connect -> Query($sql);
$sql = "CREATE TABLE IF NOT EXISTS abc12users (
   USERNAME VARCHAR(100 ) UNIQUE,
   PASSWORD_HASH VARCHAR (40),
   PHONE VARCHAR(10)
);";
try {
   $connect -> query($sql);
}catch(Exception $a){
   echo 'Error: '.$a->getMessage();
}

?>