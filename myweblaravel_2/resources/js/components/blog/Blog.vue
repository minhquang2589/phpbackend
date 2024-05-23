<template>
    <div class="my-2 ml-3">
        <nav aria-label="Breadcrumb">
            <ol class="flex items-center gap-1 text-sm text-gray-600">
                <li>
                    <a href="" class="block transition hover:text-gray-700">
                        <span class="sr-only"> Home </span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                    </a>
                </li>

                <li class="rtl:rotate-180">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </li>

                <li>
                    <a href="" class="block transition hover:text-gray-700">
                        Blog
                    </a>
                </li>
            </ol>
        </nav>
    </div>
    <div
        class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased"
    >
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert"
            >
                <div class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div
                            class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white"
                        >
                            <img
                                class="mr-4 w-16 h-16 rounded-full"
                                :src="'/images/' + image_url"
                                alt="Avatar"
                            />
                            <div>
                                <p
                                    class="text-xl font-bold text-gray-900 dark:text-white"
                                >
                                    {{ title }}
                                </p>
                            </div>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white"
                    >
                        {{ description }}
                    </h1>
                    <div v-html="content"></div>
                </div>
            </article>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "Section",
    data() {
        return {
            title: "",
            image_url: "",
            description: "",
            content: "",
            title: "",
        };
    },
    mounted() {
        axios
            .get("/api/blog")
            .then((response) => {
               //  console.log(response.data);
                if (response.data.success == true) {
                    this.title = response.data.blog.title;
                    this.image_url = response.data.blog.image_url;
                    this.description = response.data.blog.description;
                    this.content = response.data.blog.content;
                }
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    },
};
</script>
