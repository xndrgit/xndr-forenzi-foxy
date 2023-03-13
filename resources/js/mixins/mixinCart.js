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
                    const itemConaiWeight = Math.ceil((item.cart_quantity * item.weight) / this.$store.state.conai_kg);
                    conai += Math.round(itemConaiWeight * this.$store.state.conai_eur * this.$store.state.iva_pro * 100) / 100;
                });
            }

            return conai;
        },
        iva() {
            return this.subtotal * this.$store.state.iva_pro;
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
            let conai = 0.0;
            let iva = 0.0;
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

                    const itemConaiWeight = Math.ceil((el.cart_quantity * el.weight) / this.$store.state.conai_kg);
                    conai += Math.round(itemConaiWeight * this.$store.state.conai_eur * this.$store.state.iva_pro * 100) / 100;

                    return el;
                });

                this.productCount = this.items.length;
            } else {
                this.productCount = 0;
            }

            iva = total * this.$store.state.iva_pro;

            this.cartTotal = (total + iva + conai).toFixed(2);

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
