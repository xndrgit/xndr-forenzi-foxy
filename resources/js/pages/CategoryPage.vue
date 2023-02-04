<template>
    <div class="home">
        <div class="container">
            <div class="d-flex justify-content-center" v-if="loadingProduct">
                <LoadingRollComponent />
            </div>
            <div class="row" v-else>
                <ShowBox2 />
                <!-- <h4 class="fw-bold py-2">Elenco formati disponibili</h4> -->
            </div>
        </div>
        <!-- <ClassicRight /> -->
        <div class="container">
            <div class="row">
                <BannerNewsComponent />
            </div>
        </div>
    </div>
</template>

<script>
import ShowBox2 from "../components/MainComponents/ShowBox2.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";
import ClassicRight from "../components/MainComponents/ClassicRight.vue";
import LoadingRollComponent from "../components/MainComponents/LoadingRollComponent.vue";

export default {
    name: "UnOnda",
    components: {
        ShowBox2,
        BannerNewsComponent,
        ClassicRight,
        LoadingRollComponent,
    },
    data() {
        return {
            loadingProduct: true,
            product: [],
        };
    },
    methods: {
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
        this.getProduct();
    },
};
</script>

<style lang="scss" scoped></style>
