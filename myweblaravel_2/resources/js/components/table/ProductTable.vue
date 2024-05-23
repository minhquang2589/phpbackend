<template>
    <div class="w-fit flex justify-center items-center ml-3">
        <Dashboard page-title="Product - Upload">
           ffwe
        </Dashboard>
    </div>
</template>
<script>
import axios from "axios";
import Dashboard from "@/components/Dashboard.vue";
export default {
    name: "ProductTable",
    components: {
        Dashboard,
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
                    `/api/products/table?page=${this.page}`
                );
                console.log(response);

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
                document.documentElement.offsetHeight - 1;
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
