<?php
   session_start();
   if(isset($_SESSION['username'])){
      echo '<h1>Wellcome' .' '.$_SESSION['username'].'</h1>';
      
   }else{
      header('location: login.php');
      die();
   }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hello</title>
</head>
<body>
   <form action="" method="POST">
      <table>
         <tr>
            <td><a href="logout.php">Logout !</a></td>
         </tr>
      </table>
   </form>
</body>
</html>