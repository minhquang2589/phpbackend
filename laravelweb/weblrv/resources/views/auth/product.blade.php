@extends('dashboard')
@section('title', 'Product')
@section('content')

@if (!Auth::check())
    @include('layout.section')
@else
    @include('layout.section_login')
@endif

<!-- slider  -->
  @include('layout.slider')
<!--  -->
<div class="my-5 mb-3 mx-3 flex justify-center	">
  <a href=""> <div class="font-medium text-sm text-gray-600 hover:text-gray-800">NEW ARRIVALS</div></a>
</div>
<!--  -->
<span class="flex items-center">
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
      <a href="" class="block transition hover:text-gray-700"> Product </a>
    </li>
  </ol>
</nav>
</div>
<!-- product  --> 
<div class="grid grid-cols-1 mx-6 gap-4 lg:grid-cols-4 lg:gap-8 ">
@foreach($products as $product)
  <div class="h-120 rounded-lg">
    <div>
      <div href="" class="group rounded-xl relative block overflow-hidden">
          <button
            class="absolute end-4 top-4 z-10 bg-conver p-1.5 text-gray-900 transition hover:text-gray-900/75"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="h-4 w-4"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"
              />
            </svg>
          </button>
          <img
            src="{{ asset('images/' . $product->image_link) }}"
            alt="{{ $product->name }}"
            class=" min-h-full rounded-t-2xl w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72"
          />
          <div class="relative p-6">
            <span class="whitespace-nowrap rounded-full text-white bg-red-600 px-3 py-1.5 text-xs font-medium"> New </span>
            <h3 class="mt-4 text-lg font-medium text-gray-500">{{ $product->name }}</h3>
            <p class="mt-1.5 text-sm text-gray-500 transition hover:text-gray-800">{{ $product->price }}đ</p>
            <div class="">
              <a
                class="group relative justify-center	 flex items-center overflow-hidden rounded-full mt-3  border mx-12	 py-3 text-gray-500 focus:outline-none focus:ring active:text-gray-600"
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
                <div class="">
                  <form id="addToCartForm{{$product->id}}" action="{{ route('addcart') }}" method="POST">
                      @csrf
                      <input type="hidden" name="product_id" value="{{ $product->id }}">
                      <button id="addToCartBtn{{$product->id}}" class="text-sm font-medium transition-all group-hover:me-4" type="button" data-product-id="{{ $product->id }}">View Product</button>
                  </form>
                </div>
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>
@endforeach
</div>
<!--  -->
@endsection
