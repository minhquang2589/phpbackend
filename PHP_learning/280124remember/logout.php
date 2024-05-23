<?php
session_start();
unset($_SESSION['username']);
setcookie("remember","",time()- 3600);
header('location: login.php');
die();
 ?>