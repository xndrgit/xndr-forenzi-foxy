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
                    class="img-fluid p-2"
                    src="../../../../public/Links/misure-personalizzate-per-tabella.png"
                    alt="PersonaliseImage"
                />
            </a>
        </td>
        <td>
            <span v-if="!product.price_saled" class="price">
                € {{ product.price }}
            </span>
            <span v-if="product.price_saled" class="current-price">
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
import mixinCart from "../../mixins/mixinCart";

export default {
    mixins: [mixinCart],
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
    mounted() {
        this.aaa();
    },
    computed: {
        imageSource() {
            if (/^http/.test(this.product.img)) {
                return this.product.img;
            } else {
                return "/storage/" + this.product.img;
            }
        },
    },
    methods: {
        aaa() {
            this.code = this.product.code;
            this.value = this.product.purchasable_in_multi_of;
        },
        increaseValue() {
            if (this.value < this.product.quantity) {
                this.value += this.product.purchasable_in_multi_of || 1;
            }

            if (this.value > this.product.quantity) {
                this.value = this.product.quantity;
            }
        },
        decreaseValue() {
            if (this.value > 1 && this.value >= (this.product.purchasable_in_multi_of || 1)) {
                this.value -= this.product.purchasable_in_multi_of || 1;
                if (this.value < this.product.purchasable_in_multi_of)
                    this.value = this.product.purchasable_in_multi_of;
            }

            if (this.value < 1) {
                this.value = 1;
            }
        },
        addToCart() {
            let addedItem = Object.assign({}, this.product);
            this.items = this.getCartItems();

            if (!this.items) {
                this.items = [];
            }

            const filterIndex = this.items.findIndex(el => el.id === addedItem.id);
            if (filterIndex > -1 && filterIndex !== undefined && filterIndex !== null) {
                let updatedItems = JSON.parse(JSON.stringify(this.items));
                if (updatedItems[filterIndex]) {
                    updatedItems[filterIndex].cart_quantity += this.value;
                }

                this.items = updatedItems;
            } else {
                addedItem.cart_quantity = this.value;

                this.items = [
                    ...this.items,
                    addedItem
                ];
            }

            alert("Added to Cart");
        },
    },
};
</script>
<style lang="scss" scoped>
.current-price {
    color: #f68630;
    font-weight: bold;
}
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
            font-size: 0.75rem;
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
