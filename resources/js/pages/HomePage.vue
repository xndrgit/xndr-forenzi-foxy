<template>
    <div class="home">
        <div class="container-lg">
            <div class="row justify-content-center">
                <loadingComponent v-if="loadingCategories" />

                <div
                    class="d-flex flex-wrap justify-content-around justify-content-sm-between
 col-12"
                    v-else
                >
                    <NavBoxesComponent
                        v-for="category in categories"
                        :key="category.name"
                        :category="category"
                    />
                    <div @click="goToPersonalizePage">
                        <CustomizeBoxesComponent />
                    </div>
                </div>

                <JumboComponent />
                <BannerNewsComponent />
                <BannerTextComponent
                    v-for="element in txtbanners"
                    :key="element.title"
                    :title="element.title"
                    :description="element.description"
                    :descriptionTwo="element.descriptionTwo"
                    :descriptionBold="element.descriptionBold"
                />

                <LoadingRollComponent v-if="loadingProducts" />
                <div class="d-flex justify-content-center flex-wrap" v-else>
                    <BoxesComponent
                        v-for="product in products"
                        :key="product.name"
                        :product="product"
                    />
                </div>

                <div v-if="!loadingProducts">
                    <div v-if="pagination.next_page_url">
                        <button class="yellow-button" @click="loadMore">
                            Load More
                        </button>
                    </div>
                </div>

                <!-- <HolidayComponent /> -->
            </div>
        </div>

        <ClassicLeft
            v-for="(element, index) in txtleft"
            :key="index"
            :title="element.title"
            :description="element.description"
            :subdescription="element.subdescription"
            :notes="element.notes"
            :button="element.button"
        />
        <ClassicRight />
    </div>
</template>

<script>
import axios from "axios";
import LoadingComponent from "../components/MainComponents/LoadingComponent.vue";
import LoadingRollComponent from "../components/MainComponents/LoadingRollComponent.vue";

import NavBoxesComponent from "../components/MainComponents/NavBoxesComponent.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";
import BannerTextComponent from "../components/MainComponents/BannerTextComponent.vue";

import JumboComponent from "../components/MainComponents/JumboComponent.vue";

import BoxesComponent from "../components/MainComponents/BoxesComponent.vue";
import ClassicLeft from "../components/MainComponents/ClassicLeft.vue";
import ClassicRight from "../components/MainComponents/ClassicRight.vue";
import CustomizeBoxesComponent from "../components/MainComponents/CustomizeBoxesComponent.vue";

export default {
    name: "HomePage",
    components: {
        LoadingComponent,
        LoadingRollComponent,

        NavBoxesComponent,
        BannerNewsComponent,
        BannerTextComponent,

        JumboComponent,

        BoxesComponent,
        ClassicLeft,
        ClassicRight,
        CustomizeBoxesComponent,
    },
    data() {
        return {
            products: [],
            categories: [],
            // currentPageCategories: 1,
            // lastPageCategories: null,
            loadingCategories: true,
            loadingProducts: true,
            pagination: {
                total: null,
                per_page: null,
                current_page: 1,
                last_page: 1,
                next_page_url: 1,
                prev_page_url: null,
            },

            txtbanners: [
                {
                    title: "FoxyBox - Scatole di tutti i tipi consegnate in tempi record",
                    description:
                        "Scegli tra le nostre linee di prodotti in pronta consegna oppure le scatole con misure personalizzate. ",
                    descriptionTwo:
                        "Acquista ora in modo facile, veloce e sicuro!",
                    descriptionBold: "",
                },
            ],
            txtleft: [
                {
                    title: "Scegli FoxyBox, qualità dei prodotti, consegna rapida e assistenza dedicata.",
                    description:
                        "Semplifica il tuo rifornimento di scatole, sono tutte in pronta consegna e le acquisti in pochi e semplici click!",
                    subdescription: "In più, la spedizione è sempre gratuita!",
                    button: "SCOPRI IL PRODOTTO",
                },
            ],
            searchParams: {
                length: null,
                width: null,
                height: null,
                searchStr: null,
            },
        };
    },
    beforeDestroy() {
        window.VBus.stop("search-products", this.searchProducts);
    },
    mounted() {
        this.getCategories();
        this.getProducts();
        window.VBus.listen("search-products", this.searchProducts);
    },
    methods: {
        loadMore() {
            if (!this.pagination.current_page) {
                // show popup error
                alert("Error: Current page is not defined!");
                return;
            }

            this.loadingProducts = true;
            axios
                .post("/shop/products", {
                    page: this.pagination.current_page + 1,
                    searchParams: this.searchParams,
                })
                .then((response) => {
                    this.loadingProducts = false;
                    this.products = [
                        ...this.products,
                        ...response.data.results,
                    ];
                    this.pagination.current_page = response.data.current_page;
                    this.pagination.last_page = response.data.last_page;
                    this.pagination.prev_page_url =
                        this.pagination.current_page > 1
                            ? this.pagination.current_page - 1
                            : 1;
                    this.pagination.next_page_url =
                        !response.data.results ||
                        !response.data.results.length ||
                        this.pagination.current_page === response.data.last_page
                            ? null
                            : this.pagination.current_page + 1;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        goToPersonalizePage() {
            this.$router.push({ path: "/personalize" });
        },
        getCategories(pageCategories = 1) {
            this.loadingCategories = true;
            axios
                .get("/shop/categories", {
                    page: pageCategories,
                })
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
        getProducts() {
            this.loadingProducts = true;
            axios
                .post("/shop/products", {
                    searchParams: this.searchParams,
                })
                .then((response) => {
                    this.products = response.data.results;
                    this.loadingProducts = false;
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
        searchProducts(data) {
            this.searchParams = Object.assign({}, data);
            this.getProducts();
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../sass/global.scss";
</style>
