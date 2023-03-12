<template>
    <section
        class="news-banner container d-flex flex-wrap justify-content-center"
    >
        <div class="new col-12 col-sm-12 col-md-4 p-0">
            <div class="w-35 d-flex justify-content-start">
                <img
                    class="img-fluid"
                    src="../../../../public/Links/side-view-of-smiling-curly-woman-pointing-away.jpg"
                    alt=""
                />
            </div>
            <div class="w-65">
                <div style="font-weight: bold" class="new-text">
                    <h3>NOVITÀ!!</h3>
                    <span>
                        Scopri i nostri nuovi prodotti a catalogo e tutti in
                        pronta consegna e spedizione gratuita.
                    </span>
                </div>
            </div>
        </div>
        <div class="new col-12 col-sm-12 col-md-4 p-0">
            <div class="new-img w-35 d-flex justify-content-center">
                <img
                    class="img-fluid"
                    src="../../../../public/Links/maniglie-ai.png"
                    alt=""
                />
            </div>
            <div class="new-text w-65">
                <h5>Scatole con maniglie</h5>
                <p>Disponibili bianche e avana</p>
                <button class="yellow-button">SCOPRI IL PRODOTTO</button>
            </div>
        </div>
        <div class="new col-12 col-sm-12 col-md-4 p-0">
            <div class="new-img w-35 d-flex justify-content-center">
                <img
                    class="img-fluid py-4"
                    src="../../../../public/Links/scatola-colorata.png"
                    alt=""
                />
            </div>
            <div class="new-text w-65">
                <h5>Scatole colorate</h5>
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
        margin: 1px 0px;

        img {
            height: 160px;
        }

        span {
            font-weight: 500;
        }
        p {
            margin: 0px;
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
</style>
