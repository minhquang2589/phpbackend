<template>
    <Dashboard page-title="Slider - Edit">
        <div class="lg:flex justify-center">
            <div class="w-full px-10 mt-10">
                <form @submit.prevent="sliderUpdate">
                    <div class="">
                        <div class="relative z-0 mb-2 group">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                v-model="name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            />
                            <label
                                for="name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                                >Name content</label
                            >
                        </div>
                        <div class="mb-5">
                            <label
                                class="block mb-2 text-sm font-medium text-gray-500 dark:text-gray-400"
                                for="content3"
                                >Image</label
                            >
                            <input
                                require
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="image"
                                for="images"
                                type="file"
                                id="image-input"
                                name="images[]"
                                multiple
                                @change="handleImageUpload"
                            />
                        </div>
                        <label>
                            <input
                                class="size-4 rounded border-gray-300"
                                type="checkbox"
                                name="status"
                                v-model="status"
                                :checked="status === 1"
                            />
                            <span for="status" class="text-red-600 ml-3"
                                >Status</span
                            >
                        </label>
                    </div>
                    <div
                        v-if="errorMessages.length"
                        class="error-messages mt-1 text-xs text-red-600"
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
                    <div class="flex justify-start lg:flex lg:justify-start">
                        <button
                            type="submit"
                            class="text-white mt-6 bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-2xl text-sm w-1/2 sm:w-auto px-20 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Dashboard>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
import Dashboard from "@/components/Dashboard.vue";
export default {
    name: "EditSlider",
    components: {
        Dashboard,
    },
    data() {
        return {
            errorMessages: [],
            images: [],
            status: false,
            name: "",
        };
    },
    mounted() {
        this.getSliderData();
    },
    computed: {
        ...mapGetters(["notification"]),
    },
    methods: {
        ...mapActions(["showNotification"]),

        async getSliderData() {
            try {
                const sliderId = this.$route.params.id;
                const response = await axios.get(
                    `/api/slider/edit/${sliderId}`
                );
                console.log(response.data);
                if (response.data.success == true) {
                    this.name = response.data.dataSlider.name;
                    this.status = response.data.dataSlider.status;
                } else {
                    console.log("voucher edit error.");
                }
            } catch (error) {
                console.error("Error fetching voucher data:", error);
            }
        },
        handleImageUpload(event) {
            const file = event.target.files[0];
            this.images = [file];
        },
        async sliderUpdate() {
            const file = this.images[0];
            const sliderId = this.$route.params.id;
            let formData = new FormData();
            formData.append("name", this.name);
            formData.append("status", this.status ? 1 : 0);
            formData.append("image", file);
            formData.append("sliderId", sliderId);

            axios
                .post("/api/slider/update", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                      console.log(response.data);
                    if (response.data.success == true) {
                        this.showNotification(response.data.message);
                    } else {
                        this.errorMessages = response.data.error;
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
