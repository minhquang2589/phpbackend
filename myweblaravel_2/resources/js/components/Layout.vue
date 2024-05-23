<template>
    <div>
       
        <Header v-if="!$route.meta.hideHeaderFooter" />
        <Section v-if="$route.meta.showSection" />
        <Slider v-if="$route.meta.showSlider" />
        <SliderSale v-if="$route.meta.showSliderSale" />
        <main>
            <router-view />
        </main>
        <Footer v-if="!$route.meta.hideHeaderFooter" />
    </div>
</template>

<script>
import Header from "@/components/Header.vue";
import Footer from "@/components/footer/Footer.vue";
import Section from "@/components/section/Section.vue";
import Slider from "@/components/slider/Slider.vue";
import SliderSale from "@/components/slider/SliderSale.vue";
import Product from "@/components/product/Product.vue";

export default {
    components: {
        Header,
        Footer,
        Section,
        SliderSale,
        Slider,
        Product,
    },
};
</script>

