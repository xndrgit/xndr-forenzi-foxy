<template>
    <div class="home">
        <div class="container-lg">
            <!-- <loadingComponent v-if="loadingCategories" /> -->

            <div
                v-if="categories"
                class="d-flex flex-wrap justify-content-around justify-content-sm-between col-12"
            >
                <NavBoxesComponent
                    v-for="item in categories"
                    :key="item.name"
                    :category="item"
                />
                <div @click="goToPersonalizePage">
                    <CustomizeBoxesComponent />
                </div>
            </div>

            <hr />

            <div class="row justify-content-center">
                <!-- <loadingRollComponent class="py-5 my-5" v-if="loadingProduct" /> -->
                <ShowBox2 />
                <!-- <h4 class="fw-bold py-2">Elenco formati disponibili</h4> -->
            </div>
        </div>
        <!-- <ClassicRight /> -->
        <div class="container-lg">
            <hr class="my-4" />

            <TableComponentCategories />
            <BannerNewsComponent />
        </div>
    </div>
</template>

<script>
import ShowBox2 from "../components/MainComponents/ShowBox2.vue";

import NavBoxesComponent from "../components/MainComponents/NavBoxesComponent.vue";
import CustomizeBoxesComponent from "../components/MainComponents/CustomizeBoxesComponent.vue";

import TableComponentCategory from "../components/MainComponents/TableComponentCategories.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";

import ClassicRight from "../components/MainComponents/ClassicRight.vue";

import LoadingRollComponent from "../components/MainComponents/LoadingRollComponent.vue";
import LoadingComponent from "../components/MainComponents/LoadingComponent.vue";
import TableComponentCategories from "../components/MainComponents/TableComponentCategories.vue";

export default {
    components: {
    ShowBox2,
    NavBoxesComponent,
    CustomizeBoxesComponent,
    TableComponentCategories,
    BannerNewsComponent,
    ClassicRight,
    LoadingRollComponent,
    LoadingComponent,
    TableComponentCategory
},
    data() {
        return {
            loadingCategory: true,
            category: [],

            categories: [],
            loadingCategories: true,
            loadingProduct: true,
        };
    },

    methods: {
        goToPersonalizePage() {
            this.$router.push({ path: "/personalize" });
        },
        getCategories() {
            this.loadingCategories = true;
            axios
                .get("/shop/categories", {})
                .then((response) => {
                    this.categories = response.data.results.data;
                    console.log(response.data.results.data);
                    // this.currentPageCategories =
                    //     response.data.results.currentPage;
                    // this.lastPageCategories = response.data.results.lastPage;
                    this.loadingCategories = false;
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
        getProduct() {
            this.loadingProduct = true;
            axios
                .get(`/shop/products/${this.$route.params.id}`)
                .then((response) => {
                    this.product = response.data.results;
                    this.loadingProduct = false;
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
    },
    created() {
        this.getCategories();
        this.getProduct();
    },
};
</script>

<style lang="scss" scoped>
</style>
