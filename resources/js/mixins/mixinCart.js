export default {
    data: () => ({
        items: null
    }),
    computed: {
        subtotal() {
            let subTotal = 0.00;
            if (this.items) {
                this.items.map((item) => {
                    subTotal += (item.pivot.quantity * (item.price_saled ? item.price_saled : item.price));
                });
            }

            return subTotal;
        },
        conai() {
            let conai = 0.00;
            if (this.items) {
                this.items.map((item) => {
                    conai += item.pivot.quantity * 4.35;
                });
            }

            return conai;
        },
        iva() {
            return (this.subtotal * 22) / 100;
        }
    },
    methods: {
        updateCartInfo(productCount, total, products) {
            this.$store.commit("updateCart", {
                productCount: productCount,
                total: parseFloat(total).toFixed(2),
            });

            this.$store.commit('setCartItems', products);

            if (!products || !products.length) {
                this.items = null;
            } else {
                this.items = JSON.parse(JSON.stringify(products));
            }

            this.$forceUpdate();
        }
    }
}
