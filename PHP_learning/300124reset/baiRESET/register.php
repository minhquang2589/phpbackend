<?php
include 'connect.php';
include 'utils.php';
$error = [];
if ($_SERVER['REQUEST_METHOD']== 'POST'){
   $Username = santize($_POST['Username']);
   $Password = santize($_POST['Password']);
   $passsha = sha1($Password);
   $Phone = santize($_POST['Phone']);
   if (empty($Username)){
      $error[]  = 'Username is reiquified !' ;
   }
   if (empty($Password)){
      $error[]  = 'Password is reiquified !';
   }
   if (empty($Phone)){
      $error[]  = 'Phone is reiquified';
   }
   $sql = "SELECT * FROM mydb_user WHERE USERNAME = ?";
   $stmt = $connect ->  prepare($sql);
   $stmt -> bind_param('s', $Username);
   try{
      $stmt -> execute();
      $result = $stmt ->get_result();
      if ($result -> num_rows > 0){
         $error[] = ' Error : người dùng đã tồn tại!';
      
      }
   }catch(Exception $e){
      $error[] = 'Error :'. $e->getMessage();
   }
   $sql = "INSERT INTO mydb_user values (?,?,?);";
   $stmt -> prepare($sql);
   $stmt -> bind_param('sss', $Username,$passsha, $Phone );
   try{
      $stmt -> execute();
      $error[] = 'Registration sucessfully';
   }catch(Exception $e){
      $error[] = 'Error :'. $e->getMessage();
   }
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
</head>
<body>
   <h1>registration form</h1>
   <form action="" method="POST">
      <label for="Username">Username</label>
      <input type="text" name="Username" id="Username">
      <br>
      <label for="Password" >Password</label>
      <input type="Password" id="Password" name ="Password">
      <br>
      <label for="Phone">Phone Number</label>
      <input type="text" name="Phone" id="Phone" >
      <br>
      <button>Registration</button>
   </form>
   <br>
   <?php
   foreach($error as $err){
      echo $err. '<br>';
   }
    ?>
</body>
</html>