<template>
    <div>
        <div class="text-center mt-10">
            <h1 class="text-xl font-bold text-gray-900 sm:text-3xl">Payment</h1>
        </div>
    </div>
    <div class="px-4 py-5 mb-10 lg:px-52 lg:py-20">
        <div class="grid grid-cols-1 gap-1 lg:grid-cols-2 lg:gap-1">
            <div class="h-full mt-8 lg:mt-10">
                <div class="flex justify-center">
                    <img
                        alt=""
                        class="h-4/5 w-3/5 lg:w-40 lg:h-48 object-cover transition duration-500 group-hover:scale-105"
                    />
                </div>
                <div class="flex mt-5 justify-center">
                    <span class="text-[12px] text-red-600">
                        Please transfer the correct content
                        <strong> {{ orderNumber }}</strong> for we can confirm
                        the payment
                    </span>
                </div>
                <div class="flex mt-3 mb-10 justify-center">
                    <div>
                        <table>
                            <tr>
                                <td class="text-[12px] flex justify-end">
                                    Account name:
                                </td>
                                <td class="text-[12px] px-4 ml-4">
                                    NGO MINH QUANG
                                </td>
                            </tr>
                            <tr>
                                <td class="text-[12px] flex justify-end">
                                    Account number:
                                </td>
                                <td class="text-[12px] px-4 ml-4">
                                    1035505217
                                </td>
                            </tr>
                            <tr>
                                <td class="text-[12px] flex justify-end">
                                    Bank:
                                </td>
                                <td class="text-[12px] px-4 ml-4">
                                    Vietcombank
                                </td>
                            </tr>
                            <tr>
                                <td class="text-[12px] flex justify-end">
                                    Total:
                                </td>
                                <td class="text-[12px] px-4 ml-4">
                                    {{ formatCurrency(totalPrice) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-[12px] flex justify-end">
                                    Memo:
                                </td>
                                <td class="text-[12px] px-4 ml-4">
                                    <strong class="text-red-600">{{
                                        orderNumber
                                    }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="h-fit bg-gray-100">
                <div class="ml-3 mr-3 mt-3">
                    <div class="flex justify-start">
                        <span class="text-gray-800 text-sm italic"
                            >Thank you. Your order has been received!</span
                        >
                    </div>
                    <div class="mt-3 ml-3 lg:mt-3 lg:ml-3">
                        <ul>
                            <li class="text-xs text-black">
                                Order number:
                                <strong>{{ orderNumber }}</strong>
                            </li>
                            <li class="text-xs">
                                Date: <strong>{{ date }}</strong>
                            </li>
                            <li class="text-xs">
                                Total price:
                                <strong>{{
                                    formatCurrency(totalPrice)
                                }}</strong>
                            </li>
                            <li class="text-xs">
                                Payment method:
                                <strong>{{ paymentMethod }}</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="flex mt-2 justify-between">
                        <div class="text-gray-800 text-sm">Order Detail</div>
                        <div class="text-gray-800 text-sm">Order Total</div>
                    </div>
                </div>
                <div class="flex justify-end border-t border-gray-600"></div>
                <div class="ml-3 mr-3 mt-3">
                    <div
                        v-for="value in cartCheckout"
                        :key="value.id"
                        class="flex justify-between"
                    >
                        <div>
                            <span class="text-[12px]">
                                {{ value.name }} - {{ value.size }} x
                                {{ value.quantity }}
                                <span v-if="value.discountPercent > 0">
                                    - {{ value.discountPercent }}%</span
                                >
                            </span>

                            <div class="text-[12px]">
                                Color: {{ value.color }}
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="text-[12px]">
                                {{ formatCurrency(value.price) }}
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex my-1 justify-end border-t border-gray-300"
                    ></div>
                    <div v-if="totalDiscountAmount && totalDiscountAmount >0 ">
                        <span class="text-[12px] flex justify-between">
                            <dt class="inline">Total discount:</dt>
                            <dd class="inline">
                                {{ formatCurrency(totalDiscountAmount) }}
                            </dd>
                        </span>
                    </div>
                    <form @submit.prevent="handleCheckout">
                        <div class="mt-3 lg:mt-3">
                            <ul>
                                <li class="text-xs mt-1 text-black">
                                    Name: {{ name }}
                                </li>
                                <li class="text-xs mt-1 text-black">
                                    Email: {{ email }}
                                </li>
                                <li class="text-xs mt-1 text-black">
                                    Phone :{{ phone }}
                                </li>
                                <li class="text-xs mt-1 text-black">
                                    Address: {{ address }}
                                </li>
                                <li v-if="note" class="text-xs mt-1 text-black">
                                    Note :{{ note }}
                                </li>
                            </ul>
                        </div>
                        <div class="my-4 flex justify-center">
                            <button
                                type="submit"
                                class="mr-1 text-sm rounded-xl text-white px-10 py-2 font-medium bg-gray-800 hover:bg-black"
                            >
                                Confirm
                            </button>
                            <a
                                href="javascript:void(0);"
                                onclick="window.history.back()"
                                class="text-sm rounded-xl text-white px-12 py-2 font-medium bg-gray-800 hover:bg-black"
                            >
                                Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
export default {
    name: "Payment",
    data() {
        return {
            cartCheckout: [],
            errorMessages: [],
            cartQuantity: null,
            checkoutTotal: null,
            checkoutSubtotal: null,
            totalDiscountAmount: 0,
            voucherCode: null,
            orderNumber: null,
            date: null,
            totalPrice: null,
            name: "",
            email: "",
            phone: "",
            address: "",
            note: "",
            paymentMethod: "",
        };
    },
    mounted() {
        axios
            .get("/api/checkout/payment")
            .then((response) => {
                if (response.data.success == true) {
                    this.cartCheckout = response.data.data.cartCheckout;
                    this.cartQuantity = response.data.data.cartQuantity;
                    this.checkoutSubtotal = response.data.data.checkoutSubtotal;
                    this.totalDiscountAmount =
                        response.data.data.totalDiscountAmount;
                    this.orderNumber = response.data.orderNumber;
                    this.name = response.data.element.name;
                    this.email = response.data.element.email;
                    this.phone = response.data.element.phone;
                    this.address = response.data.element.address;
                    this.note = response.data.element.notes;
                    this.totalPrice = response.data.data.checkoutSubtotal;
                    this.date = response.data.time;
                    this.paymentMethod = response.data.element.payment;
                }
                if (
                    response.data.success == false &&
                    response.data.payment == false
                ) {
                    this.$router.push({ name: "Error" });
                }
            })
            .catch((error) => {
                // console.error("Error:", error);
            });
    },
    computed: {
        ...mapGetters(["cart", "cartData"]),
    },
    methods: {
        ...mapActions(["fetchCart", "fetchCartData", "fetchCartQuantity"]),
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
        handleCheckout() {
            axios
                .post("/api/handle/checkout")
                .then((response) => {
                    // console.log(response.data);
                    console.log(response.data);
                    if (response.data.success == true) {
                        this.fetchCart();
                        this.fetchCartData();
                        this.fetchCartQuantity();
                        this.$router.push({ name: "Confirm" });
                    }
                    if (response.data.success == false) {
                        this.showNotification(response.data.error);
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
