<template>
    <div class="my-5 mb-3 mt-2 mx-3 flex justify-center">
        <div>
            <h1 class="text-xl font-bold mt-7 text-gray-900 sm:text-3xl">
                Related product
            </h1>
        </div>
    </div>
    <span class="flex items-center">
        <span class="h-px flex-1 bg-gray-300"></span>
    </span>
    <div class="h-fit moving rounded-lg lg:col-span-5">
        <div
            class="grid grid-cols-2 lg:mx-6 lg:grid-cols-4 2xl:grid-cols-5 lg:gap-1"
        >
            <div v-for="product in products" :key="product.id">
                <div class="product-card w-full rounded-lg">
                    <div
                        class="group rounded-xl relative block overflow-hidden"
                    >
                        <span
                            v-if="product.discount > 0"
                            class="absolute text-red-600 text-sm end-4 top-4 z-10 p-1"
                        >
                            - {{ product.discount }} %
                        </span>

                        <div>
                            <img
                                :src="`/images/${product.image}`"
                                :alt="product.name"
                                class="primage rounded-t-2xl w-full object-cover transition duration-500 group-hover:scale-105"
                            />
                        </div>
                        <div class="relative p-6">
                            <div class="flex items-baseline lg:items-start">
                                <h3
                                    class="mr-3 flex text-[11px] lg:text-sm font-medium"
                                >
                                    {{ product.name }}
                                </h3>
                                <span
                                    v-if="product.is_new"
                                    class="rounded-full mr-1 text-white bg-red-600 px-1 py-0.5 lg:px-2 lg:py-1 text-xs"
                                >
                                    New
                                </span>
                            </div>
                            <p
                                class="mt-1.5 text-[11px] lg:text-sm text-gray-600 transition hover:text-gray-800"
                            >
                                {{ formatCurrency(product.price) }}
                            </p>
                            <div class="flex justify-center mt-1">
                                <div
                                    class="group relative justify-center flex items-center overflow-hidden rounded-full border w-fit px-6 py-1.5 lg:px-6 lg:py-2 text-gray-500 focus:outline-none focus:ring active:text-gray-600"
                                >
                                    <button
                                        class="text-sm font-medium transition-all group-hover:me-4"
                                        @click="viewProduct(product.id)"
                                    >
                                        View Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="hasMore" class="flex mt-2 w-full items-center justify-center">
        <button @click="loadMore" class="text-gray-800 hover:underline">
            Loading...
        </button>
    </div>
    <div v-else class="flex mt-2 w-full items-center justify-center">
        <span class="text-gray-800"> End </span>
    </div>
</template>
<script>
import axios from "axios";
import { mapActions, mapState } from "vuex";
export default {
    name: "RelatedProduct",
    emits: ["viewProduct"],
    data() {
        return {
            products: [],
            page: 1,
            perPage: 36,
            hasMore: true,
        };
    },
    mounted() {
        this.fetchData();
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    methods: {
        viewProduct(productId) {
            this.$emit("viewProduct", productId);
            this.$router.push({
                name: "ViewProduct",
                params: { id: productId },
            });
        },
        async fetchData() {
            try {
                const response = await axios.get(
                    `/api/products/related?page=${this.page}`
                );
                const newProducts = response.data.productsMore;
                if (response.data.hasMore == false) {
                    this.hasMore = false;
                }
                this.products = this.products.concat(newProducts);
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },

        loadMore() {
            if (this.hasMore) {
                this.page += 1;
                this.fetchData();
            }
        },
        handleScroll() {
            const bottomOfWindow =
                window.innerHeight + window.scrollY >=
                document.documentElement.offsetHeight - 40;
            if (bottomOfWindow && this.hasMore) {
                this.loadMore();
            }
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
