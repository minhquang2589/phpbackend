<?php
require_once 'connect.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add</title>
</head>
<style>
   select:invalid {
      color: gray;
   }
</style>
<style>
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<body>
   <div class="container">
      <h1 ><p>Add Products</p></h1>
      <div class="cart-body">
         <form action="" method="POST">
            <div class="mt-3">
               <label for="productname form" class="form-label"><b>Product Name</b></label>
               <input type="text" class = "form-control" name ="productname" id="productname" placeholder="Enter Product Name" >
            </div>
            <div class="mt-3">
               <label for="productprice" class="form-label"><b>Product Price</b></label>
               <input type="text" class = "form-control" name ="productprice" id="productprice" >
            </div>
            <div class="mt-3">
               <label for="productimg" class="form-label"><b>Product Image</b></label>
               <input type="file" class = "form-control" name ="productimg" id="productimg" >
            </div>
            <div class="mt-3">
               <label for="productcategory" class="form-label"><b>Product Category</b></label>
               <select name="productcategory" id="productcategory" class="form-control">
                  <option value="" disabled selected hidden>Select Category...</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
               </select>
            </div>
            <div class="mt-3">
               <label for="productbrand" class="form-label"><b>Product Brand</b></label>
               <select  name="productbrand" id="productbrand"  class="form-control">
                  <option value="" class="" disabled selected hidden>Select Brand...</option>
                  <option value="Apple">Apple</option>
                  <option value="Samsung">Samsung</option>
                  <option value="Xiaomi">Xiaomi</option>
                  <option value="Nokia">Nokia</option>
               </select>
            </div>
            <div class="mt-3">
               <label for="productdes" class="form-label"><b>Product Description</b></label>
               <input type="text" class = "form-control" name ="productdes" id="productdes" >
            </div>
            <div>
               <button class="btn btn-success mt-3">Submit</button>
            </div>
         </form>
      </div>

   </div>
  
</body>
</html>