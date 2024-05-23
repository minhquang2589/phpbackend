<?php 
$host = "localhost";
$username = "root";
$password = "";
$charset = 'utf8';
//connect to PHPmyAdmin, create DATABASE and Create Table,
   try {
         $connect = new PDO("mysql:host=$host; charset=$charset", $username, $password);
         $connect -> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
         $DBname = 'MyDatabases';
         $SqlCreateDb = "CREATE DATABASE IF NOT EXISTS $DBname";
         $connect -> exec($SqlCreateDb);
         $connect -> exec("USE $DBname");
         $SqlCreateTb = "CREATE TABLE IF NOT EXISTS myguests (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstname varchar (50),
            lastname varchar (50),
            email  varchar (50),
            reg_date datetime
         )";
         $connect -> exec($SqlCreateTb );
   } catch (Exception $aa) {
      echo "Connection failed: " . $aa->getMessage();
   }
   $select = "SELECT * FROM `myguests`";
   $result = $connect -> query($select);
   $product = $result -> fetchAll(PDO::FETCH_ASSOC);