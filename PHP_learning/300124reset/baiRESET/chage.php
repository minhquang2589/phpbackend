<?php
include 'connect.php';
include 'utils.php';
$error = [];
if ($_SERVER['REQUEST_METHOD']== 'POST'){
   $Username = santize($_POST['Username']);
   $CurrentPassword = santize($_POST['CurrentPassword']);
   $cpsha = sha1($CurrentPassword);
   $NewPassword = santize($_POST['NewPassword']);
   $npsha = sha1($NewPassword);

   if (empty($Username)){
      $error[] = ' Username is required';
   }
   if (empty($CurrentPassword)){
      $error[] = ' Current Password is required';
   }
   if (empty($NewPassword)){
      $error[] = ' New Password is required';
   }
   if (count($error) == 0){
      $sql = "SELECT * FROM mydb_user WHERE USERNAME = ? AND PASSWORD_HASH = ?;";
      $stmt -> prepare ($sql );
      $stmt -> bind_param ('ss', $Username,$cpsha);
      $stmt -> execute();
      $result = $stmt -> get_result();
      if ($result -> num_rows >0 ){
         $newpass = $npsha;
         $sql = "UPDATE mydb_user SET PASSWORD_HASH = ? WHERE USERNAME = ? AND PASSWORD_HASH = ?;";
         $stmt -> prepare ($sql);
         $stmt -> bind_param('sss', $newpass, $Username, $cpsha);
         try{
            $stmt -> execute();
            $error[ ] = 'change password Successfully';
         }catch(Exception $a){
            echo $a->getMessage();
         }
      }
   }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Chage</title>
</head>
<body>
   <h1>Chage Password form</h1>
   <form action="" method="POST">
      <label for="Username">Username</label>
      <input type="text" name="Username" id="Username">
      <br>
      <label for="CurrentPassword" >current Password</label>
      <input type="password" id="CurrentPassword" name ="CurrentPassword">
      <br>
      <label for="NewPassword" >New Password</label>
      <input type="password" id="NewPassword" name ="NewPassword">
      <br>
      <button>Chage</button>
   </form>
   <br>
   <?php
   foreach($error as $err){
      echo $err. '<br>';
   }
    ?>
</body>
</html>