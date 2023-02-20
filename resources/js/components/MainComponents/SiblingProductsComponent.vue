<template>
    <tr>
        <td>
            <img class="img-fluid" :src="imageSource" :alt="product.name" />
        </td>

        <td class="font-weight-bold">{{ product.code }}</td>
        <td class="font-weight-bold">{{ product.length }}</td>
        <td class="font-weight-bold">{{ product.weight }}</td>
        <td class="font-weight-bold">{{ product.height }}</td>
        <td>
            <a href="/personalize">
                <img
                    class="img-fluid"
                    src="https://static.wixstatic.com/media/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png/v1/fill/w_320,h_360,q_90/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png"
                    alt="PersonaliseImage"
                />
            </a>
        </td>
        <td>
            <span v-if="!product.price_saled" class="price">
                € {{ product.price }}
            </span>
            <span v-if="product.price_saled" class="current-price text-danger">
                € {{ product.price_saled }}
            </span>
        </td>
        <td>€ {{ product.first_price }}</td>
        <td>€ {{ product.second_price }}</td>
        <td>€ {{ product.third_price }}</td>
        <td>€ {{ product.fourth_price }}</td>
        <td class="bancale">
            <div class="d-inline">1.280</div>
            <div class="yellow-button d-inline p-2 mx-2">+</div>
        </td>
        <td>
            <div class="d-flex align-items-center">
                <div class="quantity d-flex">
                    <input type="text" id="input" v-model="value" />
                    <div class="d-flex flex-column">
                        <button @click="increaseValue()">+</button>
                        <button @click="decreaseValue()">-</button>
                    </div>
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
            code: "",
            value: 0,
        };
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
    },
    computed: {
        imageSource() {
            if (/^http/.test(this.product.img)) {
                return this.product.img;
            } else {
                return "/storage" + this.product.img.substring(6);
            }
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
            min-width: 60px;
            border: 1px solid #ddd;
            font-size: 0.5rem;
            text-align: center;
            vertical-align: middle;

            img {
                max-height: 50px;
            }

            button {
                font-size: large;
            }

            .quantity {
                height: max-content;

                align-items: center;
                input {
                    width: 40px;
                    height: 30px;

                    text-align: center;

                    border: 1px solid lightgray;
                }
                button {
                    border: 1px solid lightgray;
                    padding: 0px 0.5rem;

                    font-size: 0.6rem;

                    margin-right: 10px;
                }
            }
        }
    }
}
</style>
