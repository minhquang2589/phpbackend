<?php
require_once 'connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $Username = htmlspecialchars($_POST['Username']);
   $Password = htmlspecialchars($_POST['Password']);
   $Phone = htmlspecialchars($_POST['Phonenumber']);
   $kiemTraUsernameQuery = "SELECT * FROM abc12users WHERE USERNAME = '$Username'";
   $kiemTraKetQua = $connect->query($kiemTraUsernameQuery);
    if ($kiemTraKetQua->num_rows > 0) {
        echo 'Lỗi: Tên người dùng đã tồn tại';
    } else {
        $sql = 'INSERT INTO abc12users (USERNAME, PASSWORD_HASH, PHONE) VALUES (?,?,?) ';
        $stmt = $connect->prepare($sql);
        try {
            $stmt->bind_param('sss', $Username, sha1($Password), $Phone);
            $stmt->execute();
            echo 'registration successful';
        } catch (Exception $e) {
            echo 'fail: ' . $e->getMessage();
        }
    }
}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration</title>
 </head>
 <body>
   <form action="" method="POST">
      <h2>Registration Form</h2>
      <table>
         <tr>
            <td><label for="Username" id="Username" name="Username">Username</label></td>
            <td><input type="text" id="Username" name="Username"></td>
         </tr>
         <tr>
            <td><label for="Password" id="Password" name="Password">Password</label></td>
            <td><input type="Password" id="Password" name="Password"></td>
         </tr>
         <tr>
            <td><label for="Phonenumber" id="Phonenumber" name="Phonenumber">Phone Number</label></td>
            <td><input type="phone" id="Phonenumber" name="Phonenumber" ></td>
         </tr>
         <tr>
            <td><button type="submit">Registration</button></td>
         </tr>
      </table>
   </form>
 </body>
 </html>