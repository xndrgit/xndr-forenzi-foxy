<template>
    <div class="home">
        <div class="container-lg">
            <div
                v-if="categories"
                class="flex-wrap d-none d-lg-flex justify-content-around justify-content-sm-between"
            >
                <NavBoxesComponent
                    v-for="item in categories"
                    :key="item.name"
                    :category="item"
                />
                <div @click="goToPersonalizePage">
                    <CustomizeBoxesComponent/>
                </div>
            </div>

            <hr/>

            <div class="row justify-content-center">
                <ShowBox2/>
            </div>
        </div>
        <div class="container-lg">
            <hr class="my-4"/>

            <TableComponentCategories/>
            <BannerNewsComponent/>
        </div>
    </div>
</template>

<script>
import ShowBox2 from "../components/MainComponents/ShowBox2.vue";

import NavBoxesComponent from "../components/MainComponents/NavBoxesComponent.vue";
import CustomizeBoxesComponent from "../components/MainComponents/CustomizeBoxesComponent.vue";

import TableComponentCategories from "../components/MainComponents/TableComponentCategories.vue";
import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";

import Categories from "../mixins/categories";

export default {
    components: {
        ShowBox2,
        NavBoxesComponent,
        CustomizeBoxesComponent,
        TableComponentCategories,
        BannerNewsComponent
    },
    mixins: [Categories],
    methods: {
        goToPersonalizePage() {
            this.$router.push({path: "/personalize"});
        },
    },
};
</script>

<style lang="scss" scoped>
</style>
