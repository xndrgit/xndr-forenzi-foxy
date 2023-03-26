<template>
    <div class="shopping-cart d-flex align-items-start">
        <div class="summary d-flex flex-column">
            <h3>RIEPILOGO</h3>
            <div class="summary-item">
                <span class="text">MISURE</span>
                <span class="price"
                    >{{ inputL }} <strong>L x</strong> {{ inputP }}
                    <strong>P x</strong> {{ inputH }} <strong>H</strong>
                </span>
            </div>
            <div class="summary-item">
                <span class="text">QUANTITÀ</span>
                <span class="price"
                    >{{ inputQ }}
                    <strong>PREZZI</strong>
                </span>
            </div>
            <div class="summary-item">
                <span class="text">COLORE SCATOLA</span>
                <span class="price"
                    ><strong>{{ selectedColor.value }}</strong>
                </span>
            </div>
            <div class="summary-item">
                <span class="text">TIPO DI CARTONE</span>
                <span class="price"
                    ><strong>{{ selectedType.value }}</strong>
                </span>
            </div>
            <div class="summary-item">
                <span class="text">STAMPA</span>
                <span class="price"
                    ><strong>{{ radioValue }}</strong>
                </span>
            </div>

            <div class="summary-item">
                <div class="summary-item py-3">
                    <span class="title-create">INSERISCI I DATI</span>
                </div>
                <form>
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="">NOME</label>
                            <div
                                class="d-flex jusify-content-start align-items-center"
                            >
                                <input
                                    v-model="first_name"
                                    type="text"
                                    @input="updateSender"
                                />
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <label class="">COGNOME</label>
                            <div
                                class="d-flex jusify-content-start align-items-center"
                            >
                                <input
                                    v-model="last_name"
                                    type="text"
                                    @input="updateSender"
                                />
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label class="">RAGIONE SOCIALE</label>
                            <div
                                class="d-flex jusify-content-start align-items-center"
                            >
                                <input
                                    v-model="business_name"
                                    type="text"
                                    @input="updateSender"
                                />
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="">CITTÀ</label>
                            <div
                                class="d-flex jusify-content-start align-items-center"
                            >
                                <input
                                    v-model="address"
                                    type="text"
                                    @input="updateSender"
                                />
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="">TELEFONO</label>
                                <div
                                    class="d-flex jusify-content-start align-items-center"
                                >
                                    <input
                                        v-model="phone"
                                        type="text"
                                        @input="updateSender"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="">EMAIL</label>
                                <div
                                    class="d-flex jusify-content-start align-items-center"
                                >
                                    <input
                                        v-model="sender_email"
                                        type="text"
                                        @input="updateSender"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <button
                :disabled="!sender_email && !first_name"
                class="btn bg-yellow fw-bold btn-lg btn-block"
                type="button"
                @click="sendEmail"
            >
                INVIA IL PREVENTIVO
            </button>
        </div>
    </div>
</template>

<script>
export default {
    components: {},
    props: [
        "inputH",
        "inputL",
        "inputP",
        "inputQ",
        "selectedColor",
        "selectedType",
        "radioValue",
    ],
    data() {
        return {
            sender_email: "",
            first_name: "",
            last_name: "",
            business_name: "",
            address: "",
            phone: "",
        };
    },

    methods: {
        updateSender() {
            this.$emit("update-sender", {
                sender_email: this.sender_email,
                first_name: this.first_name,
                last_name: this.last_name,
                business_name: this.business_name,
                address: this.address,
                phone: this.phone,
            });
        },
        sendEmail() {
            this.$emit("send-email");
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";

.shopping-cart .summary {
    border: 1px solid lightgray;
    background-color: white;
    padding: 30px;
    color: black;
}

.shopping-cart .summary h3 {
    text-align: start;
    font-size: 1.3em;
    font-weight: 900;
    padding-top: 0;
    padding-bottom: 10px;
}

.shopping-cart .summary .summary-item:not(:last-of-type) {
    padding-bottom: 10px;
    padding-top: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text {
    font-size: 0.5em;
    font-weight: 600;
}

.shopping-cart .summary .price {
    float: right;
    font-size: 0.8rem;
}

.shopping-cart .summary button {
    margin-top: 20px;
}

h2 {
    font-size: 1.5rem;
}

.active {
    transition: 1s;
    transform: scale(0.9);
}

.box {
    position: relative;
    border: none;
}

i {
    position: absolute;
    font-size: 8rem;
    top: 80px;
    color: white;
    font-weight: bold;
}

.title-create {
    font-weight: bold;
    font-size: 1rem;
}

.step {
    margin-bottom: 5rem;
    display: flex;
    border: 1px solid lightgray;
    padding: 1rem;

    background-color: white;
    color: black;
}

label {
    font-size: 0.6rem;
    font-weight: bold;
    margin: 0;
}

input {
    width: 30%;
    font-size: .8rem;
    border: 1px solid lightgray;
    background-color: white;
  padding: .2rem;
}

.form-group input {
    width: 100%;
    margin: 0;
}

.form-group {
    margin: 0;
}

.image img {
    padding: 1rem;
}
</style>
