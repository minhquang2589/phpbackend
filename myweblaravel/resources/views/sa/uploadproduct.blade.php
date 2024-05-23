@extends('dashboard')
@section('title', 'Upload Product')
@section('content')
<div class="mx-6 lg:mx-0 ">
    <div class="flex justify-start mt-14 mb-10 ml-20">
        <h3><strong class="text-3xl">Upload Product</strong></h3>
    </div>
    <form id="imageUploadForm" action="/upload" class="dropzone">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

    <form class="max-w-md mx-auto " method="POST" action="{{ route('uploadproduct') }}" enctype="multipart/form-data">
        @csrf
        <div class="relative z-0 w-full mb-5 mt-4 group">
            <input type="text" name="product_name" id="product_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="product_name" name="product_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Product Name</label>
        </div>
        <div class="relative z-0 w-full mb-2 group">
            <input require type="text" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="price" name="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price</label>
        </div>
        <div class="mt-1">
            <label class="sr-only" for="description" name="description">Giới thiệu</label>
            <textarea name="description" id="description" class="w-full border rounded-lg border-gray-700 p-3 text-sm" placeholder="mô tả chi tiết sản phẩm" rows="4"></textarea>
        </div>

        <!--  -->
        <div class="relative z-0 w-full mt-4 mb-5 group">
            <input type="text" name="detail1" id="detail1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="detail1" name="detail1" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">miêu tả</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="detail2" id="detail2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="detail2" name="detail2" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">đặc điểm 1</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="detail3" id="detail3" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="detail3" name="detail3" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">đặc điểm 2</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="detail4" id="detail4" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="detail4" name="detail4" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">đặc điểm 3</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="detail5" id="detail5" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="detail5" name="detail5" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">đặc điểm 4 </label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <input type="text" name="detail6" id="detail6" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" />
            <label for="detail6" name="detail6" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">đặc điểm 5</label>
        </div>

        <!--  -->
        <div class="max-w-lg">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Ảnh Chính</label>
            <input require class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="images" name="images" id="images" type="file">
        </div>
        <!--  -->
        <div class=" mb-1">Ảnh phụ</div>
        <div class="mb-1">
            <input name="image1" id="image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        </div>
        <div class="mb-1">
            <input name="image2" id="image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        </div>
        <div class="mb-1">
            <input name="image3" id="image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        </div>
        <div class="mb-1">
            <input name="image4" id="image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        </div>
        <div class="mb-1">
            <input name="image5" id="image" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
        </div>

        <!--  -->
        <div class="mt-4">
            <div class="w-full mr-5">
                <div class="">
                    <select id="gender" for="gender" name="gender" class="block w-full px-3 sm:px-3 lg:px-5 pt-2 pb-1 text-sm text-grey-darker border border-grey-lighter rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option hidden selected disabled>Choose a gender</option>
                        <option for="gender" value="Men">Men</option>
                        <option for="gender" value="Women">Women</option>
                        <option for="gender" value="Unisex">Unisex</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <label for="start_datetime" class="text-sm">Start discount:</label>
            <input type="datetime-local" class="text-sm" id="start_datetime" name="start_datetime">
            <br>
            <label for="end_datetime" class="text-sm">End discount:</label>
            <input type="datetime-local" id="end_datetime" class="text-sm" name="end_datetime">
            <br>
            <div class="flex my-3">
                <input type="number" name="discountnumber" placeholder="Discount %" min="1" max="100" oninput="validity.valid||(value='');" class=" w-2/3  px-3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                |
                <input type="number" name="discountquantity" placeholder="Discount Quantity" min="0" oninput="validity.valid||(value='');" class=" w-2/3  px-3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
            </div>
        </div>
        <div class="mb-5 mt-2 w-full">
            <div class="form-group flex">
                <label>
                    <input class="size-4 rounded border-gray-300" type="checkbox" name="is_new" value="1">
                    <span class="text-red-600 ml-3"><strong>New</strong></span>
                </label>
            </div>
            <div class="flex">
                <div>
                    <label for="color1" id="color1" class="flex cursor-pointer items-start gap-4">
                        <div class="flex items-center mb-1">
                            &#8203;
                            <input name="Red" id="color1Input" type="checkbox" class="size-4 rounded border-gray-300" />
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
                        <input type="number" name="Green[S]" placeholder="Quantity for S" min="0" oninput="validity.valid||(value='');" class="product_quantity block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                        <input type="number" name="Green[M]" placeholder="Quantity for M" min="0" oninput="validity.valid||(value='');" class="product_quantity block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                        <input type="number" name="Green[L]" placeholder="Quantity for L" min="0" oninput="validity.valid||(value='');" class=" product_quantity block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                        <input type="number" name="Green[XL]" placeholder="Quantity for XL" min="0" oninput="validity.valid||(value='');" class=" product_quantity block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                        <input type="number" name="Green[2XL]" placeholder="Quantity for 2XL" min="0" oninput="validity.valid||(value='');" class=" product_quantity block mb-1 px-3 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600" />
                    </div>
                </div>
            </div>
            @if (session('success'))
            <div class="alert text-blue-600 alert-success">
                <strong>{{ session('success') }} </strong>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-1">
                    @foreach ($errors->all() as $error)
                    <div class="mt-0 text-red-700 rounded-xl relative" role="alert">
                        <li class="block sm:inline text-xs">{{ $error }}</li>
                    </div>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="flex justify-start lg:flex lg:justify-start">
                <button type="submit" id="submit-button" class="text-white mt-6 bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-1/2 sm:w-auto px-20 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </div>
    </form>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Dropzone.options.imageUploadForm = {
            paramName: 'file',
            maxFilesize: 2,
            acceptedFiles: 'image/*',
            parallelUploads: 10,
        };

        ['color1', 'color2', 'color3', 'color4', 'color5', 'color6'].forEach(function(colorId) {
            var checkbox = document.getElementById(colorId + 'Input');
            var quantityOptions = document.getElementById('quantity-options' + colorId.substring(5));

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    quantityOptions.style.display = 'block';
                } else {
                    quantityOptions.style.display = 'none';
                }
                var discountquantity = parseInt(document.getElementsByName('discountquantity')[0].value);
                var totalQuantity = 0;
                var quantities = document.getElementsByClassName('product_quantity');
                for (var i = 0; i < quantities.length; i++) {
                    totalQuantity += parseInt(quantities[i].value);
                }
                if (discountquantity > totalQuantity) {
                    alert("Discount quantity must be less than or equal to total product quantity.");
                }
            });
        });
    });
</script>

@endsection