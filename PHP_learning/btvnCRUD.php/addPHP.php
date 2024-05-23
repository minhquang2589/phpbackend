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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $firstname = $_POST["firstname"];
      $lastname = $_POST["lastname"];
      $email = $_POST["email"];
      $sql = "INSERT INTO myguests (firstname, lastname, email ,reg_date) VALUES (:firstname, :lastname, :email , NOW()) ";
      $stmt = $connect->prepare($sql);
      $stmt->bindParam(':firstname', $firstname);
      $stmt->bindParam(':lastname', $lastname  );
      $stmt->bindParam(':email', $email);
      try {
         $stmt -> execute();
         echo 'Inserted data into TABLE successfully';   
         
      } catch (Exception $aa) {
         echo 'INSERT DATA failed: ' . $aa->getMessage();
      }
}

?>
