<template>
    <div class="home">
        <div class="container-lg">
            <loadingComponent v-if="loadingCategories"/>

            <div
                v-else
                class="d-flex flex-wrap justify-content-around justify-content-sm-between col-12"
            >
                <NavBoxesComponent
                    v-for="category in categories"
                    :key="category.name"
                    :category="category"
                />
                <div @click="goToPersonalizePage">
                    <CustomizeBoxesComponent/>
                </div>
            </div>

            <hr/>

            <div class="">
                <loadingRollComponent v-if="loadingProduct" class="py-5 my-5"/>
                <ShowBox v-else/>
            </div>

            <h6 class="font-weight-bold m-0">Elenco formati disponibili</h6>
            <TableComponent/>
            <BannerNewsComponent/>
        </div>

        <ClassicLeft
            v-for="(element, index) in txtleft"
            :key="index"
            :button="element.button"
            :description="element.description"
            :notes="element.notes"
            :subdescription="element.subdescription"
            :title="element.title"
        />
        <ClassicRight/>
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

import Categories from "../mixins/categories";

export default {
    name: "ProductPage",
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
    mixins: [Categories],
    data() {
        return {
            loadingProduct: true,
            txtleft: [
                {
                    title: "Scegli FoxyBox, qualità dei prodotti, consegna rapida e assistenza dedicata.",
                    description:
                        "Semplifica il tuo rifornimento di scatole, sono tutte in pronta consegna e le acquisti in pochi e semplici click!",
                    subdescription: "In più, la spedizione è sempre gratuita!",
                    button: "SCOPRI IL PRODOTTO",
                },
            ],
        };
    },
    created() {
        this.getProduct();
    },
    methods: {
        goToPersonalizePage() {
            this.$router.push({path: "/personalize"});
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
};
</script>

<style></style>
