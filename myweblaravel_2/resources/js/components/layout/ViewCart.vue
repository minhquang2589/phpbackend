<template>
    <div @mouseleave="closeCart" class="z-50">
        <div class="incart rounded border-l bg-white border-gray-500">
            <div
                class="flex justify-end bg-white text-gray-900 mx-4 mt-4 transition"
            >
                <button @click="closeViewCart" class="togger-hidden">X</button>
            </div>
            <div class="text-center">
                <h1 class="text-xl font-bold text-gray-900">Your Cart</h1>
            </div>
            <span class="flex mt-1 items-center">
                <span class="h-px flex-1 bg-gray-400"></span>
            </span>
            <div class="px-4 sm:px-6 lg:px-6">
                <div class="mt-4 space-y-6">
                    <ul class="space-y-2">
                        <li
                            v-for="item in cart"
                            class="flex items-center gap-4"
                        >
                            <img
                                @click="viewProduct(item.id)"
                                :src="'/images/' + item.image"
                                alt=""
                                class="size-20 rounded hover:cursor-pointer object-cover"
                            />

                            <div>
                                <h3
                                    @click="viewProduct(item.id)"
                                    class="text-sm text-gray-900 hover:text-blue-600 hover:cursor-pointer"
                                >
                                    {{ item.name }} x {{ item.quantity }}
                                </h3>

                                <dl
                                    class="mt-0.5 space-y-px text-[10px] text-gray-600"
                                >
                                    <div>
                                        <dt class="inline mr-1">Size:</dt>
                                        <dd class="inline">{{ item.size }}</dd>
                                    </div>

                                    <div>
                                        <dt class="inline mr-1">Color:</dt>
                                        <dd class="inline">{{ item.color }}</dd>
                                    </div>
                                </dl>
                            </div>
                            <div
                                class="flex flex-1 items-center justify-end gap-2"
                            >
                                <button
                                    @click="
                                        removeItem(
                                            item.id,
                                            item.size,
                                            item.color,
                                            item.quantity
                                        )
                                    "
                                    class="text-gray-600 transition hover:text-red-600"
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
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </li>
                    </ul>

                    <div v-if="dataCartView != null" class="text-center">
                        <div
                            class="flex justify-start text-sm text-gray-800 mt-5"
                        >
                            <div>
                                Total: {{ formatCurrency(cartData.subtotal) }}
                            </div>
                        </div>
                        <span class="flex items-center mb-5">
                            <span class="h-px flex-1 bg-gray-500"></span>
                        </span>
                        <router-link to="/cart">
                            <a
                                href="#"
                                class="block rounded border border-gray-600 px-5 py-3 text-sm text-gray-600 transition hover:ring-1 hover:ring-gray-400"
                            >
                                View my cart
                            </a>
                        </router-link>
                        <router-link to="/checkout">
                            <a
                                href="#"
                                class="block rounded bg-gray-900 mt-2 mb-5 px-5 py-3 text-sm text-gray-100 transition hover:bg-black"
                            >
                                Checkout
                            </a>
                        </router-link>
                    </div>
                    <div v-if="dataCartView == null" class="text-center">
                        <h1 class="text-xl italic text-gray-600">
                            No item in cart!
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import axios from "axios";

export default {
    name: "ViewCart",
    props: {
        toggleViewCart: {
            type: Function,
            required: true,
        },
    },
    data() {
        return {
            dataCartView: [],
            subTotal: null,
            isCartOpen: false,
        };
    },
    computed: {
        ...mapGetters(["cart", "cartData"]),
    },
    methods: {
        ...mapActions(["fetchCart", "fetchCartData", "fetchCartQuantity"]),
        closeViewCart() {
            this.toggleViewCart();
        },
        closeCart() {
            this.toggleViewCart();
        },
        viewProduct(productId) {
            this.$emit("viewProduct", productId);
            this.$router.push({
                name: "ViewProduct",
                params: { id: productId },
            });
        },
        removeItem(id, size, color, quantity) {
            axios
                .delete(`/api/cart/remove/${id}/${size}/${color}/${quantity}`)
                .then((response) => {
                    if (response.data.success === true) {
                        this.fetchCart();
                        this.fetchCartData();
                        this.fetchCartQuantity();
                    }
                })
                .catch((error) => {
                    console.error("Error removing item:", error);
                });
        },
        formatCurrency(value) {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
    },
};
</script>
