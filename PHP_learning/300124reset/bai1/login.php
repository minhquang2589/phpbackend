<?php
require_once 'connect.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
   $Username = $_POST['Username'];
   $Password = $_POST['Password'];
   $PasswordSha = sha1($Password);
   $sql = "SELECT * FROM User WHERE Username = ? AND Password = ?";
   $stmt = $connect -> prepare($sql);
   $stmt -> bind_param('ss', $Username, $PasswordSha);
   $stmt -> execute();
   $result = $stmt -> get_result();
   if ($result -> num_rows > 0){
      session_start();
      $_SESSION['User'] = $Username;
      header('location: index.php');
   }else{
      echo 'Login Fail !';
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
      <h2>Login Form</h2>
      <table>
         <tr>
            <td><label for="Username">Username</label></td>
            <td><input type="text" id="Username" name="Username"></td>
         </tr>
         <tr>
            <td><label for="Password">Password</label></td>
            <td> <input type="Password" id="Password" name="Password"></td>
         </tr>
         <tr>
            <td><button type="submit">Login</button></td>
         </tr>
      </table>
   </form>
 </body>
 </html>