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
                                src="https://lh3.googleusercontent.com/1nhedymgp5b6yGMF5ebryG4YlgGqgRbypmRYvIZh3u0FwbVdvfl-x4dvozD8MLdcbpW7-VtD8XTkaTj_fsm-tY0gkXL-RoN6qjeuBIUr"
                                alt="category-img"
                            />
                            <div class="litlogo position-absolute">
                                <img class="img-fluid" src="" alt="" />
                            </div>
                        </div>

                        <div class="down">
                            <div class="card-body text-center p-1">
                                <p class="card-title">SCATOLE</p>
                                <p class="card-text font-weight-bold mb-4">
                                    PERSONALIZZATE
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
        border-radius: 0px;
        border: 0px;
        transition: transform 0.2s;
        padding: 0px;
        margin: 8px 2px;
        min-height: 150px;
        max-height: 150px;

        &:hover {
            transform: scale(0.95);
            cursor: pointer;
        }

        .up {
            height: 75%;
            img {
                padding: 10px;
                height: -webkit-fill-available;
                padding: 1rem 0px;
            }
            .litlogo {
                bottom: 30px;
                right: -25px;
                height: 80px;
                width: 80px;
            }
        }

        .down {
            height: 25%;
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
