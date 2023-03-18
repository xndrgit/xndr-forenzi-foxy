<template>
  <div class="home">
    <div class="container-lg">
      <div
        v-if="categories"
        class="flex-wrap d-none d-lg-flex justify-content-around justify-content-sm-between col-12"
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
        <ShowBox3/>
      </div>
    </div>
    <div class="container-lg">
      <hr class="my-4"/>


      <BannerNewsComponent/>
    </div>
  </div>
</template>

<script>
import ShowBox3 from "../components/MainComponents/ShowBox3.vue";

import NavBoxesComponent from "../components/MainComponents/NavBoxesComponent.vue";
import CustomizeBoxesComponent from "../components/MainComponents/CustomizeBoxesComponent.vue";

import BannerNewsComponent from "../components/MainComponents/BannerNewsComponent.vue";

import Categories from "../mixins/categories";

export default {
  components: {
    ShowBox3,
    NavBoxesComponent,
    CustomizeBoxesComponent,

    BannerNewsComponent
  },
  mixins: [Categories],
  data: () => ({
    subcategory: null
  }),
  mounted() {
    this.getData();
  },
  methods: {
    goToPersonalizePage() {
      this.$router.push({path: "/personalize"});
    },
    async getData() {
      let response = await axios.get(`/shop/subcategories/${this.$route.params.id}`);
      if (response.data.success) {
        this.subcategory = response.data.result;
        console.log(this.subcategory);
      }
    }
  },
};
</script>

<style lang="scss" scoped>
</style>
