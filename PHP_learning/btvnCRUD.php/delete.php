<?php
include "utils.php";

$DBname = 'MyDatabases';
$host = "localhost";
$username = "root";
$password = "";
$charset = 'utf8';
try {
   $connect = new PDO("mysql:host=$host;dbname=$DBname;charset=$charset", $username, $password);
   $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $aa) {
   echo "Connection failed: " . $aa->getMessage();
}
if ($_SERVER ['REQUEST_METHOD']== 'POST'){
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];
   $sql = 
   $stmt = $connect -> prepare($sql);
   try{
      $stmt -> execute();
      echo 'DELETE DATA successfully';
   }catch (PDOException $aa){
      echo 'DELETE DATA failed: ' . $aa->getMessage(); 
   }
}


?>