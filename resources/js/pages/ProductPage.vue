<template>
    <div class="home">
        <div class="container">
            <loadingComponent v-if="loadingCategories" />

            <div class="d-flex flex-wrap justify-content-center" v-else>
                <NavBoxesComponent
                    v-for="category in categories"
                    :key="category.name"
                    :category="category"
                />
                <div @click="goToPersonalizePage">
                    <CustomizeBoxesComponent />
                </div>
            </div>

            <hr />

            <div class="d-flex justify-content-center">
                <loadingRollComponent class="py-5 my-5" v-if="loadingProduct" />
                <ShowBox v-else/>
            </div>

            <h6 class="font-weight-bold m-0">Elenco formati disponibili</h6>
            <TableComponent />
            <BannerNewsComponent />
        </div>

        <ClassicLeft />
        <ClassicRight />
    </div>
</template>

<script>
import ShowBox from "../components/MainComponents/ShowBox.vue";

import NavBoxesComponent from "../components/MainComponents/NavBoxesComponent.vue";
import CustomizeBoxesComponent from "../components/MainComponents/CustomizeBoxesComponent.vue";

import LoadingComponent from "../components/MainComponents/LoadingComponent.vue";
import LoadingRollComponent from "../components/MainComponents/LoadingRollComponent.vue";

import TableComponent from "../components/MainComponents/TableComponent.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";
import ClassicLeft from "../components/MainComponents/ClassicLeft.vue";
import ClassicRight from "../components/MainComponents/ClassicRight.vue";

export default {
    name: "UnOnda",
    components: {
        ClassicRight,
        ClassicLeft,
        ShowBox,

        NavBoxesComponent,

        LoadingComponent,
        LoadingRollComponent,

        CustomizeBoxesComponent,
        TableComponent,
        BannerNewsComponent,
    },
    data() {
        return {
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
                    this.currentPageCategories =
                        response.data.results.currentPage;
                    this.lastPageCategories = response.data.results.lastPage;
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

<style></style>
