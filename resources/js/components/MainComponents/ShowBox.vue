<template>
    <div>
        <LoadingRollComponent v-if="loadingProduct" />
        <div class="d-flex flex-wrap justify-content-center" v-if="product">
            <div class="left col-12 col-lg-5 d-flex justify-content-center">
                <img class="img-fluid" :src="imageSource" :alt="product.name" />
            </div>
            <div class="right col-12 col-lg-7">
                <div>
                    <h2 class="font-weight-bold">{{ product.name }}</h2>
                    <h6 class="price font-weight-bold">
                        {{ product.length }} x {{ product.width }} x
                        {{ product.height }} cm
                    </h6>
                    <hr class="w-5" />
                    <div class="d-flex align-items-center">
                        <h4 v-if="product.price_saled" class="old-price">
                            € {{ product.price }}
                        </h4>
                        <h4 v-if="!product.price_saled" class="price">
                            € {{ product.price }}
                        </h4>
                        <h4 v-if="product.price_saled" class="current-price">
                            € {{ product.price_saled }}
                        </h4>
                        <span class="fw-bold px-2">prezzo cad.</span>
                    </div>
                    <p class="mt-3">
                        Aliqui ium faccum consequi vent, aut que volorum quiatur
                        mo beriam res consedi con pa abore venis audandunt ma
                        ata eum autati quodian dandust et volorem ulparum non
                        restiur ionsequid quidi consequam quatiatene sitem fugit
                        eveliciis dolori vit delistotati simus.
                    </p>
                    <div
                        class="d-flex flex-column py-2"
                        style="border-bottom: 1px solid lightgray"
                    >
                        <div class="d-flex">
                            <span>CODICE:</span>
                            <strong class="fw-bold">{{ product.code }}</strong>
                        </div>

                        <div class="d-flex">
                            <span>CATEGORIA:</span>
                            <strong v-if="product.category">
                                <span class="fw-bold">
                                    {{ product.category.name }}
                                </span>
                            </strong>
                        </div>
                    </div>
                    <div class="d-flex align-items-center productAdd">
                        <QuantityProductsComponent
                            @update-quantity="updateQuantity"
                            :product="product"
                        />
                        <div @click="addToCart" class="yellow-button mx-2">
                            AGGIUNGI AL CARRELLO
                        </div>
                    </div>
                </div>

                <div class="overflow-table">
                    <table
                        class="alternating-rows table table-hover table-fixed"
                    >
                        <tr>
                            <td class="td1">QUANTITÀ</td>
                            <td>DA 1+</td>
                            <td>DA 100+</td>
                            <td>DA 300+</td>
                            <td>DA 500+</td>
                            <td>DA 1000+</td>
                        </tr>
                        <tr>
                            <td class="td1">PREZZO UNITARIO</td>
                            <td class="td2">
                                <span v-if="!product.price_saled" class="price">
                                    € {{ product.price }}
                                </span>
                                <span
                                    v-if="product.price_saled"
                                    class="current-price"
                                >
                                    € {{ product.price_saled }}
                                </span>
                            </td>
                            <td class="td2">€ {{ product.first_price }}</td>
                            <td class="td2">€ {{ product.second_price }}</td>
                            <td class="td2">€ {{ product.third_price }}</td>
                            <td class="td2">€ {{ product.fourth_price }}</td>
                        </tr>
                    </table>
                </div>

                <div class="d-flex align-items-center py-2">
                    <h6 class="font-weight-bold">
                        PREZZO TOTALE CON IVA E CONAI:
                    </h6>
                    <h6 class="font-weight-bold mx-1" style="color: orange">
                        € {{ totalPrice.toFixed(2) }}
                    </h6>
                </div>
            </div>
        </div>

        <div class="">
            <nav>
                <a href="#" class="active">CARATTERISTICHE SCATOLA</a>
            </nav>
            <table
                class="alternating-rows table table-hover mb-5"
                v-if="product"
            >
                <tr>
                    <td class="td1">Tipologia:</td>
                    <td class="td2" v-if="product.category">
                        {{ product.category.name }}
                    </td>
                </tr>
                <tr>
                    <td class="td1">Cartone:</td>
                    <td class="td2">{{ product.color }}</td>
                </tr>
                <tr>
                    <td class="td1">Misure (cm):</td>
                    <td class="td2">
                        {{ product.length }} L x {{ product.width }} P x
                        {{ product.height }} H
                    </td>
                </tr>
                <tr>
                    <td class="td1">Stampa esterna:</td>
                    <td class="td2">{{ product.print }}</td>
                </tr>
                <tr>
                    <td class="td1">Peso scatola:</td>
                    <td class="td2">{{ product.weight }} kg</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import LoadingRollComponent from "../MainComponents/LoadingRollComponent.vue";
import QuantityProductsComponent from "../MainComponents/QuantityProductsComponent.vue";
import mixinCart from "../../mixins/mixinCart";

export default {
    components: {
        LoadingRollComponent,
        QuantityProductsComponent,
    },
    mixins: [mixinCart],
    data() {
        return {
            isReadOnly: true,
            product: null,
            priceDynamic: "",
            loadingProduct: true,
            quantity: 0,
        };
    },
    computed: {
        imageSource() {
            if (/^http/.test(this.product.img)) {
                return this.product.img;
            } else {
                return "/storage/" + this.product.img;
            }
        },
        totalPrice() {
            if (this.quantity >= 1) {
                this.priceDynamic = this.product.price;
            }
            if (this.quantity >= 100) {
                this.priceDynamic = this.product.first_price;
            }
            if (this.quantity >= 300) {
                this.priceDynamic = this.product.second_price;
            }
            if (this.quantity >= 500) {
                this.priceDynamic = this.product.third_price;
            }
            if (this.quantity >= 1000) {
                this.priceDynamic = this.product.fourth_price;
            }

            let priceSum = this.priceDynamic * this.quantity;

            const itemConaiWeight = Math.ceil((this.quantity * this.product.weight) / this.$store.state.conai_kg);
            const conai = Math.round(itemConaiWeight * this.$store.state.conai_eur * this.$store.state.iva_pro * 100) / 100;
            const iva = priceSum * this.$store.state.iva_pro;

            return priceSum + iva + conai;
        },
    },
    created() {
        this.getProduct();
    },
    mounted() {
        window.scrollTo(0, 0);
    },
    methods: {
        updateQuantity(quantity) {
            this.quantity = quantity;
        },
        getProduct() {
            this.loadingProduct = true;
            axios
                .get(`/shop/products/${this.$route.params.id}`)
                .then((response) => {
                    this.product = response.data.results;
                    this.loadingProduct = false;
                })
                .catch((error) => {
                    console.warn(error.message);
                });
        },
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

            alert("Added to Cart");
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
}
.current-price {
    font-weight: bold;
    color: #f68630;
}

.old-price {
    font-size: 0.8rem;
    font-weight: bold;
    color: lightgray;
    margin-right: 5px;

    text-decoration: line-through;
}

.price {
    font-weight: bold;
}

p {
    font-size: 0.8rem;
}

span {
    font-size: 0.8rem;
    margin-right: 3px;
}

strong {
    font-size: 0.6rem;
}

img {
    border: 1px solid lightgray;
    object-fit: contain;
    max-width: 100%;
    height: fit-content;

    width: 100%;
}

input {
    width: 50px;
    text-align: center;
    border: none;
}

// NAV BAR
nav {
    display: flex;
    align-items: center;
    margin: 1rem;
    border-bottom: 2px solid lightgray;

    a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
        font-size: 0.8rem;
        transition: all 0.2s;

        &:hover {
            color: #0076ff;
            font-size: 0.8rem;
        }

        &.active {
            position: relative;
            bottom: -2px;
            border-bottom: 2px solid #000;
        }
    }
}

// TABLE
table {
    width: 100%;
}

.alternating-rows tr:nth-child(odd) {
    background-color: rgba(211, 211, 211, 0.5);
}

.alternating-rows tr:nth-child(even) {
    background-color: rgba(211, 211, 211, 0.2);
}

td {
    font-size: 0.8rem;
    padding: 1rem;
    border: 1px solid white;
    min-width: 80px;
}

.td1 {
    font-weight: bold;
    width: 30%;
}

.td2 {
    color: orange;
    font-weight: bold;
}
</style>
