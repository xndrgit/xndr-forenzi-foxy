<template>
    <tr>
        <td>
            <img class="img-fluid"
                src="https://static.wixstatic.com/media/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png/v1/fill/w_320,h_360,q_90/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png"
                alt="productImage" />
        </td>

        <td>{{ product.code }}</td>
        <td>{{ product.length }}</td>
        <td>{{ product.weight }}</td>
        <td>{{ product.height }}</td>
        <td>
            <img class="img-fluid"
                src="https://static.wixstatic.com/media/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png/v1/fill/w_320,h_360,q_90/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png"
                alt="PersonaliseImage" />
        </td>
        <td>€ {{ product.price_saled }}</td>
        <td>€ {{ product.first_price }}</td>
        <td>€ {{ product.second_price }}</td>
        <td>€ {{ product.third_price }}</td>
        <td>€ {{ product.fourth_price }}</td>
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
                    <input type="text" id="input" v-model="value" />
                    <button @click="increaseValue()">
                        +
                    </button>
                </div>

                <div @click="addToCart" class="yellow-button">AGGIUNGI</div>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            code: '',
            value: 0,
        }
    },
    methods: {
        aaa() {
            this.code = this.product.code;
            this.value = this.product.purchasable_in_multi_of;
        },
        increaseValue() {
            this.value += this.product.purchasable_in_multi_of || 1;
        },
        decreaseValue() {
            if (this.value >= (this.product.purchasable_in_multi_of || 1)) {
                this.value -= this.product.purchasable_in_multi_of || 1;
                if (this.value < this.product.purchasable_in_multi_of)
                    this.value = this.product.purchasable_in_multi_of;
            }
        },
        addToCart() {
            // code to add item to cart, for example
            // using this.product and this.quantity to add the product to the cart

            if (!this.$store.state.isAuth) {
                //not login
                alert("Try to login");
                // this.$router.push("/login");
                return;
            }
            axios
                .post("/api/orders", {
                    id: this.product.id,
                    quantity: this.value,
                })
                .then((response) => {
                    if (response.data.productCount) alert("Added to Cart");
                    this.$store.commit("updateCart", {
                        productCount: response.data.productCount,
                        total: response.data.result,
                    });
                })
                .catch((err) => {
                    //handle error
                });
        },
    },
    mounted() {
        this.aaa();
    }
}
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