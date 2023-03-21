<template>
    <section class="classic d-flex">
        <div class="container-lg">
            <div
                class="d-flex flex-wrap col-12 justify-content-center justify-content-md-between align-items-center"
            >
                <div class="classic-text col-lg-5">
                    <h1 class="">{{ title }}</h1>
                    <p class="">
                        {{ description }}
                    </p>
                    <p class="font-weight-bold">
                        {{ subdescription }}
                    </p>
                    <p class="">
                        {{ notes }}
                    </p>
                    <button v-show="button" class="yellow-button my-4">
                        {{ button }}
                    </button>
                </div>
                <div class="classic-image col-10 col-lg-7 d-flex justify-content-center align-items-center ">
                    <img
                        alt="img"
                        class="img-fluid"
                        src="../../../../public/Links/scatole.jpg"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        title: String,
        description: String,
        subdescription: String,
        notes: String,
        button: String,
    },
    components: {},
    data() {
        return {};
    },
    created() {},
};
</script>

<style lang="scss" scoped>
.classic {
    background-color: #f1f1f1;

    .classic-text {
        width: fit-content;
    }

    img {
        max-height: 380px;
    }

    p {
        font-size: 0.8rem;
        margin: 0;
    }

    h1 {
        color: rgb(246, 135, 46);
        font-weight: bold;
        font-size: 1.8rem;

        margin-right: 2rem;
    }
}
@media (max-width: 576px) {
  .classic {
    background-color: #f1f1f1;

    text-align: center;

    .classic-text {
      width: fit-content;
    }

    img {
      max-height: 380px;
    }

    p {
      font-size: 0.6rem;
      margin: 0;
    }

    h1 {
      color: rgb(246, 135, 46);
      font-weight: bold;
      font-size: 1.2rem;

      margin: 0;
    }
  }
}
</style>
