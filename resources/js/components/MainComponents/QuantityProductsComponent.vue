<template>
    <div class="quantity">
        <button @click="decrementQuantity" id="minus-button">-</button>
        <input
            class="font-weight-bold"
            type="number"
            v-model="quantity"
            readonly
            id="quantity-input"
        />
        <button @click="incrementQuantity" id="plus-button">+</button>
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
            this.quantity += this.product.purchasable_in_multi_of || 1;
        },
        decrementQuantity() {
            if (this.quantity >= (this.product.purchasable_in_multi_of || 1)) {
                this.quantity -= this.product.purchasable_in_multi_of || 1;
                if (this.quantity < this.product.purchasable_in_multi_of)
                    this.quantity = this.product.purchasable_in_multi_of;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.quantity {
    color: lightgray;
    display: flex;
    input {
        text-align: center;
        max-width: 40px;
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
