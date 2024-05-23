<?php
include 'connect.php';
include 'utils.php';
$error = [];
if ($_SERVER['REQUEST_METHOD']== 'POST'){
   $Username = santize($_POST['Username']);
   $Phone = santize($_POST['Phone']);
   $sql = "SELECT * FROM mydb_user WHERE USERNAME = ? AND PHONE = ? ;";
   $stmt -> prepare($sql);
   try {
      $stmt -> bind_param('ss', $Username, $Phone);
      $stmt -> execute();
      $result = $stmt -> get_result();
      if ($result -> num_rows == 0){
         $error[] = 'USER not found !';
      }
      $newpass = randompass();
      $newpassHASH = sha1($newpass);
      $sql = "UPDATE mydb_user SET PASSWORD_HASH = ? WHERE USERNAME = ?;";
      $stmt -> prepare($sql);
      try{
         $stmt -> bind_param('ss', $newpassHASH, $Username);
         $stmt -> execute();
         $error[] = 'New Password :'. $newpassHASH;
      }catch (exception $a){
         $error[] = $a->getMessage();
      }
   }catch (Exception $e){
      $error[] = $e->getMessage();
   }

   
   
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>reset</title>
</head>
<body>
   <h1>Reset password form</h1>
   <form action="" method="POST">
      <label for="Username">Username</label>
      <input type="text" name="Username" id="Username">
      <br>
      <label for="Phone" >Phone Number</label>
      <input type="Phone" id="Phone" name ="Phone">
      <br>
      <button>Reset</button>
   </form>
   <br>
   <?php
   foreach($error as $err){
      echo $err. '<br>';
   }
    ?>
</body>
</html>