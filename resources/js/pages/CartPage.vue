<template>
    <section class="shopping-cart">
        <div class="container">
            <div class="block-heading">
                <h2 class="display-5 font-weight-bold">Il tuo carrello</h2>
                <hr class="w-5" />
            </div>
            <hr />
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8" v-if="items">
                        <div class="items" v-for="item in items">
                            <div class="product">
                                <div class="row">
                                    <div class="col-md-2 item">
                                        <img
                                            class="img-fluid mx-auto d-block image"
                                            :src="productImage(item)"
                                            alt=""
                                        />
                                        <a
                                            type="button"
                                            class="delete"
                                            @click="deleteProduct(item)"
                                        >
                                            <i
                                                class="fa-2x fa-regular fa-circle-xmark"
                                            ></i>
                                        </a>
                                    </div>

                                    <div class="col-md-10 d-flex align-items-center ">
                                        <div class="info col-12 ">
                                            <div class="row">
                                                <div
                                                    class="col-md-4 product-name"
                                                >
                                                    <div class="product-name">
                                                        <div
                                                            class="product-info"
                                                        >
                                                            <div>
                                                                <span
                                                                    class="value"
                                                                >
                                                                    Codice:
                                                                    <strong>
                                                                        {{
                                                                            item.code
                                                                        }}
                                                                    </strong>
                                                                </span>
                                                            </div>

                                                            <div>
                                                                <span
                                                                    class="value"
                                                                >
                                                                    <a href="#">
                                                                        <strong>
                                                                            {{
                                                                                item.name
                                                                            }}
                                                                        </strong>
                                                                    </a>
                                                                </span>
                                                            </div>

                                                            <div>
                                                                <span
                                                                    class="value"
                                                                >
                                                                    <strong>
                                                                        {{
                                                                            item.length
                                                                        }}
                                                                        x
                                                                        {{
                                                                            item.height
                                                                        }}
                                                                        x
                                                                        {{
                                                                            item.width
                                                                        }}
                                                                    </strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 price">
                                                    <div>
                                                        <span
                                                            :class="{
                                                                price: !item.price_saled,
                                                                'current-price':
                                                                    item.price_saled,
                                                                'text-warning':
                                                                    item.price_saled,
                                                            }"
                                                        >
                                                            €{{
                                                                item.price_saled
                                                                    ? item.price_saled
                                                                    : item.price
                                                            }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 quantity d-flex align-items-center">
                                                    <label
                                                        class="fw-bold"
                                                        for="quantity"
                                                    ></label>

                                                    <input
                                                        readonly
                                                        class="form-control quantity-input"
                                                        :id="item.id"
                                                        type="number"
                                                        min="0"
                                                        ref="totalQuantity"
                                                        :value="
                                                            item.cart_quantity
                                                        "
                                                    />
                                                </div>
                                                <div class="col-md-2 price">


                                                        <span>€</span>
                                                        <input
                                                            type="text"
                                                            id="id1"
                                                            class="priceLabel"
                                                            :id="item.id"
                                                            ref="subTotalPrice"
                                                            style="
                                                                border: none;
                                                                box-shadow: none;
                                                                background-color: white;
                                                                pointer-events: none;
                                                            "
                                                            :value="
                                                                (
                                                                    item.cart_quantity *
                                                                    (item.price_saled
                                                                        ? item.price_saled
                                                                        : item.price)
                                                                ).toFixed(2)
                                                            "
                                                            readonly
                                                        />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8" v-else></div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary d-flex flex-column">
                            <h3>TOTALE A CARRELLO</h3>
                            <div class="summary-item">
                                <span class="text">SUBTOTALE</span>
                                <span class="price">
                                    €{{ parseFloat(subtotal).toFixed(2) }}
                                </span>
                            </div>
                            <div class="summary-item">
                                <span class="text">SPEDIZIONE GRATUITA</span>
                                <span class="price">
                                    €{{ parseFloat(shipping_cost).toFixed(2) }}
                                </span>
                            </div>
                            <div class="summary-item">
                                <span class="text">CONTRIBUTO CONAI</span>
                                <span class="price">
                                    €{{ parseFloat(conai).toFixed(2) }}
                                </span>
                            </div>
                            <div class="summary-item">
                                <span class="text">IVA</span>
                                <span class="price">
                                    €{{ parseFloat(iva).toFixed(2) }}
                                </span>
                            </div>
                            <div
                                class="summary-item txt-orange d-flex align-items-center justify-content-between"
                            >
                                <span class="text">TOTALE ORDINE</span>
                                <span class="price">
                                    €{{
                                        parseFloat(
                                            subtotal +
                                                shipping_cost +
                                                conai +
                                                iva
                                        ).toFixed(2)
                                    }}
                                </span>
                            </div>
                            <hr />
                            <a
                                v-if="items"
                                type="button"
                                class="btn bg-yellow fw-bold btn-lg btn-block"
                                @click="checkout()"
                            >
                                PROCEDI AL CHECKOUT
                            </a>
                            <a
                                v-else
                                type="button"
                                class="btn bg-yellow fw-bold btn-lg btn-block disabled"
                            >
                                PROCEDI AL CHECKOUT
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import mixinCart from "../mixins/mixinCart";

export default {
    mixins: [mixinCart],
    data() {
        return {
            shipping_cost: 0.0,
        };
    },
    computed: {
        productImage() {
            return function (product) {
                if (/^http/.test(product.img)) {
                    return product.img;
                } else {
                    return "/storage/" + product.img;
                }
            };
        },
    },
    methods: {
        checkout() {
            this.items = this.getCartItems();

            if (!this.isLoggedIn) {
                window.location.href = "/login";

                return;
            }

            if (!this.items) {
                return false;
            }

            axios
                .post('/shop/carts', {
                    items: this.items
                })
                .then((response) => {
                    if (response.data.result === "success") {
                        this.items = response.data.products;

                        alert("Procedi Al Checkout");

                        window.location.href = "/checkout";
                    }
                })
                .catch((err) => {
                    console.error(err);
                });
        },

        deleteProduct(item) {
            this.items = this.getCartItems();

            if (this.items) {
                const deletedIndex = this.items.findIndex(el => el.id === item.id);

                this.items.splice(deletedIndex, 1);
            }

            if (this.isLoggedIn) {
                axios
                    .delete(`/shop/carts/${item.id}`)
                    .then((response) => {
                        if (response.data.result === "success") {
                            this.items = response.data.products;
                        }
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../sass/global.scss";

.btn {
    font-size: 0.8rem;
}

.price {
    font-size: 0.6rem;
}

a {
    font-size: 0.5rem;
}

.product img {
    width: fit-content;
    height: 100px;
}

.coupon {
    margin: 2rem;
}

.shopping-cart {
    padding-bottom: 50px;
}

.shopping-cart .block-heading {
    padding-top: 50px;
    margin-bottom: 40px;
    text-align: start;
}

.shopping-cart .block-heading p {
    text-align: center;
    max-width: 420px;
    margin: auto;
    opacity: 0.7;
}

.shopping-cart .dark .block-heading p {
    opacity: 0.8;
}

.shopping-cart .block-heading h1,
.shopping-cart .block-heading h2,
.shopping-cart .block-heading h3 {
    margin-bottom: 1.2rem;
}

.shopping-cart .items {
    margin: auto;
}

// .shopping-cart .items .product {
// }

.shopping-cart .items .product img {
    transform: scale(0.8);
}

.shopping-cart .items .product .info {
    padding-top: 0px;
    text-align: center;
}

.shopping-cart .items .product .info .product-name {
    font-weight: 600;
}

.shopping-cart .items .product .info .product-name .product-info {
    font-size: 10px;
    margin-top: 15px;
}

.shopping-cart .items .product .info .product-name .product-info .value {
    font-weight: 400;
    font-size: 0.7rem;
}

.shopping-cart .items .product .info .product-name .product-info .value a {
    font-weight: 400;
    font-size: 0.6rem;
}

.shopping-cart .items .product .info .quantity .quantity-input {
    margin: auto;
    width: 68px;
    height: 32px;
}

.shopping-cart .items .product .info .price {
display: flex;
align-items: center;

    font-weight: bold;
}

.shopping-cart .summary {
    border: 1px solid lightgray;
    background-color: white;
    height: 100%;
    padding: 30px;
}

.shopping-cart .summary h3 {
    text-align: start;
    font-size: 1rem;
    font-weight: 600;
    padding-top: 20px;
    padding-bottom: 20px;
}

.shopping-cart .summary .summary-item:not(:last-of-type) {
    padding-bottom: 10px;
    padding-top: 10px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.shopping-cart .summary .text {
    font-size: 0.8rem;
    font-weight: 800;
}

.shopping-cart .summary .price {
    float: right;
    font-size: 0.8rem;
    font-weight: 800;
}

.shopping-cart .summary button {
    margin-top: 20px;
}

@media (min-width: 768px) {
    .shopping-cart .items .product .info {
        text-align: left;
    }

    .shopping-cart .items .product .info .price {
        font-weight: bold;
        font-size: 0.9rem;
    }

    .shopping-cart .items .product .info .quantity {
        text-align: center;
    }

    .shopping-cart .items .product .info .quantity .quantity-input {
        text-align: center;
    }

    input {
        border: 1px solid lightgray;
        outline: none;
    }
}

.item img {
    object-fit: cover;
    border-radius: 5px;
}

.item {
    position: relative;
}

.delete {
    position: absolute;

    font-weight: 800;
    font-size: 0.8rem;
    text-align: center;
    color: #fff;
    padding-left: 4px;

    top: 30px;
    right: 25px;

    i {
        background-color: rgb(244, 190, 89);
        border-radius: 50%;
        cursor: pointer;
        transition: 1s ease-in-out;

        &:hover {
            transform: scale(0.9);
            filter: grayscale(2);
        }
    }
}
</style>
