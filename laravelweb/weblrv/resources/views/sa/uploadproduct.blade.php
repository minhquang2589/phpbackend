
@extends('sa.sadashboard')

@section('title', 'Upload Product')
<!--  -->
<div>
    @error('product_name')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
<div>
    @error('price')
        <span class="text-red-500">{{ $message }}</span>
    @enderror
</div>
<!--  -->

@section('content')
<div class=""> 
   <div class="flex justify-start mt-20 mb-10 ml-20">
      <h3><strong class="text-3xl">Upload Product</strong></h3>
   </div>
   <form class="max-w-md mx-auto" method="POST" action="{{ route('upload.product') }}" enctype="multipart/form-data">
    @csrf
    <div class="relative z-0 w-full mb-5 group">
        <input  type="text" name="product_name" id="product_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
        <label for="product_name" name="product_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Product Name</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input require type="text" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
        <label for="price" name="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
    </div>

    <div class="max-w-lg">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Upload file</label>
        <input require class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="image" name="image" id="image" type="file">
    </div>
    <div class="mb-5 mt-4 w-full">
    <h2>Select Size</h2>
        <fieldset>
            <legend class="sr-only">Select Size</legend>
            <div class="space-y-2">
                <label for="size" class="flex cursor-pointer items-start gap-4">
                <div class="flex items-center">
                    &#8203;
                    <input name="size" value="s" for="size" type="checkbox" class="size-4 rounded border-gray-300" id="s" />
                </div>
                <div>
                    <strong class="font-medium text-gray-900">S</strong>
                </div>
                </label>
                <label for="size" class="flex cursor-pointer items-start gap-4">
                <div class="flex items-center">
                    &#8203;
                    <input name="size" value="m" for="size" type="checkbox" class="size-4 rounded border-gray-300" id="m" />
                </div>
                <div>
                    <strong class="font-medium text-gray-900"> M</strong>
                </div>
                </label>
                <label for="size" class="flex cursor-pointer items-start gap-4">
                <div class="flex items-center">
                    &#8203;
                    <input name="size" value="l" for="size" type="checkbox" class="size-4 rounded border-gray-300" id="l" />
                </div>
                <div>
                    <strong class="font-medium text-gray-900"> L</strong>
                </div>
                </label>
                <label for="size" class="flex cursor-pointer items-start gap-4">
                <div class="flex items-center">
                    &#8203;
                    <input name="size" value="xl" for="size" type="checkbox" class="size-4 rounded border-gray-300" id="xl" />
                </div>
                <div>
                    <strong class="font-medium text-gray-900"> XL</strong>
                </div>
                </label>
                <label for="size" class="flex cursor-pointer items-start gap-4">
                <div class="flex items-center">
                    &#8203;
                    <input name="size" value="2xl" for="size" type="checkbox" class="size-4 rounded border-gray-300" id="2xl" />
                </div>
                <div>
                    <strong class="font-medium text-gray-900"> 2XL</strong>
                </div>
                </label>
            </div>
        </fieldset>
            <!--  -->
        <h2>Select Color</h2>
            <fieldset>
                <legend class="sr-only">Select Size</legend>
                <div class="space-y-2">
                    <label for="color" class="flex cursor-pointer items-start gap-4">
                    <div class="flex items-center">
                        &#8203;
                        <input name="color" value="black" for="color" type="checkbox" class="size-4 rounded border-gray-300" id="black" />
                    </div>
                    <div>
                        <strong class="font-medium text-gray-900">Black</strong>
                    </div>
                    </label>
                    <label  for="color"class="flex cursor-pointer items-start gap-4">
                    <div class="flex items-center">
                        &#8203;
                        <input name="color" value="while"  for="color" type="checkbox" class="size-4 rounded border-gray-300" id="while" />
                    </div>
                    <div>
                        <strong class="font-medium text-gray-900">While</strong>
                    </div>
                    </label>
                    <label  for="color" class="flex cursor-pointer items-start gap-4">
                    <div class="flex items-center">
                        &#8203;
                        <input name="color" value="pink"  for="color" type="checkbox" class="size-4 rounded border-gray-300" id="pink" />
                    </div>
                    <div>
                        <strong class="font-medium text-gray-900">Pink</strong>
                    </div>
                    </label>
                    <label  for="color" class="flex cursor-pointer items-start gap-4">
                    <div class="flex items-center">
                        &#8203;
                        <input name="color" value="green"  for="color" type="checkbox" class="size-4 rounded border-gray-300" id="green" />
                    </div>
                    <div>
                        <strong class="font-medium text-gray-900">Green</strong>
                    </div>
                    </label>
                    <label for="color" class="flex cursor-pointer items-start gap-4">
                    <div class="flex items-center">
                        &#8203;
                        <input name="color" value="yellow" for="color" type="checkbox" class="size-4 rounded border-gray-300" id="yellow" />
                    </div>
                    <div>
                        <strong class="font-medium text-gray-900">Yellow</strong>
                    </div>
                    </label>
                </div>
            </fieldset>
            <!--  -->
            
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

</div>


@endsection