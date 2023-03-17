<template>
    <div>
        <HeaderTop/>
        <HeaderBottom/>

        <router-view></router-view>

        <FooterTop/>
        <FooterBottom/>

        <div v-show="showBackCover" @click="showBackgroundCover(false)" class="background-cover"></div>
    </div>
</template>

<script>
import HeaderTop from "../components/HeaderComponents/HeaderTop.vue";
import HeaderBottom from "../components/HeaderComponents/HeaderBottom.vue";

import HomePage from "../pages/HomePage.vue";
import PersonalizePage from "../pages/PersonalizePage.vue";
import CartPage from "../pages/CartPage.vue";
import CheckoutPage from "../pages/CheckoutPage.vue";
import ProductPage from "../pages/ProductPage.vue";
import CategoryPage from "../pages/CategoryPage.vue";

import FooterTop from "../components/FooterComponents/FooterTop.vue";
import FooterBottom from "../components/FooterComponents/FooterBottom.vue";

export default {
    name: "App",
    components: {
        HeaderTop,
        HeaderBottom,

        HomePage,
        PersonalizePage,
        CartPage,
        CheckoutPage,
        ProductPage,
        CategoryPage,

        FooterTop,
        FooterBottom,
    },
    data: () => ({
        showBackCover: false
    }),
    beforeDestroy() {
        window.VBus.stop('toggle-background-cover', this.showBackgroundCover);
    },
    mounted() {
        window.VBus.listen('toggle-background-cover', this.showBackgroundCover);
    },
    methods: {
        showBackgroundCover(flag) {
            this.showBackCover = flag;

            if (!flag) {
                window.VBus.fire("hide-category-menu");
                document.querySelector('.background-cover').style.height = 0;
                document.querySelector('#navbarSupportedContent').style.height = '100vh';
            } else {
                document.querySelector('.background-cover').style.height = `${document.body.getBoundingClientRect().height}px`;
                document.querySelector('#navbarSupportedContent').style.height = `${document.body.getBoundingClientRect().height - 40}px`;
            }
        }
    }
};
</script>

<style lang="scss">
@import "~bootstrap/scss/bootstrap";
@import "~@fortawesome/fontawesome-free/css/all.css";

body * {
    font-family: "Poppins", sans-serif;

}
</style>
