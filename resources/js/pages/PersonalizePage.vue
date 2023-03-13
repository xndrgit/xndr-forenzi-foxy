<template>
    <div class="personalize">
        <div class="container-lg">
            <div class="d-flex flex-column align-items-center mb-4">
                <h2 class="text-center font-weight-bold my-2">
                    Configura la tua scatola su misura in meno di un minuto!
                </h2>
            </div>
        </div>

        <div class="bg-gray">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div
                        class="create-images col-10 d-flex flex-wrap justify-content-center"
                    >
                        <img
                            v-for="(image, index) in images"
                            :key="index"
                            class="personalize-img img-fluid d-none d-sm-block col-sm-3"
                            :alt="image.title"
                            :src="image.src"
                        />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="row flex-wrap justify-content-center col-12">
                        <div class="steps col-12 col-md-8 col-sm-10">
                            <!-- Left side content goes here -->
                            <StepFirstDynamic
                                v-for="(element, index) in boxone"
                                @inputValuesChanged="setInputValues"
                                @inputQuantityChanged="setInputQuantity"
                                class="step"
                                :key="element.id"
                                :step="element.step"
                                :title="element.title"
                                :letter-q="element.letterQ"
                                :letter-one="element.letterOne"
                                :letter-two="element.letterTwo"
                                :letter-three="element.letterThree"
                                :txt-q="element.txtQ"
                                :txt-one="element.txtOne"
                                :txt-two="element.txtTwo"
                                :txt-three="element.txtThree"
                                :txt-banner="element.txtBanner"
                                :img="element.img"
                            />
                            <StepColor
                                v-for="(element, index) in colorData"
                                @selectedColor="setSelectedColor"
                                :key="element.id"
                                :step="element.step"
                                :title="element.title"
                                :title-one="element.titleOne"
                                :title-two="element.titleTwo"
                                :txt-one="element.txtOne"
                                :txt-two="element.txtTwo"
                                :img-one="element.imgOne"
                                :img-two="element.imgTwo"
                            />
                            <StepType
                                v-for="(element, index) in typeData"
                                @selectedType="setSelectedType"
                                :key="element.id"
                                :step="element.step"
                                :title="element.title"
                                :title-one="element.titleOne"
                                :title-two="element.titleTwo"
                                :txt-one="element.txtOne"
                                :txt-two="element.txtTwo"
                                :img-one="element.imgOne"
                                :img-two="element.imgTwo"
                            />

                            <StepThirdDynamic
                                @printSelected="setPrintValue"
                                :radio-value="radioValue"
                            />
                        </div>
                        <div class="col-12 col-md-4">
                            <SummaryPersonalize
                                :inputH="inputH"
                                :inputP="inputP"
                                :inputL="inputL"
                                :inputQ="inputQ"
                                :selectedColor="selectedColor"
                                :selectedType="selectedType"
                                :radioValue="radioValue"
                                @update-sender="updateSenderAddress"
                                @send-email="sendEmail"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StepFirstDynamic from "../components/MainComponents/StepFirstDynamic.vue";
import StepColor from "../components/MainComponents/StepColor.vue";
import StepType from "../components/MainComponents/StepType.vue";
import StepThirdDynamic from "../components/MainComponents/StepThirdDynamic.vue";
import SummaryPersonalize from "../components/MainComponents/SummaryPersonalize.vue";

export default {
    components: {
        StepFirstDynamic,
        StepColor,
        StepType,
        StepThirdDynamic,
        SummaryPersonalize,
    },
    data() {
        return {
            inputH: "",
            inputP: "",
            inputL: "",
            inputQ: "",
            radioValue: "",
            selectedColor: "",
            selectedType: "",

            sender_email: "",
            first_name: "",
            last_name: "",
            business_name: "",
            address: "",
            phone: "",

            boxone: [
                {
                    step: "1",
                    title: "INSERISCI LE MISURE DELLA SCATOLA",
                    letterOne: "L",
                    letterTwo: "P",
                    letterThree: "H",
                    txtOne: "CM",
                    txtTwo: "CM",
                    txtThree: "CM",
                    txtBanner: "",
                    img: require("../../../public/Links/misure.png"),
                },
                {
                    step: "2",
                    title: "INSERISCI LA QUANTITÀ",
                    letterQ: "Q",
                    letterOne: "",
                    letterTwo: "",
                    letterThree: "",
                    txtQ: "PEZZI",
                    txtOne: "",
                    txtTwo: "",
                    txtThree: "",
                    txtBanner: "50 è la quantità minima che puoi ordinare",
                    img: require("../../../public/Links/quantity-personalize.png"),
                },
            ],
            colorData: [
                {
                    step: "3",
                    title: "SCEGLI IL COLORE DELLA SCATOLA",
                    titleOne: "AVANA",
                    titleTwo: "BIANCA",
                    txtOne: "",
                    txtTwo: "",
                    imgOne: require("../../../public/Links/scatola-personalizzata-1-per-pagina-avana.png"),
                    imgTwo: require("../../../public/Links/scatola-personalizzata-bianca.png"),
                },
            ],
            typeData: [
                {
                    step: "4",
                    title: "SCEGLI IL TIPO DI CARTONE",
                    titleOne: "SCATOLA A 1 ONDA",
                    titleTwo: "SCATOLE A 2 ONDE",
                    txtOne: "consigliata fino a 10kg",
                    txtTwo: "consigliata fino a 10k",
                    imgOne: require("../../../public/Links/1-onda.jpg"),
                    imgTwo: require("../../../public/Links/2-onde.jpg"),
                },
            ],
            images: [
                {
                    title: "",
                    src: require("../../../public/Links/rm442-09-05-g-mockup.png"),
                },
                {
                    title: "",
                    src: require("../../../public/Links/scatola-box.png"),
                },
                {
                    title: "",
                    src: require("../../../public/Links/28_April_04.png"),
                },
                {
                    title: "",
                    src: require("../../../public/Links/04.png"),
                },
            ],
        };
    },
    methods: {
        setPrintValue(print) {
            this.radioValue = print;
        },

        setInputValues(inputValues) {
            this.inputL = inputValues.inputL;
            this.inputH = inputValues.inputH;
            this.inputP = inputValues.inputP;
        },
        setInputQuantity(inputQuantity) {
            this.inputQ = inputQuantity.inputQ;
        },

        setSelectedColor(color) {
            this.selectedColor = color;
        },
        setSelectedType(type) {
            this.selectedType = type;
        },

        updateSenderAddress(data) {
            this.sender_email = data.sender_email;
            this.first_name = data.first_name;
            this.last_name = data.last_name;
            this.business_name = data.business_name;
            this.address = data.address;
            this.phone = data.phone;
        },

        sendEmail() {
            axios
                .post("/shop/personalizes", {
                    sender_email: this.sender_email,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    business_name: this.business_name,
                    address: this.address,
                    phone: this.phone,
                    length: this.inputL,
                    width: this.inputP,
                    height: this.inputH,
                    quantity: this.inputQ,
                    color: this.selectedColor.value,
                    cardboard_type: this.selectedType.value,
                    press_type: this.radioValue,
                })
                .then((r) => {
                    this.$router.push({
                        path: "/congratulation",
                        name: "congratulation",
                    });
                })
                .catch((e) => {});
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../sass/global.scss";

.create-images {
    padding: 1rem;

    img {
        height: 180px;
    }
}

h2 {
    font-size: 1.7rem;
    font-weight: bold;
    margin: 0px;
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
    font-size: 12rem;
    top: 80px;
    color: white;
    font-weight: bold;
}

.title-create {
    font-weight: bold;
    font-size: 1.5rem;
}

.step {
    margin-bottom: 1rem;
    display: flex;
    border: 1px solid lightgray;
    padding: 1rem;

    background-color: white;
    color: black;
}

label {
    font-size: 1rem;
}

input {
    width: 30%;
    margin: 1rem 0px;
    height: 30px;
    font-size: 1.5rem;
    border: none;
    background-color: #f1f1f1;
}

.form-group input {
    width: 100%;
}

.image img {
    padding: 1rem;
}
</style>
