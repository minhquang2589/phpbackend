<template>
    <Dashboard page-title="Blog - Edit">
        <form class="max-w-md mx-auto" @submit.prevent="blogUpdate">
            <div class="relative z-0 w-full mb-5 mt-4 group">
                <input
                    type="text"
                    name="title"
                    id="title"
                    v-model="title"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                />
                <label
                    for="title"
                    name="title"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >Blog title</label
                >
            </div>
            <div class="relative z-0 w-full mb-5 mt-4 group">
                <input
                    type="text"
                    name="description"
                    id="description"
                    v-model="description"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                />
                <label
                    for="description"
                    name="description"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                    >Description</label
                >
            </div>

            <div class="max-w-lg">
                <label
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="images"
                    >Avatar</label
                >
                <input
                    require
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="images"
                    for="images"
                    type="file"
                    id="image-input"
                    name="images[]"
                    multiple
                    @change="handleImageUpload"
                />
            </div>
            <div class="mt-3">
                <textarea class="w-full"  v-model="content" name="content" id="editor"></textarea>
            </div>
            <div class="mt-2">
                <label>
                    <input
                        class="size-4 rounded border-gray-300"
                        type="checkbox"
                        name="status"
                        v-model="status"
                    />
                    <span for="status" class="text-red-600 ml-3">Status</span>
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
            <div class="mb-5 mt-2 w-full">
                <div class="flex py-3 justify-start lg:flex lg:justify-start">
                    <button
                        type="submit"
                        class="block mr-2 rounded-xl bg-gray-800 px-8 py-2 text-sm text-white transition hover:bg-black"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </Dashboard>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from "vuex";
import Dashboard from "@/components/Dashboard.vue";
export default {
    name: "EditBlog",
    components: {
        Dashboard,
    },
    data() {
        return {
            errorMessages: [],
            images: [],
            status: false,
            title: "",
            description: "",
            content: "",
        };
    },
    mounted() {
        this.getBlogData();
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        const uploadUrl = "/api/upload/product/file?_token=" + csrfToken;

        ClassicEditor.create(document.querySelector("#editor"), {
            ckfinder: {
                uploadUrl: uploadUrl,
            },
        })
            .then((editor) => {
                editor.model.document.on("change", () => {
                    this.content = editor.getData();
                });
            })
            .catch((error) => {
                console.error(error);
            });
    },
    computed: {
        ...mapGetters(["notification"]),
    },
    methods: {
        ...mapActions(["showNotification"]),

        async getBlogData() {
            try {
                const response = await axios.get(`/api/blog/edit/${this.$route.params.id}`);
                console.log(response.data);
                if (response.data.success == true) {
                    this.title = response.data.blog.title;
                    this.description = response.data.blog.description;
                    this.status = response.data.blog.status;
                    this.images = response.data.blog.image_url;
                    this.content = response.data.blog.content;
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
        async blogUpdate() {
            const file = this.images[0];
            const blogId = this.$route.params.id;
            let formData = new FormData();
            formData.append("title", this.title);
            formData.append("description", this.description);
            formData.append("content", this.content);
            formData.append("status", this.status ? 1 : 0);
            formData.append("images", file);
            formData.append("blogId", blogId);

            axios
                .post("/api/blog/update", formData, {
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
