<template>
    <section class="boxes d-flex flex-wrap justify-content-center">
        <div class="box">
            <div class="card-header">
                <router-link
                    :to="{ name: 'product', params: { id: product.id } }"
                >
                    <img
                        class="img-fluid"
                        :src="imageSource"
                        :alt="product.name"
                    />
                </router-link>
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ product.name }}</h5>
                <!-- <h6 class="text-muted small">{{ product.category.name }}</h6> -->

                <div class="price d-flex align-items-center">
                    <div v-if="product.price_saled" class="sale-banner">
                        {{ salePercentage.toFixed(0) }}%
                    </div>
                    <p v-if="product.price_saled" class="old-price">
                        {{ product.price }} €
                    </p>
                    <p v-if="!product.price_saled" class="price">
                        {{ product.price }} €
                    </p>
                    <p v-if="product.price_saled" class="current-price">
                        {{ product.price_saled }} €
                    </p>
                </div>
            </div>
            <div class="card-footer">
                <div class="add-to-cart d-flex col-12">
                    <div class="left">
                        <button @click="addToCart" class="yellow-button">
                            AGGIUNGI AL CARRELLO
                        </button>
                    </div>
                    <div class="right">
                        <QuantityProductsComponent
                            @update-quantity="updateQuantity"
                            :product="product"
                        />
                        <!-- <p>Quantity: {{ quantity }}</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import QuantityProductsComponent from "../MainComponents/QuantityProductsComponent.vue";

export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    components: {
        QuantityProductsComponent,
    },
    data() {
        return {
            quantity: 0,
        };
    },
    methods: {
        addToCart() {
            // code to add item to cart, for example
            // using this.product and this.quantity to add the product to the cart

            // if (!this.$store.state.isAuth) {
            //     //not login
            //     alert("Try to login");
            //     this.$router.push("/login");
            //     return;
            // }
            axios
                .post("/shop/orders", {
                    id: this.product.id,
                    quantity: this.quantity,
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
        updateQuantity(value) {
            this.quantity = value;
        },
    },
    computed: {
        salePercentage() {
            if (!this.product.price_saled) return 0;
            return (
                ((this.product.price - this.product.price_saled) /
                    this.product.price) *
                100
            );
        },
        imageSource() {
            if (/^http/.test(this.product.img)) {
                return this.product.img;
            } else {
                return "/storage/" + this.product.img;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.col-12 {
    padding: 0px;
    justify-content: space-around;
}

.box {
    width: 250px;
    border: 1px solid white;
    overflow: hidden;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease-in-out;

    margin: 1.2rem;

    &:hover {
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);
        transform: scale(1.05);
    }

    img {
        object-fit: contain;
    }

    .card-header {
        background-color: white;

        border-bottom: 0px;
    }

    .card-body {
        background-color: white;
        padding: 0px 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;

        .card-title {
            margin: 0;
            font-size: .8rem;
            font-weight: bold;
            line-height: 1.5;
        }

        .current-price {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .old-price {
            font-size: 0.8rem;
            font-weight: bold;
            color: lightgray;
            margin-right: 5px;
        }

        .price {
            font-size: 1.2rem;
            font-weight: bold;
        }

        p {
            margin: 0px;
        }

        .add-to-cart {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            .col-12 {
                padding: 0px;
            }
        }

        #add-to-cart-button {
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        #add-to-cart-button:hover {
            background-color: #3e8e41;
        }
    }

    .card-footer {
        background-color: white;
        padding: 0px;
        margin: 0px;

        border-top: 0px;

        .left {
            width: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right {
            margin: 0rem 5px;

            display: flex;
            align-items: center;
            justify-content: center;

            input {
                text-align: center;
                max-width: 45px;
                height: fit-content;
            }

            input,
            button {
                border: 1px solid lightgrey;
                font-size: 0.7rem;
            }

            #minus-button,
            #plus-button {
                height: fit-content;
                background-color: white;

                text-align: center;
                font-weight: bold;
                cursor: pointer;
            }

            #minus-button:hover,
            #plus-button:hover {
                background-color: #fdbc48;
            }
        }
    }
}
</style>
