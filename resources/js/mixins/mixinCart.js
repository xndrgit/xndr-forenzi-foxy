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
            return (this.subtotal * 22) / 100;
        },
        iva() {
            // let iva = 0.00;
            // if (this.items) {
            //     this.items.map((item) => {
            //         iva += item.pivot.quantity * 4.35;
            //     });
            // }
            //
            // return iva;
            return 4.35;
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
