@extends('viewitem')
@section('title', 'View Product')
@section('content')

<!--  -->

<!--  -->
<div class="text-center">
  <h1 class="text-xl font-bold mt-20 text-gray-900 sm:text-3xl">Product View</h1>
</div>
<span class="flex mt-3 items-center">
    <span class="h-px flex-1 bg-slate-200"></span>
</span>
<!--  -->
<div class="my-2 mx-10 mt-3 ml-6">
<nav aria-label="Breadcrumb">
  <ol class="flex items-center gap-1 text-sm text-gray-600">
    <li>
      <a href="{{url('')}}" class="block transition hover:text-gray-700">
        <span class="sr-only"> Home </span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-4 w-4"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
          />
        </svg>
      </a>
    </li>
    <li class="rtl:rotate-180">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
          clip-rule="evenodd"
        />
      </svg>
    </li>
    <li>
      <a href="" class="block transition hover:text-gray-700">Product view </a>
    </li>
  </ol>
</nav>
</div>

<!-- view product -->
<div class="grid grid-cols-1 gap-3 lg:grid-cols-3 lg:gap-8 px-5 ">
  <div class="h-full ml-1 content-center">
    <div>
      <div class="flex justify-start  lg:px-8 pt-3">
          <strong class="text-gray-900 text-sm italic">Product Details</strong>
      </div>
        <div class="lg:px-8">
          <span class="  italic space-y-px text-[12px]">
            Cotton flannel and wool twill skirt. Pleats throughout.
          </span>
          <ul class="my-3 ml-3 lg:mt-6 lg:ml-5 ">
            <li class="text-xs italic">- Two-pocket styling</li>
            <li class="text-xs italic">- Two layers at front</li>
            <li class="text-xs italic">- Zip closure at outseam</li>
            <li class="text-xs italic">- Drawstring at elasticized waistband</li>
          </ul>
          <span class=" mt-10 italic  text-[12px]">
            Color : green, Pink, Blue, Red
          </span>
        </div>
    </div>

  </div>
  <div class="h-full w-fit lg:col-span-1">
    <div class="w-full h-full group relative overflow-hidden	">
       @if($product)
        <img
            src="{{ asset('images/' . $product->image_link) }}"
            alt="{{ $product->name }}"
            class=" min-h-full w-full object-cover transition duration-500 group-hover:scale-105"
        />
        @else
          <p>Product not image</p>
        @endif
      </div>
  </div>
  <div class="h-full content-center">
    <div class="relative ml-2 lg:ml-9 ">
      <span class="whitespace-nowrap rounded-full text-white bg-red-600 px-3 py-1.5 text-xs font-medium"> New </span>
      <h3 class="text-[16px] text-gray-700 mt-5">{{ $product->name }}</h3>
      <p class="text-[12px] text-gray-700">{{ $product->price }}đ</p>
      <p class="text-[12px] text-gray-700 mt-2 	 hover:text-blue-700">
        <a href="">
        Size Guize
        </a>
      </p>
      <form id="addToCartForm{{$product->id}}" action="{{ route('addcart') }}" method="POST">
        @csrf
        <select for="size" name="size" id="size" class="text-[12px] border-gray-400 rounded border w-2/6 mt-1 p-1 text-gray-700 hover:text-blue-700">
            <option for="size" value="selectsize" hidden selected>Select Size</option>
            <option for="size" value="XS">XS</option>
            <option for="size" value="S">S</option>
            <option for="size" value="M">M</option>
            <option for="size" value="L">L</option>
            <option for="size" value="XL">XL</option>
            <option for="size" value="2XL">2XL</option>
        </select>
        <br>
        <select for="color" name="color" id="color" class="text-[12px] border-gray-400 rounded border w-2/6 mt-1 p-1 text-gray-700 hover:text-blue-700">
            <option for="color" value="selectcolor" hidden selected>Select Color</option>
            <option for="color" value="red">Red</option>
            <option for="color" value="blue">Blue</option>
            <option for="color" value="green">Green</option>
            <option for="color" value="yellow">Yellow</option>
        </select>

          <div class=" mt-1 flex justify-center" >
            <a
              class="group relative inline-flex items-center overflow-hidden rounded-full mt-3   border  px-10 py-3 text-gray-600 focus:outline-none focus:ring active:text-gray-700"
              href=""
            >
              <span class="absolute -end-full transition-all group-hover:end-4">
                <svg
                  class="size-5 rtl:rotate-180"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                  />
                </svg>
              </span>
                <div>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button id="addToCartBtn{{$product->id}}" class="text-sm font-medium transition-all group-hover:me-4" type="button">Add to Cart</button>
                </div>
            </a>
        </div>
        @if (session('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach (session('errors') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </form>
    </div>
    </div>
  </div>
</div>

<!--  -->
<div class="text-center pt-2 ">
  <h1 class="text-xl font-bold mt-7 text-gray-900 sm:text-3xl">RELATED PRODUCTS</h1>
</div>
<span class="flex pt-2 pb-5 items-center">
    <span class="h-px flex-1 bg-slate-200"></span>
</span>
<div class="px-7 lg:px-10">
    <span>Flowbite is an open-source library of UI components built with the utility-first classes from Tailwind CSS. It also includes interactive elements such as dropdowns, modals, datepickers.
        Before going digital, you might benefit from scribbling down some ideas in a sketchbook. This way, you can think things through before committing to an actual design project.
        But then I found a component library based on Tailwind CSS called Flowbite. It comes with the most commonly used UI components, such as buttons, navigation bars, cards, form elements, and more which are conveniently built with the utility classes from Tailwind CSS.
        Getting started with Flowbite
        First of all you need to understand how Flowbite works. This library is not another framework. Rather, it is a set of components based on Tailwind CSS that you can just copy-paste from the documentation.
        It also includes a JavaScript file that enables interactive components, such as modals, dropdowns, and datepickers which you can optionally include into your project via CDN or NPM.
        You can check out the quickstart guide to explore the elements by including the CDN files into your project. But if you want to build a project with Flowbite I recommend you to follow the build tools steps so that you can purge and minify the generated CSS.
        You'll also receive a lot of useful application UI, marketing UI, and e-commerce pages that can help you get started with your projects even faster. You can check out this comparison table to better understand the differences betwe
      </span>
</div>

<!-- end view  -->
@endsection
