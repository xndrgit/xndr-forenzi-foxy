<template>
    <div class="row">
        <div class="col-12">
            <div class="overflow-table">
                <table class="table table-fixed my-4">
                    <thead>
                        <tr class="header-top">
                            <th class="bg-dark text-white" colspan="2">
                                SCATOLE 1 ONDA
                            </th>
                            <th class="bg-secondary text-white" colspan="3">
                                MISURE IN CM
                            </th>
                            <th
                                style="
                                    position: relative;
                                    padding: 0px;
                                    background-color: rgb(246, 134, 48);
                                    border: 1px solid rgb(246, 134, 48);
                                "
                            >
                                <img
                                    style="
                                        position: absolute;
                                        width: 30px;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                    "
                                    class="img-fluid"
                                    src="../../../../public/Links/scatola-personalizzata-per-tabella.png"
                                    alt=""
                                />
                            </th>
                            <th class="bg-dark text-white" colspan="5"></th>

                            <th
                                style="
                                    position: relative;
                                    padding: 0px;
                                    background-color: rgb(246, 134, 48);
                                    border: 1px solid rgb(246, 134, 48);
                                "
                            >
                                <img
                                    style="
                                        position: absolute;
                                        width: 30px;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                    "
                                    class="img-fluid"
                                    src="../../../../public/Links/bancale-per-tabella.png"
                                    alt=""
                                />
                            </th>
                            <th class="bg-dark text-white">
                                CONSEGNA IN 24/48 ORE
                            </th>
                        </tr>
                        <tr>
                            <th class="th-sm">SCHEDA PRODOTTO</th>
                            <th>CODICE</th>
                            <th>LATO LUNGO</th>
                            <th>LATO CORTO</th>
                            <th>ALTEZZA</th>
                            <th style="background-color: rgb(246, 134, 48)">
                                PERSONALIZZA LA SCATOLA
                            </th>
                            <th>DA 1+</th>
                            <th>DA 100+</th>
                            <th>DA 300+</th>
                            <th>DA 500+</th>
                            <th>DA 1000+</th>
                            <th style="background-color: rgb(246, 134, 48)">
                                AGGIUNGI UN BANCALE DA
                            </th>
                            <th>QUANTITÀ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <SiblingProductsComponent
                            v-for="(sibling, index) in siblings"
                            :key="index"
                            :product="sibling"
                        />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
import SiblingProductsComponent from "../MainComponents/SiblingProductsComponent.vue";

export default {
    data() {
        return {
            value: [],
            siblings: [],
        };
    },
    components: {
        SiblingProductsComponent,
    },
    methods: {
        increaseValue(i) {
            this.value[i] += 10;
        },
        decreaseValue(i) {
            this.value[i] -= 10;
        },
        sortTable() {},
        getSiblings() {
            console.log(this.$route);
            Axios.get(
                `/shop/products/siblings/${this.$route.params.id}`,

                {}
            ).then((res) => {
                this.siblings = res.data.results;
                // this.value = res.data.results.purchasable_in_multi_of;
                res.data.results.map((val) => {
                    this.value.push(val.purchasable_in_multi_of);
                });
            });
        },
        getCategory() {
            this.loadingCategory = true;
            axios
                .get(`/shop/categories/${this.$route.params.id}`)
                .then((response) => {
                    this.category = response.data.results;
                    setTimeout(() => {
                        this.loadingCategory = false;
                    }, 1000);
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
    },
    mounted() {
        this.getSiblings();
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/global.scss";

.overflow-table {
    overflow-x: auto !important;

    table {
        td,
        th {
            background-color: $yellow;
            border: 1px solid #ddd;
            font-size: 0.5rem;
            text-align: center;
            vertical-align: middle;

            font-weight: bold;

            img {
                max-height: 50px;
            }

            button {
                font-size: large;
            }
        }
    }
}
</style>
