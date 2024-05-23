<template>
    <header class="z-10 w-full">
        <div class="mx-auto max-w-screen-xl px-6 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="md:flex mr-24 md:items-center md:gap-12">
                    <router-link to="/">
                        <a class="block">
                            <img src="" alt="Logo" />
                        </a>
                    </router-link>
                </div>
                <div class="md:flex mr-24 md:items-center md:gap-12"></div>
                <div class="hidden ml-24 md:block">
                    <nav aria-label="Global">
                        <ul class="flex items-center gap-7 mr-10 text-sm">
                            <li class="dropdown-1">
                                <router-link to="/product">
                                    <a
                                        class="hover:text-gray-800 hover:underline"
                                        >Product</a
                                    >
                                </router-link>

                                <div
                                    id="dropdownMenu-1"
                                    class="dropdown-menu-1"
                                >
                                    <a
                                        class="dropdown-option-1 hover:text-gray-800"
                                        href="{{ Route('product.bestseller.view') }}"
                                        >Best Seller</a
                                    >
                                    <a
                                        class="dropdown-option-1 hover:text-gray-800"
                                        href="{{ Route('product.new') }}"
                                        >New Product</a
                                    >
                                    <a
                                        class="dropdown-option-1 hover:text-gray-800"
                                        href="{{ Route('product.formen') }}"
                                        >Men's wear</a
                                    >
                                    <a
                                        class="dropdown-option-1 hover:text-gray-800"
                                        href="{{ Route('product.forwomen') }}"
                                        >Women's wear</a
                                    >
                                    <a
                                        class="dropdown-option-1 hover:text-gray-800"
                                        href="{{ Route('product.forunisex') }}"
                                        >For unisex</a
                                    >
                                    <a
                                        class="dropdown-option-1 hover:text-gray-800"
                                        href="{{ Route('discount.view.view') }}"
                                        >Discount</a
                                    >
                                </div>
                            </li>
                            <li>
                                <a
                                    class="hover:text-gray-800 hover:underline"
                                    href="/about"
                                >
                                    About
                                </a>
                            </li>
                            <li>
                                <a
                                    class="hover:text-gray-800 hover:underline"
                                    href="/blog"
                                >
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a
                                    class="hover:text-gray-800 hover:underline"
                                    href="/contact"
                                    >contact
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div
                    class="flex w-full xl:w-1/5 md:w-3/5 2xl:w-2/5 lg:w-1/5 gap-1 lg:gap-0 sm:gap-0 items-center"
                >
                    <div class="w-full mr-2 lg:inline sm:inline">
                        <form action="{{ route('search') }}" method="GET">
                            <div class="relative border-current">
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search for..."
                                    class="w-full border rounded-md border-gray-400 hover:border-gray-600 py-1 pe-10 shadow-sm sm:text-sm"
                                />
                                <span
                                    class="absolute inset-y-0 end-0 grid place-content-center"
                                >
                                    <button type="submit" class="text-gray-700">
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
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div
                        class="rounded-2xl relative lg:p-0 sm:p-0 mr-4 lg:mr-6 sm:mr-5 py-2 text-sm font-medium transition sm:gap-1"
                    >
                        <div class="hover:cursor-pointer">
                            <div onclick="openCart()" class="mb-3">
                                <svg
                                    class="absolute items-center"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="38"
                                    height="30"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        id="cartQuantity"
                                        d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z"
                                    />
                                </svg>
                                <span
                                    class="ml-3.5 mt-2.5"
                                    id="cartCount"
                                ></span>
                            </div>
                        </div>
                    </div>
                    <div id="cart-view" class="incart" style="display: none">
                        <div
                            class="flex justify-end mr-5 mt-4 hover:cursor-pointer"
                        >
                            <button
                                class="z-50 closecart"
                                onclick="closeCart()"
                            >
                                <p
                                    class="border-slate-400 hover:border-slate-900 rounded border px-1"
                                >
                                    X
                                </p>
                            </button>
                        </div>
                        <div class="mb-4">
                            <p
                                class="text-sm text-center font-bold text-gray-700"
                            >
                                Shopping Cart
                            </p>
                        </div>
                        <span class="flex mt-1 mb items-center">
                            <span class="h-px flex-1 bg-gray-300"></span>
                        </span>
                        <div id="cartItems">
                        </div>
                        <div class="mt-5 flex justify-center">
                            <a
                                href="/cart"
                                type="submit"
                                class="flex justify-center w-4/6 rounded-lg bg-black px-10 py-1 font-medium text-white"
                            >
                                View Cart
                            </a>
                        </div>
                        <div class="mt-1 flex justify-center mb-8">
                            <a
                                href="/checkout"
                                type="submit"
                                class="flex justify-center w-4/6 rounded-lg bg-black px-10 py-1 font-medium text-white"
                            >
                                Check Out
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>
<style scoped>
header {
    top: 0;
    left: 0;
    width: 100%;
    transition: top 1s;
    background: white;
    background-color: rgba(255, 255, 255, 0.8);
    transition: background-color 0.6s ease;
    position: sticky;
    z-index: 10;
}
header.active {
    top: 0;
    background-color: rgba(0, 0, 0, 0);
    background: white;
}
/*  */
.dropdown-1 {
    position: relative;
}

.dropdown-menu-1 {
    display: none;
    position: absolute;
    left: -50px;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    opacity: 0;
    transition: opacity 1.5s ease-out;
}

.dropdown-1:hover .dropdown-menu-1 {
    display: block;
    opacity: 1;
}

.dropdown-option-1 {
    display: flex;
    width: max-content;
    padding: 4px 60px 4px 10px;
    margin: 0px 7px;
}

.dropdown-option-1:hover {
    color: black;
    text-decoration: underline;
}
/* cart view */
.closecart {
    display: flex;
    justify-content: end;
}
.incart {
    position: fixed;
    top: 0;
    left: calc(100% - 350px);
    width: 350px;
    height: 100%;
    background-color: #fff;
    transition: 1s;
    z-index: 9999;
    overflow-y: auto;
    border-left: 1px solid rgb(20 41 20);
    /* border-color: rgb(30 41 59); */
}
.darken {
    z-index: 8000 !important;
    /* opacity: 0.1; */
    filter: blur(4px);
    /* position: relative; */
}
.search_box {
    height: fit-content;
    width: fit-content;
    position: absolute;
    background-color: rgba(255, 255, 255, 0.7);
    top: 100%;
    right: 0;
}
</style>
