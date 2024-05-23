<template>
    <div class="modal">
        <div class="modal-content">
            <p class="text-black text-center text-sm">
                Are you sure you want to remove this item?
            </p>
            <ul class="py-1 px-2 flex items-center justify-center">
                <li class="flex items-center gap-2">
                    <img
                        :src="`/images/${modalData.image}`"
                        :alt="modalData.name"
                        class="size-28 rounded object-cover"
                    />
                    <div>
                        <h3 class="lg:text-sm text-xs text-gray-900">
                            {{ modalData.name }}
                        </h3>

                        <dl class="mt-0.5 space-y-px text-[10px] text-gray-600">
                            <div>
                                <dt class="inline mr-1">Price:</dt>
                                <dd class="inline">
                                    {{ modalData.price }} x
                                    {{ modalData.quantity }}
                                </dd>
                            </div>
                            <div>
                                <dt class="inline mr-1">Size:</dt>
                                <dd class="inline">{{ modalData.size }}</dd>
                            </div>

                            <div>
                                <dt class="inline mr-1">Color:</dt>
                                <dd class="inline">{{ modalData.color }}</dd>
                            </div>
                        </dl>
                    </div>
                </li>
            </ul>
            <div class="flex mt-1 justify-center">
                <button
                    class="rounded-xl bg-black px-5 py-2 text-sm text-white mr-1"
                    @click="removeItemConfirmed"
                >
                    Yes
                </button>
                <button
                    class="rounded-xl bg-gray-600 hover:bg-gray-700 px-6 py-2 text-sm text-white"
                    @click="closeModal"
                >
                    No
                </button>
            </div>
        </div>
    </div>
    <div class="mt-20 lg:px-40 px-10">
        <div>
            <div class="overflow-hidden rounded-full bg-gray-200">
                <div class="h-1 w-1/2 rounded-full bg-blue-500"></div>
            </div>
            <ol class="mt-4 grid grid-cols-3 text-sm font-medium text-gray-500">
                <li
                    class="flex items-center justify-start text-gray-600 sm:gap-1.5"
                >
                    <span class="sm:inline">Shopping </span>
                </li>
                <li
                    class="flex items-center justify-center text-blue-700 sm:gap-1.5"
                >
                    <span class="sm:inline"><a href="">View Cart</a></span>
                </li>
                <li class="flex items-center justify-end sm:gap-1.5">
                    <span class="sm:inline"><a href="">Check Out</a></span>
                </li>
            </ol>
        </div>
    </div>

    <div>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <div class="text-center">
                    <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">
                        Your Cart
                    </h1>
                </div>
                <span class="flex mt-5 items-center">
                    <span class="h-px flex-1 bg-gray-400"></span>
                </span>
                <div class="mt-2">
                    <ul class="space-y-2">
                        <li
                            v-if="cart != null"
                            v-for="item in cart"
                            :key="item.id"
                            class="flex items-center gap-2"
                        >
                            <img
                                @click="viewProduct(item.id)"
                                :src="`/images/${item.image}`"
                                :alt="item.name"
                                class="lg:size-28 size-20 rounded hover:cursor-pointer object-cover"
                            />
                            <div>
                                <h3
                                    @click="viewProduct(item.id)"
                                    class="lg:text-sm text-xs text-gray-900 hover:text-blue-600 hover:cursor-pointer"
                                >
                                    {{ item.name }}
                                    <span
                                        v-if="item.discountPercent > 0"
                                        class="text-red-600"
                                    >
                                        - {{ item.discountPercent }}%
                                    </span>
                                </h3>

                                <dl
                                    class="mt-0.5 space-y-px text-[10px] text-gray-600"
                                >
                                    <div>
                                        <dt class="inline mr-1">Price:</dt>
                                        <dd class="inline">
                                            {{ formatCurrency(item.price) }}
                                        </dd>
                                    </div>
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
                                <div class="flex items-center">
                                    <button
                                        @click="decreaseQuantity(item)"
                                        type="button"
                                        class="mr-1 text-gray-600 transition hover:opacity-75"
                                    >
                                        &minus;
                                    </button>
                                    <input
                                        type="number"
                                        @input="updateCartItem(item)"
                                        @blur="checkQuantity(item)"
                                        v-model="item.quantity"
                                        class="h-6 w-10 border rounded border-gray-200 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none"
                                    />
                                    <button
                                        @click="increaseQuantity(item)"
                                        type="button"
                                        class="ml-1 text-gray-600 transition hover:opacity-75"
                                    >
                                        &plus;
                                    </button>
                                </div>

                                <button
                                    @click="
                                        openModal(
                                            item.id,
                                            item.size,
                                            item.color,
                                            item.quantity,
                                            item.image,
                                            formatCurrency(item.price)
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
                        <li v-else>
                            <div class="flex">
                                <p
                                    class="text-[15px] italic mr-1 text-gray-700"
                                >
                                    No items in cart.
                                </p>

                                <router-link to="/">
                                    <a
                                        class="text-[15px] italic text-blue-600 hover:text-blue-800"
                                        href="#"
                                        >Shopping Here</a
                                    >
                                </router-link>
                            </div>
                        </li>

                        <span class="flex items-center">
                            <span class="h-px flex-1 bg-gray-400"></span>
                        </span>
                    </ul>
                    <div class="justify-end flex">
                        <dl
                            class="mt-1 italic space-y-px text-[10px] text-blue-600"
                        >
                            Vietnam: Recipient pays for shipping service at the
                            time of delivery.
                        </dl>
                    </div>
                    <div class="mt-2 justify-end grid text-sm">
                        <div class="text-gray-700 text-sm mr-2">
                            {{ cartData.cartQuantity }} items
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end pt-8">
                        <div class="w-screen max-w-lg space-y-4">
                            <dl class="space-y-0.5 text-sm text-gray-700">
                                <div class="flex justify-between">
                                    <dt>Subtotal</dt>
                                    <dd>
                                        {{ formatCurrency(cartData.total) }}
                                    </dd>
                                </div>

                                <div class="flex justify-between">
                                    <dt>VAT</dt>
                                    <dd>{{ cartData.VAT }}%</dd>
                                </div>

                                <div class="flex justify-between">
                                    <dt>Discount</dt>
                                    <dd>
                                        {{
                                            formatCurrency(
                                                cartData.totalDiscountAmount
                                            )
                                        }}
                                    </dd>
                                </div>

                                <div
                                    class="flex justify-between !text-base font-medium"
                                >
                                    <dt>Total</dt>
                                    <dd>
                                        {{ formatCurrency(cartData.subtotal) }}
                                    </dd>
                                </div>
                            </dl>
                            <p
                                v-if="errorMessage"
                                :class="{
                                    'text-blue-600 text-sm': isVoucherValid,
                                    'text-red-600 text-sm': !isVoucherValid,
                                }"
                            >
                                {{ errorMessage }}
                            </p>

                            <div class="flex justify-start">
                                <div>
                                    <input
                                        type="text"
                                        id="vouchercode"
                                        v-model="voucherCode"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Apply voucher"
                                    />
                                </div>
                                <button
                                    @click="applyVoucherCode"
                                    class="block ml-1 rounded-xl bg-gray-800 hover:bg-black px-6 py-1.5 text-sm text-white transition"
                                >
                                    Apply
                                </button>
                            </div>
                            <div class="flex justify-end">
                                <div class="flex">
                                    <a
                                        href="javascript:void(0);"
                                        onclick="window.history.back()"
                                        class="mr-1 bg-gray-800 hover:bg-black px-10 py-2 text-sm rounded-xl text-white w-auto"
                                    >
                                        Back
                                    </a>
                                </div>
                                <div>
                                    <button
                                        @click="goToCheckout"
                                        class="block rounded-xl bg-gray-800 hover:bg-black px-6 py-2 text-sm text-white transition"
                                    >
                                        Checkout
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapMutations, mapActions, mapState } from "vuex";
import ViewCart from "@/components/layout/ViewCart.vue";
import axios from "axios";

export default {
    name: "Cart",
    data() {
        return {
            voucherCode: "",
            voucherMessage: "",
            isViewCartOpen: false,
            modalData: {
                id: null,
                size: null,
                color: null,
                quantity: null,
                image: null,
                price: null,
            },
        };
    },
    created() {
        window.scrollTo({ top: 0, behavior: "smooth" });
        this.fetchCart();
        this.fetchCartData();
    },
    watch: {
        voucherCode(newCode) {
            if (typeof newCode === "string" && newCode.trim() === "") {
                this.removeVoucher();
            }
        },
    },
    computed: {
        ...mapGetters(["cart", "cartData", "errorMessage", "isVoucherValid"]),
    },
    methods: {
        ...mapActions([
            "fetchCart",
            "fetchCartData",
            "fetchCartQuantity",
            "checkVoucherCode",
            "removeVoucherCode",
        ]),
        goToCheckout() {
            this.applyVoucherCode();
            if (this.isVoucherValid == true) {
                const checkoutRoute = {
                    name: "Checkout",
                    params: {},
                    query: { voucherCode: this.voucherCode },
                };
                this.$router.push(checkoutRoute);
            } else {
                const checkoutRoute = {
                    name: "Checkout",
                    params: {},
                };
                this.$router.push(checkoutRoute);
            }
        },
        async applyVoucherCode() {
            await this.checkVoucherCode(this.voucherCode);
            if (this.voucherCode.trim() === "") {
                this.removeVoucher();
            }
        },
        async removeVoucher() {
            await this.removeVoucherCode();
            this.fetchCart();
            this.fetchCartData();
        },
        showNotification(message) {
            const notification = document.createElement("div");
            notification.classList.add("notificationAddcart");
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => {
                notification.remove();
            }, 2100);
        },
        viewProduct(productId) {
            this.$emit("viewProduct", productId);
            this.$router.push({
                name: "ViewProduct",
                params: { id: productId },
            });
        },
        openModal(id, size, color, quantity, image, price) {
            this.modalData.id = id;
            this.modalData.size = size;
            this.modalData.color = color;
            this.modalData.quantity = quantity;
            this.modalData.image = image;
            this.modalData.price = price;
            var modal = document.querySelector(".modal");
            modal.style.display = "block";
        },
        closeModal() {
            this.modalData.id = null;
            this.modalData.size = null;
            this.modalData.color = null;
            this.modalData.quantity = null;
            this.modalData.image = null;
            this.modalData.price = null;
            var modal = document.querySelector(".modal");
            modal.style.display = "none";
        },
        removeItemConfirmed() {
            if (
                this.modalData.id !== null &&
                this.modalData.size !== null &&
                this.modalData.color !== null &&
                this.modalData.quantity !== null
            ) {
                this.removeItem(
                    this.modalData.id,
                    this.modalData.size,
                    this.modalData.color,
                    this.modalData.quantity
                );
                this.closeModal();
            }
        },
        removeItem(id, size, color, quantity) {
            axios
                .delete(`/api/cart/remove/${id}/${size}/${color}/${quantity}`)
                .then((response) => {
                    if (response.data.success) {
                        const voucherCodeInCart = this.cartData.voucherCode;
                        this.fetchCart();
                        this.fetchCartData();
                        this.fetchCartQuantity();
                        if (voucherCodeInCart) {
                            this.checkVoucherCode(voucherCodeInCart);
                        }
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
        decreaseQuantity(cartItem) {
            if (cartItem.quantity > 1) {
                cartItem.quantity--;
                this.updateCartItem(cartItem);
            }
        },
        increaseQuantity(cartItem) {
            cartItem.quantity++;
            this.updateCartItem(cartItem);
        },
        updateCartItem(cartItem) {
            axios
                .put(`/api/cart/update-quantity/${cartItem.id}`, {
                    quantity: cartItem.quantity,
                    color: cartItem.color,
                    size: cartItem.size,
                })
                .then((response) => {
                    if (response.data.success) {
                        const voucherCodeInCart = this.cartData.voucherCode;
                        this.fetchCartQuantity();
                        this.fetchCart();
                        this.fetchCartData();
                        if (voucherCodeInCart) {
                            this.checkVoucherCode(voucherCodeInCart);
                        }
                    } else {
                        const voucherCodeInCart = this.cartData.voucherCode;
                        this.fetchCartQuantity();
                        this.fetchCart();
                        this.fetchCartData();
                        if (voucherCodeInCart) {
                            this.checkVoucherCode(voucherCodeInCart);
                        }
                        this.showNotification(response.data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error updating quantity:", error);
                });
        },
        checkQuantity(cartItem) {
            if (!cartItem.quantity || cartItem.quantity < 1) {
                cartItem.quantity = 1;
                this.updateCartItem(cartItem);
            }
        },
    },
};
</script>
