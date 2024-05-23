<template>
    <div
        @mouseleave="mouseleave"
        class="flex h-screen w-8/12 fixed z-50 flex-col justify-between border-e bg-white"
    >
        <div class="px-4 py-6">
            <button @click="closeSidebar" class="togger-hidden">X</button>
            <ul class="mt-6 space-y-1">
                <li>
                    <router-link to="/">
                        <a
                            href="#"
                            class="block rounded-lg hover:bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900"
                        >
                            Home
                        </a>
                    </router-link>
                </li>

                <li>
                    <details
                        class="group [&_summary::-webkit-details-marker]:hidden"
                    >
                        <summary
                            class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-900 hover:bg-gray-100"
                        >
                            <span class="text-sm font-medium"> Products </span>

                            <span
                                class="shrink-0 transition duration-300 group-open:-rotate-180"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                        </summary>
                        <ul class="mt-2 space-y-1 px-4">
                            <li>
                                <router-link to="/product">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        All products
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/product/bestseller">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        BestSellers
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/product/new">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        New products
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/product/men">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        Men wear's
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/product/women">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        Women wear's
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/product/unisex">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        For unisex
                                    </a>
                                </router-link>
                            </li>
                            <li>
                                <router-link to="/product/discount">
                                    <a
                                        href="#"
                                        class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                                    >
                                        Discounts
                                    </a>
                                </router-link>
                            </li>
                        </ul>
                    </details>
                </li>

                <li>
                    <router-link to="/about">
                        <a
                            href="#"
                            class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                        >
                            About
                        </a>
                    </router-link>
                </li>

                <li>
                    <router-link to="/blog">
                        <a
                            href="#"
                            class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                        >
                            Blog
                        </a>
                    </router-link>
                </li>
                <li>
                    <router-link to="/contact">
                        <a
                            href="#"
                            class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100"
                        >
                            Contact
                        </a>
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    name: "Siderbar",
    props: {
        toggleSidebar: {
            type: Function,
            required: true,
        },
    },
    methods: {
        closeSidebar() {
            this.toggleSidebar();
        },
        mouseleave() {
            this.toggleSidebar();
        },
    },
};
</script>
