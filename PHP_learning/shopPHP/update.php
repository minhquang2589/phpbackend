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
   $id = sanitizer($_POST['id']);
   $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $email = $_POST['email'];

   $sql = "UPDATE myguests SET firstname = :firstname, lastname = :lastname, email = :email, reg_date = NOW() WHERE id = :id";
   $stmt = $connect->prepare($sql);
   $stmt->bindParam(':firstname', $firstname);
   $stmt->bindParam(':lastname', $lastname);
   $stmt->bindParam(':email', $email);
   $stmt->bindParam(':id', $id);

   try {
      $stmt->execute();
      echo 'UPLOAD DATA into TABLE successfully';
   } catch (PDOException $aa) {
      echo 'UPLOAD DATA failed: ' . $aa->getMessage();
   }
}


?>
<style>
   .info{
      border: 1px solid #999;
   }
   th{
      padding: 0px 20px 0px 20px;
   }

</style>
<body>
   <form action="update.php" method="POST">
      <table>
         <tr>
            <th><h1>Input Update </h1></th>
         </tr>
         <tr>
            <td><label >Firstname :</label></td>
            <td><input type="text"  name = "firstname" id="firstname" ></td>
         </tr>
         <tr>
            <td><label>Lastname :</label></td>
            <td><input type="text" name = "lastname" id="lastname"></td>
         </tr>
         <tr>
            <td><label >Email :</label></td>
            <td> <input type="text " name = "email" id=" email"> </td>
         </tr>
         <tr>
            <td><button type="submit" value="submit">SEND</td>
            
         </tr>
      </table>
   </form>
</body>
