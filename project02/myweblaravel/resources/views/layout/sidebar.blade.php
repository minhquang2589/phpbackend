<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');">
  <div class="flex flex-col items-center justify-center z-40 flex-1">
    <button @click="isSidebarOpen = true" class="fixed p-2 text-black bg-slate-100 z-50	 hover:bg-slate-200 rounded-xl top-20 left-5">
      <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>
  <div class="flex  antialiased text-gray-900  dark:bg-dark dark:text-light">
    <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-gray-600">
      Loading.....
    </div>
    <div x-transition:enter="transform transition-transform duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition-transform duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-show="isSidebarOpen" class="fixed z-50	 inset-y-0  flex w-80">
      <svg class="absolute inset-0 w-full h-full text-white" style="filter: drop-shadow(10px 0 10px #00000030)" preserveAspectRatio="none" viewBox="0 0 309 800" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path d="M268.487 0H0V800H247.32C207.957 725 207.975 492.294 268.487 367.647C329 243 314.906 53.4314 268.487 0Z" />
      </svg>
      <div class="z-50 flex flex-col flex-1">
        <div class="flex items-center justify-between flex-shrink-0 w-64 p-4">
          <a href="#"> </a>
          <button @click="isSidebarOpen = false" class="p-1 rounded-lg focus:outline-none focus:ring">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <nav class="flex flex-col flex-1 w-64 p-4">
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="{{ Route('product.view.view') }}">Products</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="{{ Route('discount.view.view') }}">Discount</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="{{ Route('product.new') }}">New Product</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="{{ Route('product.forunisex') }}">For unisex</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="{{ Route('product.formen') }}">Men's wear</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="{{ Route('product.forwomen') }}">Women's wear</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="/contact">Contact</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="/about">About</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
          <div class="flex items-center mt-1 ">
            <span class="mr-30 "><a href="/blog">Blog</a></span>
          </div>
          <span class="flex items-center">
            <span class="h-px flex-1 bg-slate-200"></span>
          </span>
        </nav>
        <div class="flex-shrink-0 p-4">
        </div>
      </div>
    </div>
  </div>
</div>