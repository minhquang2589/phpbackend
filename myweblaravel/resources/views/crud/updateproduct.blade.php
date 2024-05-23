@extends('dashboard')

@section('title', 'Update Products')
<!--  -->

<!--  -->
@section('content')
<div class="mx-6 lg:mx-0">
   <div class="flex justify-start mt-14 mb-10 ml-20">
      <h3><strong class="text-3xl">Update Product</strong></h3>
   </div>
   <div class="flex justify-center">
      <div class="mb-4">
         <div>
            <table class="lg:w-1/2 w-full mx-2 lg:mx-0 divide-gray-200 bg-white text-sm">
               <thead class="ltr:text-left rtl:text-right">
                  <tr>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Ảnh chính</th>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Name</th>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Price</th>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Color</th>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Size</th>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Discount</th>
                     <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Is_New</th>
                  </tr>

               </thead>
               <tbody class=" divide-gray-200">
                  <tr>
                     <td class=" text-gray-900">
                        <div class="w-28 h-28">
                           <img src="{{ asset('images/' . $product -> image) }}" alt="{{ $product->name }}" class="object-cover transition duration-500 group-hover:scale-105" />
                        </div>
                     </td>
                     <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{$product->name}}</td>
                     <td class="whitespace-nowrap px-4 py-2 text-gray-900">{{ number_format($product->price/ 1000, 3, ',', ',') }}đ</td>
                     <td class="text-[11px] pl-4 py-2 text-gray-900 ">
                        @foreach($stock->where('product_id', $product->id) as $productVariant)
                        @if($productVariant->color)
                        {{ $productVariant->color->color }}
                        <span class="flex items-center">
                           <span class="h-px flex-1 bg-gray-500"></span>
                        </span>
                        @endif
                        @endforeach
                     </td>
                     <td class=" py-2 text-[11px] text-gray-900">
                        @foreach($stock->where('product_id', $product->id) as $productVariant)
                        @if($productVariant->size)
                        {{ $productVariant->size->size }} - {{ $productVariant->quantity }}
                        <span class="flex items-center">
                           <span class="h-px flex-1 bg-gray-500"></span>
                        </span>
                        @endif
                        @endforeach
                     </td>
                     <td class="whitespace-nowrap px-4 py-2 text-gray-900">
                        @if (isset($discountInfo->discount))
                        {{ $discountInfo-> discount}}% -
                        {{ $discountInfo-> total_quantity}}
                        @else
                        <span class="rounded-full ml-2 text-white bg-red-600 px-2 py-1 text-xs">No</span>
                        @endif
                        <br>

                     </td>
                     <td class="px-4 py-2 text-gray-900">
                        @if ($product->is_new)
                        <p class="rounded-full ml-2 text-white bg-red-600 px-2 py-1 text-xs">new</p>
                        @else
                        <p class="rounded-full ml-2 text-white bg-red-600 px-3 py-1 text-xs">Not new</p>
                        @endif
                     </td>
                  </tr>
               </tbody>
            </table>
            <p class="font-medium text-gray-900 text-sm ml-5">Ảnh phụ</p>
            <span class="flex items-center">
               <span class="h-px flex-1 bg-gray-500"></span>
            </span>
         </div>
         <div>

            <table class="lg:w-1/2 w-full mx-2 lg:mx-0 divide-gray-200 bg-white text-sm">
               <tbody class=" divide-gray-200">

                  <tr>
                     @foreach($productImages as $value)
                     <td class=" text-gray-900">
                        <div class="w-28 h-28">
                           <img src="{{ asset('images/' . $value -> image) }}" alt="Images" class="object-cover transition duration-500 group-hover:scale-105" />
                        </div>
                     </td>

                     @endforeach
                  </tr>
               </tbody>
            </table>
         </div>
         <span class="flex items-center mb-3">
            <span class="h-px flex-1 bg-gray-500"></span>
         </span>
      </div>
   </div>
   <form class="max-w-md mx-auto" method="POST" action="{{ route('update.product', ['id' => $product->id]) }}" enctype="multipart/form-data">
      @csrf
      @if (session('success'))
      <div class="alert text-blue-600 alert-success mb-3">
         <strong>{{ session('success') }} </strong>
      </div>
      @endif
      <input type="hidden" name="product_id" value="{{$product->id}}">

      <div class="relative z-0 w-full mb-5 group">
         <input type="text" value="{{$product->name}}" name="product_name" id="product_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
         <label for="product_name" name="product_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Product Name</label>
      </div>
      <div class="relative z-0 w-full mb-2 group">
         <input require type="text" value="{{$product->price}}" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
         <label for="price" name="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
      </div>
      <div class="relative z-0 w-full mb-3 group">
         <label class="sr-only" for="description" name="description">Giới thiệu</label>
         <textarea name="description" id="description" class="w-full border rounded-lg border-gray-700 p-3 text-sm" placeholder="mô tả chi tiết sản phẩm" rows="4">{{$product->description}}</textarea>
      </div>
      <div class="max-w-lg">
         <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Ảnh chính</label>
         <input require class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="images" name="images" id="images" type="file">
      </div>
      <span class="flex items-center mt-4">
         <span class="h-px flex-1 bg-gray-500"></span>
      </span>
      <!--  -->
      @foreach($productImages as $key => $image)
      <div class="mb-5">
         <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400" for="image{{ $key + 1 }}">Image {{ $key + 1 }}</label>
         <input name="image{{ $key + 1 }}" id="image{{ $key + 1 }}" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
         <input type="hidden" name="image_id{{ $key + 1 }}" id="image_id{{ $key + 1 }}" value="{{ $image->id }}">
      </div>
      @endforeach

      <!--  -->
      <div class="mb-5 mt-6 w-full">
         <div class="form-group flex">
            <label>
               <input class="size-4 rounded border-gray-300" type="checkbox" name="is_new" {{ $product->is_new == 1 ? 'checked' : '' }}>
               <span class="text-red-600 ml-3">New</span>
            </label>
         </div>
         <div class="flex">
            <div>
               <label for="color1" id="color1" class="flex cursor-pointer items-start gap-4">
                  <div class="flex items-center mb-1">
                     &#8203;
                     <input id="color1Input" name="Red" type="checkbox" class="size-4 rounded border-gray-300" />
                  </div>
                  <div>
                     <strong class="font-medium text-gray-900">Red</strong>
                  </div>
               </label>
            </div>
            <div class="flex justify-start ml-5">
               <div id="quantity-options1" style="display: none;" class="mb-3">
                  <input type="number" name="Red[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Red[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Red[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Red[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Red[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
               </div>
            </div>
         </div>
         <div class="flex">
            <div>
               <label for="color2" id="color2" class="flex cursor-pointer items-start gap-4">
                  <div class="flex items-center mb-1">
                     &#8203;
                     <input name="Black" id="color2Input" type="checkbox" class="size-4 rounded border-gray-300" />
                  </div>
                  <div>
                     <strong class="font-medium text-gray-900">Black</strong>
                  </div>
               </label>
            </div>
            <div class="flex justify-start ml-5">
               <div id="quantity-options2" style="display: none;" class="mb-3">
                  <input type="number" name="Black[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Black[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Black[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Black[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Black[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
               </div>
            </div>
         </div>
         <div class="flex">
            <div>
               <label for="color3" id="color3" class="flex cursor-pointer items-start gap-4">
                  <div class="flex items-center mb-1">
                     &#8203;
                     <input name="White" id="color3Input" type="checkbox" class="size-4 rounded border-gray-300" />
                  </div>
                  <div>
                     <strong class="font-medium text-gray-900">White</strong>
                  </div>
               </label>
            </div>
            <div class="flex justify-start ml-5">
               <div id="quantity-options3" style="display: none;" class="mb-3">
                  <input type="number" name="White[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="White[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="White[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="White[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="White[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
               </div>
            </div>
         </div>
         <div class="flex">
            <div>
               <label for="color4" id="color4" class="flex cursor-pointer items-start gap-4">
                  <div class="flex items-center mb-1">
                     &#8203;
                     <input name="Blue" id="color4Input" type="checkbox" class="size-4 rounded border-gray-300" />
                  </div>
                  <div>
                     <strong class="font-medium text-gray-900">Blue</strong>
                  </div>
               </label>
            </div>
            <div class="flex justify-start ml-5">
               <div id="quantity-options4" style="display: none;" class="mb-3">
                  <input type="number" name="Blue[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Blue[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Blue[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Blue[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Blue[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
               </div>
            </div>
         </div>
         <div class="flex">
            <div>
               <label for="color5" id="color5" class="flex cursor-pointer items-start gap-4">
                  <div class="flex items-center mb-1">
                     &#8203;
                     <input name="Yellow" id="color5Input" type="checkbox" class="size-4 rounded border-gray-300" />
                  </div>
                  <div>
                     <strong class="font-medium text-gray-900">Yellow</strong>
                  </div>
               </label>
            </div>
            <div class="flex justify-start ml-5">
               <div id="quantity-options5" style="display: none;" class="mb-3">
                  <input type="number" name="Yellow[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Yellow[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Yellow[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Yellow[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Yellow[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
               </div>
            </div>
         </div>
         <div class="flex">
            <div>
               <label for="color6" id="color6" class="flex cursor-pointer items-start gap-4">
                  <div class="flex items-center mb-1">
                     &#8203;
                     <input name="Green" id="color6Input" type="checkbox" class="size-4 rounded border-gray-300" />
                  </div>
                  <div>
                     <strong class="font-medium text-gray-900">Green</strong>
                  </div>
               </label>
            </div>
            <div class="flex justify-start ml-5">
               <div id="quantity-options6" style="display: none;" class="mb-3">
                  <input type="number" name="Green[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Green[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Green[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Green[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                  <input type="number" name="Green[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class="block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
               </div>
            </div>
         </div>
         <div class="flex justify-start lg:flex lg:justify-start">
            <button type="submit" id="submit-button" class="text-white mt-6 bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-1/2 sm:w-auto px-20 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
         </div>
   </form>
</div>
</div>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      ['color1', 'color2', 'color3', 'color4', 'color5', 'color6'].forEach(function(colorId) {
         var checkbox = document.getElementById(colorId + 'Input');
         var quantityOptions = document.getElementById('quantity-options' + colorId.substring(5));

         checkbox.addEventListener('change', function() {
            if (this.checked) {
               quantityOptions.style.display = 'block';
            } else {
               quantityOptions.style.display = 'none';
            }
         });
      });
   });
</script>

@endsection