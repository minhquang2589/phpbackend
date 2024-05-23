<?php
include 'connect.php';
include 'utils.php';
   session_start();
   if (!isset($_SESSION['Username'])){
      header('location: login.php');
      die;
   }else {
      $error = [];
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $Username = santize($_POST['Username']);
         $Password = santize($_POST['Password']);
         $Email = santize($_POST['Email']);
         $Phone = santize($_POST['Phone']);
         //
         $passwordsha = sha1($Password);
         //
         $Avatar_Name  = $_FILES['Avatar']['name'];
         $Avatar_Tmp_Name = $_FILES['Avatar']['tmp_name'];
         $avatar_size = $_FILES['Avatar']['size'];
         $avatar_type = $_FILES['Avatar']['type'];
         $avatar_error = $_FILES['Avatar']['error'];
         $allowed = ['png', 'jpg', 'jpeg'];
         $avatar_ext = explode('.', $Avatar_Name);
         $avatar_actual_ext = strtolower(end($avatar_ext));
         if (in_array($avatar_actual_ext, $allowed)){
            if ($avatar_error === 0){
               if($avatar_size < 1000000){
                  $mime_type = mime_content_type($Avatar_Tmp_Name );
                  if ($mime_type != 'image/png' && $mime_type != 'image/jpg' && $mime_type != 'image/jpeg'){
                     $error[] = 'You Cant upload file of this type !';
                  }
                  $avatar_name_new = uniqid('', TRUE) . "." . $avatar_actual_ext;
                  move_uploaded_file($Avatar_Tmp_Name,$avatar_name_new);

                  $sql = "UPDATE User SET  Password = ?, Phone = ?, Avatar = ? , Email = ? WHERE Username = '{$_SESSION['Username']}';";
                  $stmt = $connect ->prepare($sql);
                  try{
                     $stmt -> bind_param('ssss',$passwordsha,$Phone,$avatar_name_new, $Email );
                     $stmt -> execute();
                     $error[] = 'Upload successfully !';
                  }catch(Exception $a){
                     $error[] = 'Upload failed !';
                  }
                  
               }else{
                  $error[] = 'Your file so Big !';
               }
            }else{
               $error[] = 'There was an error uploading your file !';
            }
         }else{
            $error[] = 'You cant updade file of this type !';
         }  
      }
   }
   
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Upload</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
   <div class="container">
      <div>
         <div> <h2>Upload Profile</h2></div>
         <div><h4><?php if (isset($_SESSION['Username'])){echo 'Welcome '. $_SESSION['Username']; }else{echo 'No';}?></h4></div>
         <form action="" method="POST" enctype="multipart/form-data">
            <label for="Password" >Password</label>
            <input type="Password" id="Password" name ="Password">
            <br>
            <label for="Phone">Phone Number</label>
            <input type="text" name="Phone" id="Phone" >
            <br>
            <label for="Avatar">Avatar :</label>
            <input type="FILE"  id="Avatar" name ="Avatar">
            <br>
            <label for="Email">Email</label>
            <input type="text" id="Email" name ="Email">
            <br>
            <button>Submit</button>
         </form>
         <?php foreach ($error as $val){
               echo $val."<br>";
            } 
         ?>
      </div>
   </div>
</body>
</html>