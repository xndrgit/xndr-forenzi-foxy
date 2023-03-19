<template>
    <section class="text-banner text-center d-block">
        <div>
            <h1 class="">
                {{ title }}
            </h1>
        </div>

        <div class="mx-5">
            <span class="text">
                {{ description }}
            </span>
        </div>
        <div class="mx-5">
            <span class="text">
                {{ descriptionTwo }}
            </span>
        </div>

        <div>
            <p class="text fw-bold">
                {{ descriptionBold }}
            </p>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        title: String,
        description: String,
        descriptionTwo: String,
        descriptionBold: String,
    },
    components: {},
    data() {
        return {};
    },
    created() {},
};
</script>

<style lang="scss" scoped>
.text-banner {
    padding: 2rem;
    width: 100%;

    .text {
        font-size: .8rem;
    }

    h1 {
        font-weight: bolder;
        font-size: 1.8rem;
    }
}

@media (max-width: 576px) {
  .text-banner {
    padding: 1.2rem;
    width: 100%;

    transition: 0.2s;

    &:active{

      transform: scale(0.95);
    }

    .text {
      font-size: .6rem;
    }

    h1 {
      font-weight: bolder;
      font-size: 1.3rem;
    }
  }
}
</style>
