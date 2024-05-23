<?php
include "utils.php";
include " addPHP.php";

$host = "localhost";
$username = "root";
$password = "";
$charset = 'utf8';

   try {
         $connect = new PDO("mysql:host=$host; charset=$charset", $username, $password);
         $connect -> setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
         $DBname = 'MyDatabases';
         $SqlCreateDb = "CREATE DATABASE IF NOT EXISTS $DBname";
         $connect -> exec($SqlCreateDb);
         $connect -> exec("USE $DBname");
         $SqlCreateTb = "CREATE TABLE IF NOT EXISTS myguests (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            firstname varchar (50) , 
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

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CRUD PHP</title>
</head>
<style>
   .info{
      border: 1px solid #999;
   }
   th{
      padding: 0px 20px 0px 20px;
   }

</style>
<body>
   
   <form action="addPHP.php" method="POST">
      <table>
         <tr>
            <td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
         </tr>
         <tr>
            <th><h1>Input</h1></th>
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
   <br>
   <br>
   <section>
      <table>
         
      <tr>
         <th><h1>Output</h1></th>
         </tr>
         <tr >
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Reg_date</th>
         </tr>
         <tr>
      <?php for ($i = 0; $i < count($product); $i++) : ?>
         <tr>
            <td class="info"><?php echo $product[$i]['id']; ?></td>
            <td class="info"><?php echo $product[$i]['firstname']; ?></td>
            <td class="info"><?php echo $product[$i]['lastname']; ?></td>
            <td class="info"><?php echo $product[$i]['email']; ?></td>
            <td class="info"><?php echo $product[$i]['reg_date']; ?></td>
            <td><a  href="update.php?id= <?=  $product[$i]['id'] ?> ">Update</a></td>
            <td><a  href="delete.php?id= <?=  $product[$i]['id'] ?>  ">Delete</a></td>
         </tr>
         </tr>
      <?php endfor; ?>
   </table>
   </section>
</body>
</html>
