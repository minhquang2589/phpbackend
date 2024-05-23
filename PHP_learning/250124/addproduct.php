<?php
include 'create.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $Name = $_POST['Name'];
   $Price = $_POST['Price'];
   $Quantity = $_POST['Quantity'];
   
   $sql = "INSERT INTO Person (Name, Price, Quantity, Created_at) VALUES (?, ?, ?, NOW())";
   $stmt = $connect->prepare($sql);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Product</title>
</head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
   <?php include "header.php"; ?>
      <div class="container">
            <div class = "main">
               <div class="row ">
                  <div class ="col-3 sidebar-warp">
                     <?php include "sidebar.php"; ?>
                  <div class ="col-9 main-warp">
                     <form action="" method = "POST">
                     <h1>ADD Product</h1>
                     <div class = " d-flex justify-content-end">
                     <div class="btn btn-success "><a style="color: white; text-decoration: none" href="index.php">Back To ListProduct</a></div>
                     </div>
                        <table>
                           <form action="" method="POST">
                              <tr>
                                 <td><label for="Name">Name</label></td>
                                 <td><input type="text" id="Name" name="Name"></td>
                              </tr>
                              <tr>
                                 <td><label for="Price">Price</label></td>
                                 <td><input type="number" id="Price" name="Price"></td>
                              </tr>
                              <tr>
                                 <td><label for="Quantity">Quantity</label></td>
                                 <td><input type="number" id="Quantity" name="Quantity"></td>
                              </tr>
                              <tr>
                                 <td><button class="btn btn-success " type="submit">SUBMIT</button></td>
                              </tr>
                              <tr>
                                 <td>
                                    <?php 
                                       try {
                                          $stmt->bindParam(1, $Name);
                                          $stmt->bindParam(2, $Price);
                                          $stmt->bindParam(3, $Quantity);
                                          $stmt->execute();
                                          header('location:'.'index.php');
                                       } catch (PDOException $aa) {
                                             echo 'Add Product Fail!' . $aa->getMessage();
                                       }
                                     ?>
                                 </td>
                              </tr>
                           </form>
                        </table>
                     </form>
                  </div>
               </div>
            </div>
      </div> 
   <?php include "footer.php"; ?>
</body>
</html>