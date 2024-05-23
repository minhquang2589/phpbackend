<template>
    <div class="w-fit flex justify-center items-center ml-3">
        <Dashboard page-title="Product - Update">
            <div>
                <div>
                    <div
                        class="overflow-x-auto rounded-lg border border-gray-200"
                    >
                        <table
                            class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm"
                        >
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Image
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Name
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Colors
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Sizes
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Quantity
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Price
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Is New
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Sale Count
                                    </th>
                                    <th
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                v-for="product in products"
                                :key="product.id"
                                class="divide-y divide-gray-200"
                            >
                                <tr>
                                    <td class="lg:w-2/12 w-4/12">
                                        <img
                                            :src="`/images/${product.image}`"
                                            :alt="product.name"
                                            class="object-cover w-full transition duration-500 group-hover:scale-105"
                                        />
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                    >
                                        {{ product.name }} - {{ product.id }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700"
                                    >
                                        <p
                                            v-for="(
                                                color, index
                                            ) in productColors[product.id]"
                                            :key="index"
                                        >
                                            {{ color.color }}
                                        </p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700"
                                    >
                                        <p
                                            v-for="(
                                                size, index
                                            ) in productSizes[product.id]"
                                            :key="index"
                                        >
                                            {{ size.size }}
                                        </p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700"
                                    >
                                        <p
                                            v-for="(
                                                quantity, index
                                            ) in productQuantity[product.id]"
                                            :key="index"
                                        >
                                            {{ quantity }}
                                        </p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700"
                                    >
                                        {{ formatCurrency(product.price) }}
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700"
                                    >
                                        <p
                                            v-if="product.is_new"
                                            class="flex justify-center rounded-full text-white bg-red-600 py-1 text-xs"
                                        >
                                            new
                                        </p>
                                        <p
                                            v-else
                                            class="flex justify-center rounded-full text-white bg-red-600 py-1 text-xs"
                                        >
                                            Not new
                                        </p>
                                    </td>
                                    <td
                                        class="whitespace-nowrap px-4 py-2 text-gray-700"
                                    >
                                        {{ product.sales_count }}
                                    </td>
                                    <td>
                                        <button
                                            @click="deleteProduct(product.id)"
                                            type="button"
                                            class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                    <td>
                                        <button
                                            @click="
                                                goToProductEditPage(product.id)
                                            "
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
                <div class="flex justify-center py-5">
                    <div class="inline-flex items-center justify-center gap-3">
                        <button
                            @click="prevPage"
                            class="inline-flex size-8 items-center justify-center rounded border border-gray-300 hover:border-gray-600 bg-white text-gray-900 rtl:rotate-180"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                        <p class="text-xs text-gray-900">
                            {{ page }}
                            <span class="mx-0.25">/</span>
                            {{ totalPage }}
                        </p>

                        <button
                            @click="nextPage"
                            class="inline-flex size-8 items-center justify-center rounded border border-gray-300 hover:border-gray-600 bg-white text-gray-900 rtl:rotate-180"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-3 w-3"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </Dashboard>
    </div>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
import Dashboard from "@/components/Dashboard.vue";
import Swal from "sweetalert2";
export default {
    name: "ProductUpdate",
    components: {
        Dashboard,
    },
    data() {
        return {
            products: [],
            displayedProducts: [],
            productVariant: [],
            page: 1,
            perPage: 10,
            hasMore: true,
            totalPage: null,
            filters: {},
            productColors: {},
            productSizes: {},
            productQuantity: {},
        };
    },
    mounted() {
        this.fetchData();
    },
    computed: {
        ...mapGetters(["notification"]),

        startIndex() {
            return (this.page - 1) * this.perPage;
        },
        endIndex() {
            return this.page * this.perPage;
        },
        paginatedProducts() {
            return this.displayedProducts.slice(this.startIndex, this.endIndex);
        },
    },
    methods: {
        ...mapActions(["showNotification"]),
        nextPage() {
            if (this.page * this.perPage < this.displayedProducts.length) {
                this.page++;
                this.fetchData();
            }
        },
        prevPage() {
            if (this.page > 1) {
                this.page--;
                this.fetchData();
            }
        },
        async deleteProduct(productId) {
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
                        `/api/product/delete/${productId}`
                    );
                    if (response.data.success) {
                        // this.showNotification(response.data.message);
                        this.fetchData();
                    } else {
                        console.error("Failed to delete product");
                    }
                } catch (error) {
                    console.error("Error deleting product:", error);
                }
            }
        },
        async fetchData() {
            try {
                const response = await axios.get(
                    `/api/products/table?page=${this.page}`
                );
                // console.log(response.data);
                this.displayedProducts = response.data.stock;
                this.products = response.data.productViews;
                this.totalPage = Math.ceil(
                    response.data.stock.length / this.perPage
                );
                response.data.stock.forEach((product) => {
                    if (!this.productColors[product.product_id]) {
                        this.productColors[product.product_id] = [];
                    }
                    if (!this.productSizes[product.product_id]) {
                        this.productSizes[product.product_id] = [];
                    }
                    if (!this.productQuantity[product.product_id]) {
                        this.productQuantity[product.product_id] = [];
                    }
                    this.productSizes[product.product_id].push(product.size);
                    this.productColors[product.product_id].push(product.color);
                    this.productQuantity[product.product_id].push(
                        product.quantity
                    );
                });
                window.scrollTo({ top: 0, behavior: "smooth" });
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
        goToProductEditPage(productId) {
            this.$router.push({
                name: "EditProduct",
                params: { id: productId },
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
