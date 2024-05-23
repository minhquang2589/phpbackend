<template>
    <Layout>
        <div>
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:gap-8">
                <div v-for="product in products" :key="product.id">
                    <div class="product-card w-full rounded-lg">
                        <div
                            class="group rounded-xl relative block overflow-hidden"
                        >
                            <button
                                v-if="product.is_new"
                                class="absolute end-4 top-4 z-10 p-1 new-badge"
                            >
                                Mới
                            </button>
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
                                </div>
                                <p
                                    class="mt-1.5 text-[11px] lg:text-sm text-gray-600 transition hover:text-gray-800"
                                >
                                    {{ product.price }} VND
                                </p>
                                <div class="flex justify-center mt-1">
                                    <a
                                        :data-product-id="product.id"
                                        :id="`addToCartBtnView${product.id}`"
                                        class="group relative justify-center flex items-center overflow-hidden rounded-full border w-fit px-6 py-1.5 lg:px-6 lg:py-2 text-gray-500 focus:outline-none focus:ring active:text-gray-600"
                                    >
                                        <button
                                            class="text-sm font-medium transition-all group-hover:me-4"
                                        >
                                            Xem Sản Phẩm
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import axios from "axios";
import Layout from "@/components/Layout.vue";

export default {
    name: "Products",
    components: {
        Layout,
    },
    data() {
        return {
            products: [],
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                const response = await axios.get("/api/products");
                console.log(response.data[0].products);
                this.products = response.data[0].products;
            } catch (error) {
                console.error("Lỗi khi lấy dữ liệu sản phẩm:", error);
            }
        },
    },
};
</script>
