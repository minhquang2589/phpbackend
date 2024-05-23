<?php
   include "utils.php";
   $host = "localhost";
   $username = "root";
   $password = "";
   $charset = 'utf8';
   
      try {
            $connect = new PDO("mysql:host=$host; charset=$charset", $username, $password);
            $connect -> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            $DBname = 'Products';
            $SqlCreateDb = "CREATE DATABASE IF NOT EXISTS $DBname";
            $connect -> exec($SqlCreateDb);
      } catch (Exception $aa) {
         echo "Connection failed: " . $aa->getMessage();
      }
      $connect -> exec("USE $DBname");
      $sql = "CREATE TABLE IF NOT EXISTS Person (
         ID INT AUTO_INCREMENT PRIMARY KEY,
         Name VARCHAR(100) NOT NULL,
         Price FLOAT,
         Quantity INT,
         Created_at DATETIME
      )";
      $connect -> exec($sql );
      $select = "SELECT * FROM `Person`";
      $result = $connect -> query($select);
      $product = $result -> fetchAll(PDO::FETCH_ASSOC);

      // 