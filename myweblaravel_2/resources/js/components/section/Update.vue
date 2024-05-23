<template>
    <Dashboard page-title="BLog - Update">
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
                                images
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Title
                            </th>
                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Status
                            </th>

                            <th
                                class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                            >
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        v-for="value in dataSection"
                        :key="value.id"
                        class="divide-y divide-gray-200"
                    >
                        <tr>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                <img
                                    :src="`/images/${value.image}`"
                                    :alt="value.name"
                                    class="size-28 rounded object-cover"
                                />
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                {{ value.title }}
                            </td>
                            <td
                                class="whitespace-nowrap px-4 py-2 text-gray-900"
                            >
                                <p
                                    v-if="value.status == 1"
                                    class="flex justify-center rounded-full text-white bg-red-600 py-1 px-1 text-xs"
                                >
                                    Active
                                </p>
                                <p
                                    v-else
                                    class="flex justify-center rounded-full text-white bg-red-600 py-1 text-xs"
                                >
                                    No
                                </p>
                            </td>

                            <td>
                                <button
                                    @click="deleteSection(value.id)"
                                    type="button"
                                    class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full"
                                >
                                    Delete
                                </button>
                            </td>
                            <td>
                                <button
                                    @click="goToEditPage(value.id)"
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
    name: "blogUpdate",
    components: {
        Dashboard,
    },
    data() {
        return {
            dataSection: [],
        };
    },
    mounted() {
        this.fetchDataSection();
    },
    computed: {
        ...mapGetters(["notification"]),
    },
    methods: {
        ...mapActions(["showNotification"]),
        async fetchDataSection() {
            try {
                const response = await axios.get("/api/section/view");
               //  console.log(response);
                if (response.data.success == true) {
                    this.dataSection = response.data.dataSection;
                } else {
                    console.log("error" + response);
                }
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
        async deleteSection(sectionId) {
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
                        `/api/section/delete/${sectionId}`
                    );
                    console.log(response);
                    if (response.data.success) {
                        // this.showNotification(response.data.message);
                        this.fetchDataSection();
                    } else {
                        console.error("Failed to delete voucher");
                    }
                } catch (error) {
                    console.error("Error deleting voucher:", error);
                }
            }
        },
        goToEditPage(sectionId) {
            this.$router.push({
                name: "EditSection",
                params: { id: sectionId },
            });
        },
    },
};
</script>
