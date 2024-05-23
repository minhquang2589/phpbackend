<template>
    <header class="z-10 w-full">
        <div v-if="isAdmin">
            <AdminHeader :isAdmin="isAdmin" />
        </div>
        <div class="filter_table">
            <div v-if="isFilterOpen">
                <FilterMobile :toggleFilter="toggleFilter" />
            </div>
        </div>
        <transition-group name="fade">
            <div v-if="isViewCartOpen" key="viewCart" class="z-50 showViewCart">
                <ViewCart :toggleViewCart="toggleViewCart" />
            </div>
        </transition-group>
        <div class="mx-auto max-w-screen-xl px-6 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="md:flex md:items-center mr-12 md:gap-12">
                    <router-link to="/">
                        <a class="block">
                            <img src="" alt="Logo" />
                        </a>
                    </router-link>
                </div>
                <div class="md:flex md:items-center md:gap-12"></div>
                <div class="hidden md:block">
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
                                    <router-link to="/product/bestseller">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Best Seller</a
                                        >
                                    </router-link>
                                    <router-link to="/product/new">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >New Product</a
                                        >
                                    </router-link>
                                    <router-link to="/product/men">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Men's wear</a
                                        >
                                    </router-link>
                                    <router-link to="/product/women">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Women's wear</a
                                        >
                                    </router-link>
                                    <router-link to="/product/unisex">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >For unisex</a
                                        >
                                    </router-link>
                                    <router-link to="/product/discount">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Discount</a
                                        >
                                    </router-link>
                                </div>
                            </li>
                            <li class="dropdown-1">
                                <span class="hover:text-gray-800 hover:underline"
                                    >Shop
                                </span>

                                <div
                                    id="dropdownMenu-1"
                                    class="dropdown-menu-1"
                                >
                                    <router-link to="/product/bag">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Bag</a
                                        >
                                    </router-link>
                                    <router-link to="/product/hat">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Hat</a
                                        >
                                    </router-link>
                                    <router-link to="/product/shoes">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Shoes</a
                                        >
                                    </router-link>
                                    <router-link to="/product/accessory">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Accessory</a
                                        >
                                    </router-link>
                                      <router-link to="/product/clothes">
                                        <a
                                            class="dropdown-option-1 hover:text-gray-800"
                                            href="#"
                                            >Clothes</a
                                        >
                                    </router-link>
                                    
                                </div>
                            </li>
                            <li>
                                <router-link to="/about">
                                    <a
                                        class="hover:text-gray-800 hover:underline"
                                        href="#"
                                    >
                                        About
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/blog">
                                    <a
                                        class="hover:text-gray-800 hover:underline"
                                        href="#"
                                    >
                                        Blog
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/contact">
                                    <a
                                        class="hover:text-gray-800 hover:underline"
                                        href="#"
                                        >contact
                                    </a>
                                </router-link>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div
                    class="flex justify-end xl:w-1/5 md:w-3/5 2xl:w-2/5 lg:w-1/5 gap-1 lg:gap-0 sm:gap-0 items-center"
                >
                    <div
                        class="rounded-2xl flex relative mt-2 lg:p-0 sm:p-0 py-2 text-sm font-medium transition sm:gap-1"
                    >
                        <div class="flex">
                            <div
                                class="mt-1.5 mr-1 transform hidden lg:block text-xl font-medium"
                            >
                                Cart
                            </div>
                            <div
                                @mouseenter="openCart"
                                class="mb-3 relative flex items-center"
                            >
                                <button @click="toggleViewCart">
                                    <svg
                                        class="h-8 w-8 hover:cursor-pointer"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="38"
                                        height="30"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M20 7h-4v-3c0-2.209-1.791-4-4-4s-4 1.791-4 4v3h-4l-2 17h20l-2-17zm-11-3c0-1.654 1.346-3 3-3s3 1.346 3 3v3h-6v-3zm-4.751 18l1.529-13h2.222v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h6v1.5c0 .276.224.5.5.5s.5-.224.5-.5v-1.5h2.222l1.529 13h-15.502z"
                                        />
                                    </svg>
                                    <div
                                        class="absolute left-1/2 top-1/2 mt-1 transform -translate-x-1/2 -translate-y-1/2 text-lg"
                                    >
                                        {{ cartQuantity }}
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="hover:cursor-pointer filter-button ml-5">
                            <button @click="toggleFilter">
                                <div class="mt-2 relative flex items-center">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            d="M19.479 2l-7.479 12.543v5.924l-1-.6v-5.324l-7.479-12.543h15.958zm3.521-2h-23l9 15.094v5.906l5 3v-8.906l9-15.094z"
                                        />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div id="cart-view" class="" style="display: none">
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
                        <div id="cartItems"></div>
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
        <span class="flex items-center">
            <span class="h-px flex-1 bg-gray-400"></span>
        </span>
    </header>
</template>
<script>
import { inject, onMounted } from "vue";
import { mapGetters, mapMutations, mapActions } from "vuex";
import AdminHeader from "@/components/AdminHeader.vue";
import FilterMobile from "@/components/layout/FilterMobile.vue";
import ViewCart from "@/components/layout/ViewCart.vue";
import axios from "axios";
export default {
    name: "Header",
    components: {
        AdminHeader,
        AdminHeader,
        FilterMobile,
        ViewCart,
    },
    data() {
        return {
            userData: null,
            isAdmin: false,
            isFilterOpen: false,
            isViewCartOpen: false,
        };
    },
    created() {
        this.getUserData();
        this.fetchCartQuantity();
    },
    computed: {
        ...mapGetters(["cart", "cartData"]),
        ...mapGetters(["cartQuantity"]),
        filterVisibility() {
            return this.isFilterOpen ? "block" : "none";
        },
        ViewCartVisibility() {
            return this.isViewCartOpen ? "block" : "none";
        },
    },
    methods: {
        ...mapActions(["fetchCart", "fetchCartData", "fetchCartQuantity"]),

        toggleFilter() {
            this.isFilterOpen = !this.isFilterOpen;
        },
        toggleViewCart() {
            // this.$emit("open-view-cart");
            this.isViewCartOpen = !this.isViewCartOpen;
            this.fetchCartQuantity();
            this.fetchCart();
            this.fetchCartData();
        },
        openCart() {
            this.toggleViewCart();
        },
        getUserData() {
            axios
                .get("/api/user")
                .then((response) => {
                    if (response.data) {
                        this.userData = response.data;
                        this.isAdmin = this.userData.role === "admin";
                    }
                })
                .catch((error) => {
                    console.error(
                        "An error occurred while fetching user data:",
                        error
                    );
                    this.$router.push({ name: "Home" });
                });
        },
        getCartQuantity() {
            axios
                .get("/api/cart-quantity")
                .then((response) => {
                    // console.log(response);
                    this.cartQty = response.data.cartQuantity;
                })
                .catch((error) => {
                    console.error("An error:", error);
                });
        },
    },
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
.filter-button {
    display: none;
}
.filter_table {
    display: none;
}
@media only screen and (max-width: 768px) {
    .filter-button {
        display: block;
    }
    .filter_table {
        display: block;
        position: fixed;
        z-index: 9999;
        right: 0;
    }
}
</style>
