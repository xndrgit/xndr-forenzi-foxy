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

            <div class="row justify-content-center" >
                <loadingRollComponent class="py-5 my-5" v-if="loadingProduct" />
                <ShowBox2 v-else />
                <!-- <h4 class="fw-bold py-2">Elenco formati disponibili</h4> -->
            </div>
        </div>
        <!-- <ClassicRight /> -->
        <div class="container">
            <h4 class="fw-bold py-2">Elenco formati disponibili</h4>
            <TableComponent />
            <BannerNewsComponent />
        </div>
    </div>
</template>

<script>
import ShowBox2 from "../components/MainComponents/ShowBox2.vue";

import NavBoxesComponent from "../components/MainComponents/NavBoxesComponent.vue";
import CustomizeBoxesComponent from "../components/MainComponents/CustomizeBoxesComponent.vue";

import TableComponent from "../components/MainComponents/TableComponent.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";

import ClassicRight from "../components/MainComponents/ClassicRight.vue";

import LoadingRollComponent from "../components/MainComponents/LoadingRollComponent.vue";
import LoadingComponent from "../components/MainComponents/LoadingComponent.vue";

export default {
    name: "UnOnda",
    components: {
        ShowBox2,

        NavBoxesComponent,
        CustomizeBoxesComponent,

        TableComponent,
        BannerNewsComponent,

        ClassicRight,

        LoadingRollComponent,
        LoadingComponent,
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
                .get("/guest/categories", {})
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
        getCategory() {
            this.loadingCategory = true;
            axios
                .get(`/guest/categories/${this.$route.params.id}`)
                .then((response) => {
                    this.category = response.data.results;
                    setTimeout(() => {
                        this.loadingCategory = false;
                    }, 1000);
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
        getProduct() {
            this.loadingProduct = true;
            axios
                .get(`/guest/products/${this.$route.params.id}`)
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
        this.getCategory();
        this.getCategories();
        this.getProduct();
    },
};
</script>

<style lang="scss" scoped></style>
