<template>
    <div
        v-if="$route.meta.showSection"
        class="overflow-hidden black-blur h-fit lg:h-screen lg:mt-0 mt-10 sm:grid sm:grid-cols-2 sm:items-center"
    >
        <div class="">
            <div
                class="mx-auto mb-10 lg:mb-0 max-w-xl text-center ltr:sm:text-left rtl:sm:text-right"
            >
                <h2 class="text-2xl font-bold text-gray-900 md:text-3xl">
                    <a :href="section.link ? section.link : '#'">{{
                        section.title
                    }}</a>
                </h2>
                <p class="hidden text-gray-600 md:mt-4 md:block">
                    {{ section.description }}
                </p>
                <div class="mt-4 md:mt-8">
                    <router-link to="/product/new">
                        <a
                            href="#"
                            class="inline-block rounded-xl bg-gray-900 px-12 py-3 text-sm font-medium text-white transition hover:bg-black focus:outline-none focus:ring focus:ring-yellow-400"
                            >Shopping now</a
                        >
                    </router-link>
                </div>
            </div>
        </div>
        <div class="mb-2 lg:mb-0">
            <router-link to="/product/new">
                <a href="#">
                    <img
                        :src="`/images/${section.image}`"
                        alt=""
                        class="h-full px-1 lg:px-0 w-full object-cover sm:h-[calc(100%_-_2rem)] sm:self-end sm:rounded-ss-[30px] md:h-[calc(100%_-_4rem)] md:rounded-ss-[100px]"
                    />
                </a>
            </router-link>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "Section",
    data() {
        return {
            section: {},
        };
    },
    mounted() {
        axios
            .get("/api/section")
            .then((response) => {
                this.section = response.data.section;
            })
            .catch((error) => {
                console.error("Error fetching section 02 data:", error);
            });
    },
};
</script>
