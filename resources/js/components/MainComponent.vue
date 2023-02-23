<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <CardCategoryComponent
                    v-for="category in categories"
                    :key="category.id"
                    :category="category"
                />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import CardCategoryComponent from "./CardCategoryComponent.vue";

export default {
    components: {
        CardCategoryComponent,
    },
    data: function () {
        return {
            categories: [],
            currentPage: 1,
            lastPage: null,
            loading: false,
        };
    },
    methods: {
        getCategories(pageCategories = 1) {
            axios
                .get("/shop/categories", {
                    page: pageCategories,
                })
                .then((response) => {
                    this.categories = response.data.results.data;
                    this.currentPage = response.data.results.currentPage;
                    this.lastPage = response.data.results.lastPage;
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
    },
    created() {
        this.getCategories();
    },
    mounted() {
    },
};
</script>

<style lang="scss" scoped></style>
