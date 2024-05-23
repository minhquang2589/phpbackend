<?php
require_once 'connect.php';
require_once 'utils.php';
$error = [];
if ($_SERVER['REQUEST_METHOD']=='POST'){
   $productname = santize($_POST['productname']);
   $productprice = santize($_POST['productprice']);
   $productcategory = isset($_POST['productcategory']) ? $_POST['productcategory'] : '';
   $productbrand = isset($_POST['productbrand']) ? $_POST['productbrand'] : '';
   $productdes = santize($_POST['productdes']);

   if (isset($_FILES['productimg'])){
      $productimg = $_FILES['productimg'];
      $img_name = $productimg['name'];
      $img_tmp_name = $productimg['tmp_name'];
      $img_size = $productimg['size'];
      $img_error = $productimg['error'];
      $img_type = $productimg['type'];
      $img_ext = explode('.', $img_name);
      $img_actual_ext = strtolower(end ($img_ext));
      $allowed = array('jpg', 'png', 'jpeg','gif');
         if(in_array($img_actual_ext,  $allowed)){
            if($img_error === 0){
               if ($img_size < 1000000){
                  $type = mime_content_type ($img_tmp_name);
                  if ($type != 'image/jpg' && $type != 'image/png' && $type != 'image/jpeg' && $type != 'image/gif'){
                     $error[] = 'you cannot upload file of this type !';
                  }
                  if ($img_error !== 0) {
                     $error[] = 'Upload Error: ' . $img_error;
                 }
                 chmod('upload', 0777);
                 
                 if (!file_exists('upload')) {
                  mkdir('upload', 0777, true);
                  }
                 $img_new_name = uniqid('', TRUE) . '.' . $img_actual_ext;
                 $img_description = 'upload/' . $img_new_name;
                 
                 if (move_uploaded_file($img_tmp_name, $img_description)) {
                  //
                  } else {
                        $error[] = 'Upload Fail';
                        $error[] = 'Move Error: ' . error_get_last()['message'];
                  }
                  $sql = "INSERT INTO productcate (Cate_Name) VALUES (?);";
                  $stmt = $install->getConnect()->prepare($sql);
                  $stmt->bind_param('s', $productcategory);
                  try {
                     $stmt->execute();
                     $lastCategoryId = $stmt->insert_id;
                     $sql = "INSERT INTO products (Product_name,Cate_id, Product_Description, Brand_Name, Price, Image) values (?,?,?,?,?,?);";
                     $stmt = $install->getConnect()->prepare($sql);
                     $stmt->bind_param('ssssis', $productname,$lastCategoryId, $productdes, $productbrand, $productprice, $img_new_name);

                     try {
                        $stmt->execute();
                        $imageSrc = 'upload/' . $img_new_name;
                     } catch (Exception $a) {
                        $error[] = 'Lỗi: ' . $a->getMessage();
                     }
               } catch (Exception $a) {
                     $error[] = 'Lỗi: ' . $a->getMessage();
               }
            }
         }
      }
   }
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product</title>
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
         <form action="" method="POST" enctype="multipart/form-data">
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
               <?php if ($imageSrc): ?>
                <div class="avatar-warp mt-2">
                    <img style="max-width: 300px;" src="<?php echo $imageSrc; ?>" alt="Product Image">
                </div>
            <?php endif; ?>
            </div>
            <div class="mt-3">
               <label for="productcategory" class="form-label"><b>Product Category</b></label>
               <select name="productcategory" id="productcategory" class="form-control">
                  <option value="" disabled selected hidden>Select Category...</option>
                  <option value="Computer">Computer</option>
                  <option value="Smartphone">Smartphone</option>
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
               <input type="text" class = " form-control" name ="productdes" id="productdes" >
            </div>
            <div>
               <button class="btn btn-success mt-3">Submit</button>
            </div>

            <?php
               foreach ( $error as $error){
                  echo $error. '<br />';
               }
             ?>
         </form>
      </div>
   </div>
</body>
</html>