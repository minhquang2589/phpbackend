<template>
    <div class="mt-20 lg:px-40 px-10">
        <div>
            <div class="overflow-hidden rounded-full bg-blue-500">
                <div class="h-1 w-1/2 rounded-full bg-blue-500"></div>
            </div>
            <ol class="mt-4 grid grid-cols-3 text-sm font-medium text-gray-500">
                <li
                    class="flex items-center justify-start text-gray-600 sm:gap-1.5"
                >
                    <span class="sm:inline">Shopping </span>
                </li>
                <li
                    class="flex items-center justify-center text-gray-600 sm:gap-1.5"
                >
                    <span class="sm:inline"
                        ><a href="/cart">View Cart</a>
                    </span>
                </li>
                <li class="flex items-center justify-end sm:gap-1.5">
                    <span class="text-blue-700 sm:inline"
                        ><a href="/checkout">Check Out</a></span
                    >
                </li>
            </ol>
        </div>
    </div>
    <div>
        <div class="text-center mt-10">
            <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">
                Checkout
            </h1>
        </div>
        <div class="mt-4">
            <form @submit.prevent="checkout">
                <div
                    class="grid grid-cols-1 gap-1 lg:grid-cols-3 lg:gap-3 lg:px-10 px-2"
                >
                    <div class="h-fit rounded-lg lg:col-span-2">
                        <div
                            class="h-full border bg-white border-slate-300 rounded-lg lg:col-span-2"
                        >
                            <div class="flex justify-start">
                                <span class="mt-4 ml-6 mb-4 text-gray-700"
                                    >Billing Details</span
                                >
                            </div>
                            <div
                                class="flex justify-end my-0 border-t border-gray-300"
                            ></div>
                            <div class="rounded-lg p-4 lg:col-span-3 lg:p-12">
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <input
                                            class="w-full border rounded-lg border-gray-700 p-3 lg:p-3 text-sm"
                                            placeholder="Name"
                                            name="name"
                                            type="name"
                                            v-model="name"
                                        />
                                    </div>
                                    <div>
                                        <input
                                            class="w-full border rounded-lg border-gray-700 p-3 text-sm"
                                            placeholder="Phone Number"
                                            name="phone"
                                            type="tel"
                                            v-model="phone"
                                        />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input
                                        class="w-full border rounded-lg border-gray-700 p-3 text-sm"
                                        placeholder="Email Address"
                                        name="email"
                                        type="email"
                                        v-model="email"
                                    />
                                </div>
                                <div class="mt-2">
                                    <input
                                        class="w-full border rounded-lg border-gray-700 p-3 text-sm"
                                        placeholder="Address"
                                        type="text"
                                        name="address"
                                        v-model="address"
                                    />
                                </div>
                                <div class="mt-2">
                                    <textarea
                                        class="w-full border rounded-lg border-gray-700 p-3 text-sm"
                                        placeholder="Notes about the order, for example more detailed delivery time or location!"
                                        rows="4"
                                        lg:row="9"
                                        for="note"
                                        name="note"
                                        v-model="note"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-fit border border-slate-300 rounded-lg">
                        <div class="flex ml-4 mt-4 justify-start">
                            <span class="text-gray-700">Your Order</span>
                        </div>
                        <div
                            class="flex mt-4 justify-end border-t border-gray-300"
                        ></div>
                        <div v-if="cartCheckout != null" class="ml-4 mt-1">
                            <div
                                v-for="item in cartCheckout"
                                :key="item.id"
                                class="flex mt-2 justify-between"
                            >
                                <div>
                                    <div>
                                        <span class="text-[12px]">
                                            {{ item.name }} - {{ item.size }} x
                                            {{ item.quantity }}</span
                                        >
                                        <div class="text-[12px]">
                                            Color: {{ item.color }}
                                        </div>
                                        <div
                                            v-if="item.discountPercent > 0"
                                            class="text-[12px]"
                                        >
                                            <span>
                                                <dt class="inline">
                                                    Discount:
                                                </dt>
                                                <dd class="inline text-red-600">
                                                    -
                                                    {{ item.discountPercent }}%
                                                </dd>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="mr-3 text-[12px]">
                                        {{ formatCurrency(item.price) }}</span
                                    >
                                </div>
                            </div>
                            <div
                                class="flex justify-end my-2 mr-4 border-t border-gray-300"
                            ></div>
                            <div class="my-1 mr-2 flex justify-start">
                                <span class="text-[12px] text-gray-700">
                                    {{ cartQuantity }} items</span
                                >
                            </div>
                            <div v-if="voucherCode && voucherCode > 0">
                                <span class="text-[12px]">
                                    <dt class="inline">Voucher:</dt>
                                    <dd class="inline text-red-700">
                                        {{ voucherCode }} %
                                    </dd>
                                </span>
                            </div>
                            <div v-else></div>
                            <div
                                v-if="
                                    totalDiscountAmount &&
                                    totalDiscountAmount > 0
                                "
                            >
                                <span class="text-[12px]">
                                    <dt class="inline mr-1">Total discount:</dt>
                                    <dd class="inline text-gray-700">
                                        {{
                                            formatCurrency(totalDiscountAmount)
                                        }}
                                    </dd>
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <div class="text-[14px] text-gray-800">
                                    Total price
                                </div>
                                <div class="text-[14px] text-gray-800 mr-5">
                                    {{ formatCurrency(checkoutSubtotal) }}
                                </div>
                            </div>
                            <div class="mt-4 text-[14px] text-gray-800">
                                Shipping
                            </div>
                            <div class="justify-start flex">
                                <dl
                                    class="mb-3 italic space-y-px text-[10px] text-blue-600"
                                >
                                    Vietnam: Recipient pays for shipping service
                                    at the time of delivery.
                                </dl>
                            </div>
                            <div>
                                <fieldset class="space-y-2 mr-4">
                                    <div>
                                        <label
                                            for="paypal"
                                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 p-1 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500"
                                        >
                                            <p class="text-gray-700">Paypal</p>
                                            <input
                                                type="radio"
                                                name="payment"
                                                value="paypal"
                                                id="paypal"
                                                class="sr-only"
                                                v-model="payment"
                                            />
                                        </label>
                                    </div>
                                    <div>
                                        <label
                                            for="qr"
                                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 p-1 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500"
                                        >
                                            <p class="text-gray-600">
                                                Quét mã QR code
                                            </p>
                                            <input
                                                type="radio"
                                                name="payment"
                                                value="qr"
                                                id="qr"
                                                class="sr-only"
                                                v-model="payment"
                                            />
                                        </label>
                                    </div>
                                    <div>
                                        <label
                                            for="bank"
                                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 p-1 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500"
                                        >
                                            <p class="text-gray-600">
                                                Chuyển khoản ngân hàng
                                            </p>
                                            <input
                                                type="radio"
                                                name="payment"
                                                value="bank"
                                                id="bank"
                                                class="sr-only"
                                                v-model="payment"
                                            />
                                        </label>
                                    </div>
                                    <div>
                                        <label
                                            for="meet"
                                            class="flex cursor-pointer items-center justify-between gap-4 rounded-lg border border-gray-100 p-1 text-sm font-medium shadow-sm hover:border-gray-200 has-[:checked]:border-blue-500 has-[:checked]:ring-1 has-[:checked]:ring-blue-500"
                                        >
                                            <p class="text-gray-600">
                                                Thanh toán khi nhận hàng
                                            </p>
                                            <input
                                                type="radio"
                                                name="payment"
                                                value="meet"
                                                id="meet"
                                                class="sr-only"
                                                v-model="payment"
                                            />
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                            <div
                                v-if="errorMessages.length"
                                class="error-messages mt-3 text-xs text-red-600"
                            >
                                <ul>
                                    <li
                                        class="mt-1"
                                        v-for="(error, index) in errorMessages"
                                        :key="index"
                                    >
                                        {{ error }}
                                    </li>
                                </ul>
                            </div>
                            <div class="my-4 flex justify-center">
                                <div class="flex">
                                    <button
                                        class="mr-1 bg-gray-800 hover:bg-black px-10 py-2 text-sm rounded-xl text-white w-auto"
                                    >
                                        Next
                                    </button>
                                </div>
                                <div>
                                    <router-link to="/cart">
                                        <a
                                            href="#"
                                            class="block rounded-xl bg-gray-800 hover:bg-black px-6 py-2 text-sm text-white transition"
                                        >
                                            Show cart
                                        </a>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="flex my-3 mx-3">
                                <p
                                    class="text-[15px] italic mr-1 text-gray-700"
                                >
                                    No items.
                                </p>
                                <router-link to="/">
                                    <a
                                        class="text-[15px] italic text-blue-600 hover:text-blue-800"
                                        href="#"
                                        >Shopping Here</a
                                    >
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
export default {
    name: "Checkout",
    data() {
        return {
            cartCheckout: [],
            errorMessages: [],
            cartQuantity: null,
            checkoutTotal: null,
            checkoutSubtotal: null,
            totalDiscountAmount: null,
            voucherCode: null,
            name: "",
            email: "",
            phone: "",
            address: "",
            note: "",
            payment: "",
        };
    },
    mounted() {
        axios
            .get("/api/checkout/view")
            .then((response) => {
                if (
                    response.data.success == false &&
                    response.data.cart == false
                ) {
                    this.$router.push({ name: "Error" });
                }
                if (response.data.success == true) {
                    this.cartCheckout = response.data.DETACheckout.cartCheckout;
                    if (response.data.DETACheckout.voucherCode > 0) {
                        this.voucherCode =
                            response.data.DETACheckout.voucherCode;
                    } else {
                        this.voucherCode = null;
                    }

                    this.cartQuantity = response.data.DETACheckout.cartQuantity;
                    this.checkoutTotal =
                        response.data.DETACheckout.checkoutTotal;
                    this.checkoutSubtotal =
                        response.data.DETACheckout.checkoutSubtotal;
                    this.totalDiscountAmount =
                        response.data.DETACheckout.totalDiscountAmount;
                } else {
                    this.cartCheckout = null;
                }
            })
            .catch((error) => {
                // console.error("Error:", error);
            });
    },
    methods: {
        showNotification(message) {
            const notification = document.createElement("div");
            notification.classList.add("notificationAddcart");
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => {
                notification.remove();
            }, 2100);
        },
        formatCurrency(value) {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },
        checkout() {
            axios
                .post("/api/checkout/process", {
                    name: this.name,
                    email: this.email,
                    phone: this.phone,
                    address: this.address,
                    note: this.note,
                    payment: this.payment,
                })
                .then((response) => {
                    if (
                        response.data.success == false &&
                        response.data.cart == false
                    ) {
                        this.$router.push({ name: "Error" });
                    }
                    if (response.data.success == true) {
                        this.$router.push({ name: "Payment" });
                    } else if (response.data.errors) {
                        this.errorMessages = response.data.errors;
                    } else {
                        this.errorMessages = response.data.message;
                    }
                })
                .catch((error) => {
                    this.errorMessages = ["An error: " + error];
                });
        },
    },
};
</script>
