<template>
    <div>
        <div class="HeaderBoxes">
            <nav class="d-flex">
                <div class="container d-flex flex-wrap justify-content-around">
                    <div
                        class="card d-flex align-items-center position-relative gray-box"
                    >
                        <div class="up">
                            <img
                                class="card-img-top"
                                src="https://www.freepnglogos.com/uploads/box-png/box-new-used-gaylord-boxes-for-sale-reliable-industries-llc-22.png"
                                alt="img"
                            />
                            <div class="litlogo position-absolute">
                                <img
                                    class="img-fluid"
                                    src="https://assets.msn.com/weathermapdata/1/static/svg/72/v6/card/SunnyDayV3.svg"
                                    alt="img2"
                                />
                            </div>
                        </div>

                        <div class="down">
                            <div class="card-body text-center p-1">
                                <p class="card-title">SCATOLE</p>
                                <p class="card-text font-weight-bold">
                                    PERSONALIIZATE
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
};
</script>

<style lang="scss" scoped>
.HeaderBoxes {
    .container {
        padding: 0px 5px;
    }
    .card {
        width: 8rem;
        margin: 8px 0px;
        border-radius: 0px;
        border: 0px;
        transition: transform 0.2s;
        padding: 0px;
        min-height: 180px;
        max-height: 180px;

        &:hover {
            transform: scale(0.95);
            cursor: pointer;
        }

        .up {
            height: 60%;
            img {
                padding: 10px;
                height: -webkit-fill-available;
                padding: 1rem 0px;
            }
            .litlogo {
                bottom: 50px;
                right: -25px;
                height: 80px;
                width: 80px;
            }
        }

        .down {
            height: 40%;
            display: flex;
            align-items: center;
        }
        p {
            font-size: 0.8rem;
            margin: 0px;
        }
    }

    .orange-box {
        background-color: rgb(245, 134, 47);
    }
    .yellow-box {
        background-color: rgb(253, 188, 72);
    }
    .gray-box {
        background-color: rgb(244, 244, 244);
    }
}
</style>
