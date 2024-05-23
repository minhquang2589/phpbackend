@extends ('layout.master')
@section('main_content')
   <div>
      <h3>List Product</h3>
   </div>
@if(session('success') !== null)
   <div>
      <span>{{ session('success') }}</span>
   </div>
@endif
@if(session('error') !== null)
   <div>
      <span style="color: red;">{{ session('error') }}</span>
   </div>
@endif

   <table class="table table-hover">
      <thead>
         <tr>
            <th scope="col">Image</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
      @foreach ($listproduct as $product)
      <tr>
         <td style="width: 150px;"><img src="{{ asset($product->Image) }}" alt="{{ $product->ProductName }}" class="w-full"></td>
         <td class="text-lg "> {{ $product -> ProductName }}</td>
         <td><p class="text-sm">{{ $product['Price']}}đ</p></td>
         <td>
         <form method="POST" action="{{ route('delete-product', $product->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
         </form>
         </td>
         <td><a href="{{ route('update-product', $product->id) }}" class="btn btn-sm btn-primary">Update</a></td>
      </tr>
         @endforeach
      </tbody>
   </table>

@endsection

@section('page_title')
   List Products
@endsection