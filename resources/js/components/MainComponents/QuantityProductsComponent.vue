<template>
    <div class="quantity">
        <button id="minus-button" :disabled="quantity < 1" @click="decrementQuantity">-</button>
        <input id="quantity-input" v-model="quantity" :max="product.quantity" :min="1" class="font-weight-bold"
               readonly type="number" @input="updateQuantity"/>
        <button id="plus-button" :disabled="quantity >= product.quantity" @click="incrementQuantity">+</button>
    </div>
</template>

<script>
export default {
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    components: {},
    data() {
        return {
            quantity: this.product.purchasable_in_multi_of || 1,
        };
    },
    methods: {
        incrementQuantity() {
            if (this.quantity < this.product.quantity) {
                this.quantity += this.product.purchasable_in_multi_of || 1;
            }

            if (this.quantity > this.product.quantity) {
                this.quantity = this.product.quantity;
            }

            this.$emit("update-quantity", this.quantity);
        },
        decrementQuantity() {
            if (this.quantity > 1 && this.quantity >= (this.product.purchasable_in_multi_of || 1)) {
                this.quantity -= this.product.purchasable_in_multi_of || 1;
                if (this.quantity < this.product.purchasable_in_multi_of)
                    this.quantity = this.product.purchasable_in_multi_of;
            }

            if (this.quantity < 1) {
                this.quantity = 1;
            }

            this.$emit("update-quantity", this.quantity);
        },
        updateQuantity() {
            this.$emit("update-quantity", this.quantity);
        },
    },
    mounted() {
        this.decrementQuantity();
    },
};
</script>

<style lang="scss" scoped>
.quantity {
    color: lightgray;
    display: flex;

    input {
        text-align: center;
        max-width: 45px;
        height: fit-content;
    }

    input,
    button {
        border: 2px solid rgb(231, 231, 231);
        font-size: 0.7rem;

        height: 30px;

        color: gray;
    }

    #minus-button,
    #plus-button {
        height: fit-content;
        background-color: white;

        text-align: center;
        font-weight: bold;
        cursor: pointer;

        height: 30px;

        padding-left: 5px;
        padding-right: 5px;
    }

    #minus-button:hover,
    #plus-button:hover {
        background-color: #fdbc48;
        color: black;
    }
}
</style>
