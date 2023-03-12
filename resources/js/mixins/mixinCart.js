import { mapGetters } from "vuex";

export default {
    data: () => ({
        items: null,
        isLoggedIn: false,
        cartTotal: 0,
        productCount: 0,
    }),
    computed: {
        ...mapGetters({
            checkAuth: "checkAuth",
        }),
        subtotal() {
            let subTotal = 0.0;
            if (this.items) {
                this.items.map((item) => {
                    subTotal +=
                        item.cart_quantity *
                        (item.price_saled ? item.price_saled : item.price);
                });
            }

            return subTotal;
        },
        conai() {
            let conai = 0.0;
            if (this.items) {
                this.items.map((item) => {
                    conai += item.cart_quantity * 4.35;
                });
            }

            return conai;
        },
        iva() {
            return (this.subtotal * 22) / 100;
        },
    },
    mounted() {
        this.items = this.getCartItems();
        this.cartTotal = this.$store.state.total;
        this.productCount = this.$store.state.productCount;
        this.isLoggedIn = this.checkAuth;
    },
    methods: {
        updateCartInfo(products) {
            let total = 0.0;
            if (products && products.length) {
                window.localStorage.setItem(
                    "foxy-cart-items",
                    JSON.stringify(products)
                );
            } else {
                window.localStorage.removeItem("foxy-cart-items");
            }

            if (this.items && this.items.length) {
                this.items.map((el) => {
                    total +=
                        el.cart_quantity *
                        (el.price_saled ? el.price_saled : el.price);

                    return el;
                });

                this.productCount = this.items.length;
            } else {
                this.productCount = 0;
            }

            this.cartTotal = total.toFixed(2);

            this.$store.commit("updateCart", {
                productCount: this.productCount,
                total: this.cartTotal,
            });

            window.VBus.fire("update-cart-total", {
                total: this.cartTotal,
                count: this.productCount,
            });

            this.$forceUpdate();
        },
        getCartItems() {
            if (window.localStorage.getItem("foxy-cart-items")) {
                return JSON.parse(
                    window.localStorage.getItem("foxy-cart-items")
                );
            } else {
                return null;
            }
        },
    },
    watch: {
        items(newItems, oldItems) {
            if (newItems !== oldItems) {
                this.updateCartInfo(newItems);
            }
        },
        checkAuth(newCheck, oldCheck) {
            if (newCheck !== oldCheck) {
                this.isLoggedIn = newCheck;
            }
        },
    },
};
