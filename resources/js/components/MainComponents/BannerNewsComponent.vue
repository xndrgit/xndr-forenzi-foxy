<template>
    <section
        class="news-banner container d-flex flex-wrap justify-content-center"
    >
        <div class="new col-12 col-sm-12 col-md-4 p-0">
            <div class="w-35 d-flex justify-content-start">
                <img
                    alt=""
                    class="img-fluid"
                    src="../../../../public/Links/side-view-of-smiling-curly-woman-pointing-away.jpg"
                />
            </div>
            <div class="w-65">
                <div class="new-text" style="font-weight: bold">
                    <h3>NOVITÀ!!</h3>
                    <p>
                        Scopri i nostri nuovi prodotti a catalogo e tutti in
                        pronta consegna e spedizione gratuita.
                    </p>
                </div>
            </div>
        </div>
        <div class="new col-12 col-sm-12 col-md-4 p-0">
            <div class="new-img w-35 d-flex justify-content-center">
                <img
                    alt=""
                    class="img-fluid"
                    src="../../../../public/Links/maniglie-ai.png"
                />
            </div>
            <div class="new-text w-65">
                <h6>Scatole con maniglie</h6>
                <p>Disponibili bianche e avana</p>
                <button class="yellow-button">SCOPRI IL PRODOTTO</button>
            </div>
        </div>
        <div class="new col-12 col-sm-12 col-md-4 p-0">
            <div class="new-img w-35 d-flex justify-content-center">
                <img
                    alt=""
                    class="img-fluid py-4"
                    src="../../../../public/Links/scatola-colorata.png"
                />
            </div>
            <div class="new-text w-65">
                <h6>Scatole colorate</h6>
                <p>Varie forme e colori</p>
                <button class="yellow-button">SCOPRI IL PRODOTTO</button>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    components: {},
    data() {
        return {};
    },
    created() {},
};
</script>

<style lang="scss" scoped>
.news-banner {
    .new {
        display: flex;
        align-items: center;

        font-size: 0.6rem;

        height: 160px;
        width: calc(33.33% - 50px);
        background-color: #e5e5e5;
        margin: 1px 0;

        img {
            height: 160px;
        }

        span {
            font-weight: 500;
        }

        p {
            margin: 0;
            font-weight: 500;
        }

        .new-text {
            padding: 10px;

            h3,
            h5 {
                color: rgb(246, 134, 48);
                font-weight: bold;
            }
        }
    }
}

@media (max-width: 576px) {
  .news-banner {
    .new {


      display: flex;
      align-items: center;

      font-size: 0.6rem;

      height: 120px;
      width: calc(33.33% - 50px);
      background-color: #e5e5e5;
      margin: 1px 0;

      transition: 0.2s;

      &:active{
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        transform: scale(0.95);
      }

      img {
        border-radius: 10px;
        height: 120px;
      }

      span {
        font-weight: 500;
      }

      p {
        font-size: .5rem;
        margin: 0;
        font-weight: 500;
      }

      .new-text {
        margin-right: 20px;

        h3,
        h5,
        h6{

          color: rgb(246, 134, 48);
          font-weight: bold;
        }
      }
    }
  }
}
</style>
