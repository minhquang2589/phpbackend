<!-- -->
@extends('sa.sadashboard')
@section('title', 'Table')
<!--  -->
@section('content')
<div class="">
   <div class="flex justify-start mt-20 ml-20">
      <h1><strong class="text-3xl">Product Table</strong></h1>
   </div>
   <div class="flex justify-center mt-7	">
      <div class="overflow-x-auto mr-5 w-9/12 rounded-lg border border-gray-200">
      <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
         <thead class="ltr:text-left rtl:text-right">
            <tr>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Price</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Discount</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Final_Price</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Image</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Updated_at</th>
            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Action</th>
            </tr>
         </thead>
         @foreach($product as $product)
            <tbody class="divide-y divide-gray-200">
               <tr>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $product->id }}</td>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $product->name }}</td>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $product->price }}</td>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $product->discount }}</td>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $product->final_price }}</td>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                     <div class="w-full h-full lg:h-5/12 lg:w-5/12	">
                        <img
                           src="{{ asset('images/' . $product->image_link) }}"
                           alt="{{ $product->name }}"
                           class="  object-cover transition duration-500 group-hover:scale-105 "
                        />
                     </div>
                  
                  </td>
                  <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ $product->updated_at }}</td>
                  <td>
                     <form action="{{ route('productmanagement.delete', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Do you want to delete this user?')" type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full">
                           Delete
                        </button>
                     </form>

                  </td> 
                  <td>
                     <form action="{{ route('usermanagement.delete', ['id' =>$product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full">
                           Update
                        </button>
                     </form>
                  </td>
               </tr>
            </tbody>
         @endforeach
      </table>
      </div>
   </div>
</div>
    <!--  -->
@endsection
