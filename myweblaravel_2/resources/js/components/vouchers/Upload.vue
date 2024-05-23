<template>
    <Dashboard page-title="Vouchers - Upload">
        <form class="max-w-md mx-auto" @submit.prevent="voucherUpload">
            <div class="relative z-0 w-full mb-5 mt-4 group">
                <input
                    type="text"
                    name="voucher_code"
                    v-model="voucher_code"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                />
                <label
                    for="voucher_code"
                    name="voucher_code"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >Voucher code</label
                >
            </div>
            <div class="mt-2">
                <label for="start_datetime" class="text-sm">Start day:</label>
                <input
                    type="datetime-local"
                    class="text-sm"
                    name="start_datetime"
                    v-model="start_datetime"
                />
                <br />
                <label for="end_datetime" class="text-sm">End day:</label>
                <input
                    type="datetime-local"
                    id="end_datetime"
                    class="text-sm"
                    name="end_datetime"
                    v-model="end_datetime"
                />
                <br />
                <div class="flex my-3">
                    <input
                        type="number"
                        name="discount_value"
                        placeholder="Discount %"
                        min="0"
                        max="100"
                        v-model="discount_value"
                        oninput="validity.valid||(value='');"
                        class="w-2/3 px-3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                    />
                    |
                    <input
                        type="number"
                        v-model="voucher_quantity"
                        name="voucher_quantity"
                        placeholder="Vouchers Quantity"
                        min="0"
                        oninput="validity.valid||(value='');"
                        class="w-2/3 px-3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                    />
                </div>
                <div class="w-full">
                    <div class="">
                        <select
                            id="status"
                            for="status"
                            name="status"
                            v-model="status"
                            class="block w-full px-3 sm:px-3 lg:px-5 pt-2 pb-1 text-sm text-grey-darker border border-grey-lighter rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option hidden selected disabled>
                                Choose a status
                            </option>
                            <option for="status" value="Active">Active</option>
                            <option for="status" value="Used">Used</option>
                            <option for="status" value="Expired">
                                Expired
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div
                v-if="errorMessages.length"
                class="error-messages mt-2 text-xs text-red-600"
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
            <div
                v-if="errorMessages.length"
                class="error-messages mt-2 text-xs text-red-600"
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
            <div class="mb-5 mt-2 w-full">
                <div class="flex justify-start lg:flex lg:justify-start">
                    <button
                        type="submit"
                        class="text-white mt-6 bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-1/2 sm:w-auto px-20 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </Dashboard>
</template>
<script>
import Dashboard from "@/components/Dashboard.vue";
import { mapGetters, mapMutations, mapActions } from "vuex";

export default {
    name: "VouchersUpload",
    components: {
        Dashboard,
    },
    data() {
        return {
            voucher_code: "",
            start_datetime: "",
            end_datetime: "",
            discount_value: null,
            voucher_quantity: null,
            status: "",
            errorMessages: [],
        };
    },
    computed: {
        ...mapGetters(["notification"]),
    },
    methods: {
        ...mapActions(["showNotification"]),

        async voucherUpload() {
            let formData = new FormData();
            formData.append("voucher_code", this.voucher_code);
            formData.append("start_datetime", this.start_datetime);
            formData.append("end_datetime", this.end_datetime);
            formData.append("discount_value", this.discount_value);
            formData.append("voucher_quantity", this.voucher_quantity);
            formData.append("status", this.status);

            try {
                const response = await axios.post(
                    "/api/voucher/upload",
                    formData
                );
                console.log(response);
                if (response.data.success == true) {
                    this.voucher_code = "";
                    this.start_datetime = "";
                    this.end_datetime = "";
                    this.discount_value = null;
                    this.voucher_quantity = null;
                    this.status = "";
                    this.showNotification(response.data.message);
                } else {
                    this.errorMessages = response.data.error;
                }
            } catch (error) {
                console.error("Error uploading section:", error);
                this.errorMessages = [error.message];
            }
        },
    },
};
</script>
