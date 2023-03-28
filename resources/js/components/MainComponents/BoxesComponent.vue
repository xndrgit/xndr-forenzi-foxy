<template>
    <section class="boxes d-flex flex-wrap justify-content-center">
        <div class="box">
            <div class="card-header">
                <router-link
                    :to="{ name: 'product', params: { id: product.id } }"
                >
                    <img
                        :alt="product.name"
                        :src="imageSource"
                        class="img-fluid"
                        alt=""
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
                    <p v-if="product.price_saled" class="current-price">
                        {{ product.price_saled }} €
                    </p>
                    <p v-else class="price">{{ product.price }} €</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="add-to-cart d-flex col-12 align-items-center">
                    <div class="left">
                        <button
                            :disabled="
                                !product.quantity || product.quantity < 1
                            "
                            class="yellow-button"
                            @click="addToCart"
                        >
                            <span class="d-none d-sm-block">
                                AGGIUNGI AL CARRELLO
                            </span>

                            <span class="d-sm-none d-block">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                        </button>
                    </div>
                    <div class="right">
                        <QuantityProductsComponent
                            :product="product"
                            @update-quantity="updateQuantity"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import QuantityProductsComponent from "../MainComponents/QuantityProductsComponent.vue";
import mixinCart from "../../mixins/mixinCart";

export default {
    components: {
        QuantityProductsComponent,
    },
    mixins: [mixinCart],
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            quantity: 0,
        };
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
    methods: {
        addToCart() {
            let addedItem = Object.assign({}, this.product);
            this.items = this.getCartItems();

            if (!this.items) {
                this.items = [];
            }

            const filterIndex = this.items.findIndex(
                (el) => el.id === addedItem.id
            );
            if (
                filterIndex > -1 &&
                filterIndex !== undefined &&
                filterIndex !== null
            ) {
                let updatedItems = JSON.parse(JSON.stringify(this.items));
                if (updatedItems[filterIndex]) {
                    updatedItems[filterIndex].cart_quantity += this.quantity;
                }

                this.items = updatedItems;
            } else {
                addedItem.cart_quantity = this.quantity;

                this.items = [...this.items, addedItem];
            }

            // alert("Added to Cart");

        },
        updateQuantity(value) {
            this.quantity = value;
        },
    },
};
</script>

<style lang="scss" scoped>
.col-12 {
    padding: 0;
    justify-content: space-around;
}

.box {
    width: 250px;
    border: 1px solid white;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease-in-out;

    margin: 0.5rem 0.5rem;

    &:hover {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        transform: scale(1.05);
    }

    img {
        object-fit: contain;
    }

    .card-header {
        background-color: white;

        border-bottom: 0;
    }

    .card-body {
        background-color: white;
        padding: 0 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;

        .card-title {
            margin: 0;
            font-size: 0.8rem;
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
            margin: 0;
        }

        .add-to-cart {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            .col-12 {
                padding: 0;
            }
        }

        #add-to-cart-button {
            background-color: black;
            color: white;
            border: none;
            cursor: pointer;
        }
    }

    .card-footer {
        background-color: white;
        padding: 0;
        margin: 0;

        border-top: 0;

        .left {
            width: fit-content;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right {
            margin: 0 5px;

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

        }
    }
}

@media (max-width: 576px) {
    .box {
        width: 155px;
        border: 1px solid white;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        margin: 0.4rem 0.2rem;
      transition: 0.2s;

      &:active{
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

      }

        img {
            object-fit: contain;
        }

        .card-header {
            background-color: white;
            height: 140px;
            padding: 0.2rem;

            border-bottom: 0;
        }

        .card-body {
            background-color: white;
            padding: 0 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;



            .card-title {
                margin: 0;
                font-size: 0.8rem;
                font-weight: bold;
                line-height: 1.5;
              max-width: 130px;
              white-space: nowrap;
              overflow: hidden;
              text-overflow: ellipsis;
            }

            .current-price {
                font-size: .8rem;
                font-weight: bold;
            }

            .old-price {
                font-size: 0.6rem;
                font-weight: bold;
                color: lightgray;
                margin-right: 5px;
            }

            .sale-banner {
                display: none;
            }

            .price {
                font-size: .8rem;
                font-weight: bold;
            }

            p {
                margin: 0;
            }

            .add-to-cart {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;

                .col-12 {
                    padding: 0;


                }
            }

            #add-to-cart-button {
                background-color: black;
                color: white;
                border: none;
                cursor: pointer;
            }
        }

        .card-footer {
            background-color: white;
            padding: 0;
            margin: 0;

            border-top: 0;

            .yellow-button {
              border-radius: 50% !important;
              padding: 0.3rem 0.5rem;
                font-size: 0.6rem;


              &:hover{

                animation: roll .5s;
                animation-fill-mode: forwards;
                color:  black;

              }

              @keyframes roll {
                0% {
                  transform: scale(1);

                  background-color: #f68630;

                }
                50% {
                  transform: scale(.8);

                  background-color: #f68630;

                }
                100% {
                  transform: scale(1);



                }
              }
            }

            .left {
                width: fit-content;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .right {
                margin: 0 5px;

                display: flex;
                align-items: center;
                justify-content: center;

                input {
                    text-align: center;
                    max-width: 35px;
                    height: fit-content;
                }

                input,
                button {
                    border: 1px solid lightgrey;
                    font-size: 0.3rem;
                  text-align: center;
                }

                #minus-button,
                #plus-button {
                    height: fit-content;
                    background-color: white;

                    text-align: center;
                    font-weight: bold;
                    cursor: pointer;
                }
            }
        }
    }
}
</style>
