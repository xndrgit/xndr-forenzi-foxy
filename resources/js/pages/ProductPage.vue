<template>
    <div class="home">
        <div class="container">
            <loadingComponent v-if="loadingCategories" />

            <div class="d-flex justify-content-center" v-else>
                <NavBoxesComponent
                    v-for="category in categories"
                    :key="category.name"
                    :category="category"
                />
                <div @click="goToPersonalizePage">
                    <CustomizeBoxesComponent />
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <loadingRollComponent class="py-5 my-5" v-if="loadingProduct" />
            </div>

            <div class="row py-5">
                <ShowBox />
                <!-- <h4 class="fw-bold py-2">Elenco formati disponibili</h4> -->
                <!-- <TableComponent /> -->
                <BannerNewsComponent />
            </div>
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

// import TableComponent from "../components/MainComponents/TableComponent.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";

export default {
    name: "UnOnda",
    components: {
        ShowBox,

        NavBoxesComponent,

        LoadingComponent,
        LoadingRollComponent,

        CustomizeBoxesComponent,
        // TableComponent,
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
            console.log(this.loadingCategories);
            axios
                .get("/api/categories", {})
                .then((response) => {
                    console.log("categories");
                    console.log(response.data.results.data);
                    this.categories = response.data.results.data;
                    this.currentPageCategories =
                        response.data.results.currentPage;
                    this.lastPageCategories = response.data.results.lastPage;
                    this.loadingCategories = false;
                    console.log(this.loadingCategories);
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
        getProduct() {
            this.loadingProduct = true;
            axios
                .get(`/api/products/${this.$route.params.id}`)
                .then((response) => {
                    this.product = response.data.results;
                    console.log(this.product);
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
