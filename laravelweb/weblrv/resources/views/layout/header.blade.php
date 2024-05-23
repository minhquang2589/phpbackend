<header class="z-10">
  <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="md:flex md:items-center md:gap-12">
          <a class="block " href="{{ url('/product') }}">
            <img src="" alt="Logo">
          </a>
        </div>
        <div class="hidden md:block">
          <nav aria-label="Global">
            <ul class="flex items-center gap-7 text-sm">
            <li>
            <a class="text-gray-500 transition hover:text-gray-800" href="{{ url('/') }}">Home</a>
              </li>
              <li>
                <a class="text-gray-500 transition hover:text-gray-800" href="/product">Product </a>
              </li>
              <li>
                <a class="text-gray-500 transition hover:text-gray-800" href="/about"> About </a>
              </li>
              <li>
                <a class="text-gray-500 transition hover:text-gray-800" href="blog"> Blog </a>
              </li>
              <li>
                <a class="text-gray-500 transition hover:text-gray-500/75" href="/contact">contact </a>
              </li>
              <li>
                <a class="text-gray-500 transition hover:text-gray-800" href="/profile">Profile </a>
              </li>
            </ul>
          </nav>
        </div>
<!-- button -->
        <div class="flex gap-4 mb:gap-4  items-center">
          <div class="sm:flex items-center flex sm:gap-3">
            <div>
            @php
              if (Auth::check()) {
                  echo '<a class="rounded-xl bg-red-600 hover:hover:bg-red-800 px-5 py-2.5 text-sm font-medium text-white shadow" href="' . route('logout') . '">Logout</a>';
              } elseif (Request::is('login')) {
                  echo '<a  class="rounded-xl bg-red-600 hover:hover:bg-red-800 px-5 py-2.5 text-sm font-medium text-white shadow" href="' . route('register') . '">Register</a>';
              } else {
                  echo '<a  class="rounded-xl bg-red-600 hover:hover:bg-red-800 px-5 py-2.5 text-sm font-medium text-white shadow" href="' . route('login') . '">Login</a>';
              }
          @endphp
        </div>
        <div class="rounded-2xl relative   p-3 py-2 text-sm font-medium transition sm:gap-4">
              <div class="" id="cartQuantity">
                  <a class="flex " href="/cart">
                  <svg class="absolute items-center" xmlns="http://www.w3.org/2000/svg" width="38" height="30" viewBox="0 0 24 24"><path d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z"/>
                  </svg>
                  <span class="ml-3.5 mt-2.5 " id="cartCount"></span>
                  </a>
              </div>
            </div>
          </div>
        </div>
    </div>
</header>