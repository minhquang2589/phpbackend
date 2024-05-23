<?php
include 'connect.php';
include 'utils.php';
$error = [];
if ($_SERVER['REQUEST_METHOD']== 'POST'){
   $Username = santize($_POST['Username']);
   $Password = santize($_POST['Password']);
   $passsha = sha1($Password);
   if (empty($Username)){
      $error[]  = 'Username is reiquified !' ;
   }
   if (empty($Password)){
      $error[]  = 'Password is reiquified !' ;
   }
   if (count($error) == 0){
      $sql = "SELECT * FROM mydb_user WHERE USERNAME = ? AND PASSWORD_HASH = ? ";
      $stmt = $connect ->  prepare($sql);
      $stmt -> bind_param('ss', $Username, $passsha);
      try{
         $stmt -> execute();
         $result = $stmt ->get_result();
         if ($result -> num_rows > 0){
            $error[] = 'Login Sucessfully !' ;
            $error[] = 'Hello ' . $Username . '!' ;
         
         }
      }catch(Exception $e){
         $error[] = 'lỗi: Đăng nhập khong thành công !';
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
   <h1>Login form</h1>
   <form action="" method="POST">
      <label for="Username">Username</label>
      <input type="text" name="Username" id="Username">
      <br>
      <label for="Password" >Password</label>
      <input type="Password" id="Password" name ="Password">
      <br>
      <button>Login</button>
   </form>
   <br>
   <?php
   foreach($error as $err){
      echo $err. '<br>';
   }
    ?>
</body>
</html>