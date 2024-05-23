<script>
   function confirmDelete(event){
      event.preventDefault();
      let cf = confirm ("Are you sure you want Delete");
      if (cf){
         let url = event.currentTarget.getAttribute("href");
         window.location.href = url;
      }
   }
</script>
<body>
   <div>
      <div><h2>Product List</h2></div>
         <div class = " d-flex justify-content-end">
            <div class="btn btn-success "><a style="color: white; text-decoration: none" href="addproduct.php">Add Product</a></div>
         </div>
      <div>
         <table  class="tablee"   >
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Created_at</th>

            </tr> 
            <?php
               include "create.php";
                  if (isset($product)) {
                     for ($i = 0; $i < count($product); $i++) {
                        echo '<tr> ';
                        echo '<td>' . $product[$i]['ID'] . '</td>';
                        echo '<td>' . $product[$i]['Name'] . '</td>';
                        echo '<td>' . $product[$i]['Price'] . '</td>';
                        echo '<td>' . $product[$i]['Quantity'] . '</td>';
                        echo '<td>' . $product[$i]['Created_at'] . '</td>';
                        echo '<td class="btn btn-danger "><a style="color: white; text-decoration: none" onclick="confirmDelete(event);" href="delete.php?id=' . $product[$i]['ID'] . '">Delete</a></td>';
                        echo '<td class="btn btn-success ">' . '<a style="color: white; text-decoration: none" href="update.php?id=' . $product[$i]['ID'] . '">Update</a>' . '</td>';
                     }
                  }
            ?>
         </table>
      </div>
   </div>

