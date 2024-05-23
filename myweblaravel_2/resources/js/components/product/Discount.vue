<template>
    <div class="mt-5 mb-2 flex justify-center">
        <div>
            <h1 class="lg:text-xl text-sm font-bold text-gray-900 sm:text-3xl">
                Discount products
            </h1>
        </div>
    </div>
    <span class="flex items-center">
        <span class="h-px flex-1 bg-gray-400"></span>
    </span>
    <div
        class="grid grid-cols-2 lg:mx-6 lg:grid-cols-4 2xl:grid-cols-5 lg:gap-1"
    >
        <div v-for="product in displayedProducts" :key="product.id">
            <div class="product-card w-full rounded-lg">
                <div class="group rounded-xl relative block overflow-hidden">
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
                            <router-link
                                :to="{
                                    name: 'ViewProduct',
                                    params: { id: product.id },
                                }"
                                class="group relative justify-center flex items-center overflow-hidden rounded-full border w-fit px-6 py-1.5 lg:px-6 lg:py-2 text-gray-500 focus:outline-none focus:ring active:text-gray-600"
                            >
                                <button
                                    class="text-sm font-medium transition-all group-hover:me-4"
                                >
                                    View Product
                                </button>
                            </router-link>
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
import Filter from "@/components/layout/Filter.vue";
import FilterMobile from "@/components/layout/FilterMobile.vue";

export default {
    name: "Discount",
    components: {
        Filter,
        FilterMobile,
    },
    data() {
        return {
            products: [],
            displayedProducts: [],
            page: 1,
            perPage: 36,
            hasMore: true,
            filters: {},
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
        async fetchData() {
            try {
                const response = await axios.get(
                    `/api/products/discount?page=${this.page}`
                );
                const newProducts = response.data.productViews;
                if (newProducts.length < this.perPage) {
                    this.hasMore = false;
                }
                this.products = this.products.concat(newProducts);
                this.applyFilters();
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
        updateFilters(filters) {
            this.filters = filters;
            this.applyFilters();
        },
        applyFilters() {
            let filteredProducts = [...this.products];

            if (this.filters.searchKey) {
                filteredProducts = filteredProducts.filter((product) =>
                    product.name
                        .toLowerCase()
                        .includes(this.filters.searchKey.toLowerCase())
                );
            }

            if (
                this.filters.priceFrom !== null &&
                this.filters.priceTo !== null
            ) {
                filteredProducts = filteredProducts.filter(
                    (product) =>
                        product.price >= this.filters.priceFrom &&
                        product.price <= this.filters.priceTo
                );
            }

            if (this.filters.filternew === true) {
                filteredProducts = filteredProducts.filter(
                    (product) => product.is_new == 1
                );
            }

            if (this.filters.filterDiscount === true) {
                filteredProducts = filteredProducts.filter(
                    (product) => product.discount > 0
                );
            }

            if (this.filters.instock === true) {
                filteredProducts = filteredProducts.filter(
                    (product) => product.total_quantity > 0
                );
            }

            if (this.filters.outofstock === true) {
                filteredProducts = filteredProducts.filter(
                    (product) => product.total_quantity <= 0
                );
            }
            this.displayedProducts =
                filteredProducts.length > 0 ? filteredProducts : this.products;
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
