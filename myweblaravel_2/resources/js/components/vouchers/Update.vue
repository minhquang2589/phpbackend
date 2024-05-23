<template>
    <Dashboard page-title="Vouchers - Update">
        <div class="mx-6 lg:mx-0">
            <div class="flex justify-center">
                <table
                    class="lg:w-fit w-full mx-2 lg:mx-0 divide-gray-200 bg-white text-sm"
                >
                    <thead class="ltr:text-left rtl:text-right">
                        <tr>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                voucher_code
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                discount_value
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                quantity
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                status
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                start_date
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                end_date
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        v-for="voucher in dataVouchers"
                        :key="voucher.id"
                        class="divide-y divide-gray-200"
                    >
                        <tr>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ voucher.voucher_code }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ voucher.discount_value }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ voucher.voucher_quantity }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ voucher.status }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ voucher.start_date }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ voucher.end_date }}
                            </td>
                            <td>
                                <button
                                    @click="deleteVoucher(voucher.id)"
                                    type="button"
                                    class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full"
                                >
                                    Delete
                                </button>
                            </td>
                            <td>
                                <button
                                    @click="goToEditPage(voucher.id)"
                                    class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-full"
                                >
                                    Update
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Dashboard>
</template>
<script>
import Dashboard from "@/components/Dashboard.vue";
import { mapGetters, mapMutations, mapActions } from "vuex";
import Swal from "sweetalert2";
import { useRouter } from "vue-router";

export default {
    name: "VouchersUpdate",
    components: {
        Dashboard,
    },
    data() {
        return {
            dataVouchers: [],
        };
    },
    mounted() {
        this.fetchDataVouchers();
    },
    computed: {
        ...mapGetters(["notification"]),
    },
    methods: {
        ...mapActions(["showNotification"]),
        async fetchDataVouchers() {
            try {
                const response = await axios.get("/api/vouchers/view");
                // console.log(response);
                if (response.data.success == true) {
                    this.dataVouchers = response.data.Vouchers;
                } else {
                    console.log("error" + response);
                }
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
        async deleteVoucher(voucherId) {
            const result = await Swal.fire({
                title: "Are you sure you want to delete?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes!",
                cancelButtonText: "No",
                customClass: {
                    popup: "confirmDeleteContainer",
                    title: "fonfirm_delete_title",
                    confirmButton: "confirm_delete_button",
                    cancelButton: "confirm_cancel_button",
                },
            });

            if (result.isConfirmed) {
                try {
                    const response = await axios.delete(
                        `/api/voucher/delete/${voucherId}`
                    );
                    // console.log(response);
                    if (response.data.success) {
                        this.showNotification(response.data.message);
                        this.fetchDataVouchers();
                    } else {
                        console.error("Failed to delete voucher");
                    }
                } catch (error) {
                    console.error("Error deleting voucher:", error);
                }
            }
        },
        goToEditPage(voucherId) {
            this.$router.push({
                name: "EditVoucher",
                params: { id: voucherId },
            });
        },
    },
};
</script>
