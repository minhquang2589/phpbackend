<?php
include 'config.php';

session_start();
if(!isset($_SESSION["User"])){
   header("location: login.php");
   die();
}else{
   // header("location: login.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product Management</title>
</head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <style>
   th{
      border: 2px solid;
      margin: 5px 10px 5px 10px !important;
      padding: 0px 10px 0px 10px !important;
   }
   td{
      border: 1px solid;
      margin: 0px 2px 0px 2px !important;
      padding: 0px 10px 0px 10px !important;
   }
   tr{
      margin: 5px 10px 5px 10px !important;
   }
   .tablee {
      padding: 0px 5px 0px 5px;
   }
 </style>
<body>
   <?php include "header.php"; ?>
      <div class="container">
            <div class = "main">
               <div class="row ">
                  <div class ="col-3 sidebar-warp">
                     <?php include "sidebar.php"; ?>
                  <div class ="col-9 main-warp">
                  <?php
                   include "ListProduct.php";
                  ?>
                  </div>
               </div>
            </div>
      </div>
      
   <?php include "footer.php"; ?>
</body>
</html>