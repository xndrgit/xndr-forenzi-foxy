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
                        <tr>
                            <td>
                                <img
                                    class="img-fluid"
                                    src="https://static.wixstatic.com/media/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png/v1/fill/w_320,h_360,q_90/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png"
                                    alt="productImage"
                                />
                            </td>

                            <td>144</td>
                            <td>14</td>
                            <td>14</td>
                            <td>10</td>
                            <td>
                                <img
                                    class="img-fluid"
                                    src="https://static.wixstatic.com/media/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png/v1/fill/w_320,h_360,q_90/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png"
                                    alt="PersonaliseImage"
                                />
                            </td>
                            <td>€ 2,08</td>
                            <td>€ 2,08</td>
                            <td>€ 2,08</td>
                            <td>€ 2,08</td>
                            <td>€ 2,08</td>
                            <td>
                                <div class="d-inline">1.280</div>
                                <div class="yellow-button d-inline p-2 mx-2">
                                    +
                                </div>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <div class="d-flex">
                                        <button @click="decreaseValue()">
                                            -
                                        </button>

                                        <input
                                            type="text"
                                            id="input"
                                            v-model="value"
                                        />
                                        <button @click="increaseValue()">
                                            +
                                        </button>
                                    </div>

                                    <div class="yellow-button">AGGIUNGI</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            value: 100,
        };
    },
    methods: {
        increaseValue() {
            this.value += 10;
        },
        decreaseValue() {
            this.value -= 10;
        },
        sortTable() {
            console.log("clicked");
        },
    },
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
