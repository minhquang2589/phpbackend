<?php

require_once 'connect.php'; 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = ($_POST['Username']);
        $password = ($_POST['Password']);
        $password = sha1($password);
        $sql = "SELECT * FROM abc12users WHERE USERNAME = ?  AND PASSWORD_HASH =  ? ";
         $stmt = $connect->prepare($sql);
         $stmt->bind_param('ss', $username, $password);
         $stmt->execute();
         $result = $stmt->get_result();
         if ($result->num_rows > 0) {
            session_start();
            $_SESSION['username'] = $username;
            if(isset($_POST['remember'])){
               $remember = $_POST['remember'];
               setcookie('remember', $remember,time()+3600);

            }
               header('location: index.php');
               die;
         } else {
            echo 'Login failed';
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
   <Form action="" method="POST">
      <h1>Login </h1>
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
            <td><input for ="remember" type="checkbox"></td>
            <td><label for="remember" name ="remember" id="remember">remember me!</label></td>
         </tr>
         <tr>
            <td><button type="submit">Login</button></td>
         </tr>
      </table>
   </Form>
</body>
</html>