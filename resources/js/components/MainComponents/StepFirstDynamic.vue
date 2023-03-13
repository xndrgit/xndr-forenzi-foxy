<template>
    <div class="step">
        <!-- Title goes here -->
        <div class="d-flex justify-content-start align-items-start">
            <div class="bg-yellow px-2 py-2 mx-2">STEP {{ step }}</div>
            <div class="col-8">
                <span class="title-create">{{ title }}</span>
                <div
                    class="d-flex flex-wrap align-items-center justify-content-between col-12"
                >
                    <!-- Left column -->
                    <div class="inputs col-md-7">
                        <!-- Left side content goes here -->
                        <div
                            class="d-flex align-items-center justify-content-start"
                        >
                            <div v-if="letterQ" class="bg-yellow">
                                {{ letterQ }}
                            </div>
                            <input
                                v-if="letterQ"
                                v-model="inputQ"
                                min="1"
                                placeholder=""
                                required
                                type="number"
                                @input="emitQuantity"
                            />
                            <h2 v-if="txtQ" class="mx-2 d-none d-sm-block">
                                {{ txtQ }}
                            </h2>
                        </div>

                        <div
                            class="d-flex align-items-center justify-content-start"
                        >
                            <div v-if="letterOne" class="bg-yellow">
                                {{ letterOne }}
                            </div>
                            <input
                                v-if="letterOne"
                                v-model="inputL"
                                min="1"
                                placeholder=""
                                required
                                type="number"
                                @input="emitInputValues"
                            />
                            <h2 v-if="txtOne" class="mx-2 d-none d-sm-block">
                                {{ txtOne }}
                            </h2>
                        </div>

                        <div
                            class="d-flex align-items-center justify-content-start"
                        >
                            <div v-if="letterTwo" class="bg-yellow">
                                {{ letterTwo }}
                            </div>
                            <input
                                v-if="letterTwo"
                                v-model="inputP"
                                min="1"
                                placeholder=""
                                required
                                type="number"
                                @input="emitInputValues"
                            />
                            <h2 v-if="txtTwo" class="mx-2 d-none d-sm-block">
                                {{ txtTwo }}
                            </h2>
                        </div>

                        <div
                            class="d-flex align-items-center justify-content-start"
                        >
                            <div v-if="letterThree" class="bg-yellow">
                                {{ letterThree }}
                            </div>
                            <input
                                v-if="letterThree"
                                v-model="inputH"
                                min="50"
                                placeholder=""
                                required
                                type="number"
                                value="50"
                                @input="emitInputValues"
                            />
                            <h2 v-if="txtThree" class="mx-2 d-none d-sm-block">
                                {{ txtThree }}
                            </h2>
                        </div>
                    </div>
                    <!-- Right column -->
                    <div class="image d-none d-md-block col-md-5">
                        <!-- Right side content goes here -->
                        <img
                            v-if="img"
                            :src="img"
                            alt="image"
                            class="img-fluid"
                        />
                    </div>
                </div>
                <span class="sub">{{ txtBanner }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        step: String,
        title: String,
        letterQ: String,
        letterOne: String,
        letterTwo: String,
        letterThree: String,
        txtQ: String,
        txtOne: String,
        txtTwo: String,
        txtThree: String,
        txtBanner: String,
        img: String,
    },
    data() {
        return {
            inputL: "",
            inputH: "",
            inputP: "",
            inputQ: "",
        };
    },
    methods: {
        emitInputValues() {
            this.$emit("inputValuesChanged", {
                inputL: this.inputL,
                inputH: this.inputH,
                inputP: this.inputP,
            });
        },
        emitQuantity() {
            this.$emit("inputQuantityChanged", {
                inputQ: this.inputQ,
            });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/global.scss";

h2 {
    font-size: 1rem;
}

.sub {
    font-size: 0.6rem;
    font-weight: 600;
}

@media screen and (max-width: 560px) {
}

.inputs {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.inputs .d-flex {
    align-items: center;
    justify-content: start;
}

.inputs .bg-yellow {
    color: white;
    display: flex;
    height: 40px;
    justify-content: center;
    align-items: center;
    width: 40px;
}

.inputs input {
    padding: 1rem 0.5rem;
    font-weight: bold;
    height: 40px;
    max-width: 60px;
    margin: 0.2rem 0px;
    font-size: 1rem;
    border: none;
    background-color: #f1f1f1;
}

.inputs input::placeholder {
    font-size: 0.5rem;
}

.image {
    display: flex;
    flex-direction: column;

    img {
        height: 156px;
        max-width: fit-content;
    }
}

.step {
    margin-bottom: 5rem;
    display: flex;
    border: 1px solid lightgray;
    padding: 1rem;
    background-color: white;
    color: black;
}

.title-create {
    font-weight: bold;
    font-size: 1rem;
}

@media screen and (max-width: 500px) {
    .title-create {
        font-size: 0.6rem;
    }
}
</style>
