<template>
    <div class="jumbo d-flex flex-wrap col-xl-12">
        <div id="slider" class="jumbo1 col-xl-7">
            <carousel
                class="align-items-center justify-content-center"
                :perPageCustom="[
                    [0, 1],
                    [480, 1],
                    [768, 1],
                    [1024, 1],
                    [1200, 1],
                ]"
            >
                <slide v-for="(image, index) in images" :key="index">
                    <div class="carousel-image-container">
                        <img
                            style="width: 80%"
                            class="img-fluid jumbo-image"
                            :src="image.src"
                            alt="Slider image"
                        />

                        <img
                            style="position: absolute; right: -40px"
                            src="../../../../public/Links/maschera_dx.png"
                            alt=""
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
        <div class="jumbo2 col-xl-5">
            <div class="clock p-2 d-none d-lg-flex d-flex flex-column">
                <h5 class="m-0 font-weight-bold">
                    EFFETUA IL TUO ORDINE ENTRO
                </h5>
                <div
                    class="countdown d-flex justify-content-center align-items-center flex-wrap col-12 p-0"
                >
                    <div class="square flex-column">
                        <div class="square-time">
                            <span>{{ days }}</span>
                        </div>

                        <div class="square-text">
                            <span>GIORNI</span>
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
                    Martedì 12 Agosto
                </h5>
            </div>
            <div
                class="delivery d-none d-lg-flex d-flex align-items-start position-relative"
            >
                <div class="p-2">
                    <h2 class="txt-orange font-weight-bold">
                        Spedizione gratuita in tutta Italia
                    </h2>
                    <span> per ordini di qualunque importo! </span>
                </div>
                <div class="w-40 d-flex justify-content-start">
                    <img
                        class="delivery-image"
                        src="../../../../public/Links/free-non-stop-delivery-man-with-fallen-boxes_23-2148462373.png"
                        alt=""
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";
export default {
    components: {
        Carousel,
        Slide,
    },
    data() {
        return {
            images: [
                {
                    src: require("../../../../public/Links/PHV7570.jpg"),
                    title: "Scatole per pizza",
                    description:
                        "Disponibili in diverse misure e colori. Possibilità di personalizzazione con logo e testi e motivi grafici.",
                },
                {
                    src: require("../../../../public/Links/PHV7570.jpg"),
                    title: "Title 2",
                    description: "Description 2",
                },
                {
                    src: require("../../../../public/Links/PHV7570.jpg"),
                    title: "Title 3",
                    description: "Description 3",
                },
                {
                    src: require("../../../../public/Links/PHV7570.jpg"),
                    title: "Title 4",
                    description: "Description 4",
                },
            ],
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            interval: null,
        };
    },
    created() {
        // Set the countdown date
        const countdownDate = new Date("Feb 29, 2023 00:00:00").getTime();

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
};
</script>

<style lang="scss">
div.VueCarousel-pagination {
    position: absolute !important;
}
.jumbo {
    display: flex;
    .jumbo1 {
        height: -webkit-fill-available;
        .carousel-image-container {
            position: relative;
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
            margin-left: 55%;
            text-align: end;
        }

        .carousel-title {
            font-size: 1.8rem;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .carousel-description {
            font-size: 1rem;
            margin-bottom: 20px;
            margin-left: 10%;
            font-weight: 400;
        }

        .VueCarousel {
            object-fit: contain;
            width: 100%;
            height: 400px;
        }
    }

    .jumbo2 {
        .clock {
            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 1rem;

            height: -webkit-fill-available;
            background-color: rgb(246, 134, 48);

            .countdown {
                .square {
                    display: flex;
                    align-items: center;
                    justify-content: center;

                    height: 70px;
                    width: 70px;
                    background-color: rgb(253, 188, 72);
                    margin: 10px;
                    padding: 1.2rem;

                    .square-time {
                        font-size: 1.8rem;
                        font-weight: bold;
                        color: black;
                    }

                    .square-text {
                        font-size: 0.5rem;
                        font-weight: bold;
                    }
                }
            }
        }

        .delivery {
            height: fit-content;
            margin-top: 10px;

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
                width: -webkit-fill-available;
                min-height: -webkit-fill-available;
            }
        }
    }
}
</style>
