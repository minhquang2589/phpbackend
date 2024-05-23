<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Main Product</title>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
   <div class="container">
      <h3 class="mt-4">List Product</h3>
      <div id="list_product" class="list_product"></div>
   </div>
   <script>
   $(document).ready(async function () {
   localStorage.setItem('token', 'Bearer 8180fdf06e6694e4fab1f561d10601967dff7918cde2c03987072debd12f6e73');
      try {
         const response = await fetch('http://127.0.0.1:8000/api/product', {
            method: 'GET',
            headers: {
               'Authorization': 'Bearer ' + localStorage.getItem('token'),
            },
         });
         console.log(response); 
         if (!response.ok) {
            throw new Error('Network response was not ok. Status: ' + response.status);
         }
         const data = await response.json();
         renderProductList(data);
      } catch (error) {
         console.error('Error: There was an error message here');
      }
   });
   function renderProductList(products) {
    const table = $('<table class="table"></table>');
    table.append('<thead><tr><th>ID</th><th>Name</th><th>Brand Name</th><th>Price</th><th>Actions</th></tr></thead><tbody>');

    products.forEach(product => {
        const editButton = `<button class="btn btn-primary btn-sm" onclick="editProduct(${product.id})">Edit</button>`;
        const deleteButton = `<button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Delete</button>`;

        table.append(`<tr><td>${product.id}</td><td>${product.ProductName}</td><td>${product.BrandName}</td><td>${product.Price}</td><td>${editButton} ${deleteButton}</td></tr>`);
    });

    table.append('</tbody>'); 

    $('.list_product').html(table);
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
