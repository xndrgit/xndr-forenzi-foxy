<template>
    <section class="shopping-cart">
        <div class="container">
            <div class="block-heading">
                <h2 class="display-5 font-weight-bold">IL TUO CARRELLO</h2>
                <hr class="w-5" />
            </div>
            <hr />
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="items" v-for="item in order.products">
                            <!-- <CartItem :detail="item"/> -->

                            <div class="product">
                                <div class="row">
                                    <div class="col-md-2 item">
                                        <img
                                            class="img-fluid mx-auto d-block image"
                                            :src="productImage(item)"
                                        />
                                        <a
                                            type="button"
                                            class="delete"
                                            @click="deleteProduct(item)"
                                            ><i
                                                class="fa-2x fa-regular fa-circle-xmark"
                                            ></i
                                        ></a>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="info">
                                            <div class="row">
                                                <div
                                                    class="col-md-3 product-name"
                                                >
                                                    <div class="product-name">
                                                        <div
                                                            class="product-info"
                                                        >
                                                            <div>
                                                                Codice:
                                                                <span
                                                                    class="value"
                                                                    >{{
                                                                        item.code
                                                                    }}</span
                                                                >
                                                            </div>
                                                            <a href="#">{{
                                                                item.name
                                                            }}</a>
                                                            <div>
                                                                <span
                                                                    class="value font-weight-bold"
                                                                    >{{
                                                                        item.length
                                                                    }}
                                                                    x
                                                                    {{
                                                                        item.height
                                                                    }}
                                                                    x
                                                                    {{
                                                                        item.width
                                                                    }}</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 price">
                                                    <div>
                                                        <span
                                                            v-if="
                                                                !item.price_saled
                                                            "
                                                            class="price"
                                                        >
                                                            €
                                                            {{ item.price }}
                                                        </span>
                                                        <span
                                                            v-if="
                                                                item.price_saled
                                                            "
                                                            class="current-price text-danger"
                                                        >
                                                            €
                                                            {{
                                                                item.price_saled
                                                            }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 quantity">
                                                    <label
                                                        class="fw-bold"
                                                        for="quantity"
                                                    >
                                                    </label>

                                                    <input
                                                        readonly
                                                        class="form-control quantity-input"
                                                        :id="item.id"
                                                        type="number"
                                                        min="0"
                                                        @change="test(item)"
                                                        ref="totalQuantity"
                                                        v-model="
                                                            item.pivot.quantity
                                                        "
                                                    />
                                                </div>
                                                <div class="col-md-3 price">
                                                    <div
                                                        style="
                                                            white-space: nowrap;
                                                        "
                                                    >
                                                        <label for="id1"
                                                            >€</label
                                                        >
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
                                                                    item.pivot
                                                                        .quantity *
                                                                    item.price
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
                            </div>
                            <hr />
                        </div>
                        <!-- <div class="d-flex justify-content-between">
																		<form class="coupon d-flex">
																						<input
																										placeholder="Codice Coupon"
																										type="text"
																						/>
																						<button class="btn bg-yellow" type="submit">
																										APPLICA COUPON
																						</button>
																		</form>
																		<form class="coupon d-flex">
																						<button class="btn bg-yellow" type="submit">
																										AGGIORNA IL CARRELLO
																						</button>
																		</form>
														</div> -->
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="summary d-flex flex-column">
                            <h3>TOTALE A CARRELLO</h3>
                            <div class="summary-item">
                                <span class="text">SUBTOTALE</span>
                                <span class="price"
                                    >€
                                    {{
                                        parseFloat(this.subtotal).toFixed(2)
                                    }}</span
                                >
                            </div>
                            <!-- <div class="summary-item">
																						<span class="text">FOXTOP - SCONTO 5%</span>
																						<span class="price">€0</span>
																		</div> -->
                            <!-- <div class="summary-item">
																						<span class="text"
																										>ABBONAMENTO FOXTOP - VALIDO 1 ANNO</span
																						>
																						<span class="price">€0</span>
																		</div> -->
                            <div class="summary-item">
                                <span class="text">SPEDIZIONE GRATUITA</span>
                                <span class="price"
                                    >€
                                    {{
                                        parseFloat(this.shipping_cost).toFixed(
                                            2
                                        )
                                    }}</span
                                >
                            </div>
                            <div class="summary-item">
                                <span class="text">CONTRIBUTO CONAI</span>
                                <span class="price"
                                    >€
                                    {{
                                        parseFloat(this.conai).toFixed(2)
                                    }}</span
                                >
                            </div>
                            <div class="summary-item">
                                <span class="text">IVA</span>
                                <span class="price"
                                    >€
                                    {{ parseFloat(this.iva).toFixed(2) }}</span
                                >
                            </div>
                            <div
                                class="summary-item txt-orange d-flex align-items-center justify-content-between"
                            >
                                <span class="text">TOTALE ORDINE</span>
                                <span class="price"
                                    >€
                                    {{
                                        parseFloat(this.total).toFixed(2)
                                    }}</span
                                >
                            </div>
                            <hr />
                            <a
                                type="button"
                                class="btn bg-yellow fw-bold btn-lg btn-block"
                                @click="checkout()"
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
import CartItem from "./CartItem";
import axios from "axios";

export default {
    components: {
        CartItem,
    },
    data() {
        return {
            products: [],
            order: {},
            order_products: [],
            computedPrice: 0,
            quantity: [],
            subtotal: 0.0,
            shipping_cost: 0.0,
            conai: 0.0,
            iva: 0.0,
            total: 0.0,
            params: [],
        };
    },
    methods: {
        getProducts() {
            axios
                .get("/guest/products", {})
                .then((response) => {
                    this.products = response.data.results;
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },

        getOrders() {
            axios
                .put("/guest/orders")
                .then((response) => {
                    this.order = response.data.results;
                    this.subtotal = parseFloat(this.order.subtotal);
                    // this.shipping_cost = parseFloat(this.order.shipping_cost);
                    this.conai = parseFloat(this.order.conai);
                    this.iva = parseFloat(this.order.iva);
                    this.total = parseFloat(this.order.total);
                })
                .catch((error) => {
                    console.log(error.message);
                });
        },

        test(item) {
            this.subtotal += item.pivot.quantity * parseFloat(item.price);

            this.subtotal = 0;
            this.iva = 0;
            this.$refs.subTotalPrice.map((sub) => {
                this.subtotal += parseFloat(sub.value);
            });

            this.$refs.totalQuantity.map((quantity) => {
                this.iva += quantity.value * 4.35;
                // this.params = [];
                // this.params.push({
                //     id: quantity.id,
                //     quantity: quantity.value,
                // });
            });

            this.conai = ((this.subtotal * 22) / 100.0).toFixed(2);
            this.total = this.subtotal + this.conai + this.iva;
        },

        checkout() {
            this.params = [];
            this.$refs.totalQuantity.map((quantity) => {
                this.params.push({
                    id: quantity.id,
                    quantity: quantity.value,
                });
            });

            axios.post("/guest/orders/id", this.params).then((res) => {
                console.log(res);
                if (res.data.response) {
                    alert("Procedi Al Checkout"); // show alert
                    this.$router.replace({ path: "/checkout" });
                }
            });
        },

        deleteProduct(item) {
            // save current quantity to store
            let quantityTemp = [];
            this.$refs.totalQuantity.map((quantity) => {
                if (item.id != quantity.id) {
                    quantityTemp.push({
                        id: quantity.id,
                        value: parseFloat(quantity.value).toFixed(2),
                    });
                }
            });

            this.$store.commit("currentQuantity", {
                quantity: quantityTemp,
            });

            // after delete subtotal
            let subtotal = 0.0;
            this.order.products.map((product) => {
                if (item.id != product.id) {
                    subtotal =
                        subtotal +
                        parseFloat(product.price * product.pivot.quantity);
                }
            });

            this.subtotal = subtotal;

            // after delete iva
            this.$refs.totalQuantity.map((quantity) => {
                if (item.id != quantity.id)
                    this.iva += (quantity.value * 4.35).toFixed(2);
            });

            // after delete conai
            this.conai = ((this.subtotal * 22) / 100.0).toFixed(2);

            // after delete total
            this.total = parseFloat(
                this.subtotal + this.conai + this.iva
            ).toFixed(2);

            console.log("subtotal:", this.subtotal);
            console.log("iva:", this.iva);
            console.log("conai:", this.conai);
            console.log("total:", this.total);

            // save product count and subtotal to store
            this.$store.commit("updateCart", {
                productCount: this.order.products.length - 1,
                total: parseFloat(this.subtotal).toFixed(2),
            });

            axios
                .post(`/guest/orders/delete/${item.pivot.order_id}`, {
                    product_id: item.pivot.product_id,
                })
                .then((res) => {
                    // if (res.data.response == true) alert("Cancelled");
                    if (res.data.response == false) alert("Failed");
                    if (res.data.response == true) {
                        this.subtotal = this.$store.state.total;

                        console.log("subtotal:", this.subtotal);

                        let params = [];
                        this.$store.state.quantity.map((quantity) => {
                            params.push({
                                id: quantity.id,
                                quantity: quantity.value,
                            });
                        });

                        axios
                            .post("/guest/orders/id", params)
                            .then((res) => {
                                if (res.data.response) {
                                    alert("Deleted Successfully!"); // show alert
                                }
                            })
                            .then();
                        this.getOrders();
                    }
                });
        },
    },
    created() {
        axios.get("/guest/users").then((res) => {
            console.log(res);
        });
        this.getOrders();
        this.getProducts();
    },
    computed: {
        productImage() {
            return function (product) {
                if (/^http/.test(product.img)) {
                    return product.img;
                } else {
                    return "/storage" + product.img.substring(6);
                }
            };
        },
        // subtotal() {
        //     return this.order.products.reduce((subtotal, product) => {
        //         return subtotal + product.price * product.pivot.quantity;
        //     }, 0);
        // },
        // iva() {
        //     return this.$refs.totalQuantity.reduce((iva, quantity) => {
        //         return iva + quantity.value * 4.35;
        //     }, 0);
        // },
        // conai() {
        //     return (this.subtotal * 22) / 100;
        // },
        // total() {
        //     return this.subtotal + this.conai + this.iva;
        // },
    },
};
</script>

<style lang="scss" scoped>
@import "../../sass/global.scss";

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
}

.shopping-cart .items .product .info .quantity .quantity-input {
    margin: auto;
    width: 80px;
}

.shopping-cart .items .product .info .price {
    margin-top: 15px;
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
    font-size: 0.6rem;
    font-weight: 600;
}

.shopping-cart .summary .price {
    float: right;
    font-size: 0.6rem;
}

.shopping-cart .summary button {
    margin-top: 20px;
}

@media (min-width: 768px) {
    .shopping-cart .items .product .info {
        padding-top: 25px;
        text-align: left;
    }

    .shopping-cart .items .product .info .price {
        font-weight: bold;
        top: 17px;
    }

    .shopping-cart .items .product .info .quantity {
        text-align: center;
    }

    .shopping-cart .items .product .info .quantity .quantity-input {
        padding: 4px 10px;
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
