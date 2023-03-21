<template>
    <div class="jumbo d-flex flex-wrap justify-content-center col-12">
        <div
            id="slider"
            class="jumbo1 col-12 col-sm-10 col-md-8 col-lg-7 col-xl-7 d-none d-md-block"
            v-if="images"
        >
            <carousel
                :perPageCustom="[
                    [0, 1],
                    [480, 1],
                    [768, 1],
                    [1024, 1],
                    [1200, 1],
                ]"
                class="align-items-center justify-content-center"
            >
                <slide v-for="(image, index) in images" :key="index">
                    <div class="carousel-image-container">
                        <img
                            :src="image.src"
                            alt="Slider image"
                            class="img-fluid jumbo-image"
                            style="width: 85%"
                        />

                        <img
                            alt=""
                            class="maschera_dx"
                            src="/Links/maschera_dx.png"
                        />

                        <img
                            alt=""
                            class="maschera_sx"
                            src="/Links/maschera_sx.png"
                        />

                        <div class="carousel-content position-absolute">
                            <h3 class="carousel-title">{{ image.title }}</h3>
                            <p class="carousel-description">
                                {{ image.description }}
                            </p>
                            <button class="orange-button">
                                SCOPRI IL PRODOTTO
                            </button>
                        </div>
                    </div>
                </slide>
            </carousel>
        </div>
        <div class="jumbo2 col-10 col-sm-10 col-md-8 col-lg-5 col-xl-5">
            <div class="clock p-2 d-none d-lg-flex d-flex flex-column">
                <h6 class="m-0 font-weight-bold">
                    EFFETUA IL TUO ORDINE ENTRO
                </h6>
                <div
                    class="countdown d-flex justify-content-center align-items-center flex-wrap col-12 p-0"
                >
                    <div class="d-none d-sm-block">
                        <div class="square flex-column">
                            <div class="square-time">
                                <span>{{ days }}</span>
                            </div>

                            <div class="square-text">
                                <span>GIORNI</span>
                            </div>
                        </div>
                    </div>

                    <div class="square flex-column">
                        <div class="square-time">
                            <span>{{ hours }}</span>
                        </div>

                        <div class="square-text">
                            <span>ORE</span>
                        </div>
                    </div>
                    <div class="square flex-column">
                        <div class="square-time">
                            <span>{{ minutes }}</span>
                        </div>

                        <div class="square-text">
                            <span>MINUTI</span>
                        </div>
                    </div>

                    <div class="square flex-column">
                        <div class="square-time">
                            <span>{{ seconds }}</span>
                        </div>

                        <div class="square-text">
                            <span>SECONDI</span>
                        </div>
                    </div>
                </div>
                <p class="m-0">e ricevi le scatole</p>
                <h5 class="text-white m-0 font-weight-bold">
                    {{ nextDay | formatDate }}
                </h5>
            </div>

            <div class="d-none d-xl-block">
                <div
                    class="delivery d-lg-flex d-flex align-items-start position-relative"
                >
                    <div class="p-2">
                        <h3 class="txt-orange font-weight-bold">
                            Spedizione gratuita in tutta Italia
                        </h3>
                        <span> per ordini di qualunque importo! </span>
                    </div>
                    <div class="w-40 d-flex justify-content-start">
                        <img
                            alt=""
                            class="delivery-image d-none d-md-block"
                            src="../../../../public/Links/free-non-stop-delivery-man-with-fallen-boxes_23-2148462373.png"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Carousel, Slide} from "vue-carousel";

export default {
    components: {
        Carousel,
        Slide,
    },
    data() {
        return {
            images: null,
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            interval: null,
            nextDay: new Date(new Date().getTime() + 2 * 24 * 60 * 60 * 1000), // set to the day after tomorrow
        };
    },
    filters: {
        formatDate(date) {
            const options = {
                weekday: "long", // spell out the day of the week
                day: "numeric", // show the day of the month as a number
                month: "long", // spell out the month name
            };
            return date.toLocaleDateString("it-IT", options);
        },
    },
    created() {
        // Set the countdown date
        // Get the current date
        const currentDate = new Date();

        // Add one day to the current date
        const tomorrow = new Date(currentDate.getTime() + 24 * 60 * 60 * 1000);

        // Set the time to 00:00:00
        tomorrow.setHours(0, 0, 0, 0);

        // Set the countdown date to tomorrow at 00:00:00
        const countdownDate = tomorrow.getTime();

        // Update the countdown every second
        this.interval = setInterval(() => {
            // Get today's date and time
            const now = new Date().getTime();

            // Find the distance between now and the countdown date
            const distance = countdownDate - now;

            // Time calculations for days, hours, minutes and seconds
            this.days = Math.floor(distance / (1000 * 60 * 60 * 24));
            this.hours = Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            this.minutes = Math.floor(
                (distance % (1000 * 60 * 60)) / (1000 * 60)
            );
            this.seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // If the countdown is finished, clear the interval
            if (distance < 0) {
                clearInterval(this.interval);
            }
        }, 1000);
    },
    beforeDestroy() {
        // Clear the interval when the component is destroyed
        clearInterval(this.interval);
    },
    mounted() {
        this.getJumbos();
    },
    methods: {
        async getJumbos() {
            let response = await axios.get('/shop/jumbos');

            if (response.data.status === 'success') {
                this.images = response.data.result;
            }
        }
    }
};
</script>

<style lang="scss">


.jumbo {
    display: flex;

    .jumbo1 {
        height: -webkit-fill-available;
        height: -moz-available;
        height: stretch;

        .carousel-image-container {
            position: relative;
        }

        .maschera_dx {
            position: absolute;
            right: -60px;
        }

        .maschera_sx {
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .carousel-content {
            top: 10px;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-end;

            color: black;
            padding: 20px;
            margin-left: 60%;
            text-align: end;
        }

        .carousel-title {
            font-size: 1.6rem;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .carousel-description {
            font-size: 0.6rem;
            margin-bottom: 20px;
            margin-left: 10%;
            font-weight: 400;
        }

        .VueCarousel {
            object-fit: contain;
            width: 100%;
            height: 360px;
        }
      div.VueCarousel-pagination {
        position: absolute !important;
        bottom: 20px;
      }
    }

    .jumbo2 {
        .clock {
            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 0.9rem;

            height: -webkit-fill-available;
            height: -moz-available;
            height: stretch;
            background-color: rgb(246, 134, 48);

            .countdown {
                .square {
                    display: flex;
                    align-items: center;
                    justify-content: center;

                    height: 60px;
                    width: 60px;
                    background-color: rgb(253, 188, 72);
                    margin: 10px;
                    padding: 1.2rem;

                  position: relative;

                  &:before {
                    content: "";
                    position: absolute;
                    top: -5px;
                    right: -5px;
                    bottom: -5px;
                    left: -5px;
                    border: 2px solid transparent;
                    border-radius: 10px;
                    z-index: -1;
                    transition: all 0.4s ease-out;
                  }

                  &:hover:before {
                    border-color: rgba(255, 255, 255, 0.7);
                    box-shadow: 0 0 20px rgba(255, 255, 255, 0.7);
                  }

                    .square-time {
                        font-size: 1.8rem;
                        font-weight: bold;
                        color: black;
                    }

                    .square-text {
                        font-size: 0.4rem;
                        font-weight: bold;
                    }
                }
            }
        }

        .delivery {
            height: fit-content;
            margin-top: 23px;

            border: 10px solid rgb(246, 134, 48);

            .h1 {
                color: rgb(246, 134, 48);
            }

            span {
                font-size: 0.8rem;
                font-weight: 500;
            }

            .delivery-image {
                height: -webkit-fill-available;
                height: -moz-available;
                height: stretch;
                width: -webkit-fill-available;
                width: -moz-available;
                width: stretch;
                min-height: -webkit-fill-available;
                min-height: -moz-available;
                min-height: stretch;
            }
        }
    }
}

@media (max-width: 576px) {
  .jumbo {
    display: flex;

    .jumbo1 {
      height: -webkit-fill-available;
      height: -moz-available;
      height: stretch;

      .carousel-image-container {
        position: relative;
      }

      .maschera_dx {
        position: absolute;
        right: -60px;
      }

      .maschera_sx {
        position: absolute;
        left: 0;
        bottom: 0;
      }

      .carousel-content {
        top: 10px;
        bottom: 0;
        left: 0;
        right: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-end;

        color: black;
        padding: 20px;
        margin-left: 60%;
        text-align: end;
      }

      .carousel-title {
        font-size: 1.6rem;
        margin-bottom: 25px;
        font-weight: bold;
      }

      .carousel-description {
        font-size: 0.6rem;
        margin-bottom: 20px;
        margin-left: 10%;
        font-weight: 400;
      }

      .VueCarousel {
        object-fit: contain;
        width: 100%;
        height: 360px;
      }
      div.VueCarousel-pagination {
        position: absolute !important;
        bottom: 20px;
      }
    }

    .jumbo2 {
      .clock {
        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 0.8rem;

        height: -webkit-fill-available;
        height: -moz-available;
        height: stretch;

        background-color: rgb(246, 134, 48);

        h6{
          font-size: .8rem;
        }
        h5{
          font-size: .7rem;
        }

        .countdown {

          .square {
            display: flex;
            align-items: center;
            justify-content: center;

            height: 50px;
            width: 50px;

            background-color: rgb(253, 188, 72);

            margin: 10px;
            padding: 1.2rem;
            border: 2px solid rgba(255, 255, 255, 0.3); /* Set initial border style */
            animation: pulse 1s ease-in-out infinite; /* Apply animation every second */

            .square-time {
              font-size: 1.2rem;
              font-weight: bold;
              color: black;
            }
            .square-text {
              font-size: 0.4rem;
              font-weight: bold;
            }


          }
        }
      }

      @keyframes pulse {
        0% {
          transform: scale(1);
          border-color: rgba(255, 255, 255, 0.3);
        }
        50% {
          transform: scale(1.05);
          border-color: rgba(255, 255, 255, 0.6);
        }
        100% {
          transform: scale(1);
          border-color: rgba(255, 255, 255, 0.3);
        }
      }


      .delivery {
        height: fit-content;
        margin-top: 23px;

        border: 10px solid rgb(246, 134, 48);

        .h1 {
          color: rgb(246, 134, 48);
        }

        span {
          font-size: 0.8rem;
          font-weight: 500;
        }

        .delivery-image {
          height: -webkit-fill-available;
          height: -moz-available;
          height: stretch;
          width: -webkit-fill-available;
          width: -moz-available;
          width: stretch;
          min-height: -webkit-fill-available;
          min-height: -moz-available;
          min-height: stretch;
        }
      }
    }
  }
}
</style>
