<?php
include "create.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   if (isset($_POST['username']) && isset($_POST['password'])) {
       $username = $_POST['username'];
       $password = $_POST['password'];

       $select = "SELECT * FROM `User` WHERE `Username` = ? AND `Password` = ?";
       $stmt = $connect->prepare($select);
       $stmt->bindParam(1, $username, PDO::PARAM_STR); 
       $stmt->bindParam(2, $password, PDO::PARAM_STR); 
       $stmt->execute();

       $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

       if (count($result) > 0) {
           session_start();
           $_SESSION['User'] = $username;
           header("location: index.php");
           die();
       } else {
           echo "User not found";
       }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
</head>
<body>
   <form action="" method="POST">
      <table>
         <h2>Login</h2>
         <tr>
            <td><label for="username">Username</label></td>
            <td><input type="text" name="username" id="username"></td>
         </tr>
         <tr>
            <td><label for="password">Password</label></td>
            <td><input type="password" id="password" name="password"></td>
         </tr>
         <tr>
            <td><button type="submit">Login</button></td>
         </tr>
      </table>
   </form>
</body>
</html>
