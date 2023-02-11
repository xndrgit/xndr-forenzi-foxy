<template>
    <div class="row">
        <div class="col-12">
            <div class="overflow-table">
                <table class="table table-hover table-fixed my-4">
                    <thead>
                        <tr class="header-top">
                            <th class="bg-dark text-white" colspan="2">
                                SCATOLE 1 ONDA
                            </th>
                            <th class="bg-secondary text-white" colspan="3">
                                MISURE IN CM
                            </th>
                            <th>
                                <!-- <img
                                style="
                                    position: absolute;
                                    top: -10px;
                                    left: 30px;
                                    width: 80px;
                                "
                                class="img-fluid"
                                src="https://th.bing.com/th/id/R.f3a729f2cdc6271bcbdae051ca28fd47?rik=FT%2f0BrFqRaQgxQ&pid=ImgRaw&r=0"
                                alt=""
                            /> -->
                            </th>
                            <th class="bg-dark text-white" colspan="5"></th>

                            <th>
                                <!-- <img
                                style="
                                    position: absolute;
                                    top: -10px;
                                    left: 40px;
                                    width: 80px;
                                "
                                class="img-fluid"
                                src="https://th.bing.com/th/id/R.f3a729f2cdc6271bcbdae051ca28fd47?rik=FT%2f0BrFqRaQgxQ&pid=ImgRaw&r=0"
                                alt=""
                            /> -->
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
                            <th style="background-color: orange">
                                PERSONALIZZA LA SCATOLA
                            </th>
                            <th>DA 1+</th>
                            <th>DA 100+</th>
                            <th>DA 300+</th>
                            <th>DA 500+</th>
                            <th>DA 1.000+</th>
                            <th style="background-color: orange">
                                AGGIUNGI UN BANCALE DA
                            </th>
                            <th>QUANTITÀ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <SiblingProductsComponent v-for="(sibling, index) in siblings" :key="index"
                            :product="sibling" />
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';
import SiblingProductsComponent from '../MainComponents/SiblingProductsComponent.vue';

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
        sortTable() {
            // console.log("clicked");
        },
        getSiblings() {
            Axios.get(`/api/products/siblings/${this.$route.params.id}`, {})
                .then(res => {
                    this.siblings = res.data.results;
                    // this.value = res.data.results.purchasable_in_multi_of;
                    res.data.results.map(val => {
                        this.value.push(val.purchasable_in_multi_of);
                    });
                });
        }
    },
    mounted() {
        this.getSiblings();
    }
};
</script>

<style lang="scss" scoped>
.overflow-table::-webkit-scrollbar {
    background-color: transparent;
}

.overflow-table {
    overflow-x: auto;

    table {

        td,
        th {
            border: 1px solid #ddd;
            font-size: 0.4rem;
            text-align: center;
            vertical-align: middle;

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
