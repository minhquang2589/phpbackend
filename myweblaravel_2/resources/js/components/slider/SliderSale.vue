<template>
    <div class="sl_2">
        <div class="my-5 flex justify-center">
            <div>
                <h1
                    class="lg:text-xl text-sm font-bold text-gray-900 sm:text-3xl"
                >
                    Discount products
                </h1>
            </div>
        </div>
        <router-link to="/product/discount">
            <div
                class="flex justify-end lg:mx-4 mx-2 hover:underline hover:text-blue-700"
            >
                View more
            </div>
        </router-link>
        <div
            v-if="$route.meta.showSliderSale"
            class="swiper mySwiper-2 mb-5 mt-1"
        >
            <div class="swiper-wrapper img2">
                <div
                    v-for="slider in SliderSale"
                    :key="slider.id"
                    class="swiper-slide"
                >
                    <div
                        class="group hover:cursor-pointer rounded-xl relative block overflow-hidden"
                    >
                        <div class="flex justify-center">
                            <span
                                v-if="
                                    slider.discount > 0 &&
                                    slider.discount_quantity > 0
                                "
                                class="rounded-full mr-1 absolute z-50 right-2 top-4 text-white bg-red-600 px-1 lg:px-1 lg:py-0.5 text-[8px] lg:text-xs font-medium"
                            >
                                - {{ slider.discount }}%
                            </span>
                        </div>
                        <router-link
                            :to="{
                                name: 'ViewProduct',
                                params: { id: slider.id },
                            }"
                        >
                            <img
                                class="img_slider object-cover transition duration-500 group-hover:scale-105"
                                :src="'/images/' + slider.image"
                                :alt="slider.image"
                            />
                        </router-link>
                    </div>
                </div>
            </div>
            <div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "SliderSale",
    data() {
        return {
            SliderSale: [],
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios
                .get("/api/slider-sale")
                .then((response) => {
                    this.SliderSale = response.data.sliderSale;
                    this.$nextTick(() => {
                        this.initSwiper();
                    });
                })
                .catch((error) => {
                    console.error("Lỗi:", error);
                });
        },
        initSwiper() {
            this.progressCircle = document.querySelector(
                ".autoplay-progress svg"
            );
            this.progressContent = document.querySelector(
                ".autoplay-progress span"
            );

            var swiper2 = new Swiper(".mySwiper-2", {
                slidesPerView: 3,
                // spaceBetween: 1,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    type: "fraction",
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                cssMode: true,
                keyboard: true,
                breakpoints: {
                    768: {
                        slidesPerView: 4,
                    },
                    1000: {
                        slidesPerView: 5,
                    },
                },
            });
        },
    },
};
</script>

<style scoped>
.sl_2 {
    position: relative;
    height: 100%;
}

.sl_2 {
    font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
    font-size: 14px;
    margin: 0;
    padding: 0;
}

.swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}

.swiper-button-next,
.swiper-button-prev {
    color: gray;
}

.swiper-pagination {
    color: gray;
}

.img2 {
    display: flex;
    height: 88%;
}

@media screen and (max-width: 720px) {
    .sl_2 {
        height: 120px;
        width: 100%;
    }

    .swiper-button-next {
        width: 10px;
    }

    .img2 {
        height: 100%;
    }
}

@media screen and (max-width: 1000px) {
    .sl_2 {
        height: 70%;
        width: 100%;
    }

    .swiper-button-next {
        width: 10px;
    }

    .img2 {
        height: 100%;
    }
}
</style>
