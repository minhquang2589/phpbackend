<?php
include 'connect.php';
include 'utils.php';
$error = [];
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $Username = $_POST['Username'];
      $Password = $_POST['Password'];
      $Password = sha1($Password);
      $sql = "SELECT * FROM User WHERE Username = ? AND Password = ?";
      $stmt = $connect -> prepare ($sql);
      $stmt -> bind_param('ss', $Username, $Password);
      $stmt -> execute();
      $result = $stmt -> get_result();
      if ($result -> num_rows > 0){
         session_start();
         $_SESSION['Username'] = $Username;
         header('location: upload.php');
      }else{
         header('location: register.php');
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
  <div class="container">
      <div> <h2>Login</h2></div>
      <form action="" method="POST" >
         <label for="Username">Username :</label>
         <input type="text" name="Username" id="Username" for="Username">
         <br>
         <label for="Password">Password :</label>
         <input type="Password" name="Password" id="Password" for="Password">
         <br>
         <button>Login</button>
      </form>

  </div> 
</body>
</html>