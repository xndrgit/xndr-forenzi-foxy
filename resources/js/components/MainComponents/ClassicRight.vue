<template>
    <section class="classic">
        <div class="container-lg align-items-center">
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center flex-wrap">
                    <div
                        class="classic-image d-none col-md-5 d-lg-flex justify-content-center"
                    >
                        <img
                            alt=""
                            class=""
                            src="../../../../public/Links/01.png"
                        />
                    </div>

                    <div class="classic-image d-none d-lg-block col-md-3">
                        <img
                            alt=""
                            class="img-fluid"
                            src="../../../../public/Links/rectangle.png"
                        />
                    </div>
                    <div
                        class="classic-text col-12 col-md-4 d-flex flex-column justify-content-center align-items-center"
                    >
                        <h1 class="text-white fw-bold display-5">
                            Desideri una scatola su misura con colori e stampa
                            personalizzata?
                        </h1>
                        <p class="h4">
                            Configurala in pochi e semplici click, un nostro
                            responsabile ti ricontatterà per comunicarti la
                            quotazione!
                        </p>
                        <div class="d-flex justify-content-center classic-btn">
                            <button
                                class="yellow-button"
                                style="background-color: black"
                            >
                                CONFIGURA ORA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script></script>

<style lang="scss" scoped>
.classic {
    background-color: #fdbc48;
    text-align: center;

    .classic-text {
        width: fit-content;
    }

    .classic-btn {
        width: -webkit-fill-available;
        width: -moz-available;
        width: stretch;
    }

    img {
        width: -webkit-fill-available;
        width: -moz-available;
        width: stretch;
        max-height: 250px;
        object-fit: contain;
    }

    p {
        font-size: 0.7rem;
        text-align: end;
    }

    h1 {
        color: rgb(246, 135, 46);
        font-weight: bold;
        font-size: 1.5rem;

    }
}

@media (max-width: 576px) {
  .classic {
    background-color: #fdbc48;
    text-align: center;

    .classic-text {
      width: fit-content;
    }

    .classic-btn {
      width: -webkit-fill-available;
      width: -moz-available;
      width: stretch;
    }

    img {
      width: -webkit-fill-available;
      width: -moz-available;
      width: stretch;
      max-height: 250px;
      object-fit: contain;
    }

    p {
      font-size: 0.6rem;
      text-align: center;
    }

    h1 {
      color: rgb(246, 135, 46);
      font-weight: bold;
      font-size: 1.2rem;

    }
  }
}
</style>
