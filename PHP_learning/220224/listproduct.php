<?php
require_once 'connect.php';
require_once 'utils.php';
$error = [];
   $sql = "SELECT * FROM products;";
   $result1 = $install -> getConnect() -> query( $sql);
   $sql = "SELECT * FROM productcate;";
   $result2 = $install -> getConnect() -> query( $sql);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product</title>
</head>
<style>
   img {
         max-width: 100px;
   }
   table{
      border: 1px solid #ddd;
   }
   th, td {
         border: 2px solid #ddd;
         padding: 8px;
         margin-right: 4px;
         text-align: left;
      }
   .header {
      justify-content: space-between;
      display: flex;
   }
   .btn-success{ 
    height: 40px;
    margin: 0px;
   }
</style>
<style>
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
   <div class="container">
      <div class="header mt-4">
         <h1 ><p>List Products</p></h1>
         <h1 class="btn btn-success"><a style="color: white; text-decoration: none;" href="add.php">Add New</a></h1>
      </div>
      <div class="table table-responsive mt-3">
         <table>
         <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Brand Name</th>
            <th>Category Name</th>
            <th>Action</th>
         </tr>
         <?php
            if ($result1 && $result2) {
               while (($row1 = $result1->fetch_assoc()) && ($row2 = $result2->fetch_assoc())) {
                  echo '<tr>';
                  echo '<td><img src="upload/' . $row1['Image'] . '" alt=" Image"></td>';
                  echo '<td>' . $row1['Product_Name'] . '</td>';
                  echo '<td>' . $row1['Price'] . '</td>';
                  echo '<td>' . $row1['Brand_Name'] . '</td>';
                  echo '<td>' . $row2['Cate_Name'] . '</td>';
                  echo '<td class="btn btn-danger mt-1 "><a onclick = "confirmDelete(event)" style="color: white; text-decoration: none" href="delete.php?id=' . $row1['id'] . '">Delete</a></td>';
                  echo '<td class="btn btn-success mt-1 "><a style="color: white; text-decoration: none"href="edit.php?id=' . $row1['id'] . $row2['id'] . '">Edit</a></td>';          
                  echo '</tr>';
               }
            
            }
            ?>
         </tr>
         </table>
      </div>
   </div>
</body>
</html>