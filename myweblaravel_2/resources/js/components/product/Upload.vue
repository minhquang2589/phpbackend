<template>
    <div class="w-fit flex justify-center items-center ml-3">
        <Dashboard page-title="Product - Upload">
            <form @submit.prevent="upload">
                <div class="relative z-0 mb-5 mt-4 group">
                    <input
                        type="text"
                        name="product_name"
                        id="product_name"
                        v-model="product_name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="product_name"
                        name="product_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Product Name</label
                    >
                </div>
                <div class="relative z-0 w-full mb-2 group">
                    <input
                        require
                        type="text"
                        name="price"
                        id="price"
                        v-model="price"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="price"
                        name="price"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >Price</label
                    >
                </div>
                <div class="relative z-0 w-full mt-4 mb-5 group">
                    <input
                        type="text"
                        name="detail1"
                        id="detail1"
                        v-model="detail1"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="detail1"
                        name="detail1"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >miêu tả</label
                    >
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        name="detail2"
                        id="detail2"
                        v-model="detail2"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="detail2"
                        name="detail2"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >đặc điểm 1</label
                    >
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        name="detail3"
                        id="detail3"
                        v-model="detail3"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="detail3"
                        name="detail3"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >đặc điểm 2</label
                    >
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        name="detail4"
                        id="detail4"
                        v-model="detail4"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="detail4"
                        name="detail4"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >đặc điểm 3</label
                    >
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        name="detail5"
                        id="detail5"
                        v-model="detail5"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="detail5"
                        name="detail5"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >đặc điểm 4
                    </label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input
                        type="text"
                        name="detail6"
                        id="detail6"
                        v-model="detail6"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    />
                    <label
                        for="detail6"
                        name="detail6"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"
                        >đặc điểm 5</label
                    >
                </div>
                <div class="form-group flex">
                    <label>
                        <input
                            class="size-4 rounded border-gray-300"
                            type="checkbox"
                            name="is_new"
                            v-model="is_new"
                        />
                        <span class="text-red-600 ml-3"
                            ><strong>New</strong></span
                        >
                    </label>
                </div>
                <div class="mt-4">
                    <div class="w-full mr-5">
                        <div class="">
                            <select
                                id="gender"
                                for="gender"
                                name="gender"
                                v-model="gender"
                                class="block w-full px-3 sm:px-3 lg:px-5 pt-2 pb-1 text-sm text-grey-darker border border-grey-lighter rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option hidden selected disabled>
                                    Choose a gender
                                </option>
                                <option for="gender" value="Men">Men</option>
                                <option for="gender" value="Women">
                                    Women
                                </option>
                                <option for="gender" value="Unisex">
                                    Unisex
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="w-full mr-5">
                        <div class="">
                            <select
                                id="class"
                                for="class"
                                name="class"
                                v-model="class"
                                class="block w-full px-3 sm:px-3 lg:px-5 pt-2 pb-1 text-sm text-grey-darker border border-grey-lighter rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                                <option hidden selected disabled>
                                    Choose a class
                                </option>
                                <option for="class" value="clothes">
                                    clothes
                                </option>
                                <option for="class" value="bag">bag</option>
                                <option for="class" value="hat">hat</option>
                                <option for="class" value="shoe">shoe</option>
                                <option for="class" value="accessory">accessory</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <label for="start_datetime" class="text-sm"
                        >Start discount:</label
                    >
                    <input
                        type="datetime-local"
                        class="text-sm"
                        v-model="start_datetime"
                        id="start_datetime"
                        name="start_datetime"
                    />
                    <br />
                    <label for="end_datetime" class="text-sm"
                        >End discount:</label
                    >
                    <input
                        type="datetime-local"
                        id="end_datetime"
                        class="text-sm"
                        name="end_datetime"
                        v-model="end_datetime"
                    />
                    <br />
                    <div class="flex my-3">
                        <input
                            type="number"
                            name="discountnumber"
                            placeholder="Discount %"
                            min="1"
                            max="100"
                            v-model="discountnumber"
                            oninput="validity.valid||(value='');"
                            class="w-2/3 px-3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                        />
                        |
                        <input
                            type="number"
                            name="discountquantity"
                            placeholder="Discount Quantity"
                            min="0"
                            v-model="discountquantity"
                            oninput="validity.valid||(value='');"
                            class="w-2/3 px-3 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600"
                        />
                    </div>
                </div>
                <div class="max-w-lg">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="image"
                        >Images</label
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
                <div class="colorInputs mt-3" id="colorInputs">
                    <div
                        v-for="(color, colorIndex) in colors"
                        :key="colorIndex"
                    >
                        <label>
                            Color:
                            <input type="text" v-model="color.name" />
                        </label>
                        <br />
                        <div
                            v-for="(size, sizeIndex) in color.sizes"
                            :key="sizeIndex"
                        >
                            <label>
                                Size {{ size.name }}:
                                <input type="number" v-model="size.quantity" />
                            </label>
                            <br />
                        </div>
                    </div>
                </div>
                <button
                    class="block mr-2 rounded-xl bg-gray-400 px-8 py-1 text-sm text-white transition hover:bg-gray-500"
                    type="button"
                    @click="addColorInput"
                >
                    Add color and quantity
                </button>
                <div class="mt-3">
                    <textarea
                        class="w-full"
                        name="description"
                        v-model="description"
                        id="editor"
                    ></textarea>
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
                    <div
                        class="flex py-3 justify-start lg:flex lg:justify-start"
                    >
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
    </div>
</template>
<script>
import axios from "axios";
import Dashboard from "@/components/Dashboard.vue";

export default {
    name: "ProductUpload",
    components: {
        Dashboard,
    },
    data() {
        return {
            errorMessages: [],
            colorCounter: 0,
            colors: [
                {
                    name: "",
                    sizes: [
                        { name: "S", quantity: null },
                        { name: "M", quantity: null },
                        { name: "L", quantity: null },
                        { name: "XL", quantity: null },
                        { name: "2XL", quantity: null },
                    ],
                },
            ],
            product_name: "",
            price: "",
            detail1: "",
            detail2: "",
            detail3: "",
            detail4: "",
            detail5: "",
            detail6: "",
            is_new: false,
            description: "",
            gender: "",
            start_datetime: "",
            end_datetime: "",
            discountnumber: "",
            discountquantity: "",
            imageUrl: "",
            class: "",
            images: [],
        };
    },
    mounted() {
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
                    this.description = editor.getData();
                });
            })
            .catch((error) => {
                console.error(error);
            });
    },

    methods: {
        handleImageUpload(event) {
            const files = event.target.files;
            this.images = [];
            for (let i = 0; i < files.length; i++) {
                this.images.push(files[i]);
            }
        },
        showNotification(message) {
            const notification = document.createElement("div");
            notification.classList.add("notificationAddcart");
            notification.textContent = message;
            document.body.appendChild(notification);
            setTimeout(() => {
                notification.remove();
            }, 2100);
        },
        upload() {
            let colorsData = [];
            this.colors.forEach((color) => {
                let sizesData = [];
                color.sizes.forEach((size) => {
                    sizesData.push({
                        name: size.name,
                        quantity: size.quantity,
                    });
                });
                colorsData.push({ name: color.name, sizes: sizesData });
            });
            let formData = new FormData();
            formData.append("product_name", this.product_name);
            formData.append("price", this.price);
            formData.append("class", this.class);
            formData.append("detail1", this.detail1);
            formData.append("detail2", this.detail2);
            formData.append("detail3", this.detail3);
            formData.append("detail4", this.detail4);
            formData.append("detail5", this.detail5);
            formData.append("detail6", this.detail6);
            formData.append("is_new", this.is_new ? 1 : 0);
            formData.append("description", this.description);
            formData.append("gender", this.gender);
            formData.append("start_datetime", this.start_datetime);
            formData.append("end_datetime", this.end_datetime);
            formData.append("discountnumber", this.discountnumber);
            formData.append("discountquantity", this.discountquantity);
            formData.append("colors", JSON.stringify(colorsData));
            for (let i = 0; i < this.images.length; i++) {
                formData.append("images[]", this.images[i]);
            }
            axios
                .post("/api/upload/product", formData, {
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
        addColorInput() {
            this.colors.push({
                name: "",
                sizes: [
                    { name: "S", quantity: null },
                    { name: "M", quantity: null },
                    { name: "L", quantity: null },
                    { name: "XL", quantity: null },
                    { name: "2XL", quantity: null },
                ],
            });
        },
    },
};
</script>
