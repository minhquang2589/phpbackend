@extends ('layout.master')
@section('main_content')
   <div>
      <h2> Update Product</h2>
   </div>
@if(session('success'))
   <p style="color: green;">{{ session('success') }}</p>
@endif
@foreach ($product as $product)
@endforeach

<form action="{{ route('update-product', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group" >
         <label >Product Name</label>
         <input name="productname" type="text" class="form-control" id="productname" placeholder="Enter Product Name">
      </div>
      <div class="form-group">
         <label>Product Brand</label>
         <input name="brandname" type="text" class="form-control" id="brandname" placeholder="Enter Brand Name">
      </div>
      <div class="form-group">
         <label >Price</label>
         <input name="price" type="text" class="form-control" id="price" placeholder="Product Price">
      </div>
      <div class="form-group">
         <label >Product Image</label>
         <input name="image" type="file" class="form-control" id="image" placeholder="Upload Product Image">
      </div>
      <button type="submit" class="btn btn-primary mt-3">Update</button>
   </form>
   
@endsection
@section('page_title')
   Update Product
@endsection